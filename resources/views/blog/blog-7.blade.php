<x-app-layout :full-width="true">

    @section('title', __('Willpower Is a Myth: Who Really Controls Your Appetite'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Appetite is not a moral trait. It is regulated by hormones, the hypothalamus, and the brain’s reward system. When diets fail, it is often biology—not weakness.') }}">
        <meta name="keywords" content="{{ __('willpower and appetite, hunger hormones, hypothalamus, dopamine reward system, diet relapse') }}">
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
                        <time datetime="2025-11-15">{{ \Carbon\Carbon::parse('2025-11-15')->translatedFormat('d M Y') }}</time>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('Willpower Is a Myth: Who Really Controls Your Appetite') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('Appetite is not a reflection of character or discipline. It is regulated by a complex neuroendocrine system where hormones, the hypothalamus, and dopamine circuits play central roles. When people “break” on diets, it is often a predictable biological adaptation—not weakness.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-7.svg"
                             alt="{{ __('Willpower and appetite: brain and hormones') }}"
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
                                    <p>{{ __('Popular culture explains overeating as a lack of willpower. Modern neuroscience suggests appetite is shaped by the interaction of hypothalamic centers, peripheral hormones, and the brain reward system.') }}</p>
                                    <p>{{ __('After restriction or weight loss, these systems adapt in ways that increase hunger, reduce satiety signals, and raise dopamine reactivity to food.') }}</p>
                                    <p>{{ __('This article reviews key appetite regulation mechanisms and explains why long-term “control” is a biologically limited resource, not an endless moral quality.') }}</p>
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
                                            {{ __('Appetite is regulated by the hypothalamus and hormones—not by “character”.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>
                                            {{ __('Ghrelin and leptin shift after diets in a direction that increases hunger.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>
                                            {{ __('The brain reward system makes food a powerful dopamine stimulus.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>
                                            {{ __('After weight loss, the brain can become more sensitive to food cues.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>
                                            {{ __('Willpower cannot compensate for these neurobiological shifts long-term.') }}
                                            <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a>, <a class="text-amber-700 hover:text-amber-800 underline" href="#ref-4">[4]</a></sup>
                                        </span>
                                    </li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('1) Hypothalamus: The Appetite Dispatcher') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('At the center of appetite regulation is the hypothalamus—a small but critical brain structure. It integrates signals from peripheral hormones (ghrelin, leptin, insulin, PYY) and generates hunger or satiety commands.') }}</p>
                                    <p>
                                        {{ __('Two key hypothalamic neuron populations have opposite roles: some promote eating (NPY/AgRP) while others suppress it (POMC/CART). The balance between these systems strongly shapes whether a person feels hungry or full.') }}
                                        <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup>
                                    </p>
                                    <p>{{ __('When this balance shifts toward hunger, motivation cannot fully cancel it out. This is a direct neural drive to act, not a psychological whim.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('2) Hunger and Satiety Hormones') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Appetite is not just “in the moment”—it reflects long-term hormonal dynamics. Two key players are ghrelin and leptin.') }}</p>
                                    <p>{{ __('Ghrelin is produced in the stomach and signals the brain that food is needed. It rises before meals and can increase after restriction.') }}</p>
                                    <p>{{ __('Leptin is produced by fat tissue and suppresses appetite. After weight loss, leptin drops, and the brain interprets it as a threat to energy reserves.') }}</p>
                                    <p>
                                        {{ __('A classic New England Journal of Medicine study showed that after weight loss, ghrelin remains elevated and leptin remains reduced for at least a year—even when body weight stabilizes.') }}
                                        <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup>
                                    </p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('3) Dopamine: Why Food Becomes Hard to Resist') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Besides homeostatic appetite (energy needs), there is a hedonic component—eating for pleasure. It is strongly linked to the dopamine reward system.') }}</p>
                                    <p>
                                        {{ __('After weight loss and prolonged dieting, reward circuits can become more reactive to food cues (sight, smell, taste), increasing craving even without true energy need.') }}
                                        <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup>
                                    </p>
                                    <p>{{ __('Neuroimaging studies show that after weight loss, reward center responses to food can be stronger than before dieting—creating a subjective feeling of “loss of control” that reflects neural adaptation, not weak character.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('4) Why “Control” Gets Exhausted') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Even when someone tries to restrict food consciously, it requires sustained activation of the prefrontal cortex—regions involved in self-control.') }}</p>
                                    <p>{{ __('But when the hypothalamus keeps sending hunger signals and the reward system increases food value, cognitive control tends to fatigue over time.') }}</p>
                                    <p>
                                        {{ __('In that state, a “relapse” is not a moral defeat but a point where biological pressure exceeds the brain’s inhibitory resources.') }}
                                        <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-4">[4]</a></sup>
                                    </p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('5) Why Willpower Cannot Beat Biology') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Willpower can help in the short term (e.g., skipping dessert today). But it cannot fight for years against:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('elevated ghrelin') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('reduced leptin') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('metabolic adaptation') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span>{{ __('a hypersensitive reward system') }}</span>
                                        </li>
                                    </ul>
                                    <p>
                                        {{ __('That is why long-term studies often show: even highly motivated people regain weight over time if the biological context does not change.') }}
                                        <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a>, <a class="text-amber-700 hover:text-amber-800 underline" href="#ref-4">[4]</a></sup>
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
                                        <span>{{ __('Appetite is regulated by hormones and the brain, not by character.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">2</span>
                                        <span>{{ __('After diets, biological pressure toward eating increases.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">3</span>
                                        <span>{{ __('The reward system amplifies food value after weight loss.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">4</span>
                                        <span>{{ __('Willpower cannot compensate for these processes long-term.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">5</span>
                                        <span>{{ __('Diet “relapses” are often a predictable consequence of neurobiology.') }}</span>
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
                                        <span>{{ __('If you feel hungry all the time, it is not a character defect.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                        <span>{{ __('Calorie restriction triggers hormonal adaptations.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                        <span>{{ __('Appetite control often requires biological tools—not just motivation.') }}</span>
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
                                            Morton GJ, Meek TH, Schwartz MW. (2014).
                                            Neurobiology of food intake in health and disease.
                                            <em>Nature Reviews Neuroscience</em>, 15(6): 367–378. doi:10.1038/nrn3745.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/24840840/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-2" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">2</span>
                                        <span>
                                            Sumithran P, Prendergast LA, Delbridge E, et al. (2011).
                                            Long-term persistence of hormonal adaptations to weight loss.
                                            <em>New England Journal of Medicine</em>, 365:1597–1604. doi:10.1056/NEJMoa1105816.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/22029981/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-3" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">3</span>
                                        <span>
                                            Volkow ND, Wang GJ, Tomasi D, Baler RD. (2013).
                                            Obesity and addiction: neurobiological overlaps.
                                            <em>Obesity Reviews</em>, 14(1): 2–18. doi:10.1111/j.1467-789X.2012.01031.x.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/23016694/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
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
                            <div class="mt-1 text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('Design for appetite, not willpower') }}</div>
                            <div class="mt-2 text-sm sm:text-base text-stone-600">{{ __('Build a food environment and routine that lowers hunger pressure and reduces decision fatigue.') }}</div>
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
