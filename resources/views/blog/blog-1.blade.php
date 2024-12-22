<x-app-layout>

    @section('title', 'Як правильно рахувати калорії для схуднення — практичний гід')

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Дізнайтеся, як правильно рахувати калорії для схуднення. Простий гід, корисні поради та як додаток Калорайз допоможе досягти мети.">
        <meta name="keywords" content="як рахувати калорії, схуднення, калорійність продуктів, програми для підрахунку калорій">
        <meta name="author" content="Калорайз">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="text-2xl font-bold">Як правильно рахувати калорії, щоб схуднути? Простий гід для початківців</h1>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <img src="https://i.ibb.co/VWVvQ9z/c3cff601-8932-40a8-a68e-86bb16da78e0.webp" alt="How to count calories for weight loss" class="w-full h-auto mb-8">
                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">Що таке калорії та чому вони важливі?</h2>
                    <p class="mb-4">Калорії — це одиниця енергії, яку отримує організм із їжі та напоїв. Ваше тіло використовує калорії для підтримання життєвих функцій: дихання, роботи серця, руху та навіть мислення.</p>
                    <p>Коли ви споживаєте більше калорій, ніж витрачаєте, надлишок відкладається у вигляді жиру. Якщо ж навпаки, то організм починає спалювати запаси, що веде до зниження ваги.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Як визначити свою норму калорій?</h2>
                    <p class="mb-4"><strong>Розрахуйте базовий обмін речовин (BMR):</strong></p>
                    <p class="mb-4">Для жінок: <code>BMR = 10 × вага (кг) + 6.25 × зріст (см) − 5 × вік (років) − 161</code></p>
                    <p class="mb-4">Для чоловіків: <code>BMR = 10 × вага (кг) + 6.25 × зріст (см) − 5 × вік (років) + 5</code></p>
                    <p class="mb-4"><strong>Помножте BMR на рівень активності:</strong></p>
                    <ul class="list-disc list-inside mb-4">
                        <li>Мінімальна активність: × 1.2</li>
                        <li>Легка активність: × 1.375</li>
                        <li>Помірна активність: × 1.55</li>
                        <li>Висока активність: × 1.725</li>
                    </ul>
                    <p>Це число — ваш добовий енергетичний баланс (TDEE). Щоб худнути, створіть дефіцит у 10-20% від TDEE.</p>
                    <p>Ви можете легко зробити всі ці розрахунки у нашошу додатку тут, якщо зарєєструєтеся:</p> <a href="{{ route('personal') }}" class="text-blue-500 underline">Персональні розрахунки</a>.
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Які продукти вибирати для схуднення?</h2>
                    <p class="mb-4">Звертайте увагу на продукти з високою поживною цінністю:</p>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong>Білки:</strong> курка, яйця, сир, бобові.</li>
                        <li><strong>Корисні жири:</strong> авокадо, горіхи, оливкова олія.</li>
                        <li><strong>Складні вуглеводи:</strong> цільнозерновий хліб, овочі, крупи.</li>
                    </ul>
                    <p>Уникайте ультраобробленої їжі, яка містить "порожні" калорії: чіпси, солодощі, газовані напої.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Як Калорайз допоможе вам?</h2>
                    <p class="mb-4">Наш додаток — це інструмент, який спрощує весь процес. Ось що ви можете зробити:</p>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong><a href="{{ route('personal') }}">Розрахувати вашу норму калорій</a></strong> за лічені секунди. Також Індекс маси тіла (BMI), відсоток жиру, базовий метаболізм (BMR), норму ваги. Кількість тижнів досягнення цільової ваги на основі введених даних.</li>
                        <li><strong><a href="{{ route('diary') }}">Вести щоденник харчування:</a></strong> просто додайте продукти та страви з нашої великої бази даних.</li>
                        <li><strong><a href="{{ route('statistic') }}">Будувати графіки прогресу:</a></strong> слідкуйте за своєю вагою, калоріями та БЖУ.</li>
                        <li><strong><a href="{{ route('recipe.create') }}">Зберігати власні рецепти:</a></strong> вводьте дані про страви, які ви любите, і не хвилюйтеся про підрахунок калорій вручну.</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Поради для ефективного схуднення</h2>
                    <ol class="list-decimal list-inside mb-4">
                        <li>Не створюйте занадто великий дефіцит калорій — це може призвести до втрати м'язової маси.</li>
                        <li>Не забувайте про фізичну активність — навіть прогулянки можуть значно підвищити витрати калорій.</li>
                        <li>Ведіть харчовий щоденник. Навіть невеликі "перекуси" можуть серйозно впливати на ваш раціон.</li>
                    </ol>
                </section>

                <section>
                    <h2 class="text-xl font-semibold mb-4">Додаткові ресурси</h2>
                    <p>Щоб отримати більше інформації про здорове харчування, відвідайте офіційний сайт <a href="https://www.who.int/" target="_blank" rel="noopener" class="text-blue-500 underline">Всесвітньої організації охорони здоров’я (ВООЗ)</a>.</p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>