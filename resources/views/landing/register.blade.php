<x-app-layout>

    @section('title', 'Calorize - Ваш помічник у контролі калорійності')

    @section('meta')
        <meta name="description"
              content="Ведіть щоденник калорійності легко та ефективно за допомогою нашого додатка. Контролюйте харчування, досягайте своїх цілей і слідкуйте за прогресом.">
        <meta name="keywords"
              content="щоденник калорійності, контроль харчування, схуднення, здорове харчування, додаток для підрахунку калорій">
        <meta name="author" content="Calorize">
        <title>Calorize - Ваш помічник у контролі калорійності</title>
        <script src="https://cdn.tailwindcss.com"></script>
    @endsection


    <header class="bg-amber-700 text-white py-10 rounded-lg mt-5">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold">Calorize<br>Контроль калорійності з легкістю</h1>
            <p class="mt-4 text-lg">Досягайте своїх цілей у харчуванні швидше, використовуючи наш зручний щоденник
                калорійності.</p>
            <a href="{{ route('register') }}"
               class="mt-6 inline-block bg-white text-orange-950 font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-100">Зареєструватися
                зараз</a>
        </div>
    </header>


    <div class="py-8">
        <section class="features container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Чому обирають Calorize?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="feature-item bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Розрахунок калорій</h3>
                    <p>Визначте вашу добову норму калорій за кілька секунд, використовуючи наукові формули.</p>
                </div>
                <div class="feature-item bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Велика база продуктів</h3>
                    <p>Шукайте серед тисяч продуктів із детальною інформацією про калорії, білки, жири та вуглеводи.</p>
                </div>
                <div class="feature-item bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Графіки прогресу</h3>
                    <p>Слідкуйте за своєю вагою та БЖУ за допомогою зручних графіків.</p>
                </div>
                <div class="feature-item bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Власні рецепти</h3>
                    <p>Створюйте власні рецепти та автоматично розраховуйте їх калорійність.</p>
                </div>
            </div>
        </section>

        <section class="cta bg-orange-100 py-12 mt-12 rounded-lg">
            <div class="container mx-auto text-center px-4">
                <h2 class="text-3xl font-bold mb-4">Почніть свій шлях до здорового харчування вже сьогодні!</h2>
                <p class="text-lg mb-6">Calorize допоможе вам стати найкращою версією себе. Легко, зручно та
                    ефективно.</p>
                <a href={{ route('register') }}
                   class="bg-orange-950 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-blue-700">Створити
                    обліковий запис</a>
            </div>
        </section>

        <section class="testimonials container mx-auto py-12 px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Відгуки наших користувачів</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="testimonial-item bg-white p-6 rounded-lg shadow">
                    <p class="italic">«Calorize став моїм незамінним помічником у схудненні. Тепер я легко контролюю
                        своє харчування та бачу результати!»</p>
                    <p class="text-right font-semibold mt-4">- Ольга, 29 років</p>
                </div>
                <div class="testimonial-item bg-white p-6 rounded-lg shadow">
                    <p class="italic">«Нарешті додаток, який враховує всі мої потреби. Зручний інтерфейс, величезна база
                        продуктів і мотивація триматися плану!»</p>
                    <p class="text-right font-semibold mt-4">- Дмитро, 35 років</p>
                </div>
            </div>
        </section>
    </div>


</x-app-layout>
