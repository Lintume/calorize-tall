<x-app-layout>

    @section('title', 'ТОП-10 продуктів для здорового харчування')

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Дізнайтеся про 10 найкращих продуктів для здорового харчування. Включіть їх у свій раціон для підтримки здоров’я та енергії.">
        <meta name="keywords" content="здорове харчування, корисні продукти, ТОП-10 продуктів, харчування">
        <meta name="author" content="Калорайз">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="text-2xl font-bold">ТОП-10 продуктів для здорового харчування</h1>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <img src="https://i.ibb.co/VWVvQ9z/c3cff601-8932-40a8-a68e-86bb16da78e0.webp" alt="ТОП-10 продуктів для здорового харчування" class="w-full h-auto mb-8">
                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">1. Авокадо</h2>
                    <p class="mb-4">Авокадо багате корисними жирами, вітамінами та антиоксидантами. Воно допомагає підтримувати серцево-судинну систему та сприяє зниженню рівня холестерину.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">2. Лосось</h2>
                    <p class="mb-4">Цей вид риби є джерелом омега-3 жирних кислот, які підтримують здоров’я мозку, серця та шкіри.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">3. Ягоди</h2>
                    <p class="mb-4">Чорниця, малина, полуниця — це суперфуди, багаті антиоксидантами, які зміцнюють імунітет і сприяють здоров’ю шкіри.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">4. Горіхи</h2>
                    <p class="mb-4">Мигдаль, волоські горіхи, кеш’ю — це джерела білків, корисних жирів і мінералів, які забезпечують організм енергією.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">5. Цільнозернові продукти</h2>
                    <p class="mb-4">Овес, гречка, кіноа — це джерела складних вуглеводів і клітковини, які сприяють травленню та забезпечують тривале відчуття ситості.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">6. Шпинат</h2>
                    <p class="mb-4">Шпинат — це джерело заліза, вітаміну K і антиоксидантів. Він допомагає підтримувати енергію та сприяє здоров’ю кісток.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">7. Йогурт</h2>
                    <p class="mb-4">Натуральний йогурт багатий пробіотиками, які підтримують здоров’я кишківника та покращують травлення.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">8. Куряче філе</h2>
                    <p class="mb-4">Куряче філе — це джерело високоякісного білка, необхідного для відновлення м’язів і підтримки енергії.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">9. Яйця</h2>
                    <p class="mb-4">Яйця — це універсальний продукт, багатий білком, вітамінами та корисними жирами, які забезпечують організм енергією.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">10. Солодка картопля (батат)</h2>
                    <p class="mb-4">Батат містить складні вуглеводи, клітковину та вітаміни групи B, які сприяють енергії та здоров’ю травної системи.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Підсумок</h2>
                    <p>Включення цих продуктів у ваш раціон допоможе підтримувати здоров’я, енергію та фізичну форму. Використовуйте додаток <a href="{{ route('register') }}" class="text-amber-500 underline">Calorize</a> для контролю харчування та досягнення своїх цілей.</p>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
