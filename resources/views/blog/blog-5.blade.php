<x-app-layout :full-width="true">

    @section('title', __('Sport Doesn\'t Make You Thin: Why Exercise Often Leads to Weight Gain'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Exercise is important for health, but its effect on weight is variable. Learn why some people don\'t lose weight from training or even gain weight due to compensatory mechanisms.') }}">
        <meta name="keywords" content="{{ __('exercise and weight, sport and weight loss, energy compensation, appetite and exercise, NEAT') }}">
        <meta name="author" content="Calorize">

        <!-- Open Graph -->
        <meta property="og:title" content="{{ __('Sport Doesn\'t Make You Thin: Why Exercise Often Leads to Weight Gain') }}" />
        <meta property="og:description" content="{{ __('Exercise is important for health, but its effect on weight is variable. Learn why some people don\'t lose weight from training or even gain weight due to compensatory mechanisms.') }}" />
        <meta property="og:image" content="{{ url('/images/blog/blog-5.svg') }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:type" content="article" />

        <!-- Structured Data -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "headline": "{{ __('Sport Doesn\'t Make You Thin: Why Exercise Often Leads to Weight Gain') }}",
            "description": "{{ __('Exercise is important for health, but its effect on weight is variable. Learn why some people don\'t lose weight from training or even gain weight due to compensatory mechanisms.') }}",
            "image": [
                "{{ url('/images/blog/blog-5.svg') }}"
            ],
            "datePublished": "2026-01-19T08:00:00+00:00",
            "dateModified": "2026-01-20T00:00:00+00:00",
            "author": [{
                "@type": "Organization",
                "name": "Calorize",
                "url": "{{ url('/') }}"
            }]
        }
        </script>
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
                            {{ __('Sport Doesn\'t Make You Thin: Why Exercise Often Leads to Weight Gain') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('Exercise is important for health, but its effect on weight is variable. Some people don\'t lose weight from training or even gain weight due to compensatory mechanisms: increased appetite, compensatory energy intake, and changes in daily energy expenditure outside of training.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-5.svg"
                             alt="{{ __('Sport and weight loss science') }}"
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
                                    <p>{{ __('The popular model "move more — eat less" assumes that exercise automatically creates an energy deficit and leads to weight loss. However, in clinical studies, weight loss from exercise interventions is often less than predicted or absent.') }}</p>
                                    <p>{{ __('The main reasons are energy compensation (increased energy intake), changes in appetite control, and possible reduction in non-exercise activity (NEAT). This article summarizes the key mechanisms and explains why weight gain after starting exercise may be a predictable consequence of physiology, not "lack of discipline".') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Key Points') }}
                                </h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Weight loss from exercise is often lower than predicted due to energy compensation.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Some people experience increased energy intake or altered appetite control after exercise.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Compensation can be behavioral (more food) and/or energetic (less movement outside the gym).') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('There is significant inter-individual variability in response to exercise (some people are "non-responders" to expected weight loss).') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ __('Exercise is beneficial for cardiometabolic health even without weight loss, but "exercise = weight loss" is not a universal rule.') }}</span>
                                    </li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('1) Why the "Deficit Logic" Often Fails') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Theoretically, adding exercise should increase total energy expenditure and lead to weight loss. However, in real interventions, weight loss is often lower than calculated.') }}</p>
                                    <p>{{ __('This is shown in classic energy analysis of causes of "under-loss" from exercise: part of the deficit is negated by increased energy intake, reduced non-exercise activity, or physiological adaptations.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('2) Compensatory Energy Intake: How Exercise Can Increase Appetite') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Systematic review and meta-analysis in adults with overweight/obesity shows that on average the effects of exercise programs on energy intake and appetite are small. However, it also highlights significant variability: some people demonstrate changes in appetite control and/or energy intake that reduce the expected energy deficit.') }}</p>
                                    <p>{{ __('In a randomized controlled trial of 12-week aerobic training, it was shown that people can compensate for the energy spent on exercise, and the scale of compensation differs between participants and may depend on the "dose" of exercise.') }}</p>
                                    <p>{{ __('Importantly: "appetite" is not just the feeling of hunger. It\'s a complex of signals that includes hormonal and neural mechanisms, and review literature describes that exercise can affect appetite regulation through multiple pathways (including hormonal and metabolite signals).') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('3) NEAT and "Hidden" Compensation') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Even if a person honestly performs training, total daily energy expenditure may increase less than expected if the body "saves" energy outside the gym. This can manifest as reduced spontaneous activity (NEAT), less movement throughout the day, or other changes in energy behavior.') }}</p>
                                    <p>{{ __('Generalizing reviews on energy balance emphasize that weight changes during interventions depend not only on the training itself, but on the total behavioral and physiological response of the body (energy intake, body composition, energy expenditure).') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('4) Why It "Works" for Some But Not Others') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Scientific papers regularly highlight inter-individual variability in response to exercise. This means that two people can perform a comparable exercise program but have different weight results due to differences in compensatory energy intake, appetite changes, changes in energy expenditure, and body composition.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('5) Why "Just Eat Less" Is a Poor Scientific Model') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('When someone is told to "just close your mouth", it\'s often based on the assumption that appetite is completely voluntary. But intervention data shows that the body can compensate for physical activity both behaviorally (through food) and energetically (through other components of daily expenditure), making "simple advice" scientifically incomplete.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Conclusions') }}
                                </h2>
                                <ol class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">1</span>
                                        <span>{{ __('Exercise is a powerful tool for health, but not a guarantee of weight loss.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">2</span>
                                        <span>{{ __('Compensatory energy intake and changes in appetite control can "eat up" the expected deficit.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">3</span>
                                        <span>{{ __('NEAT reduction and other adaptations can additionally reduce the effect of exercise on weight.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-rose-500/10 text-rose-700 font-extrabold text-xs shrink-0">4</span>
                                        <span>{{ __('Inter-individual differences in response to exercise are the norm, not the "exception".') }}</span>
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
                                        <span>{{ __('If you\'re not losing weight from exercise or gaining — this is consistent with research data and is not automatic proof of "laziness".') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                        <span>{{ __('For weight control, additional strategies are often needed: monitoring energy intake, working with appetite, individualizing exercise load.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                        <span>{{ __('If appetite is a pronounced problem, it\'s worth discussing with a doctor possible medical causes and treatment options (including pharmacotherapy if indicated).') }}</span>
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
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">1</span>
                                        <span>
                                            Beaulieu K, Blundell JE, van Baak MA, et al. (2021).
                                            Effect of exercise training interventions on energy intake and appetite control in adults with overweight or obesity: A systematic review and meta-analysis.
                                            <em>Obesity Reviews</em>, 22(Suppl 4): e13251.
                                            <a href="https://pubmed.ncbi.nlm.nih.gov/33949089/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PubMed</a>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">2</span>
                                        <span>
                                            Thomas DM, Bouchard C, Church T, et al. (2012).
                                            Why do individuals not lose more weight from an exercise intervention at a defined dose? An energy balance analysis.
                                            <em>Obesity Reviews</em>, 13: 835–847.
                                            <a href="https://pmc.ncbi.nlm.nih.gov/articles/PMC3771367/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PMC Full Text</a>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">3</span>
                                        <span>
                                            Westerterp KR. (2018).
                                            Exercise, energy balance and body composition.
                                            <em>European Journal of Clinical Nutrition</em> (review).
                                            <a href="https://pmc.ncbi.nlm.nih.gov/articles/PMC6125254/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PMC Full Text</a>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">4</span>
                                        <span>
                                            Flack KD, et al. (2020).
                                            Exercise for Weight Loss: Further Evaluating Energy Compensation.
                                            <em>Medicine &amp; Science in Sports &amp; Exercise</em>.
                                            <a href="https://pmc.ncbi.nlm.nih.gov/articles/PMC7556238/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PMC Full Text</a>
                                        </span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-lg bg-stone-100 text-stone-600 font-semibold text-xs shrink-0">5</span>
                                        <span>
                                            Caruso L, et al. (2023).
                                            Physical Exercise and Appetite Regulation: New Insights.
                                            <a href="https://pmc.ncbi.nlm.nih.gov/articles/PMC10452291/" target="_blank" rel="noopener" class="text-amber-700 hover:text-amber-800 underline">PMC Full Text</a>
                                        </span>
                                    </li>
                                </ol>
                            </section>
                        </div>

                        <div class="mt-10 rounded-[1.5rem] border border-stone-200 bg-stone-50 p-5 sm:p-6">
                            <div class="text-sm font-semibold text-stone-500">{{ __('Next step') }}</div>
                            <div class="mt-1 text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('Track what you eat, not just what you burn') }}</div>
                            <div class="mt-2 text-sm sm:text-base text-stone-600">{{ __('Monitoring your food intake helps you understand your true energy balance and make informed decisions.') }}</div>
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
