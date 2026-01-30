<x-app-layout :full-width="true">

    @section('title', __('280$ за 10 банок? Вся правда про ціни на Тирзепатид, Оземпік та Мунджаро в Україні'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Розкриваємо реальні ціни на Тирзепатид, Семаглутид та Мунджаро. Чому в Україні націнка 800%, де купують перекупи та чи варто ризикувати здоров\'ям заради економії.') }}">
        <meta name="keywords" content="{{ __('купити тирзепатид, мунджаро ціна, оземпік україна, семаглутид купити, ретатрутид, пептиди китай, схуднення уколи, tirzepatide ukraine price') }}">
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
                        <span>{{ __('Market Analysis') }}</span>
                        <span class="text-stone-400">•</span>
                        <span>{{ __('6 min read') }}</span>
                        <span class="text-stone-400">•</span>
                        <time datetime="2026-01-29">{{ \Carbon\Carbon::parse('2026-01-29')->translatedFormat('d M Y') }}</time>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('280$ за 10 банок чи 5000 грн за одну? Вся правда про ціни на Тирзепатид в Україні') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('Ми знайшли реальні ціни постачальників, у яких закуповуються українські магазини пептидів. Ваш шок буде у шоці, коли ви побачите націнку.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    
                    {{-- Visual representation of markup --}}
                    <div class="aspect-[16/9] bg-gradient-to-br from-stone-100 to-stone-50 overflow-hidden flex items-center justify-center p-8">
                        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-stone-200 overflow-hidden">
                            <div class="bg-stone-900 px-6 py-4">
                                <h3 class="text-white font-bold text-lg text-center">{{ __('Tirzepatide 30mg (Generic)') }}</h3>
                            </div>
                            <div class="p-6 grid grid-cols-2 gap-px bg-stone-200">
                                <div class="bg-white p-4 text-center">
                                    <div class="text-xs font-semibold text-stone-500 uppercase tracking-wide">{{ __('China Price') }}</div>
                                    <div class="mt-1 text-3xl font-extrabold text-emerald-600">$28</div>
                                    <div class="text-[10px] text-stone-400">{{ __('per vial') }}</div>
                                </div>
                                <div class="bg-white p-4 text-center relative overflow-hidden">
                                    <div class="text-xs font-semibold text-stone-500 uppercase tracking-wide">{{ __('Ukraine Price') }}</div>
                                    <div class="mt-1 text-3xl font-extrabold text-rose-600">$250+</div>
                                    <div class="text-[10px] text-stone-400">{{ __('per vial equivalent') }}</div>
                                    <div class="absolute top-0 right-0 bg-rose-500 text-white text-[10px] font-bold px-2 py-1 rounded-bl-lg">
                                        +800%
                                    </div>
                                </div>
                            </div>
                            <div class="bg-stone-50 px-6 py-3 text-xs text-stone-500 text-center border-t border-stone-200">
                                {{ __('Data based on wholesale quotes from January 2026') }}
                            </div>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="space-y-8 text-stone-700 leading-relaxed text-lg">
                            
                            <section>
                                <p class="font-bold text-xl text-stone-900">
                                    {{ __('Спойлер: Вас "гріють" на гроші. Сильно.') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('Якщо ви цікавитеся схудненням, ви точно бачили ці оголошення в Instagram або Telegram: "Тирзепатид", "Семаглутид", "Мунджаро-аналог", "Оземпік-дженерик". Ціни коливаються від 3000 до 6500 грн за один флакон (віалу).') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('Ми вирішили перевірити, звідки береться цей товар. Результат розслідування змусив нас схопитися за голову.') }}
                                </p>
                            </section>

                            <section>
                                <h2 class="text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Математика шоку') }}
                                </h2>
                                <p class="mt-4">
                                    {{ __('Ми знайшли прямих постачальників з Китаю (звідки їде 99% "сірого" ринку пептидів). Ось пропозиція від одного з "дорогих" та перевірених постачальників, який тестує кожну партію в незалежній лабораторії Janoshik (Чехія):') }}
                                </p>
                                
                                <div class="my-6 bg-stone-50 rounded-xl border border-stone-200 p-5 font-mono text-sm sm:text-base">
                                    <div class="flex justify-between items-center border-b border-stone-200 pb-2 mb-2">
                                        <span>Item:</span>
                                        <span class="font-bold text-stone-900">Tirzepatide 30mg</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-stone-200 pb-2 mb-2">
                                        <span>Quantity:</span>
                                        <span class="font-bold text-stone-900">10 vials (Kit)</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-stone-200 pb-2 mb-2">
                                        <span>Price:</span>
                                        <span class="font-bold text-emerald-600">$280 (incl. shipping)</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-1 text-rose-600 font-bold">
                                        <span>Cost per vial:</span>
                                        <span>$28 (~1150 UAH)</span>
                                    </div>
                                </div>

                                <p>
                                    {{ __('Це ціна за "преміум" Китай з тестами чистоти. Якщо заглибитися у Reddit, можна знайти постачальників ще вдвічі дешевше — по $140-150 за такий самий набір. Але навіть за "дорогою" ціною одна банка 30 мг коштує 1150 грн.') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('В Україні зазвичай продають флакони по 5 мг, 10 мг або 15 мг. Давайте порахуємо вартість 1 мг діючої речовини:') }}
                                </p>
                                <ul class="list-disc pl-5 mt-2 space-y-2">
                                    <li><strong>{{ __('Китай (дорогий):') }}</strong> {{ __('~38 грн за 1 мг') }}</li>
                                    <li><strong>{{ __('Китай (дешевий):') }}</strong> {{ __('~19 грн за 1 мг') }}</li>
                                    <li><strong>{{ __('Україна (перекуп):') }}</strong> {{ __('~330-430 грн за 1 мг (при ціні 5000-6500 грн за 15 мг)') }}</li>
                                </ul>
                                <p class="mt-4 font-bold text-rose-600">
                                    {{ __('Націнка складає від 900% до 2200%.') }}
                                </p>
                            </section>

                            <section>
                                <h2 class="text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Чому так дорого?') }}
                                </h2>
                                <p class="mt-4">
                                    {{ __('Продавці скажуть вам про "складну логістику", "холодові ланцюги" та "митницю". Частково це правда — доставка пептидів вимагає дотримання температурного режиму (хоча не всі дотримуються його ідеально).') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('Але основна причина — це "податок на страх" і "податок на незнання". Люди бояться замовляти напряму з Китаю, не знають перевірених заводів (QSC та інші) і бояться проблем з оплатою криптою.') }}
                                </p>
                            </section>

                            <section>
                                <h2 class="text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Небезпечна правда про "Сірий Ринок"') }}
                                </h2>
                                <div class="bg-amber-50 border-l-4 border-amber-400 p-4 my-4 text-base">
                                    <p class="font-bold text-amber-800">{{ __('Важливо:') }}</p>
                                    <p class="mt-1 text-amber-700">{{ __('Ми не закликаємо купувати препарати в Китаї. Ми закликаємо розуміти ризики.') }}</p>
                                </div>
                                <p class="mt-4">
                                    {{ __('Коли ви купуєте "банку без наклейки" в українському телеграм-каналі за 5000 грн, ви отримуєте ТУ САМУ китайську банку, яка коштує 28$.') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('Перекупник не має своєї лабораторії. Він не виробляє препарат. Він просто замовляє його оптом і перепродує вам. Ризики чистоти (purity), недоливу або зіпсованого при доставці товару залишаються тими ж самими, тільки ви платите за них у 9 разів більше.') }}
                                </p>
                            </section>

                            <section>
                                <h2 class="text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Що робити?') }}
                                </h2>
                                <p class="mt-4">
                                    <strong>{{ __('1. Не будьте наївними.') }}</strong> {{ __('Розумійте, що "авторський курс схуднення" за 10 тисяч гривень — це часто просто перепродаж дешевого дженерика.') }}
                                </p>
                                <p class="mt-2">
                                    <strong>{{ __('2. Консультуйтеся з лікарем.') }}</strong> {{ __('Офіційні препарати (Ozempic, Mounjaro в шприц-ручках) коштують дорого через патентний захист, клінічні випробування і гарантію якості. Дженерики — це лотерея.') }}
                                </p>
                                <p class="mt-2">
                                    <strong>{{ __('3. Терапія — це надовго.') }}</strong> {{ __('Ожиріння — це хронічна хвороба, і "курсом на місяць" її не вилікувати. Світові дослідження показують, що для утримання ваги терапія пептидами може бути потрібна роками або навіть довічно. "Просто сила волі" тут часто не працює.') }}
                                </p>
                                <p class="mt-2">
                                    {!! __('Але навіть на терапії вам потрібен контроль. Не для того, щоб "менше їсти" (препарат зробить це за вас), а щоб <strong>їсти достатньо</strong>. Головний ризик на пептидах — втрата м\'язів (саркопенія) через те, що ви просто перестаєте їсти білок.') !!}
                                </p>
                            </section>

                            <hr class="border-stone-200">

                            <section>
                                <h2 class="text-2xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Навіщо тоді Calorize?') }}
                                </h2>
                                <p class="mt-4">
                                    {{ __('Якщо ви на терапії, вам критично важливо добирати норму білка, щоб не перетворитися на "skinny fat" і не втратити волосся. Calorize — це ідеальний компаньйон для терапії.') }}
                                </p>
                                <p class="mt-4">
                                    {{ __('Наш AI-щоденник допоможе стежити за нутрієнтами без стресу. Просто скажіть "з\'їла стейк", і ми порахуємо білок за вас.') }}
                                </p>
                            </section>

                        </div>

                        <div class="mt-12 rounded-[1.5rem] border border-stone-200 bg-stone-50 p-6 sm:p-8">
                            <div class="text-sm font-semibold text-stone-500">{{ __('Ваш компаньйон у терапії') }}</div>
                            <div class="mt-2 text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">{{ __('Стежте за білком, а не тільки за вагою') }}</div>
                            <div class="mt-3 text-base text-stone-600">{{ __('Calorize допоможе зберегти здоров\'я та м\'язи під час схуднення. Спробуйте безкоштовно.') }}</div>
                            <div class="mt-6 flex flex-col sm:flex-row gap-4">
                                <a href="{{ $primaryUrl }}" class="inline-flex items-center justify-center rounded-2xl bg-stone-900 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 transition">
                                    {{ $primaryLabel }}
                                </a>
                                <a href="{{ route('blog') }}" class="inline-flex items-center justify-center rounded-2xl border border-stone-200 bg-white px-6 py-3.5 text-base font-semibold text-stone-800 hover:bg-white transition">
                                    {{ __('Читати інші статті') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
