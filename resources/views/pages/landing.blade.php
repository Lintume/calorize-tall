<x-app-layout :full-width="true">
    @section('title', __('landing.meta.title'))

    @section('meta')
        <meta name="description" content="{{ __('landing.meta.description') }}">
        <meta name="keywords" content="{{ __('landing.meta.keywords') }}">
        <meta name="author" content="Calorize">
    @endsection

    @php
        $primaryUrl = auth()->check() ? route('diary') : route('register');
        $primaryLabel = auth()->check() ? __('landing.hero.cta_primary_auth') : __('landing.hero.cta_primary_guest');
        $secondaryUrl = auth()->check() ? route('diary') : route('login');
    @endphp

    <div class="min-h-screen bg-[radial-gradient(1200px_circle_at_20%_-10%,rgba(245,158,11,0.18),transparent_55%),radial-gradient(900px_circle_at_90%_10%,rgba(14,165,233,0.16),transparent_50%),linear-gradient(to_bottom,rgba(250,250,249,1),rgba(255,255,255,1))]">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <!-- HERO -->
                <section class="pt-10 sm:pt-12 lg:pt-16 pb-10 sm:pb-14 lg:pb-20">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                        <div class="lg:col-span-6">
                            <div class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white/70 backdrop-blur px-3.5 py-2 text-xs font-semibold text-stone-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                <span>{{ __('landing.hero.eyebrow') }}</span>
                            </div>

                            <div class="mt-6">
                                <h1 class="text-[clamp(2.1rem,5vw,3.35rem)] leading-[1.04] font-extrabold tracking-tight text-stone-900">
                                    <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                                        {{ __('landing.hero.title') }}
                                    </span>
                                </h1>
                                <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600 max-w-xl">
                                    {{ __('landing.hero.subtitle') }}
                                </p>
                            </div>

                            <div class="mt-7 flex flex-col sm:flex-row sm:items-center gap-3">
                                <a href="{{ $primaryUrl }}"
                                   class="inline-flex items-center justify-center gap-2 rounded-2xl bg-stone-900 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 transition">
                                    <span>{{ $primaryLabel }}</span>
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                @guest
                                    <a href="{{ $secondaryUrl }}"
                                       class="inline-flex items-center justify-center rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-5 py-3.5 text-sm font-semibold text-stone-800 hover:bg-white transition">
                                        {{ __('landing.hero.cta_secondary') }}
                                    </a>
                                @endguest
                            </div>

                            <p class="mt-4 text-xs sm:text-sm text-stone-500 max-w-xl">
                                {{ __('landing.hero.note') }}
                            </p>

                            <div class="mt-8 grid grid-cols-2 gap-3 sm:gap-4">
                                <div class="rounded-2xl border border-stone-200 bg-white/70 backdrop-blur p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-9 w-9 rounded-xl bg-amber-500/10 text-amber-700 flex items-center justify-center">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M4 6h16M4 12h10M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-semibold text-stone-800">{{ __('landing.proof.foods') }}</div>
                                    </div>
                                </div>
                                <div class="rounded-2xl border border-stone-200 bg-white/70 backdrop-blur p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-9 w-9 rounded-xl bg-sky-500/10 text-sky-700 flex items-center justify-center">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M12 3a3 3 0 0 1 3 3v5a3 3 0 0 1-6 0V6a3 3 0 0 1 3-3Z" stroke="currentColor" stroke-width="2"/>
                                                <path d="M19 11a7 7 0 0 1-14 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                <path d="M12 18v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-semibold text-stone-800">{{ __('landing.proof.voice') }}</div>
                                    </div>
                                </div>
                                <div class="rounded-2xl border border-stone-200 bg-white/70 backdrop-blur p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-9 w-9 rounded-xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M12 3l7 4v10l-7 4-7-4V7l7-4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                                <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-semibold text-stone-800">{{ __('landing.proof.memory') }}</div>
                                    </div>
                                </div>
                                <div class="rounded-2xl border border-stone-200 bg-white/70 backdrop-blur p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-9 w-9 rounded-xl bg-violet-500/10 text-violet-700 flex items-center justify-center">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M4 7h16M7 7v14m10-14v14M4 21h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-semibold text-stone-800">{{ __('landing.proof.recipes') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PHONE MOCK -->
                        <div class="lg:col-span-6">
                            <div class="relative">
                                <div class="absolute -inset-4 sm:-inset-6 rounded-[2.25rem] bg-gradient-to-br from-amber-400/20 via-white/30 to-sky-400/20 blur-2xl"></div>

                                <div class="relative mx-auto w-full max-w-[430px]">
                                    <div class="rounded-[2.2rem] border border-stone-200 bg-white/80 backdrop-blur shadow-2xl shadow-stone-900/10 overflow-hidden">
                                        <div class="px-5 pt-5 pb-3 border-b border-stone-200/60 bg-white/60">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-10 w-10 rounded-2xl bg-white border border-stone-200 flex items-center justify-center overflow-hidden">
                                                        <img
                                                            src="/favicon/favicon.svg"
                                                            onerror="this.onerror=null;this.src='/favicon/favicon-96x96.png';"
                                                            alt="Calorize"
                                                            class="h-7 w-7"
                                                        />
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-semibold text-stone-900">Calorize</div>
                                                        <div class="text-xs text-stone-500">{{ __('landing.demo.subtitle') }}</div>
                                                    </div>
                                                </div>
                                                <div class="h-10 w-10 rounded-2xl bg-stone-100 text-stone-700 flex items-center justify-center">
                                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                        <path d="M12 20a8 8 0 1 0-8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                        <path d="M4 12a8 8 0 0 0 8 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.35"/>
                                                        <path d="M12 12l4-2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-5 bg-[linear-gradient(to_bottom,rgba(250,250,249,1),rgba(245,245,244,1))]">
                                            <div class="grid grid-cols-12 gap-4">
                                                <div class="col-span-5 rounded-2xl border border-stone-200 bg-white p-4">
                                                    <div class="text-[11px] font-semibold text-stone-500">{{ __('landing.mock.today') }}</div>
                                                    <div class="mt-2 flex items-center gap-3">
                                                        <div class="h-14 w-14 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center font-extrabold">
                                                            1 420
                                                        </div>
                                                        <div>
                                                            <div class="text-xs text-stone-500">kcal</div>
                                                            <div class="text-sm font-semibold text-stone-800">{{ __('landing.mock.in_budget') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 space-y-2">
                                                        <div class="flex items-center justify-between text-[11px] text-stone-600">
                                                            <span>Б</span><span class="font-semibold text-stone-800">86</span>
                                                        </div>
                                                        <div class="h-1.5 rounded-full bg-stone-100 overflow-hidden">
                                                            <div class="h-full w-[62%] bg-emerald-500/70 rounded-full"></div>
                                                        </div>
                                                        <div class="flex items-center justify-between text-[11px] text-stone-600">
                                                            <span>Ж</span><span class="font-semibold text-stone-800">44</span>
                                                        </div>
                                                        <div class="h-1.5 rounded-full bg-stone-100 overflow-hidden">
                                                            <div class="h-full w-[48%] bg-amber-500/70 rounded-full"></div>
                                                        </div>
                                                        <div class="flex items-center justify-between text-[11px] text-stone-600">
                                                            <span>В</span><span class="font-semibold text-stone-800">156</span>
                                                        </div>
                                                        <div class="h-1.5 rounded-full bg-stone-100 overflow-hidden">
                                                            <div class="h-full w-[72%] bg-sky-500/70 rounded-full"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-span-7 rounded-2xl border border-stone-200 bg-white p-4">
                                                    <div class="flex items-center justify-between">
                                                        <div class="text-[11px] font-semibold text-stone-500">{{ __('landing.mock.lunch') }}</div>
                                                        <div class="text-[11px] text-stone-500">12:40</div>
                                                    </div>
                                                    <div class="mt-3 space-y-2">
                                                        <div class="flex items-center justify-between text-xs">
                                                            <span class="text-stone-800 font-medium">Борщ домашній</span>
                                                            <span class="text-stone-500">350 г</span>
                                                        </div>
                                                        <div class="flex items-center justify-between text-xs">
                                                            <span class="text-stone-800 font-medium">Яйця</span>
                                                            <span class="text-stone-500">120 г</span>
                                                        </div>
                                                        <div class="flex items-center justify-between text-xs">
                                                            <span class="text-stone-800 font-medium">Кава + молоко</span>
                                                            <span class="text-stone-500">250 мл</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4 rounded-2xl border border-stone-200 bg-white overflow-hidden">
                                                <div class="px-4 py-3 border-b border-stone-200/60 bg-white/70 flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <div class="h-7 w-7 rounded-xl bg-amber-500/10 text-amber-700 flex items-center justify-center font-bold text-xs">AI</div>
                                                    </div>
                                                    <div class="h-8 w-8 rounded-xl bg-stone-100 flex items-center justify-center text-stone-700">
                                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                            <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                        </svg>
                                                    </div>
                                                </div>

                                                <div class="px-4 py-4 bg-stone-50 space-y-3">
                                                    <div class="flex justify-end">
                                                        <div class="max-w-[90%] rounded-2xl rounded-br-md bg-stone-900 text-white px-4 py-2.5 text-sm shadow-sm">
                                                            {{ __('landing.demo.micro_1') }}
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-start">
                                                        <div class="max-w-[92%] rounded-2xl rounded-bl-md bg-white border border-stone-200 px-4 py-2.5 text-sm text-stone-800 shadow-sm">
                                                            <div class="text-xs font-semibold text-stone-500 mb-1">{{ __('landing.mock.memory') }}</div>
                                                            <div class="text-sm">{{ __('landing.demo.memory_line') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-start">
                                                        <div class="max-w-[92%] rounded-2xl rounded-bl-md bg-white border border-stone-200 px-4 py-2.5 text-sm text-stone-800 shadow-sm">
                                                            <div>{{ __('landing.demo.assistant_reply') }}</div>
                                                            <div class="mt-2 text-xs text-stone-500">{{ __('landing.demo.assistant_reply_2') }}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="px-4 py-3 bg-white border-t border-stone-200/60">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex-1 rounded-xl border border-stone-200 bg-white px-3 py-2 text-xs text-stone-500">
                                                            {{ __('landing.demo.title') }}
                                                        </div>
                                                        <div class="h-10 w-10 rounded-xl bg-stone-100 text-stone-700 flex items-center justify-center border border-stone-200">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                                <path d="M12 3a3 3 0 0 1 3 3v5a3 3 0 0 1-6 0V6a3 3 0 0 1 3-3Z" stroke="currentColor" stroke-width="2"/>
                                                                <path d="M19 11a7 7 0 0 1-14 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                                <path d="M12 18v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                            </svg>
                                                        </div>
                                                        <div class="h-10 w-10 rounded-xl bg-amber-600 text-white flex items-center justify-center">
                                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                                <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 flex flex-wrap justify-center gap-2 text-xs text-stone-500">
                                    <span class="rounded-full border border-stone-200 bg-white/70 backdrop-blur px-3 py-1.5">{{ __('landing.demo.micro_1') }}</span>
                                    <span class="rounded-full border border-stone-200 bg-white/70 backdrop-blur px-3 py-1.5">{{ __('landing.demo.micro_2') }}</span>
                                    <span class="rounded-full border border-stone-200 bg-white/70 backdrop-blur px-3 py-1.5">{{ __('landing.demo.micro_3') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- AI CAN -->
                    <div class="mt-10 sm:mt-12">
                        <div class="rounded-[2.2rem] border border-stone-200 bg-white/70 backdrop-blur p-6 sm:p-8">
                            <div class="flex items-start justify-between gap-6">
                                <div class="max-w-2xl">
                                    <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                        {{ __('landing.ai_can.title') }}
                                    </h2>
                                    <p class="mt-2 text-sm sm:text-base text-stone-600 leading-relaxed">
                                        {{ __('landing.ai_can.subtitle') }}
                                    </p>
                                </div>
                                <div class="hidden sm:flex h-12 w-12 rounded-2xl bg-stone-900 text-white items-center justify-center">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M12 2v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M8 22h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M9 19h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M6 9a6 6 0 0 1 12 0c0 2.3-1.2 3.7-2.3 4.8-.8.8-1.7 1.8-1.7 3.2H10c0-1.4-.9-2.4-1.7-3.2C7.2 12.7 6 11.3 6 9Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                                @foreach (__('landing.ai_can.items') as $item)
                                    <div class="rounded-2xl border border-stone-200 bg-white p-5">
                                        <div class="text-sm font-bold text-stone-900">{{ $item['title'] }}</div>
                                        <div class="mt-2 text-sm text-stone-600">
                                            <span class="text-stone-400">→</span>
                                            <span class="font-medium text-stone-800">{{ $item['example'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- WHY -->
        <section class="py-12 sm:py-16 lg:py-20 border-t border-stone-200/60 bg-white/40 backdrop-blur">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="max-w-6xl mx-auto">
                    <div class="max-w-2xl">
                        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-stone-900">
                            {{ __('landing.sections.why_title') }}
                        </h2>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                        @foreach (__('landing.sections.why_items') as $item)
                            <div class="rounded-3xl border border-stone-200 bg-white/70 backdrop-blur p-6 shadow-sm">
                                <div class="text-base font-bold text-stone-900">{{ $item['title'] }}</div>
                                <p class="mt-3 text-sm leading-relaxed text-stone-600">{{ $item['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- FREE -->
        <section class="py-12 sm:py-16 lg:py-20">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="max-w-6xl mx-auto">
                    <div class="rounded-[2.2rem] border border-stone-200 bg-gradient-to-br from-stone-900 via-stone-900 to-stone-800 text-white overflow-hidden">
                        <div class="p-8 sm:p-10 lg:p-12">
                            <div class="max-w-2xl">
                                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                                    {{ __('landing.sections.free_title') }}
                                </h2>
                                <p class="mt-4 text-sm sm:text-base leading-relaxed text-stone-300">
                                    {{ __('landing.sections.free_text') }}
                                </p>
                            </div>

                            <div class="mt-10 rounded-3xl border border-white/10 bg-white/5 p-6 sm:p-7">
                                <div class="text-sm font-semibold text-white/90">
                                    {{ __('landing.sections.geek_title') }}
                                </div>
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @foreach (__('landing.sections.geek_items') as $item)
                                        <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                            <div class="text-sm font-semibold">{{ $item['title'] }}</div>
                                            <div class="mt-2 text-xs text-stone-300 leading-relaxed">{{ $item['text'] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="pb-12 sm:pb-16 lg:pb-20">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="max-w-6xl mx-auto">
                    <div class="rounded-[2.2rem] border border-stone-200 bg-white/80 backdrop-blur p-8 sm:p-10 lg:p-12 shadow-xl shadow-stone-900/5">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                            <div class="lg:col-span-8">
                                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('landing.cta.title') }}
                                </h2>
                                <p class="mt-3 text-sm sm:text-base text-stone-600 leading-relaxed max-w-2xl">
                                    {{ __('landing.cta.subtitle') }}
                                </p>
                            </div>
                            <div class="lg:col-span-4 flex lg:justify-end">
                                <a href="{{ $primaryUrl }}"
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-600 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-amber-600/20 hover:bg-amber-700 transition">
                                    <span>{{ auth()->check() ? __('landing.cta.button_auth') : __('landing.cta.button_guest') }}</span>
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center gap-4 text-xs text-stone-500">
                            <a class="hover:text-stone-800 transition" href="{{ route('about') }}">{{ __('About us') }}</a>
                            <span class="text-stone-300">•</span>
                            <a class="hover:text-stone-800 transition" href="{{ route('privacy') }}">{{ __('Privacy Policy') }}</a>
                            <span class="text-stone-300">•</span>
                            <a class="hover:text-stone-800 transition" href="{{ route('blog') }}">{{ __('Blog') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sticky mobile CTA -->
        @guest
            <div class="sm:hidden fixed inset-x-0 bottom-0 z-40">
                <div class="px-4 pb-4">
                    <div class="rounded-2xl border border-stone-200 bg-white/85 backdrop-blur shadow-2xl shadow-stone-900/10 p-3 flex items-center gap-3">
                        <div class="flex-1">
                            <div class="text-xs font-semibold text-stone-900">{{ __('landing.hero.eyebrow') }}</div>
                            <div class="text-[11px] text-stone-500">{{ __('landing.hero.note') }}</div>
                        </div>
                        <a href="{{ route('register') }}" class="shrink-0 inline-flex items-center justify-center rounded-xl bg-stone-900 px-4 py-2.5 text-xs font-semibold text-white">
                            {{ __('landing.hero.cta_primary_guest') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="h-24"></div>
        @endguest
    </div>
</x-app-layout>

