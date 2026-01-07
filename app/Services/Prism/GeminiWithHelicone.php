<?php

declare(strict_types=1);

namespace App\Services\Prism;

use Generator;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Auth;
use Override;
use Prism\Prism\Concerns\InitializesClient;
use Prism\Prism\Contracts\Message;
use Prism\Prism\Embeddings\Request as EmbeddingRequest;
use Prism\Prism\Embeddings\Response as EmbeddingResponse;
use Prism\Prism\Exceptions\PrismException;
use Prism\Prism\Exceptions\PrismProviderOverloadedException;
use Prism\Prism\Exceptions\PrismRateLimitedException;
use Prism\Prism\Images\Request as ImagesRequest;
use Prism\Prism\Images\Response as ImagesResponse;
use Prism\Prism\Providers\Gemini\Handlers\Cache;
use Prism\Prism\Providers\Gemini\Handlers\Embeddings;
use Prism\Prism\Providers\Gemini\Handlers\Images;
use Prism\Prism\Providers\Gemini\Handlers\Stream;
use Prism\Prism\Providers\Gemini\Handlers\Structured;
use Prism\Prism\Providers\Gemini\Handlers\Text;
use Prism\Prism\Providers\Gemini\ValueObjects\GeminiCachedObject;
use Prism\Prism\Providers\Provider;
use Prism\Prism\Structured\Request as StructuredRequest;
use Prism\Prism\Structured\Response as StructuredResponse;
use Prism\Prism\Text\Request as TextRequest;
use Prism\Prism\Text\Response as TextResponse;
use Prism\Prism\ValueObjects\Messages\SystemMessage;
use SensitiveParameter;

/**
 * Custom Gemini provider that routes requests through Helicone for monitoring.
 * 
 * This extends the standard Gemini provider to add Helicone headers,
 * allowing all Gemini API calls to be logged and monitored via Helicone.
 */
class GeminiWithHelicone extends Provider
{
    use InitializesClient;

    public function __construct(
        #[SensitiveParameter] public readonly string $apiKey,
        public readonly string $url,
        protected readonly ?string $heliconeApiKey = null,
    ) {}

    #[Override]
    public function text(TextRequest $request): TextResponse
    {
        $handler = new Text(
            $this->client($request->clientOptions(), $request->clientRetry()),
            $this->apiKey
        );

        return $handler->handle($request);
    }

    /**
     * @param  array<string, mixed>  $options
     * @param  array<mixed>  $retry
     */
    protected function client(array $options = [], array $retry = [], ?string $baseUrl = null): PendingRequest
    {
        $headers = [
            'x-goog-api-key' => $this->apiKey,
        ];

        if ($this->heliconeApiKey) {
            $headers['Helicone-Auth'] = 'Bearer ' . $this->heliconeApiKey;
            $headers['Helicone-Target-URL'] = 'https://generativelanguage.googleapis.com';

            $userId = Auth::id();
            if ($userId) {
                $headers['Helicone-User-Id'] = (string) $userId;
            }

            $headers['Helicone-Property-App'] = config('app.name');
            $headers['Helicone-Property-Environment'] = app()->environment();
            $headers['Helicone-Property-Feature'] = 'diary_agent';
        }

        return $this->baseClient()
            ->withHeaders($headers)
            ->withOptions($options)
            ->when($retry !== [], fn ($client) => $client->retry(...$retry)) // @phpstan-ignore argument.type
            ->baseUrl($baseUrl ?? $this->url);
    }

    #[Override]
    public function structured(StructuredRequest $request): StructuredResponse
    {
        $handler = new Structured($this->client(
            $request->clientOptions(),
            $request->clientRetry()
        ));

        return $handler->handle($request);
    }

    #[Override]
    public function embeddings(EmbeddingRequest $request): EmbeddingResponse
    {
        $handler = new Embeddings($this->client(
            $request->clientOptions(),
            $request->clientRetry()
        ));

        return $handler->handle($request);
    }

    #[Override]
    public function images(ImagesRequest $request): ImagesResponse
    {
        $handler = new Images($this->client(
            $request->clientOptions(),
            $request->clientRetry()
        ));

        return $handler->handle($request);
    }

    #[Override]
    public function stream(TextRequest $request): Generator
    {
        $handler = new Stream(
            $this->client($request->clientOptions(), $request->clientRetry()),
            $this->apiKey
        );

        return $handler->handle($request);
    }

    /**
     * @param  Message[]  $messages
     * @param  array<SystemMessage|string>  $systemPrompts
     */
    public function cache(string $model, array $messages = [], array $systemPrompts = [], ?int $ttl = null): GeminiCachedObject
    {
        if ($messages === [] && $systemPrompts === []) {
            throw new PrismException('At least one message or system prompt must be provided');
        }

        $systemPrompts = array_map(
            fn (SystemMessage|string $prompt): SystemMessage => $prompt instanceof SystemMessage ? $prompt : new SystemMessage($prompt),
            $systemPrompts
        );

        $handler = new Cache(
            client: $this->client(
                baseUrl: 'https://generativelanguage.googleapis.com/v1beta'
            ),
            model: $model,
            messages: $messages,
            systemPrompts: $systemPrompts,
            ttl: $ttl
        );

        try {
            return $handler->handle();
        } catch (RequestException $requestException) {
            $this->handleRequestException($model, $requestException);
        }
    }

    #[Override]
    public function handleRequestException(string $model, RequestException $e): never
    {
        match ($e->response->getStatusCode()) {
            429 => throw PrismRateLimitedException::make([]),
            503 => throw PrismProviderOverloadedException::make(class_basename($this)),
            default => throw PrismException::providerRequestError($model, $e),
        };
    }
}

