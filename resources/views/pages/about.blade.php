<x-app-layout>

    @section('title', 'Про нас — Calorize')

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Дізнайтеся про український додаток Calorize, його засновників та місію. Простий і зручний інструмент для контролю калорійності.">
        <meta name="keywords" content="про нас, Calorize, Ляля Сахно, Уляна Сахно, контроль калорійності, український продукт">
        <meta name="author" content="Calorize">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="text-3xl font-bold text-center">Про нас</h1>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <section class="text-center">
                    <img src="{{ asset('images/Lialia&Uliana.jpg') }}" alt="Ляля та Уляна Сахно" class="w-48 h-48 mx-auto rounded-full shadow mb-6 object-cover">
                    <h2 class="text-2xl font-semibold mb-4">Ляля та Уляна Сахно</h2>
                    <p class="text-gray-700 text-lg">Засновники та натхненники проекту Calorize</p>
                </section>

                <section class="my-8">
                    <h2 class="text-2xl font-semibold mb-4">Наша історія</h2>
                    <p class="text-gray-800 leading-relaxed mb-4">
                        <strong>Calorize</strong> народився із реальної потреби. 7 років тому я, Ляля Сахно, вирішила схуднути й почала шукати ідеальний додаток, який би відповідав усім моїм вимогам: простота, наукова доказовість, точність, і нічого зайвого. На жаль, я не знайшла такого інструменту. Усі наявні додатки були або надто схожі на гру, або не підтримували точні розрахунки для власних рецептів, зокрема з урахуванням випарювання чи вижарювання вологи.
                    </p>
                    <p class="text-gray-800 leading-relaxed">
                        Тому я вирішила створити власний додаток — з акцентом на зручність, функціональність і мінімалізм. <strong>Calorize</strong> — це результат мого багаторічного досвіду у програмуванні та прагнення допомогти іншим досягти своїх цілей у здоровому харчуванні.
                    </p>
                </section>

                <section class="my-8">
                    <h2 class="text-2xl font-semibold mb-4">Наша команда</h2>
                    <p class="text-gray-800 leading-relaxed mb-4">
                        Я — Ляля Сахно, досвідчена розробниця Laravel з багаторічним досвідом роботи над складними проектами. У цьому проекті я відповідальна за весь код, від серверної частини до дизайну. Оскільки я більше спеціалізуюся на бекенді, створення дизайну стало для мене викликом, але я із задоволенням подолала його.
                    </p>
                    <p class="text-gray-800 leading-relaxed">
                        Моя дівчина, Уляна Сахно, допомагає мені тестувати додаток і знаходити способи зробити його ще кращим. Разом ми прагнемо створити продукт, який стане надійним помічником для всіх, хто обрав шлях до здорового способу життя.
                    </p>
                </section>

                <section class="my-8">
                    <h2 class="text-2xl font-semibold mb-4">Наша місія</h2>
                    <p class="text-gray-800 leading-relaxed">
                        Ми віримо, що кожна людина заслуговує на зручний і точний інструмент для контролю свого харчування. Наша місія — допомогти людям ставати здоровішими та досягати своїх цілей у харчуванні без зайвих складнощів.
                    </p>
                    <p class="text-gray-800 leading-relaxed">
                        Простота, мінімалізм, точність і науковий підхід — це основні цінності, які ми закладаємо у <strong>Calorize</strong>.
                    </p>
                </section>

                <section class="my-8">
                    <h2 class="text-2xl font-semibold mb-4">Чому обирають Calorize?</h2>
                    <ul class="list-disc list-inside text-gray-800 leading-relaxed mb-4">
                        <li>Простий і зрозумілий інтерфейс</li>
                        <li>Точні розрахунки калорій, білків, жирів і вуглеводів</li>
                        <li>Унікальна можливість створювати власні рецепти з урахуванням способу приготування</li>
                        <li>Інструменти для відстеження прогресу та досягнення цілей</li>
                    </ul>
                </section>

                <section class="my-8">
                    <h2 class="text-2xl font-semibold mb-4">Наші плани</h2>
                    <p class="text-gray-800 leading-relaxed mb-4">
                        У майбутньому ми плануємо додати нові функції, такі як сканер штрих-кодів для зручного додавання продуктів, інструменти на основі штучного інтелекту для створення персоналізованих планів харчування, та розширення бази даних продуктів.
                    </p>
                </section>

                <section class="text-center my-8">
                    <h2 class="text-2xl font-semibold mb-4">Дякуємо, що обрали нас!</h2>
                    <p class="text-gray-800 leading-relaxed mb-6">
                        Ми віримо, що разом з вами ми зможемо створити здорове та натхненне майбутнє для кожного.
                    </p>
                    <a href="{{ route('register') }}" class="bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-amber-700">
                        Приєднатися до Calorize
                    </a>
                </section>
            </div>
        </div>
    </div>

</x-app-layout>
