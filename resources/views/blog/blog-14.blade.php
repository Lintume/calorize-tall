<x-app-layout :full-width="true">

    @section('title', __('280$ for 10 vials? The truth about Tirzepatide, Ozempic and Mounjaro prices in Ukraine'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('We reveal the real prices of Tirzepatide, Semaglutide and Mounjaro. Why the markup in Ukraine is 800%, where resellers buy, and whether it\'s worth risking your health to save money.') }}">
        <meta name="keywords" content="{{ __('buy tirzepatide, mounjaro price, ozempic ukraine, buy semaglutide, retatrutide, peptides china, weight loss injections, tirzepatide ukraine price') }}">
        <meta name="author" content="Calorize">
    @endsection

    @php
        $primaryUrl = auth()->check() ? route('diary') : route('register');
        $primaryLabel = auth()->check() ? __('Go to Diary') : __('Start for free');
    @endphp

    <div class="bg-[radial-gradient(1100px_circle_at_20%_-10%,rgba(245,158,11,0.16),transparent_55%),radial-gradient(900px_circle_at_90%_10%,rgba(14,165,233,0.12),transparent_50%),linear-gradient(to_bottom,rgba(250,250,249,1),rgba(255,255,255,1))]">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto pt-8 sm:pt-10 lg:pt-12 pb-10">
                <a href="{{ route('blog') }}"
                   class="inline-flex items-center gap-2 rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-4 py-2 text-sm font-semibold text-stone-700 hover:bg-white transition"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>{{ __('Back to Blog') }}</span>
                </a>

                <div class="mt-6 max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white/70 backdrop-blur px-3.5 py-2 text-xs font-semibold text-stone-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                        <span>{{ __('Market Analysis') }}</span>
                        <span class="text-stone-400">•</span>
                        <span>{{ __('6 min read') }}</span>
                        <span class="text-stone-400">•</span>
                        <time datetime="2026-01-29">{{ \Carbon\Carbon::parse('2026-01-29')->translatedFormat('d M Y') }}</time>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('280$ for 10 vials or 5000 UAH for one? The truth about Tirzepatide prices in Ukraine') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('We found the real prices from suppliers that Ukrainian peptide shops buy from. Your shock will be limitless when you see the markup.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    
                    {{-- Visual representation of markup --}}
                    <div class="aspect-[16/9] bg-gradient-to-br from-stone-100 to-stone-50 overflow-hidden flex items-center justify-center p-8">
                        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-stone-200 overflow-hidden">
                            <div class="bg-stone-900 px-6 py-4">
                                <h3 class="text-white font-bold text-lg text-center">{{ __('Tirzepatide 30mg (Generic)') }}</h3>
                            </div>
                            <div class="p-6 grid grid-cols-2 gap-px bg-stone-200">
                                <div class="bg-white p-4 text-center">
                                    <div class="text-xs font-semibold text-stone-500 uppercase tracking-wide">{{ __('China Price') }}</div>
                                    <div class="mt-1 text-3xl font-extrabold text-emerald-600">$28</div>
                                    <div class="text-[10px] text-stone-400">{{ __('per vial') }}</div>
                                </div>
                                <div class="bg-white p-4 text-center relative overflow-hidden">
                                    <div class="text-xs font-semibold text-stone-500 uppercase tracking-wide">{{ __('Ukraine Price') }}</div>
                                    <div class="mt-1 text-3xl font-extrabold text-rose-600">$250+</div>
                                    <div class="text-[10px] text-stone-400">{{ __('per vial equivalent') }}</div>
                                    <div class="absolute top-0 right-0 bg-rose-500 text-white text-[10px] font-bold px-2 py-1 rounded-bl-lg">
                                        +800%
                                    </div>
                                </div>
                            </div>
                            <div class="bg-stone-50 px-6 py-3 text-xs text-stone-500 text-center border-t border-stone-200">
                                {{ __('Data based on wholesale quotes from January 2026') }}
                            </div>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="space-y-8 text-stone-700 leading-relaxed text-lg">
                            
                            <section>
                                <p class="font-bold text-xl text-stone-900">
                                    {{ __('Spoiler: You\'re being ripped off. Big time.') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('If you\'re interested in weight loss, you\'ve definitely seen these ads on Instagram or Telegram: "Tirzepatide", "Semaglutide", "Mounjaro-analog", "Ozempic-generic". Prices range from 3000 to 6500 UAH per vial.') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('We decided to check where this product comes from. The results of our investigation made us grab our heads.') }}
                                </p>
                            </section>

                            <section>
                                <h2 class="text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('The Math of Shock') }}
                                </h2>
                                <p class="mt-4">
                                    {{ __('We found direct suppliers from China (where 99% of the "gray" peptide market comes from). Here\'s an offer from one of the "expensive" and verified suppliers who tests each batch at the independent Janoshik laboratory (Czech Republic):') }}
                                </p>
                                
                                <div class="my-6 bg-stone-50 rounded-xl border border-stone-200 p-5 font-mono text-sm sm:text-base">
                                    <div class="flex justify-between items-center border-b border-stone-200 pb-2 mb-2">
                                        <span>Item:</span>
                                        <span class="font-bold text-stone-900">Tirzepatide 30mg</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-stone-200 pb-2 mb-2">
                                        <span>Quantity:</span>
                                        <span class="font-bold text-stone-900">10 vials (Kit)</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-stone-200 pb-2 mb-2">
                                        <span>Price:</span>
                                        <span class="font-bold text-emerald-600">$280 (incl. shipping)</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-1 text-rose-600 font-bold">
                                        <span>Cost per vial:</span>
                                        <span>$28 (~1150 UAH)</span>
                                    </div>
                                </div>

                                <p>
                                    {{ __('This is the price for "premium" China with purity tests. If you dig into Reddit, you can find suppliers half the price — $140-150 for the same kit. But even at the "expensive" price, one 30mg vial costs 1150 UAH.') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('In Ukraine, vials of 5mg, 10mg or 15mg are usually sold. Let\'s calculate the cost of 1mg of active substance:') }}
                                </p>
                                <ul class="list-disc pl-5 mt-2 space-y-2">
                                    <li><strong>{{ __('China (expensive):') }}</strong> {{ __('~38 UAH per 1mg') }}</li>
                                    <li><strong>{{ __('China (cheap):') }}</strong> {{ __('~19 UAH per 1mg') }}</li>
                                    <li><strong>{{ __('Ukraine (reseller):') }}</strong> {{ __('~330-430 UAH per 1mg (at 5000-6500 UAH for 15mg)') }}</li>
                                </ul>
                                <p class="mt-4 font-bold text-rose-600">
                                    {{ __('The markup ranges from 900% to 2200%.') }}
                                </p>
                            </section>

                            <section>
                                <h2 class="text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Why so expensive?') }}
                                </h2>
                                <p class="mt-4">
                                    {{ __('Sellers will tell you about "complex logistics", "cold chains" and "customs". This is partially true — peptide delivery requires temperature control (although not everyone follows it perfectly).') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('But the main reason is the "fear tax" and "ignorance tax". People are afraid to order directly from China, don\'t know verified factories (QSC and others) and are afraid of crypto payment issues.') }}
                                </p>
                            </section>

                            <section>
                                <h2 class="text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('The Dangerous Truth About the "Gray Market"') }}
                                </h2>
                                <div class="bg-amber-50 border-l-4 border-amber-400 p-4 my-4 text-base">
                                    <p class="font-bold text-amber-800">{{ __('Important:') }}</p>
                                    <p class="mt-1 text-amber-700">{{ __('We are not encouraging you to buy drugs from China. We are encouraging you to understand the risks.') }}</p>
                                </div>
                                <p class="mt-4">
                                    {{ __('When you buy a "vial without a label" in a Ukrainian Telegram channel for 5000 UAH, you get THE SAME Chinese vial that costs $28.') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('The reseller doesn\'t have their own laboratory. They don\'t manufacture the drug. They just order it in bulk and resell it to you. The risks of purity, underfilling or spoiled goods during delivery remain the same, only you pay 9 times more for them.') }}
                                </p>
                            </section>

                            <section>
                                <h2 class="text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('What to do?') }}
                                </h2>
                                <p class="mt-4">
                                    <strong>{{ __('1. Don\'t be naive.') }}</strong> {{ __('Understand that an "author\'s weight loss course" for 10 thousand hryvnias is often just a resale of a cheap generic.') }}
                                </p>
                                <p class="mt-2">
                                    <strong>{{ __('2. Consult a doctor.') }}</strong> {{ __('Official drugs (Ozempic, Mounjaro in pen-injectors) are expensive due to patent protection, clinical trials and quality guarantees. Generics are a lottery.') }}
                                </p>
                                <p class="mt-2">
                                    <strong>{{ __('3. Therapy is long-term.') }}</strong> {{ __('Obesity is a chronic disease, and a "one-month course" won\'t cure it. World research shows that peptide therapy may be needed for years or even lifelong to maintain weight. "Just willpower" often doesn\'t work here.') }}
                                </p>
                                <p class="mt-2">
                                    {!! __('But even on therapy you need control. Not to "eat less" (the drug will do that for you), but to <strong>eat enough</strong>. The main risk on peptides is muscle loss (sarcopenia) because you simply stop eating protein.') !!}
                                </p>
                            </section>

                            <hr class="border-stone-200">

                            <section>
                                <h2 class="text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Why Calorize then?') }}
                                </h2>
                                <p class="mt-4">
                                    {{ __('If you\'re on therapy, it\'s critically important to get your protein intake, so you don\'t turn into "skinny fat" and lose your hair. Calorize is the ideal companion for therapy.') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('Our AI diary will help you track nutrients without stress. Just say "ate a steak" and we\'ll count the protein for you.') }}
                                </p>
                            </section>

                        </div>

                        <div class="mt-12 rounded-[1.5rem] border border-stone-200 bg-stone-50 p-6 sm:p-8">
                            <div class="text-sm font-semibold text-stone-500">{{ __('Your companion in therapy') }}</div>
                            <div class="mt-2 text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">{{ __('Track protein, not just weight') }}</div>
                            <div class="mt-3 text-base text-stone-600">{{ __('Calorize will help preserve your health and muscles during weight loss. Try it for free.') }}</div>
                            <div class="mt-6 flex flex-col sm:flex-row gap-4">
                                <a href="{{ $primaryUrl }}" class="inline-flex items-center justify-center rounded-2xl bg-stone-900 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 transition">
                                    {{ $primaryLabel }}
                                </a>
                                <a href="{{ route('blog') }}" class="inline-flex items-center justify-center rounded-2xl border border-stone-200 bg-white px-6 py-3.5 text-base font-semibold text-stone-800 hover:bg-white transition">
                                    {{ __('Read other articles') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
