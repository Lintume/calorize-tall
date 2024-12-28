<x-app-layout>

    @section('title', 'Чому вода важлива для схуднення?')

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Дізнайтеся, чому вода є ключовим фактором у процесі схуднення. Від підвищення метаболізму до контролю апетиту — все про користь води.">
        <meta name="keywords" content="вода для схуднення, користь води, зниження ваги, гідратація">
        <meta name="author" content="Калорайз">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="text-2xl font-bold">Чому вода важлива для схуднення?</h1>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <img src="https://i.ibb.co/VWVvQ9z/c3cff601-8932-40a8-a68e-86bb16da78e0.webp" alt="Чому вода важлива для схуднення?" class="w-full h-auto mb-8">
                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">1. Вода стимулює метаболізм</h2>
                    <p class="mb-4">Дослідження показали, що випивання 500 мл води може збільшити швидкість метаболізму на 24-30% протягом наступних годин. Це допомагає організму ефективніше спалювати калорії.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">2. Контроль апетиту</h2>
                    <p class="mb-4">Часто організм плутає відчуття голоду зі спрагою. Випивши склянку води перед їжею, ви можете зменшити кількість споживаних калорій та краще контролювати свій апетит.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">3. Вода підтримує енергію</h2>
                    <p class="mb-4">Зневоднення може призвести до відчуття втоми та зниження продуктивності. Достатня гідратація допомагає підтримувати енергію та активність, що важливо для фізичних тренувань і повсякденної активності.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">4. Вода покращує травлення</h2>
                    <p class="mb-4">Пиття води сприяє кращому травленню, запобігає запорам та підтримує нормальну роботу шлунково-кишкового тракту. Це важливо для здорового схуднення.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">5. Допомога у виведенні токсинів</h2>
                    <p class="mb-4">Вода допомагає очищувати організм від токсинів, які можуть накопичуватися через неправильне харчування або недостатню фізичну активність. Це підтримує ваше тіло у найкращій формі.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">Скільки води потрібно пити?</h2>
                    <p class="mb-4">Рекомендована норма для дорослої людини становить близько 1.5-2 літрів води на день. Однак, ця кількість може змінюватися залежно від рівня активності, клімату та ваших індивідуальних потреб.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Як Calorize допоможе?</h2>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong>Контроль гідратації:</strong> відстежуйте кількість споживаної води за день.</li>
                        <li><strong>Графіки прогресу:</strong> слідкуйте за своїми звичками гідратації разом з іншими даними.</li>
                        <li><strong>Зручний інтерфейс:</strong> додайте воду у свій щоденник харчування за кілька кліків.</li>
                    </ul>
                </section>
                <a href="{{ route('register') }}" class="bg-amber-500 text-white font-semibold px-4 py-2 rounded-lg">Зареєструватися зараз</a>
            </div>
        </div>
    </div>
</x-app-layout>
