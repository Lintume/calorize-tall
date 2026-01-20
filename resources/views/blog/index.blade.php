<x-app-layout :full-width="true">

    @section('title', __('Blog - useful articles about nutrition and health'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description"
              content="{{ __('Useful articles about healthy eating, weight loss, and fitness. Learn how to count calories correctly, which foods to choose for weight loss, and how the Calorize app can help you reach your goals.') }}">
        <meta name="keywords" content="{{ __('Articles about nutrition, weight loss, health, fitness') }}">
    @endsection

    @php
        $primaryUrl = auth()->check() ? route('diary') : route('register');
        $primaryLabel = auth()->check() ? __('Go to Diary') : __('Start for free');

        $posts = [
            [
                'href' => route('blog-1'),
                'title' => __('How to Count Calories for Weight Loss — A Practical Guide'),
                'excerpt' => __('A beginner-friendly guide to calorie counting: BMR/TDEE, how to create a safe deficit, what foods to pick, and how Calorize helps you stay consistent.'),
                'image' => '/images/blog/blog-1.webp',
                'tag' => __('Calories'),
                'time' => __('7 min read'),
            ],
            [
                'href' => route('blog-2'),
                'title' => __('5 Tips for Effective Weight Loss'),
                'excerpt' => __('Five practical, repeatable habits that actually move the needle: deficit, quality foods, water, activity, and keeping a food diary.'),
                'image' => '/images/blog/blog-2.webp',
                'tag' => __('Habits'),
                'time' => __('5 min read'),
            ],
            [
                'href' => route('blog-3'),
                'title' => __('TOP 10 Foods for Healthy Eating'),
                'excerpt' => __('A simple list of foods that cover the basics: protein, fiber, micronutrients, and healthy fats — with examples you can add this week.'),
                'image' => '/images/blog/blog-3.webp',
                'tag' => __('Foods'),
                'time' => __('4 min read'),
            ],
            [
                'href' => route('blog-4'),
                'title' => __('Why Water is Important for Weight Loss?'),
                'excerpt' => __("Water supports energy, digestion, appetite control, and metabolism - here's what the research says and how much to aim for."),
                'image' => '/images/blog/blog-4.webp',
                'tag' => __('Hydration'),
                'time' => __('4 min read'),
            ],
            [
                'href' => route('blog-5'),
                'title' => __("Sport Doesn't Make You Thin: Why Exercise Often Leads to Weight Gain"),
                'excerpt' => __('Exercise is important for health but its effect on weight is variable. Learn why some people do not lose weight from training or even gain weight.'),
                'image' => '/images/blog/blog-5.svg',
                'tag' => __('Science'),
                'time' => __('8 min read'),
            ],
            [
                'href' => route('blog-6'),
                'title' => __('Rebound Is Not a Relapse: Why Weight Comes Back and Why That Is Normal'),
                'excerpt' => __('Weight regain after weight loss is not a failure. It is a predictable biological response driven by hormones and metabolism.'),
                'image' => '/images/blog/blog-6.svg',
                'tag' => __('Science'),
                'time' => __('8 min read'),
            ],
            [
                'href' => route('blog-7'),
                'title' => __('Willpower Is a Myth: Who Really Controls Your Appetite'),
                'excerpt' => __('Appetite is regulated by hormones and the brain. When diets fail, it is often biology—not weakness.'),
                'image' => '/images/blog/blog-7.svg',
                'tag' => __('Science'),
                'time' => __('8 min read'),
            ],
            [
                'href' => route('blog-8'),
                'title' => __('Set Point: Why Weight Stalls and Why the Body Resists Weight Loss'),
                'excerpt' => __('Weight plateaus are often an adaptation: lower energy expenditure, higher hunger, and a defended weight range.'),
                'image' => '/images/blog/blog-8.svg',
                'tag' => __('Science'),
                'time' => __('8 min read'),
            ],
            [
                'href' => route('blog-9'),
                'title' => __('Intuitive Eating Is Not a Universal Solution: When “Listening to Your Body” Doesn’t Work'),
                'excerpt' => __('Intuitive eating can reduce food anxiety, but after dieting “hunger cues” may be distorted and lead to gradual overeating.'),
                'image' => '/images/blog/blog-9.svg',
                'tag' => __('Science'),
                'time' => __('8 min read'),
            ],
            [
                'href' => route('blog-10'),
                'title' => __('GLP-1: How Hormonal Therapy Breaks All “Moral” Theories of Weight Loss'),
                'excerpt' => __('GLP-1 drugs change appetite, satiety, and reward signaling—showing weight control is biology, not a moral test.'),
                'image' => '/images/blog/blog-10.svg',
                'tag' => __('Science'),
                'time' => __('8 min read'),
            ],
            [
                'href' => route('blog-11'),
                'title' => __('Why Most Fitness Coaches Are Wrong (Not Out of Malice)'),
                'excerpt' => __('Selection bias: many coaches never lived through true obesity, metabolic adaptation, or rebound cycles—so their model doesn’t scale.'),
                'image' => '/images/blog/blog-11.svg',
                'tag' => __('Science'),
                'time' => __('8 min read'),
            ],
            [
                'href' => route('blog-12'),
                'title' => __('The Female Body Is Not Lazy: Why Women Often Find Weight Loss Harder'),
                'excerpt' => __('Women’s bodies often defend fat mass more strongly: lower resting expenditure, cycle-related appetite shifts, and stronger adaptation.'),
                'image' => '/images/blog/blog-12.svg',
                'tag' => __('Science'),
                'time' => __('8 min read'),
            ],
        ];
    @endphp

    <div class="min-h-[calc(100vh-4rem)] bg-[radial-gradient(1200px_circle_at_20%_-10%,rgba(245,158,11,0.16),transparent_55%),radial-gradient(900px_circle_at_90%_10%,rgba(14,165,233,0.12),transparent_50%),linear-gradient(to_bottom,rgba(250,250,249,1),rgba(255,255,255,1))]">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto pt-8 sm:pt-10 lg:pt-12 pb-12 sm:pb-16">
                <section class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                    <div class="lg:col-span-7">
                        <div class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white/70 backdrop-blur px-3.5 py-2 text-xs font-semibold text-stone-700">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                            <span>{{ __('Blog') }}</span>
                        </div>

                        <h1 class="mt-5 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                            <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                                {{ __('Useful articles about nutrition and health') }}
                            </span>
                        </h1>

                        <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600 max-w-2xl">
                            {{ __('Short, practical reads to help you eat better, lose weight safely, and stay consistent — without overthinking.') }}
                        </p>

                        <div class="mt-7 flex flex-col sm:flex-row gap-3">
                            <a href="{{ $primaryUrl }}"
                               class="inline-flex items-center justify-center gap-2 rounded-2xl bg-stone-900 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 transition">
                                <span>{{ $primaryLabel }}</span>
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <a href="{{ route('product.index') }}"
                               class="inline-flex items-center justify-center rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-5 py-3.5 text-sm font-semibold text-stone-800 hover:bg-white transition">
                                {{ __('Browse products') }}
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-5">
                        <div class="rounded-[1.75rem] border border-stone-200 bg-white/75 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                            <div class="px-6 py-5 border-b border-stone-200/70 bg-white/60">
                                <div class="text-sm font-extrabold text-stone-900">{{ __('What you’ll find here') }}</div>
                                <div class="mt-1 text-sm text-stone-600">{{ __('Simple guidance and tools you can apply today.') }}</div>
                            </div>
                            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-3">
                                <div class="rounded-2xl border border-stone-200 bg-white p-4">
                                    <div class="text-xs font-semibold text-stone-500">{{ __('Basics') }}</div>
                                    <div class="mt-1 text-sm font-semibold text-stone-800">{{ __('Calories, BMR, TDEE') }}</div>
                                </div>
                                <div class="rounded-2xl border border-stone-200 bg-white p-4">
                                    <div class="text-xs font-semibold text-stone-500">{{ __('Habits') }}</div>
                                    <div class="mt-1 text-sm font-semibold text-stone-800">{{ __('Water, activity, consistency') }}</div>
                                </div>
                                <div class="rounded-2xl border border-stone-200 bg-white p-4">
                                    <div class="text-xs font-semibold text-stone-500">{{ __('Food choices') }}</div>
                                    <div class="mt-1 text-sm font-semibold text-stone-800">{{ __('High-quality products') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mt-10 sm:mt-12">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                        @foreach($posts as $post)
                            <a href="{{ $post['href'] }}"
                               class="group rounded-[1.5rem] border border-stone-200 bg-white/80 backdrop-blur shadow-sm hover:shadow-xl hover:shadow-stone-900/5 transition overflow-hidden"
                            >
                                <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                                    <img
                                        src="{{ $post['image'] }}"
                                        alt="{{ $post['title'] }}"
                                        class="h-full w-full object-cover group-hover:scale-[1.03] transition duration-300"
                                        loading="lazy"
                                    />
                                </div>

                                <div class="p-5">
                                    <div class="flex items-center gap-2 text-xs text-stone-500">
                                        <span class="inline-flex items-center rounded-full border border-stone-200 bg-white px-2.5 py-1 font-semibold text-stone-700">
                                            {{ $post['tag'] }}
                                        </span>
                                        <span class="font-semibold">{{ $post['time'] }}</span>
                                    </div>

                                    <h2 class="mt-3 text-lg sm:text-xl font-extrabold tracking-tight text-stone-900 group-hover:text-amber-800 transition">
                                        {{ $post['title'] }}
                                    </h2>
                                    <p class="mt-2 text-sm leading-relaxed text-stone-600">
                                        {{ $post['excerpt'] }}
                                    </p>

                                    <div class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-amber-700">
                                        <span>{{ __('Read article') }}</span>
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="mt-10 sm:mt-12">
                    <div class="rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                        <div class="p-6 sm:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                            <div>
                                <div class="text-sm font-semibold text-stone-500">{{ __('Ready to put it into practice?') }}</div>
                                <div class="mt-1 text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Track meals and progress in Calorize') }}
                                </div>
                                <div class="mt-2 text-sm sm:text-base text-stone-600 max-w-2xl">
                                    {{ __('Logging takes seconds — consistency is what drives results.') }}
                                </div>
                            </div>
                            <a href="{{ $primaryUrl }}"
                               class="inline-flex items-center justify-center gap-2 rounded-2xl bg-stone-900 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 transition"
                            >
                                <span>{{ $primaryLabel }}</span>
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>