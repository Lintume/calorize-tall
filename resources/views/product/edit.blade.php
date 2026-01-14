<x-app-layout :full-width="true">
    @section('title', __('Edit Product'))

    <div class="min-h-screen bg-[radial-gradient(1200px_circle_at_20%_-10%,rgba(245,158,11,0.16),transparent_55%),radial-gradient(900px_circle_at_90%_10%,rgba(14,165,233,0.14),transparent_50%),linear-gradient(to_bottom,rgba(250,250,249,1),rgba(255,255,255,1))]">
        <div class="px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
            <div class="max-w-6xl mx-auto space-y-8">
                {{-- Hero --}}
                <div class="relative overflow-hidden rounded-[1.75rem] border border-stone-200 bg-white/90 backdrop-blur shadow-xl shadow-stone-900/5 p-6 sm:p-8">
                    <div class="absolute inset-0 bg-[radial-gradient(1200px_circle_at_10%_-20%,rgba(245,158,11,0.15),transparent_55%),radial-gradient(900px_circle_at_95%_-20%,rgba(14,165,233,0.12),transparent_55%)]"></div>
                    <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <div class="space-y-3">
                            <div class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white/80 px-3 py-1.5 text-[11px] font-semibold text-stone-700">
                                <i class="fas fa-pen text-amber-600"></i>
                                <span>{{ __('Edit Product') }}</span>
                            </div>
                            <h1 class="text-[clamp(2rem,3vw,2.8rem)] font-extrabold leading-[1.05] text-stone-900">
                                {{ __('Refresh macros, keep diary accurate') }}
                            </h1>
                            <p class="text-sm sm:text-base text-stone-600 max-w-2xl">
                                {{ __('Update per-100g values so AI search, voice, and manual diary entries stay consistent across all meals.') }}
                            </p>
                            <div class="flex flex-wrap gap-2 text-[11px] font-semibold text-stone-700">
                                <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/70 px-3 py-1.5">
                                    <i class="fas fa-wand-magic-sparkles text-amber-600"></i>{{ __('AI-ready') }}
                                </span>
                                <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/70 px-3 py-1.5">
                                    <i class="fas fa-bolt text-emerald-600"></i>{{ __('Per 100 g macros') }}
                                </span>
                                <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/70 px-3 py-1.5">
                                    <i class="fas fa-book-open text-sky-600"></i>{{ __('Diary-first flow') }}
                                </span>
                            </div>
                        </div>
                        <div class="w-full lg:w-auto">
                            <div class="mx-auto w-full max-w-xs">
                                <div class="rounded-[1.5rem] border border-stone-200 bg-white shadow-lg shadow-stone-900/10 p-5 space-y-3">
                                    <div class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500 text-center">{{ __('Before you save') }}</div>
                                    <div class="space-y-2 text-sm text-stone-700">
                                        <div class="flex items-start gap-2">
                                            <span class="h-6 w-6 rounded-lg bg-amber-500/10 border border-amber-200 text-amber-700 grid place-items-center text-xs font-bold">1</span>
                                            <span>{{ __('Keep macros per 100 g') }}</span>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <span class="h-6 w-6 rounded-lg bg-amber-500/10 border border-amber-200 text-amber-700 grid place-items-center text-xs font-bold">2</span>
                                            <span>{{ __('Double-check numbers to avoid duplicates') }}</span>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <span class="h-6 w-6 rounded-lg bg-amber-500/10 border border-amber-200 text-amber-700 grid place-items-center text-xs font-bold">3</span>
                                            <span>{{ __('Save — diary & AI will use the new values') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form & context --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                    <div class="lg:col-span-2">
                        <livewire:product-update :product="$product"/>
                    </div>
                    <div class="space-y-4">
                        <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur shadow-lg shadow-stone-900/5 p-5 space-y-3">
                            <div class="text-sm font-extrabold text-stone-900">{{ __('What changes impact') }}</div>
                            <ul class="space-y-2 text-sm text-stone-600">
                                <li class="flex items-start gap-2"><span class="text-emerald-600 mt-[2px]">✓</span>{{ __('AI suggestions and voice commands') }}</li>
                                <li class="flex items-start gap-2"><span class="text-emerald-600 mt-[2px]">✓</span>{{ __('Diary totals and meal macros') }}</li>
                                <li class="flex items-start gap-2"><span class="text-emerald-600 mt-[2px]">✓</span>{{ __('Search ranking and duplicates detection') }}</li>
                            </ul>
                        </div>
                        <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur shadow-lg shadow-stone-900/5 p-5 space-y-3">
                            <div class="text-sm font-extrabold text-stone-900">{{ __('Need to cancel?') }}</div>
                            <p class="text-sm text-stone-600">
                                {{ __('Use Cancel to go back without saving and keep the current values active in the diary.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>