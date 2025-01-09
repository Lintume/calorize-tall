<x-app-layout>

    @section('title', __('Privacy Policy — Calorize'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn how Calorize ensures the security and privacy of your data. Get acquainted with our privacy policy.') }}">
        <meta name="keywords" content="{{ __('privacy policy, Calorize, data protection, confidentiality') }}">
        <meta name="author" content="Calorize">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="text-2xl font-bold">{{ __('Privacy Policy') }}</h1>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('Introduction') }}</h2>
                    <p class="mb-4">{{ __('We, the Calorize team, are committed to ensuring the confidentiality of your data. This privacy policy describes how we collect, use, store, and protect your information.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('What data do we collect?') }}</h2>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong>{{ __('Personal Information:') }}</strong> {{ __('your name, email address, date of birth.') }}</li>
                        <li><strong>{{ __('Activity Data:') }}</strong> {{ __('entries in the calorie diary, selected products, recipes, etc.') }}</li>
                        <li><strong>{{ __('Technical Data:') }}</strong> {{ __('IP address, browser type, operating system.') }}</li>
                    </ul>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('How do we use your data?') }}</h2>
                    <ul class="list-disc list-inside mb-4">
                        <li>{{ __('To ensure the correct operation of the app and its features.') }}</li>
                        <li>{{ __('To analyze and improve the service.') }}</li>
                        <li>{{ __('To communicate with you regarding updates or important information.') }}</li>
                    </ul>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('How do we protect your data?') }}</h2>
                    <p class="mb-4">{{ __('Your data is protected using modern encryption methods and security protocols. Only authorized personnel have access to your data, and solely for the purposes of completing necessary tasks.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('Do we share your data with third parties?') }}</h2>
                    <p class="mb-4">{{ __('We do not share your personal data with third parties without your consent, except as required by law.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('Your Rights') }}</h2>
                    <ul class="list-disc list-inside mb-4">
                        <li>{{ __('You have the right to know what data we collect and how we use it.') }}</li>
                        <li>{{ __('You can request the deletion or updating of your data.') }}</li>
                        <li>{{ __('You can withdraw your consent for data processing at any time.') }}</li>
                    </ul>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('How to contact us?') }}</h2>
                    <p class="mb-4">{{ __('If you have questions about this privacy policy or your data, contact us at:') }} <a href="hey@calorize.com.ua" class="text-blue-500 underline">hey@calorize.com.ua</a>.</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('Changes to the Privacy Policy') }}</h2>
                    <p class="mb-4">{{ __('We may update this privacy policy from time to time. We will notify you of any changes through our app or via email.') }}</p>
                </section>
            </div>
        </div>
    </div>

</x-app-layout>
