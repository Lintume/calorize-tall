<x-app-layout :full-width="true">

    @section('title', __('Why Most Fitness Coaches Are Wrong (Not Out of Malice)'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Fitness advice is shaped by selection and survivorship bias: many coaches never experienced true obesity, metabolic adaptation, or rebound cycles. Their model can work for them, but it often does not scale to most people.') }}">
        <meta name="keywords" content="{{ __('fitness coaches, selection bias, survivorship bias, obesity, metabolic adaptation, rebound, genetics') }}">
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
                            {{ __('Why Most Fitness Coaches Are Wrong (Not Out of Malice)') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('The fitness and “clean eating” industry is built on selection bias. Most coaches never experienced true obesity, metabolic adaptation, or rebound cycles. They truly believe in their model—but that model does not scale to most people.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-11.svg"
                             alt="{{ __('Selection bias in fitness coaching') }}"
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
                                    <p>{{ __('In popular discourse, fitness coaches present weight loss as a simple process driven by discipline and “good habits”. But long-term data show stable weight maintenance is a rare exception, not the typical outcome.') }}</p>
                                    <p>{{ __('This article explains how selection bias, survivorship bias, and genetic variability create a distorted picture of “success” in the weight-loss industry—and why many coaches are wrong not out of bad intent, but due to their own biological luck.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Key Points') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('The fitness industry suffers from survivorship bias.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Most coaches have never experienced true obesity.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Their “success” often does not scale to others.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Genetics and biology can outweigh “habits”.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Moralizing weight is not science-based.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-4">[4]</a></sup></span>
                                    </li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('1) Selection Bias: You Are Looking at the Wrong People') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Social feeds are full of success stories: “I lost 30 kg”, “I changed my life”, “I just started eating right”.') }}</p>
                                    <p>{{ __('You do not see the hundreds who did the same—and regained weight 2–5 years later.') }}</p>
                                    <p>{{ __('This is classic survivorship bias: only those for whom it worked (by chance or biology) remain visible.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-1">[1]</a></sup></p>
                                    <p>{{ __('And those visible outliers often become coaches—not because they have a universal formula, but because they are a rare exception.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('2) Many Never Lived Through True Obesity') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('If you look closely at the background of many coaches, a pattern appears:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('they were “a bit chubby” in childhood') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('or they were always lean') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('or they had a short weight-gain phase') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('but they never lived for years with obesity') }}</span></li>
                                    </ul>
                                    <p>{{ __('This matters because people without obesity history often do not experience the same biological pressure: metabolic adaptation, defended weight shifts, chronic appetite elevation, rebound cycles.') }}</p>
                                    <p>{{ __('So they genuinely do not understand why “just eat less” fails for others.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('3) Genetic Luck Often Gets Labeled “Discipline”') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Twin studies suggest heritability explains a large share (often 40–70%) of body-weight variability.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-3">[3]</a></sup></p>
                                    <p>{{ __('That means some people naturally have lower appetite, higher energy expenditure, weaker compensation to restriction, and more stable satiety signals.') }}</p>
                                    <p>{{ __('When such a person loses weight, they may sincerely believe it was purely willpower. Often it is biology plus survivorship bias.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('4) Why Their Advice Does Not Scale') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('A coach sees 10 clients. Two succeed. Eight do not.') }}</p>
                                    <p>{{ __('A common (wrong) conclusion is: “the two were disciplined, the rest were lazy”.') }}</p>
                                    <p>{{ __('In reality, those groups can differ in biology: dieting history, defended weight, appetite pressure, and the strength of metabolic adaptation.') }}</p>
                                    <p>{{ __('Long-term evidence shows most people do not maintain weight loss.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-2">[2]</a></sup></p>
                                    <p>{{ __('So the model does not scale. It may work for a minority, but it fails for the majority.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('5) Moralizing Weight Is Pseudoscience') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('When a coach says “you just are not trying hard enough”, that is not motivation—it is bad science.') }}</p>
                                    <p>{{ __('Hormonal and metabolic adaptations after weight loss can persist for years.') }} <sup><a class="text-amber-700 hover:text-amber-800 underline" href="#ref-4">[4]</a></sup></p>
                                    <p>{{ __('That means someone can do “everything right” and still struggle to lose or maintain weight.') }}</p>
                                    <p>{{ __('Calling this “lack of discipline” is ignoring biology.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('6) Why Many Coaches Truly Do Not See It') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Most fitness coaches are not malicious manipulators. They often:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('have their own success story') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('see a few successful clients') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('do not see those who quit and disappear') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('lack the biological contrast') }}</span></li>
                                    </ul>
                                    <p>{{ __('The brain draws a natural conclusion: “it worked, so it is universal”. That is not malice—it is a cognitive bias.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('7) What To Do Instead') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('The solution is not to “cancel fitness”. The solution is to:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('stop selling universal formulas') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('stop moralizing weight') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('acknowledge biological diversity') }}</span></li>
                                        <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('individualize strategies') }}</span></li>
                                    </ul>
                                    <p>{{ __('And stop implying that if it did not work, something is wrong with the person.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Conclusions') }}
                                </h2>
                                <ol class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">1</span><span>{{ __('The fitness industry is shaped by survivorship bias.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">2</span><span>{{ __('Most coaches do not know what true obesity feels like.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">3</span><span>{{ __('Their success does not reliably scale.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">4</span><span>{{ __('Genetics often masquerades as discipline.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">5</span><span>{{ __('Moralizing weight is pseudoscience.') }}</span></li>
                                </ol>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Practical Implications (Not Medical Advice)') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('If coach advice does not work for you, the problem is not necessarily you.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Comparing yourself to outliers is a methodological error.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('There are no universal strategies.') }}</span></li>
                                    <li class="flex items-start gap-3"><span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span><span>{{ __('Individualization is the only scientifically sound model.') }}</span></li>
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
                                            Ioannidis JPA. (2005). Why most published research findings are false.
                                            <em>PLOS Medicine</em>, 2(8): e124. doi:10.1371/journal.pmed.0020124.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/16060722/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-2" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">2</span>
                                        <span>
                                            Mann T, Tomiyama AJ, Westling E, et al. (2007). Medicare's search for effective obesity treatments: Diets are not the answer.
                                            <em>American Psychologist</em>, 62(3):220–233. doi:10.1037/0003-066X.62.3.220.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/17469900/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-3" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">3</span>
                                        <span>
                                            Wardle J, Carnell S, Haworth CMA, Plomin R. (2008). Evidence for a strong genetic influence on childhood adiposity.
                                            <em>International Journal of Obesity</em>, 32:398–404. doi:10.1038/sj.ijo.0803724.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/17987002/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li id="ref-4" class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">4</span>
                                        <span>
                                            Fothergill E, Guo J, Howard L, et al. (2016). Persistent metabolic adaptation 6 years after “The Biggest Loser” competition.
                                            <em>Obesity</em>, 24(8):1612–1619. doi:10.1002/oby.21538.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/27136388/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                </ol>
                            </section>
                        </div>

                        <div class="mt-10 rounded-[1.5rem] border border-stone-200 bg-stone-50 p-5 sm:p-6">
                            <div class="text-sm font-semibold text-stone-500">{{ __('Next step') }}</div>
                            <div class="mt-1 text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('Stop comparing yourself to outliers') }}</div>
                            <div class="mt-2 text-sm sm:text-base text-stone-600">{{ __('Build a strategy that fits your biology, not someone else’s highlight reel.') }}</div>
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
