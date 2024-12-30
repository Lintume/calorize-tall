<x-app-layout>

    @section('title', 'Calorize - Ваш помічник у контролі калорійності')

    @section('meta')
        <meta name="description"
              content="Ведіть щоденник калорійності легко та ефективно за допомогою нашого додатка. Контролюйте харчування, досягайте своїх цілей і слідкуйте за прогресом.">
        <meta name="keywords"
              content="щоденник калорійності, контроль харчування, схуднення, здорове харчування, додаток для підрахунку калорій">
        <meta name="author" content="Calorize">
    @endsection


    <!-- Головний хедер -->
    <header class="bg-amber-700 text-white py-10 px-4">
        <div class="container mx-auto text-center">
            <div class="flex flex-col items-center">
                <!-- Логотип -->
                <img
                    src="/logo.png"
                    alt="Calorize Logo"
                    class="w-28 h-24 object-cover mb-3"
                    style="object-position: top;"
                />

                <!-- Заголовок H1 -->
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Calorize<br>
                    Контроль калорійності з легкістю
                </h1>

                <!-- Короткий опис -->
                <p class="mt-4 text-lg max-w-xl mx-auto">
                    Досягайте своїх цілей у харчуванні швидше, використовуючи наш зручний
                    <a href="{{ route('diary') }}" class="underline hover:text-amber-300">щоденник калорійності</a>.
                </p>

                <!-- Кнопка дії -->
                <a
                    href="{{ route('register') }}"
                    class="mt-6 inline-block bg-white text-amber-700 font-semibold px-6 py-3 rounded-lg shadow hover:bg-amber-100 transition-colors"
                >
                    Зареєструватися зараз
                </a>
            </div>
        </div>
    </header>


    <!-- Основний контент -->
    <div class="py-12">

        <!-- Секція переваг (Why Calorize?) -->
        <section class="container mx-auto px-4 py-8 bg-amber-50 rounded-md">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-8">
                Чому обирають Calorize?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Картка 1: Розрахунок калорій -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <a href="{{ route('personal') }}" class="block">
                        <!-- Заголовок із іконкою -->
                        <h3 class="text-xl font-semibold mb-2 flex items-center space-x-4">
                            <i class="fa-solid fa-calculator text-2xl text-amber-700"></i>
                            <span>Розрахунок калорій</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            Визначте вашу добову норму калорій за кілька секунд, використовуючи наукові формули.
                        </p>
                    </a>
                </div>

                <!-- Картка 2: Велика база продуктів -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <a href="{{ route('product.index') }}" class="block">
                        <h3 class="text-xl font-semibold mb-2 flex items-center space-x-4">
                            <i class="fa-solid fa-apple-whole text-2xl text-amber-700"></i>
                            <span>Велика база продуктів</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            Шукайте серед тисяч продуктів із детальною інформацією про калорії, білки, жири та вуглеводи.
                        </p>
                    </a>
                </div>

                <!-- Картка 3: Графіки прогресу -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <a href="{{ route('statistic') }}" class="block">
                        <h3 class="text-xl font-semibold mb-2 flex items-center space-x-4">
                            <i class="fa-solid fa-chart-line text-2xl text-amber-700"></i>
                            <span>Графіки прогресу</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            Слідкуйте за своєю вагою та БЖУ за допомогою зручних графіків.
                        </p>
                    </a>
                </div>

                <!-- Картка 4: Власні рецепти -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <a href="{{ route('recipe.index') }}" class="block">
                        <h3 class="text-xl font-semibold mb-2 flex items-center space-x-4">
                            <i class="fa-solid fa-utensils text-2xl text-amber-700"></i>
                            <span>Власні рецепти</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            Створюйте власні рецепти та автоматично розраховуйте їх калорійність.
                        </p>
                    </a>
                </div>

            </div>
        </section>

        <!-- Проміжна CTA-секція -->
        <section class="bg-amber-100 py-12 mt-12 rounded-lg">
            <div class="container mx-auto text-center px-4">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Почніть свій шлях до здорового харчування вже сьогодні!
                </h2>
                <p class="text-lg max-w-2xl mx-auto mb-6 leading-relaxed">
                    Calorize допоможе вам стати найкращою версією себе. Легко, зручно та ефективно.
                </p>
                <a
                    href="{{ route('register') }}"
                    class="bg-amber-700 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-amber-800 transition-colors"
                >
                    Створити обліковий запис
                </a>
            </div>
        </section>

        <!-- Відгуки -->
        <section class="container mx-auto py-12 px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-8">
                Відгуки наших користувачів
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Відгук 1 -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <p class="italic text-gray-700">
                        «Calorize став моїм незамінним помічником у схудненні. Тепер я легко контролюю
                        своє харчування та бачу результати!»
                    </p>
                    <p class="text-right font-semibold mt-4 text-gray-800">
                        – Ольга, 29 років
                    </p>
                </div>
                <!-- Відгук 2 -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <p class="italic text-gray-700">
                        «Нарешті додаток, який враховує всі мої потреби. Зручний інтерфейс,
                        величезна база продуктів і мотивація триматися плану!»
                    </p>
                    <p class="text-right font-semibold mt-4 text-gray-800">
                        – Дмитро, 35 років
                    </p>
                </div>
            </div>
        </section>

        <!-- Блог (карусель) -->
        <section class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-8">
                Наш блог
            </h2>
            <div class="relative">
                <!-- Врахуйте, що flex-скрол карусель зручніший на десктопі,
                     але для мобільних варто або зробити свайп, або використовувати Glide/Swiper -->
                <div class="carousel flex overflow-x-auto space-x-4">
                    <!-- Картка блогу 1 -->
                    <div class="bg-white p-6 rounded-lg shadow w-[300px] flex-shrink-0 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">
                            5 порад для ефективного схуднення
                        </h3>
                        <p class="text-gray-600">
                            Дізнайтеся, як досягти своєї ідеальної ваги без шкоди для здоров'я.
                        </p>
                        <a
                            href="{{ route('blog-2') }}"
                            class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                        >
                            Читати більше
                        </a>
                    </div>

                    <!-- Картка блогу 2 -->
                    <div class="bg-white p-6 rounded-lg shadow w-[300px] flex-shrink-0 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">
                            Як правильно рахувати калорії?
                        </h3>
                        <p class="text-gray-600">
                            Крок за кроком: дізнайтеся, як підрахунок калорій може змінити ваше життя.
                        </p>
                        <a
                            href="{{ route('blog-1') }}"
                            class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                        >
                            Читати більше
                        </a>
                    </div>

                    <!-- Картка блогу 3 -->
                    <div class="bg-white p-6 rounded-lg shadow w-[300px] flex-shrink-0 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">
                            ТОП-10 продуктів для здорового харчування
                        </h3>
                        <p class="text-gray-600">
                            Перелік продуктів, які допоможуть вам залишатися здоровими та активними.
                        </p>
                        <a
                            href="{{ route('blog-3') }}"
                            class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                        >
                            Читати більше
                        </a>
                    </div>

                    <!-- Картка блогу 4 -->
                    <div class="bg-white p-6 rounded-lg shadow w-[300px] flex-shrink-0 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">
                            Чому вода важлива для схуднення?
                        </h3>
                        <p class="text-gray-600">
                            Дізнайтеся, чому вода — ваш найкращий союзник у контролі ваги.
                        </p>
                        <a
                            href="{{ route('blog-4') }}"
                            class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                        >
                            Читати більше
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>

</x-app-layout>
