<x-app-layout :full-width="true">

    @section('title', __('Calorize: The \'Anti-Boring\' Guide to Weight Loss (Class is in Session)'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Most apps can count calories. The hard part is doing it every day. Calorize makes consistency easy with a human AI diary, Ukrainian-first search, and fast voice logging.') }}">
        <meta name="keywords" content="{{ __('Calorize, weight loss, AI nutritionist, funny diet app, precise calorie counting') }}">
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
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        <span>{{ __('Product Update') }}</span>
                        <span class="text-stone-400">•</span>
                        <span>{{ __('5 min read') }}</span>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('Class is in Session: Why Calorize isn\'t just another "eat less" app') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('OK, class. Settle down. Most apps can calculate numbers. The real problem is that tracking feels like work. Calorize is built around a human AI assistant that makes logging feel natural, not like homework.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    {{-- The same cool SVG image --}}
                    <div class="aspect-[16/9] bg-gradient-to-br from-amber-50 via-stone-50 to-sky-50 overflow-hidden flex items-center justify-center">
                        <svg viewBox="0 0 800 450" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                            <circle cx="120" cy="80" r="180" fill="url(#grad1)" opacity="0.4"/>
                            <circle cx="700" cy="380" r="150" fill="url(#grad2)" opacity="0.3"/>
                            <g transform="translate(280, 40)">
                                <rect x="0" y="0" width="240" height="370" rx="28" fill="#1c1917" stroke="#292524" stroke-width="2"/>
                                <rect x="8" y="8" width="224" height="354" rx="22" fill="#fafaf9"/>
                                <rect x="16" y="16" width="208" height="40" rx="8" fill="#f5f5f4"/>
                                <text x="120" y="42" text-anchor="middle" font-size="14" font-weight="700" fill="#44403c">Щоденник</text>
                                <g transform="translate(16, 70)">
                                    <rect x="50" y="0" width="150" height="36" rx="12" fill="#f59e0b"/>
                                    <text x="125" y="23" text-anchor="middle" font-size="11" fill="white" font-weight="500">тарілка борщу 300г</text>
                                    <rect x="0" y="46" width="170" height="50" rx="12" fill="#f5f5f4" stroke="#e7e5e4" stroke-width="1"/>
                                    <text x="12" y="68" font-size="10" fill="#57534e">✓ Додано: Борщ</text>
                                    <text x="12" y="84" font-size="10" fill="#78716c">102 ккал · Обід</text>
                                    <rect x="60" y="106" width="140" height="36" rx="12" fill="#f59e0b"/>
                                    <text x="130" y="129" text-anchor="middle" font-size="11" fill="white" font-weight="500">56,8 кг</text>
                                    <rect x="0" y="152" width="180" height="50" rx="12" fill="#f5f5f4" stroke="#e7e5e4" stroke-width="1"/>
                                    <text x="12" y="174" font-size="10" fill="#57534e">✓ Вага записана</text>
                                    <text x="12" y="190" font-size="10" fill="#78716c">До мети: 21 день 🎯</text>
                                </g>
                                <rect x="16" y="310" width="208" height="40" rx="12" fill="#f5f5f4" stroke="#e7e5e4" stroke-width="1"/>
                                <text x="28" y="335" font-size="11" fill="#a8a29e">Напишіть щось...</text>
                                <circle cx="200" cy="330" r="14" fill="#f59e0b"/>
                                <path d="M195 330 L205 330 M200 325 L200 335" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            </g>
                            <g transform="translate(40, 100)">
                                <rect x="0" y="0" width="180" height="140" rx="16" fill="white" stroke="#e7e5e4" stroke-width="1" filter="url(#shadow)"/>
                                <text x="16" y="28" font-size="12" font-weight="700" fill="#1c1917">🍲 Розрахунок рецепту</text>
                                <text x="16" y="52" font-size="10" fill="#78716c">Картопля сира</text>
                                <text x="145" y="52" font-size="10" fill="#57534e" text-anchor="end">400г</text>
                                <text x="16" y="70" font-size="10" fill="#78716c">М'ясо яловичини</text>
                                <text x="145" y="70" font-size="10" fill="#57534e" text-anchor="end">300г</text>
                                <text x="16" y="88" font-size="10" fill="#78716c">Овочі</text>
                                <text x="145" y="88" font-size="10" fill="#57534e" text-anchor="end">200г</text>
                                <line x1="16" y1="100" x2="164" y2="100" stroke="#e7e5e4" stroke-width="1"/>
                                <text x="16" y="118" font-size="10" font-weight="600" fill="#1c1917">Готова страва:</text>
                                <text x="145" y="118" font-size="10" font-weight="600" fill="#f59e0b" text-anchor="end">680г</text>
                                <path d="M165 60 L185 80 L165 100" stroke="#d6d3d1" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <g transform="translate(560, 80)">
                                <rect x="0" y="0" width="190" height="160" rx="16" fill="white" stroke="#e7e5e4" stroke-width="1" filter="url(#shadow)"/>
                                <text x="16" y="28" font-size="12" font-weight="700" fill="#1c1917">📊 Прогрес</text>
                                <g transform="translate(16, 45)">
                                    <polyline points="0,70 30,65 60,55 90,60 120,45 150,30" stroke="#f59e0b" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="150" cy="30" r="5" fill="#f59e0b"/>
                                    <line x1="0" y1="70" x2="158" y2="70" stroke="#e7e5e4" stroke-width="1"/>
                                    <text x="0" y="85" font-size="8" fill="#a8a29e">Тиж 1</text>
                                    <text x="130" y="85" font-size="8" fill="#a8a29e">Тиж 6</text>
                                </g>
                                <rect x="16" y="120" width="158" height="28" rx="8" fill="#ecfdf5"/>
                                <text x="95" y="139" text-anchor="middle" font-size="10" font-weight="600" fill="#059669">🎯 Мета: 15 лютого</text>
                            </g>
                            <g transform="translate(560, 260)">
                                <rect x="0" y="0" width="190" height="130" rx="16" fill="white" stroke="#e7e5e4" stroke-width="1" filter="url(#shadow)"/>
                                <text x="16" y="28" font-size="12" font-weight="700" fill="#1c1917">🔍 86 000 продуктів</text>
                                <g transform="translate(12, 40)">
                                    <rect x="0" y="0" width="166" height="26" rx="6" fill="#fafaf9"/>
                                    <text x="8" y="17" font-size="9" fill="#57534e">Яготинське 2.6%</text>
                                    <text x="158" y="17" text-anchor="end" font-size="9" fill="#78716c">52</text>
                                </g>
                                <g transform="translate(12, 72)">
                                    <rect x="0" y="0" width="166" height="26" rx="6" fill="#fafaf9"/>
                                    <text x="8" y="17" font-size="9" fill="#57534e">Рошен Конафето</text>
                                    <text x="158" y="17" text-anchor="end" font-size="9" fill="#78716c">523</text>
                                </g>
                            </g>
                            <g transform="translate(50, 280)">
                                <circle cx="20" cy="20" r="24" fill="white" stroke="#e7e5e4" stroke-width="1" filter="url(#shadow)"/>
                                <text x="20" y="26" text-anchor="middle" font-size="20">🥗</text>
                            </g>
                            <g transform="translate(180, 320)">
                                <circle cx="20" cy="20" r="20" fill="white" stroke="#e7e5e4" stroke-width="1" filter="url(#shadow)"/>
                                <text x="20" y="26" text-anchor="middle" font-size="16">🍎</text>
                            </g>
                            <g transform="translate(100, 360)">
                                <circle cx="16" cy="16" r="18" fill="white" stroke="#e7e5e4" stroke-width="1" filter="url(#shadow)"/>
                                <text x="16" y="22" text-anchor="middle" font-size="14">🥛</text>
                            </g>
                            <g fill="#f59e0b" opacity="0.6">
                                <circle cx="260" cy="60" r="3"/>
                                <circle cx="540" cy="100" r="2"/>
                                <circle cx="240" cy="380" r="2.5"/>
                                <circle cx="580" cy="420" r="2"/>
                            </g>
                            <defs>
                                <radialGradient id="grad1" cx="50%" cy="50%" r="50%">
                                    <stop offset="0%" stop-color="#f59e0b" stop-opacity="0.3"/>
                                    <stop offset="100%" stop-color="#f59e0b" stop-opacity="0"/>
                                </radialGradient>
                                <radialGradient id="grad2" cx="50%" cy="50%" r="50%">
                                    <stop offset="0%" stop-color="#0ea5e9" stop-opacity="0.25"/>
                                    <stop offset="100%" stop-color="#0ea5e9" stop-opacity="0"/>
                                </radialGradient>
                                <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
                                    <feDropShadow dx="0" dy="4" stdDeviation="8" flood-color="#1c1917" flood-opacity="0.08"/>
                                </filter>
                            </defs>
                        </svg>
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="space-y-12 text-stone-700 leading-relaxed">
                            
                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('The most human AI food diary you’ll use') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('Most people don’t quit because they don’t understand calories. They quit because logging is annoying. So we made the diary conversational: you write like a human, and the AI does the admin work.') }}</p>

                                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                        <li class="bg-white border border-stone-200 rounded-xl p-4 shadow-sm">
                                            <div class="font-bold text-stone-900 mb-1">{{ __('It remembers context') }}</div>
                                            <p class="text-sm">{{ __('Ate “Strila” candy yesterday? Today you can type one word (“kanhveta”) and the agent will add it — without interrogation.') }}</p>
                                        </li>
                                        <li class="bg-white border border-stone-200 rounded-xl p-4 shadow-sm">
                                            <div class="font-bold text-stone-900 mb-1">{{ __('It understands real Ukrainian') }}</div>
                                            <p class="text-sm">{{ __('Slang, typos, mixed phrases, voice input — it’s built for how people actually talk, not how databases want you to.') }}</p>
                                        </li>
                                        <li class="bg-white border border-stone-200 rounded-xl p-4 shadow-sm">
                                            <div class="font-bold text-stone-900 mb-1">{{ __('It can estimate complex dishes') }}</div>
                                            <p class="text-sm">{{ __('Describe your pastry experiment with cinnamon, sugar, and an air fryer. The agent will model the recipe and create a reasonable calorie estimate.') }}</p>
                                        </li>
                                        <li class="bg-white border border-stone-200 rounded-xl p-4 shadow-sm">
                                            <div class="font-bold text-stone-900 mb-1">{{ __('It logs measurements too') }}</div>
                                            <p class="text-sm">{{ __('Just write “56.8 kg”. The agent understands it’s a measurement and records it. Done.') }}</p>
                                        </li>
                                    </ul>

                                    <div class="bg-stone-50 border-l-4 border-stone-300 p-4 my-4">
                                        <p class="font-semibold text-stone-900">{{ __('Short commands, big impact') }}</p>
                                        <p class="mt-2 text-sm sm:text-base">{{ __('Try: “Copy yesterday to today”, “Delete all today”, or “Copy yesterday’s breakfast”. This is what “frictionless” looks like.') }}</p>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('We speak Ukrainian (and not just via Google Translate)') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('Stop logging "Generic Cheddar Cheese" from a database made in Ohio. You shop at ATB and Silpo, and so does our database.') }}</p>
                                    <p>{{ __('86,000 local products. Yahotynske, Roshen, that specific bread you like. Real brands, zero duplicates. It\'s a beautiful, organized paradise.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Recipe calculation, but painless') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('Yes, many apps can calculate recipes. The difference is whether you want to use them on a random Tuesday.') }}</p>
                                    <p>{!! __('In Calorize it’s straightforward: enter ingredient weights, then enter the final cooked weight. <strong>We handle the shrinkage math</strong> and give you accurate per-100g nutrition for the dish you actually eat.') !!}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('The Oracle of Weight Loss') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('Graphs are nice, but they don\'t tell you when you\'ll fit into those jeans. We do.') }}</p>
                                    <p>{!! __('Calorize calculates a <strong>dynamic completion date</strong> based on your actual progress. It\'s not a random guess; it\'s math. Watching that date move closer is the best dopamine hit you\'ll get all day.') !!}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('One box to rule them all') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('Want to log your weight? Don\'t go looking for the "Measurements" tab buried in settings. Just tell the agent:') }}</p>
                                    <div class="flex items-center gap-3">
                                        <span class="font-mono bg-stone-100 px-3 py-1.5 rounded-lg text-stone-800 border border-stone-200">{{ __('56.9 kg') }}</span>
                                    </div>
                                    <p>{{ __('Boom. Done. Chart updated. Now go on with your life.') }}</p>
                                </div>
                            </section>

                            <hr class="border-stone-200">

                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('TL;DR') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('Calorize is built around one idea: consistency beats perfection. Our AI makes tracking feel human, so you actually keep doing it. The rest (database, recipes, analytics) supports that.') }}</p>
                                </div>
                            </section>

                        </div>

                        <div class="mt-12 rounded-[1.5rem] border border-stone-200 bg-stone-50 p-6 sm:p-8">
                            <div class="text-sm font-semibold text-stone-500">{{ __('Homework assignment') }}</div>
                            <div class="mt-2 text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">{{ __('Try it. Your future self will thank you.') }}</div>
                            <div class="mt-3 text-base text-stone-600">{{ __('Join thousands of users who stopped hating calorie counting.') }}</div>
                            <div class="mt-6 flex flex-col sm:flex-row gap-4">
                                <a href="{{ $primaryUrl }}" class="inline-flex items-center justify-center rounded-2xl bg-stone-900 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 transition">
                                    {{ $primaryLabel }}
                                </a>
                                <a href="{{ route('blog') }}" class="inline-flex items-center justify-center rounded-2xl border border-stone-200 bg-white px-6 py-3.5 text-base font-semibold text-stone-800 hover:bg-white transition">
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
