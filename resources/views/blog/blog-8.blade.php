<x-app-layout :full-width="true">

    @section('title', __('Set Point: Why Weight Stalls and Why the Body Resists Weight Loss'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('If your weight does not move for months despite a calorie deficit and training, it is not always a tracking mistake. The body can actively defend a higher weight by lowering energy expenditure and increasing appetite.') }}">
        <meta name="keywords" content="{{ __('set point, defended weight, weight loss plateau, adaptive thermogenesis, NEAT, appetite') }}">
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
                        <span class="text-stone-400">•</span>
                        <time datetime="2025-11-28">{{ \Carbon\Carbon::parse('2025-11-28')->translatedFormat('d M Y') }}</time>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('Set Point: Why Weight Stalls and Why the Body Resists Weight Loss') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('If your weight does not move for months despite a calorie deficit and training, it is not always a tracking mistake or sabotage. The body may defend a higher weight by lowering energy expenditure and increasing appetite to return to what it considers safe.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-8.svg"
                             alt="{{ __('Set point and plateau: defended weight') }}"
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
                                    <p>{{ __('Many people face a plateau: weight stops decreasing even when a calorie deficit and regular activity are maintained.') }}</p>
                                    <p>{{ __('Popular explanations focus on tracking errors or motivation. However, research shows plateaus can reflect active neuroendocrine and metabolic adaptations aimed at protecting body mass after weight loss.') }}</p>
                                    <p>{{ __('This article takes a practical look at the set point (defended weight) concept, explains why the body resists further loss, and why plateaus are common and not necessarily pathological.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Key Points') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('After weight loss, the body can actively defend the previous weight.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Metabolism can slow down more than formulas would predict.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Appetite can increase even when calorie targets stay the same.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('A plateau is often a phase of biological adaptation, not a process failure.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Not every body can easily “reset” the defended weight range.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a>, <a class="text-amber-700 hover:text-amber-800 underline" href="#ref-4">[4]</a></sup></span>
                                    </li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('1) What Set Point Means in Plain Language') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Modern research often uses defended weight or settling point instead of a rigid set point. The idea is similar: the body has a weight range it considers safe and will try to return to it after weight loss.') }}</p>
                                    <p>{{ __('When you lose weight, the brain does not interpret it as “better shape”. It can interpret fat loss as a threat and trigger compensations:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('higher appetite') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('weaker satiety signals') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('slower metabolism') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('less spontaneous daily movement (NEAT)') }}</span></li>
                                    </ul>
                                    <p>{{ __('This is not “broken metabolism”. It is an evolutionary energy defense system.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('2) Why Weight Stalls Even If You Eat “Little”') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('A common complaint sounds like: “I eat 1200–1500 kcal, I train, and my weight does not move for weeks or months.”') }}</p>
                                    <p>{{ __('From a scientific point of view, there are several reasons:') }}</p>
                                    <ul class="mt-2 space-y-3">
                                        <li>
                                            <strong>{{ __('Adaptive thermogenesis.') }}</strong>
                                            {{ __('After weight loss, resting energy expenditure can drop more than expected from body mass change alone.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup>
                                        </li>
                                        <li>
                                            <strong>{{ __('Lower NEAT.') }}</strong>
                                            {{ __('The body can unconsciously reduce spontaneous activity outside training, lowering total daily expenditure.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup>
                                        </li>
                                        <li>
                                            <strong>{{ __('Higher appetite.') }}</strong>
                                            {{ __('Even if the planned calorie target does not change, hunger signals can increase and make the real deficit harder to maintain.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup>
                                        </li>
                                    </ul>
                                    <p>{{ __('As a result, the actual energy deficit can disappear even if the plan looks unchanged on paper.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('3) Why a Plateau Is Not the End of the Process') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('A plateau often feels like proof that the method stopped working. In reality, it can be a period when the body is rebuilding a new energy balance.') }}</p>
                                    <p>{{ __('At the same time, scale weight is noisy: glycogen, water retention, bowel content, and training inflammation can mask fat loss for weeks.') }}</p>
                                    <p>{{ __('Plateaus are a signal to adjust strategy, not a moral verdict. The goal is to reduce hunger pressure and keep the deficit realistic and sustainable.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('4) What to Do During a Plateau (Practical Checklist)') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Track trends, not single weigh-ins (use a 7–14 day trend line).') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Audit intake for 7 days (hidden calories, oils, snacks, drinks).') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Raise protein and fiber to improve satiety.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Increase steps/NEAT (a small daily increase can matter).') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Consider a 1–2 week maintenance phase if hunger is high and adherence is collapsing.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Prioritize sleep and stress reduction (both affect appetite).') }}</span></li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Conclusions') }}
                                </h2>
                                <ol class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">1</span><span>{{ __('A plateau is common after weight loss and often reflects adaptation.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">2</span><span>{{ __('The body can defend weight by lowering expenditure and increasing hunger.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">3</span><span>{{ __('NEAT and metabolic adaptation can reduce the expected deficit.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">4</span><span>{{ __('Plateaus are best handled by strategy adjustments, not extreme restriction.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">5</span><span>{{ __('If plateaus are persistent, professional support and medical evaluation can help.') }}</span></li>
                                </ol>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Practical Implications (Not Medical Advice)') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('If weight is stuck, it does not automatically mean you are doing something wrong.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Aim for a sustainable deficit and build skills for maintenance phases.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('If hunger is overwhelming, discuss evidence-based tools with a clinician (including medication when appropriate).') }}</span></li>
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
                                            Sumithran P, Prendergast LA, Delbridge E, et al. (2011).
                                            Long-term persistence of hormonal adaptations to weight loss.
                                            <em>New England Journal of Medicine</em>, 365:1597–1604. doi:10.1056/NEJMoa1105816.
                                        </span>
                                    </li>
                                    <li id="ref-2" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">2</span>
                                        <span>
                                            Fothergill E, Guo J, Howard L, et al. (2016).
                                            Persistent metabolic adaptation 6 years after “The Biggest Loser” competition.
                                            <em>Obesity</em>, 24(8):1612–1619. doi:10.1002/oby.21538.
                                        </span>
                                    </li>
                                    <li id="ref-3" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">3</span>
                                        <span>
                                            Westerterp KR. (2018).
                                            Exercise, energy balance and body composition.
                                            <em>European Journal of Clinical Nutrition</em> (review). doi:10.1038/s41430-018-0180-4.
                                        </span>
                                    </li>
                                    <li id="ref-4" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">4</span>
                                        <span>
                                            Hall KD, Kahan S. (2018).
                                            Maintenance of lost weight and long-term management of obesity.
                                            <em>Medical Clinics of North America</em>, 102(1):183–197. doi:10.1016/j.mcna.2017.08.012.
                                        </span>
                                    </li>
                                </ol>
                            </section>
                        </div>

                        <div class="mt-10 rounded-[1.5rem] border border-stone-200 bg-stone-50 p-5 sm:p-6">
                            <div class="text-sm font-semibold text-stone-500">{{ __('Next step') }}</div>
                            <div class="mt-1 text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('Plan plateaus like you plan workouts') }}</div>
                            <div class="mt-2 text-sm sm:text-base text-stone-600">{{ __('Use tracking, maintenance phases, and routine to reduce hunger pressure and stay consistent.') }}</div>
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
