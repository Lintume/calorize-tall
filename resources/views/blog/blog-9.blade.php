<x-app-layout :full-width="true">

    @section('title', __('Intuitive Eating Is Not a Universal Solution: When “Listening to Your Body” Doesn’t Work'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Intuitive eating can reduce food anxiety, but it is not a universal weight-control strategy. After dieting, hunger signals can be biologically distorted and lead to gradual overeating and weight regain.') }}">
        <meta name="keywords" content="{{ __('intuitive eating, weight regain, defended weight, post-diet hunger, appetite signals') }}">
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
                        <span>{{ __('Science') }}</span>
                        <span class="text-stone-400">•</span>
                        <span>{{ __('8 min read') }}</span>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('Intuitive Eating Is Not a Universal Solution: When “Listening to Your Body” Doesn’t Work') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('Intuitive eating can help people who live with strict food rules and fear of eating. But for people prone to weight gain, high appetite, and a long dieting history, it can lead to gradual overeating and rebound. The issue is not the method itself, but the belief that it fits everyone.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-9.svg"
                             alt="{{ __('Intuitive eating is not universal') }}"
                             class="h-full w-full object-cover"
                        />
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="space-y-10 text-stone-700 leading-relaxed">
                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Abstract') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Intuitive eating (IE) is promoted as an alternative to dieting and a way to restore “natural” hunger and satiety cues.') }}</p>
                                    <p>{{ __('Studies associate IE with better psychological outcomes, less food anxiety, and improved body image.') }}</p>
                                    <p>{{ __('However, current evidence does not support IE as an effective weight-control strategy for people prone to obesity or with high appetite. This article explains the scientific limitations of intuitive eating and why it is not universal.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Key Points') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Intuitive eating improves psychological outcomes, but does not guarantee stable body weight.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('It tends to work better for people without obesity and without a long dieting history.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('After dieting, hunger signals can be biologically distorted.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Elevated appetite can persist for years after weight loss.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('For some people, “eating by feelings” systematically means overeating.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-4">[4]</a></sup></span>
                                    </li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('1) What Intuitive Eating Actually Is') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Intuitive eating was designed as an alternative to rigid dieting. Its key principles include:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('removing strict food rules') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('responding to hunger and satiety cues') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('reducing guilt around food') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('focusing on well-being rather than weight') }}</span></li>
                                    </ul>
                                    <p>{{ __('Research links IE to lower depression, fewer eating-disorder symptoms, and improved body image.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup></p>
                                    <p>{{ __('The problem starts when IE is marketed not as a therapeutic tool, but as a universal nutrition model for everyone—regardless of biology.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('2) Who Intuitive Eating Truly Works For') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Across studies, the best outcomes for IE are often seen in people who are:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('without obesity') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('without a long dieting history') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('without chronic overeating history') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('with relatively stable hunger and satiety signals') }}</span> <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup></li>
                                    </ul>
                                    <p>{{ __('For this group, “listening to the body” can translate to moderate intake and less obsessive food drive.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('3) Why “Intuition” Breaks After Dieting') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('After restriction, hunger and satiety cues are no longer “clean”. They undergo hormonal and neural changes.') }}</p>
                                    <p>{{ __('Evidence suggests that after weight loss:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('ghrelin increases (hunger hormone)') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('leptin decreases (satiety hormone)') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('the brain becomes more reactive to food cues') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('subjective hunger increases') }}</span> <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></li>
                                    </ul>
                                    <p>{{ __('In that state, eating “intuitively” may mean obeying biologically distorted signals that push toward overeating.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('4) High Appetite Does Not Automatically Mean an Eating Disorder') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Many discussions treat any overeating as a psychological issue. From a scientific view, that is often wrong.') }}</p>
                                    <p>{{ __('High appetite after dieting is not a “bad habit” or “compulsive behavior”. It can be a hormonally driven state where the body tries to restore lost energy reserves.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></p>
                                    <p>{{ __('Calling such a person “food addicted” can confuse a biological mechanism with a psychiatric diagnosis.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('5) Why IE Often Leads to Gradual Weight Gain') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('For people prone to obesity and with a dieting history, IE often looks like this:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('guilt around food decreases') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('restrictions are removed') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('energy intake increases') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('weight slowly but steadily increases') }}</span></li>
                                    </ul>
                                    <p>{{ __('Early on, it can look like “healing from diet mentality”. But long-term, it may ignore defended weight, metabolic adaptation, and post-diet appetite.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-4">[4]</a></sup></p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('6) Why IE Should Not Be Sold as an Absolute') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('The issue is not IE itself, but how it is marketed.') }}</p>
                                    <p>{{ __('When people with heavy dieting history are told: “Just listen to your body and your weight will stabilize”, it creates unrealistic expectations and often ends in frustration.') }}</p>
                                    <p>{{ __('Evidence does not show that IE is an effective weight-control strategy for people prone to obesity.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a>, <a class="text-amber-700 hover:text-amber-800 underline" href="#ref-4">[4]</a></sup></p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Conclusions') }}
                                </h2>
                                <ol class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">1</span><span>{{ __('Intuitive eating can support mental health, but it is not universal.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">2</span><span>{{ __('After dieting, hunger signals can be biologically distorted.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">3</span><span>{{ __('High appetite is physiology, not automatically an eating disorder.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">4</span><span>{{ __('For some people, IE becomes chronic overeating.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">5</span><span>{{ __('IE does not account for defended weight and rebound in everyone.') }}</span></li>
                                </ol>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Practical Implications (Not Medical Advice)') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('IE can be useful as a therapeutic phase, not necessarily a final strategy.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('If weight increases on IE, it does not automatically mean you are “doing it wrong”.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Nutrition strategies should account for biology, not only psychology.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Some people need other tools to stabilize weight long-term.') }}</span></li>
                                </ul>
                                <div class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm">
                                    <span class="font-semibold text-amber-800">{{ __('Disclaimer:') }}</span>
                                    <span class="text-amber-700"> {{ __('This material is informational in nature and does not replace consultation with a doctor.') }}</span>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('References') }}
                                </h2>
                                <ol class="mt-3 space-y-3 text-sm">
                                    <li id="ref-1" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">1</span>
                                        <span>
                                            Van Dyke N, Drinkwater EJ. (2014).
                                            Relationships between intuitive eating and health indicators: literature review.
                                            <em>Public Health Nutrition</em>, 17(8):1757–1766. doi:10.1017/S1368980013002139.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/24184418/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-2" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">2</span>
                                        <span>
                                            Tylka TL, Calogero RM, Daníelsdóttir S. (2020).
                                            Intuitive Eating is Connected to Self-Reported Weight Stability in Community Women and Men.
                                            <em>Eating Disorders</em>, 28(3):256–264. doi:10.1080/10640266.2019.1642031.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/31437087/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-3" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">3</span>
                                        <span>
                                            Sumithran P, Prendergast LA, Delbridge E, et al. (2011).
                                            Long-term persistence of hormonal adaptations to weight loss.
                                            <em>New England Journal of Medicine</em>, 365:1597–1604. doi:10.1056/NEJMoa1105816.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/22029981/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-4" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">4</span>
                                        <span>
                                            Mann T, Tomiyama AJ, Westling E, et al. (2007).
                                            Medicare's search for effective obesity treatments: Diets are not the answer.
                                            <em>American Psychologist</em>, 62(3):220–233. doi:10.1037/0003-066X.62.3.220.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/17469900/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                </ol>
                            </section>
                        </div>

                        <div class="mt-10 rounded-[1.5rem] border border-stone-200 bg-stone-50 p-5 sm:p-6">
                            <div class="text-sm font-semibold text-stone-500">{{ __('Next step') }}</div>
                            <div class="mt-1 text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('Use IE as a tool, not a promise') }}</div>
                            <div class="mt-2 text-sm sm:text-base text-stone-600">{{ __('If appetite is high, combine IE with structure: protein, fiber, routines, and evidence-based support.') }}</div>
                            <div class="mt-5 flex flex-col sm:flex-row gap-3">
                                <a href="{{ $primaryUrl }}" class="inline-flex items-center justify-center rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 transition">
                                    {{ $primaryLabel }}
                                </a>
                                <a href="{{ route('blog') }}" class="inline-flex items-center justify-center rounded-2xl border border-stone-200 bg-white px-5 py-3 text-sm font-semibold text-stone-800 hover:bg-white transition">
                                    {{ __('Back to Blog') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
