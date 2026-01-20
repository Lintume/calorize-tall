<x-app-layout :full-width="true">

    @section('title', __('Rebound Is Not a Relapse: Why Weight Comes Back and Why That Is Normal'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Weight regain after weight loss is not a failure of willpower. It is a predictable biological response driven by hormones and metabolism that can persist for years.') }}">
        <meta name="keywords" content="{{ __('weight regain, rebound effect, weight maintenance, appetite hormones, metabolic adaptation') }}">
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
                            {{ __('Rebound Is Not a Relapse: Why Weight Comes Back and Why That Is Normal') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('Weight regain after weight loss is not a sign of weak willpower or a motivation failure. It is a predictable biological response to fat loss. Hormonal, metabolic, and neural adaptations can persist for years and push body weight upward.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-6.svg"
                             alt="{{ __('Rebound effect: weight regain is normal') }}"
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
                                    <p>{{ __('In most people who lose a substantial amount of weight, part or all of it returns over the following years.') }}</p>
                                    <p>{{ __('This is often interpreted as a relapse, loss of control, or lack of discipline. However, modern research shows that the rebound effect is driven by long-lasting hormonal and metabolic adaptations: stronger hunger signals, weaker satiety signals, and lower resting energy expenditure.') }}</p>
                                    <p>{{ __('This article reviews the key rebound mechanisms and explains why weight regain is usually biology doing its job, not a character flaw.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Key Points') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>
                                            {{ __('After weight loss, appetite hormones can shift toward hunger for a long time.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>
                                            {{ __('Metabolic adaptation can persist for years after weight loss.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>
                                            {{ __('Most people partially or fully regain the lost weight over time.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>
                                            {{ __('Rebound is not an eating disorder and not a relapse. It is a protective response of the body.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a>, <a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>
                                            {{ __('Weight maintenance is usually harder than weight loss itself.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup>
                                        </span>
                                    </li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('1) Why Weight Regain Is the Statistical Norm') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>
                                        {{ __('Long-term follow-ups after diets and weight loss programs show a stable pattern: within 2–5 years, most people regain a large share of the lost weight or return close to baseline.') }}
                                        <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup>
                                    </p>
                                    <p>{{ __('Culture frames this as a personal failure. Physiology frames it as an expected consequence of how the brain and hormones react to sustained energy loss.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('2) The Hormonal Trap After Weight Loss') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('After weight loss, appetite regulation changes significantly. A large study published in the New England Journal of Medicine showed that for at least a year after weight loss:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('ghrelin increases (hunger hormone)') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('leptin decreases (satiety hormone)') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('satiety peptides (PYY, CCK) decrease') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('subjective hunger increases') }}</span>
                                        </li>
                                    </ul>
                                    <p>
                                        {{ __('These changes are not short-term. They can persist even when weight stabilizes, creating chronic biological pressure toward regain.') }}
                                        <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup>
                                    </p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('3) Metabolic Adaptation: The Body Burns Less Than It Should') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Beyond appetite hormones, the energy economy changes after weight loss. This phenomenon is known as metabolic adaptation or adaptive thermogenesis.') }}</p>
                                    <p>
                                        {{ __('A classic 6-year follow-up of The Biggest Loser participants showed that even years after extreme weight loss, resting metabolic rate remained significantly lower than expected for their body weight and composition.') }}
                                        <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup>
                                    </p>
                                    <p>{{ __('This means maintaining the new weight may require eating less than calorie calculators would predict. Over time, this increases the feeling of chronic energy shortage and reinforces hunger.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('4) Why Rebound Does Not Equal a Relapse') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Popular rhetoric calls rebound a loss of control or a return to bad habits. But that framing ignores a key fact: after weight loss, the body can behave like it is in chronic energy deficit even with normal eating.') }}</p>
                                    <p>{{ __('When a person starts eating more after restriction, it is not always weakness. It can be the brain trying to restore energy reserves it perceives as necessary for survival.') }}</p>
                                    <p>
                                        {{ __('In this context, rebound is not pathology but a logical adaptation of the energy regulation system shaped by evolution.') }}
                                        <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a>, <a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup>
                                    </p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('5) Why Maintaining Weight Is Harder Than Losing It') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Many people think the hardest phase is weight loss. Biologically, the maintenance phase is often harder.') }}</p>
                                    <p>{{ __('During maintenance:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('hunger hormones stay elevated') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('satiety signals stay reduced') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('metabolism can run in an energy-saving mode') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('the brain reacts more strongly to food cues') }}</span>
                                        </li>
                                    </ul>
                                    <p>
                                        {{ __('That is why long-term studies often show that sustained weight loss maintenance is the rare exception, not the typical outcome.') }}
                                        <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup>
                                    </p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Conclusions') }}
                                </h2>
                                <ol class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">1</span>
                                        <span>{{ __('Rebound after weight loss is common and predictable.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">2</span>
                                        <span>{{ __('It is driven by hormonal and metabolic adaptations.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">3</span>
                                        <span>{{ __('It is not a relapse and not a lack of willpower.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">4</span>
                                        <span>{{ __('Maintaining weight is biologically harder than losing it.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">5</span>
                                        <span>{{ __('Weight regain is the body responding to energy loss, not a character flaw.') }}</span>
                                    </li>
                                </ol>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Practical Implications (Not Medical Advice)') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                        <span>{{ __('If your weight comes back, it is consistent with scientific evidence.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                        <span>{{ __('Long-term maintenance usually requires different strategies than weight loss itself.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                        <span>{{ __('Appetite management, reducing biological hunger pressure, and an individualized approach are key.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                        <span>{{ __('In some cases, medication support may be appropriate (prescribed by a doctor).') }}</span>
                                    </li>
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
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/22029981/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-2" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">2</span>
                                        <span>
                                            Fothergill E, Guo J, Howard L, et al. (2016).
                                            Persistent metabolic adaptation 6 years after “The Biggest Loser” competition.
                                            <em>Obesity</em>, 24(8):1612–1619. doi:10.1002/oby.21538.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/27136388/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-3" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">3</span>
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
                            <div class="mt-1 text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('Focus on maintenance skills') }}</div>
                            <div class="mt-2 text-sm sm:text-base text-stone-600">{{ __('Track meals, appetite patterns, and weight trends. Maintenance is a different game than weight loss.') }}</div>
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
