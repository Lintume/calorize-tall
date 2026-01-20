<x-app-layout :full-width="true">

    @section('title', __('GLP-1: How Hormonal Therapy Breaks All “Moral” Theories of Weight Loss'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('GLP-1 drugs (semaglutide, tirzepatide) do not “build willpower”. They change appetite, satiety, and reward signaling—showing weight control is a neuroendocrine process, not a moral test.') }}">
        <meta name="keywords" content="{{ __('GLP-1, semaglutide, tirzepatide, appetite control, obesity neuroendocrine, food noise') }}">
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
                            {{ __('GLP-1: How Hormonal Therapy Breaks All “Moral” Theories of Weight Loss') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('GLP-1 drugs (semaglutide, tirzepatide) do not “train willpower”. They change biological signals of appetite, satiety, and reward. Their effect shows that what used to be blamed on discipline is often a controllable neuroendocrine process.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-10.svg"
                             alt="{{ __('GLP-1 therapy and appetite control') }}"
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
                                    <p>{{ __('GLP-1 receptor agonists have radically changed how we think about weight control. They show that appetite and overeating are not just habits, but direct consequences of hormonal and neural signaling.') }}</p>
                                    <p>{{ __('This article explains how GLP-1 drugs work, why they reduce not only food intake but also obsessive thoughts about food, and what their effect suggests about the true nature of obesity.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Key Points') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('GLP-1 drugs reduce appetite and strengthen satiety signals.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('They act not only on the gut, but also on brain reward circuits.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Food “noise” can decrease substantially for many people.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('The effect is not willpower—it is pharmacological signal change.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('GLP-1 shows appetite is a manageable biological parameter.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></span>
                                    </li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('1) What GLP-1 Means in Plain Language') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('GLP-1 (glucagon-like peptide-1) is a gut hormone released in response to food. Its effects include:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('slower gastric emptying') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('stronger satiety') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('lower appetite') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('effects on brain reward circuitry') }}</span></li>
                                    </ul>
                                    <p>{{ __('GLP-1-based medications (semaglutide, tirzepatide) mimic or amplify these signals, changing not “behavior”, but the underlying biology of appetite.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup></p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('2) Why It Feels Like “A Different Version of You”') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Many people on GLP-1 therapy describe a similar shift: food stops being a constant background thought.') }}</p>
                                    <p>{{ __('This is not magic or placebo. Neuroimaging work suggests GLP-1 agonists can reduce reward-circuit activation to food cues, lowering subjective “pull”.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup></p>
                                    <p>{{ __('In other words, the drug does not force restraint—it reduces the intensity of craving itself.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('3) Why GLP-1 Breaks the Willpower Myth') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('If someone struggled for years to maintain weight, but on GLP-1 they suddenly:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('eats less without effort') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('gets full faster') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('thinks about food less') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('stops “relapsing” into overeating') }}</span></li>
                                    </ul>
                                    <p>{{ __('— it strongly suggests the bottleneck was never character.') }}</p>
                                    <p>{{ __('The drug does not add discipline. It changes hormonal and neural signals that previously pushed eating.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('4) Why the Effect Can Be So Stable') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('In clinical trials, semaglutide and tirzepatide show long-term reductions in energy intake with a relatively stable effect profile.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup></p>
                                    <p>{{ __('This relates to multi-pathway action: hypothalamic hunger circuits, satiety signaling, and reward responses can all shift.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('5) Why This Is Not “Cheating”') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Public discourse sometimes calls GLP-1 “the easy way”. That frame is scientifically misleading.') }}</p>
                                    <p>{{ __('We do not call antidepressants “cheating” for mood or insulin “cheating” for diabetes. If appetite is hormonally regulated, pharmacological correction can be a logical medical intervention—not a moral compromise.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('6) What GLP-1 Suggests About Obesity') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('The effect of these drugs points to a simple idea: obesity is not just “lack of discipline”, but a chronic dysregulation of energy balance biology.') }}</p>
                                    <p>{{ __('If changing signals can change eating behavior dramatically, biology was a primary driver—not simply “bad habits”.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Conclusions') }}
                                </h2>
                                <ol class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">1</span><span>{{ __('GLP-1 drugs change biological appetite signals.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">2</span><span>{{ __('They can reduce obsessive food thoughts.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">3</span><span>{{ __('Their effect is not willpower.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">4</span><span>{{ __('They show appetite is a controllable biological process.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">5</span><span>{{ __('They challenge moral narratives around obesity.') }}</span></li>
                                </ol>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Practical Implications (Not Medical Advice)') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('If GLP-1 “suddenly helped”, it is physiology—not magic.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('This does not mean everyone needs medication.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('But it suggests appetite is not a character defect.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Any medication should be prescribed and monitored by a clinician.') }}</span></li>
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
                                            Wilding JPH, Batterham RL, Calanna S, et al. (2021).
                                            Once-weekly semaglutide in adults with overweight or obesity.
                                            <em>New England Journal of Medicine</em>, 384:989–1002. doi:10.1056/NEJMoa2032183.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/33567185/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-2" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">2</span>
                                        <span>
                                            Farr OM, Upadhyay J, Rutagengwa C, et al. (2016).
                                            Central nervous system regulation of food intake by GLP-1.
                                            <em>Obesity Reviews</em>, 17(Suppl 1): S73–S81. doi:10.1111/obr.12310.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/27169990/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-3" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">3</span>
                                        <span>
                                            Bray GA, Kim KK, Wilding JPH. (2017).
                                            Obesity: a chronic relapsing progressive disease process.
                                            <em>Obesity Reviews</em>, 18(7):715–723. doi:10.1111/obr.12551.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/28489290/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                </ol>
                            </section>
                        </div>

                        <div class="mt-10 rounded-[1.5rem] border border-stone-200 bg-stone-50 p-5 sm:p-6">
                            <div class="text-sm font-semibold text-stone-500">{{ __('Next step') }}</div>
                            <div class="mt-1 text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('Treat appetite like physiology') }}</div>
                            <div class="mt-2 text-sm sm:text-base text-stone-600">{{ __('Combine evidence-based tools: nutrition structure, activity, sleep, and medical support when appropriate.') }}</div>
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
