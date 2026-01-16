<div
    x-data="{ clearSuccessTimeout: null }"
    x-init="
        $wire.on('clear-success', () => {
            clearTimeout(clearSuccessTimeout);
            clearSuccessTimeout = setTimeout(() => $wire.clearSuccess(), 5000);
        })
    "
    class="pb-12"
>
    @section('title', __('reviews.title'))

    {{-- Success Toast --}}
    @if($successMessage)
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="fixed top-20 sm:top-24 left-1/2 -translate-x-1/2 z-50 max-w-[92vw] sm:max-w-md rounded-2xl bg-emerald-600 text-white px-5 py-3 shadow-2xl shadow-emerald-600/20 font-medium"
        >
            {{ $successMessage }}
        </div>
    @endif

    {{-- Hero Section --}}
    <section class="pt-8 sm:pt-12">
        <div class="text-center max-w-2xl mx-auto">
            <div class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white/70 backdrop-blur px-3.5 py-2 text-xs font-semibold text-stone-700">
                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                <span>{{ __('reviews.eyebrow') }}</span>
            </div>

            <h1 class="mt-5 text-3xl sm:text-4xl font-extrabold tracking-tight text-stone-900">
                {{ __('reviews.heading') }}
            </h1>

            <p class="mt-3 text-base sm:text-lg text-stone-600 leading-relaxed">
                {{ __('reviews.subheading') }}
            </p>
        </div>

        {{-- Stats --}}
        @if($stats['count'] > 0)
            <div class="mt-8 flex justify-center gap-4 sm:gap-6">
                <div class="rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-5 py-3 text-center">
                    <div class="text-2xl font-extrabold text-amber-600">{{ $stats['average'] }}</div>
                    <div class="flex items-center justify-center gap-0.5 mt-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="h-4 w-4 {{ $i <= round($stats['average']) ? 'text-amber-400' : 'text-stone-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <div class="text-xs text-stone-500 mt-1">{{ __('reviews.average_rating') }}</div>
                </div>

                <div class="rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-5 py-3 text-center">
                    <div class="text-2xl font-extrabold text-stone-900">{{ $stats['count'] }}</div>
                    <div class="text-xs text-stone-500 mt-1">{{ trans_choice('reviews.reviews_count', $stats['count']) }}</div>
                </div>
            </div>
        @endif
    </section>

    {{-- Write Review CTA --}}
    <section class="mt-10 sm:mt-12">
        <div class="rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
            @guest
                {{-- Not logged in --}}
                <div class="px-6 py-8 sm:p-10 text-center">
                    <div class="h-14 w-14 mx-auto rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-bold text-stone-900">{{ __('reviews.share_experience') }}</h3>
                    <p class="mt-2 text-sm text-stone-600">{{ __('reviews.login_to_review') }}</p>
                    <div class="mt-5 flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="{{ route('login') }}"
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 transition">
                            {{ __('auth.login') }}
                        </a>
                        <a href="{{ route('register') }}"
                           class="w-full sm:w-auto inline-flex items-center justify-center rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-5 py-3 text-sm font-semibold text-stone-800 hover:bg-white transition">
                            {{ __('auth.register') }}
                        </a>
                    </div>
                </div>
            @else
                @if($userReview)
                    {{-- Already submitted --}}
                    <div class="px-6 py-8 sm:p-10">
                        <div class="flex items-start gap-4">
                            <div class="h-12 w-12 rounded-full bg-emerald-500/10 text-emerald-700 flex items-center justify-center shrink-0">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-stone-900">{{ __('reviews.thank_you') }}</h3>
                                <p class="mt-1 text-sm text-stone-600">
                                    @if($userReview->is_approved)
                                        {{ __('reviews.your_review_visible') }}
                                    @else
                                        {{ __('reviews.awaiting_moderation') }}
                                    @endif
                                </p>

                                {{-- Show user's own review --}}
                                <div class="mt-4 rounded-2xl border border-stone-200 bg-stone-50 p-4">
                                    <div class="flex items-center gap-0.5 mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="h-4 w-4 {{ $i <= $userReview->rating ? 'text-amber-400' : 'text-stone-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-sm text-stone-700">{{ $userReview->text }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(!Auth::user()->hasVerifiedEmail())
                    {{-- Email not verified --}}
                    <div class="px-6 py-8 sm:p-10 text-center">
                        <div class="h-14 w-14 mx-auto rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-bold text-stone-900">{{ __('reviews.verify_email_title') }}</h3>
                        <p class="mt-2 text-sm text-stone-600 max-w-md mx-auto">{{ __('reviews.verify_email_text') }}</p>
                        <button
                            wire:click="resendVerification"
                            wire:loading.attr="disabled"
                            class="mt-5 inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-amber-600/20 hover:bg-amber-700 transition disabled:opacity-50"
                        >
                            <span wire:loading.remove wire:target="resendVerification">{{ __('reviews.resend_verification') }}</span>
                            <span wire:loading wire:target="resendVerification">{{ __('reviews.sending') }}</span>
                        </button>
                        <p class="mt-3 text-xs text-stone-500">{{ Auth::user()->email }}</p>
                    </div>
                @elseif($showForm)
                    {{-- Review Form --}}
                    <div class="px-6 py-8 sm:p-10">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-stone-900">{{ __('reviews.write_review') }}</h3>
                            <button
                                wire:click="closeForm"
                                class="h-10 w-10 rounded-xl border border-stone-200 bg-white grid place-items-center text-stone-500 hover:text-stone-700 hover:bg-stone-50 transition"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form wire:submit="submit" class="space-y-5">
                            {{-- Name fields --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="firstName" class="block text-sm font-semibold text-stone-700 mb-1.5">
                                        {{ __('reviews.first_name') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="firstName"
                                        wire:model="firstName"
                                        class="w-full h-12 rounded-2xl border-stone-200 text-sm px-4 focus:border-amber-500 focus:ring-amber-500"
                                        placeholder="{{ __('reviews.first_name_placeholder') }}"
                                    >
                                    @error('firstName')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="lastName" class="block text-sm font-semibold text-stone-700 mb-1.5">
                                        {{ __('reviews.last_name') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="lastName"
                                        wire:model="lastName"
                                        class="w-full h-12 rounded-2xl border-stone-200 text-sm px-4 focus:border-amber-500 focus:ring-amber-500"
                                        placeholder="{{ __('reviews.last_name_placeholder') }}"
                                    >
                                    @error('lastName')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Instagram --}}
                            <div>
                                <label for="instagram" class="block text-sm font-semibold text-stone-700 mb-1.5">
                                    {{ __('reviews.instagram') }}
                                    <span class="text-stone-400 font-normal">({{ __('reviews.optional') }})</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-stone-400">@</span>
                                    <input
                                        type="text"
                                        id="instagram"
                                        wire:model="instagram"
                                        class="w-full h-12 rounded-2xl border-stone-200 text-sm pl-8 pr-4 focus:border-amber-500 focus:ring-amber-500"
                                        placeholder="username"
                                    >
                                </div>
                                @error('instagram')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Rating --}}
                            <div>
                                <label class="block text-sm font-semibold text-stone-700 mb-2">
                                    {{ __('reviews.your_rating') }} <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button
                                            type="button"
                                            wire:click="setRating({{ $i }})"
                                            class="p-1 rounded-lg hover:bg-amber-50 transition focus:outline-none focus:ring-2 focus:ring-amber-500"
                                        >
                                            <svg class="h-8 w-8 {{ $i <= $rating ? 'text-amber-400' : 'text-stone-200' }} transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    @endfor
                                    <span class="ml-2 text-sm font-semibold text-stone-600">{{ $rating }}/5</span>
                                </div>
                                @error('rating')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Review text --}}
                            <div>
                                <label for="text" class="block text-sm font-semibold text-stone-700 mb-1.5">
                                    {{ __('reviews.your_review') }} <span class="text-red-500">*</span>
                                </label>
                                <textarea
                                    id="text"
                                    wire:model="text"
                                    rows="4"
                                    class="w-full rounded-2xl border-stone-200 text-sm p-4 focus:border-amber-500 focus:ring-amber-500 resize-none"
                                    placeholder="{{ __('reviews.review_placeholder') }}"
                                ></textarea>
                                <div class="flex items-center justify-between mt-1">
                                    @error('text')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @else
                                        <p class="text-xs text-stone-400">{{ __('reviews.min_characters') }}</p>
                                    @enderror
                                    <p class="text-xs text-stone-400">{{ strlen($text) }}/2000</p>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                class="w-full h-12 rounded-2xl bg-amber-600 text-white text-sm font-semibold shadow-lg shadow-amber-600/20 hover:bg-amber-700 active:scale-[0.99] transition disabled:opacity-50 flex items-center justify-center gap-2"
                            >
                                <span wire:loading.remove wire:target="submit">{{ __('reviews.submit_review') }}</span>
                                <span wire:loading wire:target="submit">{{ __('reviews.submitting') }}</span>
                            </button>
                        </form>
                    </div>
                @else
                    {{-- CTA to write review --}}
                    <div class="px-6 py-8 sm:p-10 text-center">
                        <div class="h-14 w-14 mx-auto rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-bold text-stone-900">{{ __('reviews.share_experience') }}</h3>
                        <p class="mt-2 text-sm text-stone-600 max-w-md mx-auto">{{ __('reviews.share_experience_text') }}</p>
                        <button
                            wire:click="openForm"
                            class="mt-5 inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-amber-600/20 hover:bg-amber-700 transition"
                        >
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            {{ __('reviews.write_review') }}
                        </button>
                    </div>
                @endif
            @endguest
        </div>
    </section>

    {{-- Reviews List --}}
    @if($reviews->count() > 0)
        <section class="mt-10 sm:mt-12">
            <h2 class="text-xl sm:text-2xl font-extrabold text-stone-900 mb-6">{{ __('reviews.all_reviews') }}</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($reviews as $review)
                    <div class="rounded-[1.5rem] border border-stone-200 bg-white/80 backdrop-blur p-5 sm:p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-4">
                            <img
                                src="{{ $review->gravatar_url }}"
                                alt="{{ $review->first_name }}"
                                class="h-12 w-12 rounded-full border-2 border-stone-100 shrink-0"
                            >
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center flex-wrap gap-2">
                                    <h4 class="font-bold text-stone-900">{{ $review->first_name }} {{ $review->last_name }}</h4>
                                    @if($review->instagram)
                                        <a
                                            href="https://instagram.com/{{ ltrim($review->instagram, '@') }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="text-xs text-amber-600 hover:text-amber-700 font-medium"
                                        >
                                            {{ $review->instagram_handle }}
                                        </a>
                                    @endif
                                </div>
                                <div class="flex items-center gap-1 mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-amber-400' : 'text-stone-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                    <span class="text-xs text-stone-400 ml-2">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-stone-700 leading-relaxed">{{ $review->text }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @else
        {{-- No reviews yet --}}
        <section class="mt-10 sm:mt-12">
            <div class="rounded-[1.75rem] border border-dashed border-stone-300 bg-stone-50/50 p-10 sm:p-12 text-center">
                <div class="h-16 w-16 mx-auto rounded-2xl bg-stone-100 text-stone-400 flex items-center justify-center">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h3 class="mt-5 text-lg font-bold text-stone-700">{{ __('reviews.no_reviews_yet') }}</h3>
                <p class="mt-2 text-sm text-stone-500">{{ __('reviews.be_first') }}</p>
            </div>
        </section>
    @endif
</div>
