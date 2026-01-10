<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новий Feedback</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #1c1917; max-width: 600px; margin: 0 auto; padding: 20px;">

    <div style="background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%); padding: 24px; border-radius: 16px 16px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 24px;">
            @if($feedbackType === 'bug')
                🐛 Новий баг-репорт
            @elseif($feedbackType === 'feature')
                💡 Нова пропозиція
            @elseif($feedbackType === 'question')
                ❓ Нове питання
            @else
                📝 Новий feedback
            @endif
        </h1>
    </div>

    <div style="background: #fafaf9; border: 1px solid #e7e5e4; border-top: none; padding: 24px; border-radius: 0 0 16px 16px;">

        <div style="margin-bottom: 20px;">
            <span style="display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;
                @if($feedbackType === 'bug')
                    background: #fef2f2; color: #dc2626;
                @elseif($feedbackType === 'feature')
                    background: #faf5ff; color: #9333ea;
                @else
                    background: #eff6ff; color: #2563eb;
                @endif
            ">
                {{ $feedbackType === 'bug' ? 'Баг' : ($feedbackType === 'feature' ? 'Покращення' : 'Питання') }}
            </span>
            <span style="display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: #f5f5f4; color: #78716c; margin-left: 8px;">
                #{{ $issueNumber }}
            </span>
        </div>

        <h2 style="margin: 0 0 16px 0; color: #1c1917; font-size: 20px;">
            {{ $feedbackTitle }}
        </h2>

        <div style="background: white; border: 1px solid #e7e5e4; border-radius: 12px; padding: 16px; margin-bottom: 20px;">
            <p style="margin: 0; white-space: pre-wrap; color: #44403c;">{{ $feedbackBody }}</p>
        </div>

        <div style="border-top: 1px solid #e7e5e4; padding-top: 16px; margin-top: 16px;">
            <p style="margin: 0 0 8px 0; font-size: 14px; color: #78716c;">
                <strong>Від користувача:</strong> {{ $userEmail }}
            </p>
            <p style="margin: 0; font-size: 14px; color: #78716c;">
                <strong>Дата:</strong> {{ now()->format('d.m.Y H:i') }}
            </p>
        </div>

        <div style="margin-top: 24px;">
            <a href="{{ $issueUrl }}"
               style="display: inline-block; background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%); color: white; text-decoration: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 14px;">
                Відкрити в GitHub →
            </a>
        </div>

    </div>

    <p style="text-align: center; font-size: 12px; color: #a8a29e; margin-top: 24px;">
        Calorize Feedback System
    </p>

</body>
</html>
