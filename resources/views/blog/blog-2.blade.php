<x-app-layout>

    @section('title', '5 порад для ефективного схуднення')

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Дізнайтеся 5 найефективніших порад для схуднення. Від створення дефіциту калорій до вибору правильних продуктів.">
        <meta name="keywords" content="поради для схуднення, як схуднути, калорії, контроль ваги, харчування">
        <meta name="author" content="Калорайз">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="text-2xl font-bold">5 порад для ефективного схуднення</h1>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <img src="https://i.ibb.co/VWVvQ9z/c3cff601-8932-40a8-a68e-86bb16da78e0.webp" alt="5 порад для схуднення" class="w-full h-auto mb-8">
                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">1. Створіть дефіцит калорій</h2>
                    <p class="mb-4">Основний принцип схуднення — споживати менше калорій, ніж витрачає ваше тіло. Використовуйте формулу TDEE (добовий енергетичний баланс), щоб визначити, скільки калорій вам потрібно, і створіть дефіцит у 10-20% від цього числа.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">2. Зосередьтеся на високоякісних продуктах</h2>
                    <p class="mb-4">Вибирайте продукти з високим вмістом білка, корисними жирами та складними вуглеводами. Наприклад:</p>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong>Білки:</strong> курка, риба, яйця, сир.</li>
                        <li><strong>Жири:</strong> авокадо, горіхи, оливкова олія.</li>
                        <li><strong>Вуглеводи:</strong> гречка, вівсянка, овочі.</li>
                    </ul>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">3. Пийте більше води</h2>
                    <p class="mb-4">Вода допомагає підтримувати обмін речовин, очищує організм і знижує відчуття голоду. Спробуйте випивати 1,5-2 літри води на день.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">4. Фізична активність — ваш союзник</h2>
                    <p class="mb-4">Регулярні фізичні навантаження допомагають не лише спалювати калорії, але й підтримують м’язову масу. Навіть щоденні прогулянки на 30 хвилин принесуть результати.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">5. Ведіть харчовий щоденник</h2>
                    <p class="mb-4">Записуйте все, що їсте, щоб контролювати кількість калорій. Використовуйте додаток <a href="{{ route('register') }}" class="text-blue-500 underline">Calorize</a> для простого та зручного ведення щоденника.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Як Calorize допоможе?</h2>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong>Розрахунок калорій:</strong> визначте свою норму калорій за кілька секунд.</li>
                        <li><strong>Контроль харчування:</strong> додайте страви та продукти до щоденника.</li>
                        <li><strong>Графіки прогресу:</strong> слідкуйте за змінами у вазі.</li>
                    </ul>
                </section>
                <a href="{{ route('register') }}" class="bg-amber-500 text-white font-semibold px-4 py-2 rounded-lg">Зареєструватися зараз</a>

            </div>
        </div>
    </div>
</x-app-layout>
