<x-app-layout :full-width="true">

    @section('title', __('Calorize: Full Feature Overview. Why It\'s the Most Effective Weight Loss Tool'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn how Calorize solves major weight loss problems: precise home meal calculation, instant Ukrainian product search, and AI that handles the routine.') }}">
        <meta name="keywords" content="{{ __('Calorize, weight loss, calorie counting, AI nutritionist, recipes, Ukrainian products, food diary') }}">
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
                        <span>{{ __('Feature Overview') }}</span>
                        <span class="text-stone-400">•</span>
                        <span>{{ __('6 min read') }}</span>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('Calorize: Full Feature Overview. Why It\'s the Most Effective Weight Loss Tool') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('Most people quit calorie counting for two reasons: it takes too much time or doesn\'t yield expected results due to inaccuracies. Calorize was created to eliminate both problems.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-gradient-to-br from-amber-50 via-stone-50 to-sky-50 overflow-hidden flex items-center justify-center">
                        <svg viewBox="0 0 800 450" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                            <!-- Background decorative elements -->
                            <circle cx="120" cy="80" r="180" fill="url(#grad1)" opacity="0.4"/>
                            <circle cx="700" cy="380" r="150" fill="url(#grad2)" opacity="0.3"/>
                            
                            <!-- Central phone mockup -->
                            <g transform="translate(280, 40)">
                                <rect x="0" y="0" width="240" height="370" rx="28" fill="#1c1917" stroke="#292524" stroke-width="2"/>
                                <rect x="8" y="8" width="224" height="354" rx="22" fill="#fafaf9"/>
                                
                                <!-- Phone screen content - Chat UI -->
                                <rect x="16" y="16" width="208" height="40" rx="8" fill="#f5f5f4"/>
                                <text x="120" y="42" text-anchor="middle" font-size="14" font-weight="700" fill="#44403c">Щоденник</text>
                                
                                <!-- Chat messages -->
                                <g transform="translate(16, 70)">
                                    <!-- User message -->
                                    <rect x="50" y="0" width="150" height="36" rx="12" fill="#f59e0b"/>
                                    <text x="125" y="23" text-anchor="middle" font-size="11" fill="white" font-weight="500">тарілка борщу 300г</text>
                                    
                                    <!-- AI response -->
                                    <rect x="0" y="46" width="170" height="50" rx="12" fill="#f5f5f4" stroke="#e7e5e4" stroke-width="1"/>
                                    <text x="12" y="68" font-size="10" fill="#57534e">✓ Додано: Борщ</text>
                                    <text x="12" y="84" font-size="10" fill="#78716c">102 ккал · Обід</text>
                                    
                                    <!-- User message 2 -->
                                    <rect x="60" y="106" width="140" height="36" rx="12" fill="#f59e0b"/>
                                    <text x="130" y="129" text-anchor="middle" font-size="11" fill="white" font-weight="500">56,8 кг</text>
                                    
                                    <!-- AI response 2 -->
                                    <rect x="0" y="152" width="180" height="50" rx="12" fill="#f5f5f4" stroke="#e7e5e4" stroke-width="1"/>
                                    <text x="12" y="174" font-size="10" fill="#57534e">✓ Вага записана</text>
                                    <text x="12" y="190" font-size="10" fill="#78716c">До мети: 21 день 🎯</text>
                                </g>
                                
                                <!-- Input field -->
                                <rect x="16" y="310" width="208" height="40" rx="12" fill="#f5f5f4" stroke="#e7e5e4" stroke-width="1"/>
                                <text x="28" y="335" font-size="11" fill="#a8a29e">Напишіть щось...</text>
                                <circle cx="200" cy="330" r="14" fill="#f59e0b"/>
                                <path d="M195 330 L205 330 M200 325 L200 335" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            </g>
                            
                            <!-- Left side - Recipe calculation -->
                            <g transform="translate(40, 100)">
                                <rect x="0" y="0" width="180" height="140" rx="16" fill="white" stroke="#e7e5e4" stroke-width="1" filter="url(#shadow)"/>
                                <text x="16" y="28" font-size="12" font-weight="700" fill="#1c1917">🍲 Розрахунок рецепту</text>
                                
                                <!-- Ingredients list -->
                                <text x="16" y="52" font-size="10" fill="#78716c">Картопля сира</text>
                                <text x="145" y="52" font-size="10" fill="#57534e" text-anchor="end">400г</text>
                                
                                <text x="16" y="70" font-size="10" fill="#78716c">М'ясо яловичини</text>
                                <text x="145" y="70" font-size="10" fill="#57534e" text-anchor="end">300г</text>
                                
                                <text x="16" y="88" font-size="10" fill="#78716c">Овочі</text>
                                <text x="145" y="88" font-size="10" fill="#57534e" text-anchor="end">200г</text>
                                
                                <line x1="16" y1="100" x2="164" y2="100" stroke="#e7e5e4" stroke-width="1"/>
                                
                                <text x="16" y="118" font-size="10" font-weight="600" fill="#1c1917">Готова страва:</text>
                                <text x="145" y="118" font-size="10" font-weight="600" fill="#f59e0b" text-anchor="end">680г</text>
                                
                                <!-- Arrow showing calculation -->
                                <path d="M165 60 L185 80 L165 100" stroke="#d6d3d1" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            
                            <!-- Right side - Progress chart -->
                            <g transform="translate(560, 80)">
                                <rect x="0" y="0" width="190" height="160" rx="16" fill="white" stroke="#e7e5e4" stroke-width="1" filter="url(#shadow)"/>
                                <text x="16" y="28" font-size="12" font-weight="700" fill="#1c1917">📊 Прогрес</text>
                                
                                <!-- Mini chart -->
                                <g transform="translate(16, 45)">
                                    <polyline points="0,70 30,65 60,55 90,60 120,45 150,30" stroke="#f59e0b" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="150" cy="30" r="5" fill="#f59e0b"/>
                                    
                                    <!-- Chart grid -->
                                    <line x1="0" y1="70" x2="158" y2="70" stroke="#e7e5e4" stroke-width="1"/>
                                    <text x="0" y="85" font-size="8" fill="#a8a29e">Тиж 1</text>
                                    <text x="130" y="85" font-size="8" fill="#a8a29e">Тиж 6</text>
                                </g>
                                
                                <!-- Goal date -->
                                <rect x="16" y="120" width="158" height="28" rx="8" fill="#ecfdf5"/>
                                <text x="95" y="139" text-anchor="middle" font-size="10" font-weight="600" fill="#059669">🎯 Мета: 15 лютого</text>
                            </g>
                            
                            <!-- Bottom - Product search -->
                            <g transform="translate(560, 260)">
                                <rect x="0" y="0" width="190" height="130" rx="16" fill="white" stroke="#e7e5e4" stroke-width="1" filter="url(#shadow)"/>
                                <text x="16" y="28" font-size="12" font-weight="700" fill="#1c1917">🔍 86 000 продуктів</text>
                                
                                <!-- Product items -->
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
                            
                            <!-- Floating elements -->
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
                            
                            <!-- Sparkle effects -->
                            <g fill="#f59e0b" opacity="0.6">
                                <circle cx="260" cy="60" r="3"/>
                                <circle cx="540" cy="100" r="2"/>
                                <circle cx="240" cy="380" r="2.5"/>
                                <circle cx="580" cy="420" r="2"/>
                            </g>
                            
                            <!-- Definitions -->
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
                                    {{ __('1. Precise Calculation of Complex Meals (And Why It\'s Critical)') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('The biggest "blind spot" in weight loss is home-cooked food. When you boil soup or roast meat, products lose moisture but retain calories. 100 grams of raw chicken and 100 grams of roasted chicken have completely different energy values. Ignoring this fact can silently add 300-400 extra calories to your daily diet.') }}</p>
                                    
                                    <div class="bg-stone-50 border-l-4 border-stone-300 p-4 my-4">
                                        <p class="font-semibold text-stone-900">{{ __('How Calorize Solves This:') }}</p>
                                        <p class="mt-2 text-sm sm:text-base">{!! __('We implemented a professional calculation algorithm. You enter the weight of all raw ingredients, and then — <strong>the weight of the finished dish</strong>. The system automatically calculates the shrinkage/evaporation coefficient. This gives you laboratory precision for every spoonful of your homemade borscht or stew.') !!}</p>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('2. AI Assistant That Saves Your Time') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('Keeping a diary often becomes a tiring routine. Searching lists, selecting grams, switching screens — this creates friction that makes us skip entries.') }}</p>
                                    <p>{!! __('Calorize offers a different approach: <strong>natural language communication</strong>. This is your personal nutrition secretary.') !!}</p>
                                    
                                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                        <li class="bg-white border border-stone-200 rounded-xl p-4 shadow-sm">
                                            <div class="font-bold text-stone-900 mb-1">{{ __('Understanding Slang') }}</div>
                                            <p class="text-sm">{{ __('Write "candy" or "raffaello" — the agent understands the context, finds the right product in your history, and adds it.') }}</p>
                                        </li>
                                        <li class="bg-white border border-stone-200 rounded-xl p-4 shadow-sm">
                                            <div class="font-bold text-stone-900 mb-1">{{ __('Intelligent Estimation') }}</div>
                                            <p class="text-sm">{{ __('Describe a complex dish ("puff pastry with cinnamon in an air fryer"), and the agent will model its composition and calorie content itself.') }}</p>
                                        </li>
                                    </ul>

                                    <p class="mt-2">{{ __('Quick commands for routine automation are also available:') }}</p>
                                    <ul class="list-disc pl-5 space-y-1 text-stone-600">
                                        <li>{!! __('<em>"Copy yesterday\'s breakfast"</em> — ideal for those with stable habits.') !!}</li>
                                        <li>{!! __('<em>"Delete everything for today"</em> — if you decided to start the day with a clean slate.') !!}</li>
                                    </ul>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('3. Adapted Database: 86,000 Ukrainian Products') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('There is nothing more annoying than looking for ordinary cheese and getting dozens of American brand options. It takes time and reduces accuracy.') }}</p>
                                    <p>{{ __('Our database is a showcase of a Ukrainian supermarket. Local brands, bakery from popular chains — it\'s all here. You find exactly the product you are holding in seconds. No duplicates, no junk.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('4. Progress Transparency: Knowing When You\'ll See Results') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('Weight loss is a non-linear process. Weight can stall for weeks, even if you do everything right. It\'s demotivating.') }}</p>
                                    <p>{!! __('Calorize analyzes not just weight, but your average calorie deficit and activity to build a <strong>dynamic goal achievement date forecast</strong>. It\'s an honest answer to the question "How much longer?". When you see a specific date, the path becomes clear and manageable.') !!}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('5. Instant Measurement Logging') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('You don\'t need to look for special menus to log your morning weight. Just write to the agent in the chat:') }}</p>
                                    <div class="flex items-center gap-3">
                                        <span class="font-mono bg-stone-100 px-3 py-1.5 rounded-lg text-stone-800 border border-stone-200">{{ __('56.9 kg') }}</span>
                                        <span class="text-stone-500 text-sm">{{ __('or') }}</span>
                                        <span class="font-mono bg-stone-100 px-3 py-1.5 rounded-lg text-stone-800 border border-stone-200">{{ __('waist 65') }}</span>
                                    </div>
                                    <p>{{ __('The system recognizes this as tracking data and instantly updates your charts. It\'s a small detail that makes using the app seamless in daily life.') }}</p>
                                </div>
                            </section>

                            <hr class="border-stone-200">

                            <section>
                                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Why It Works?') }}
                                </h2>
                                <div class="mt-4 space-y-4">
                                    <p>{{ __('Calorize isn\'t about "magic". It\'s about removing obstacles. We removed complex recipe math, long product searches, and tedious data entry.') }}</p>
                                    <p>{{ __('Only pure focus on your goal remains. When a tool is convenient, you use it consistently. And consistency is the only key to results.') }}</p>
                                </div>
                            </section>

                        </div>

                        <div class="mt-12 rounded-[1.5rem] border border-stone-200 bg-stone-50 p-6 sm:p-8">
                            <div class="text-sm font-semibold text-stone-500">{{ __('Your Next Step') }}</div>
                            <div class="mt-2 text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">{{ __('Try a Stress-Free Approach') }}</div>
                            <div class="mt-3 text-base text-stone-600">{{ __('Join thousands of users who have already appreciated the convenience of Calorize.') }}</div>
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
