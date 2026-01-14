<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Calorize') }}</title>

        <!-- Meta Tags for SEO -->
        <meta name="description"
              content="{{ __('Calorize - Your personal calorie tracker and nutrition assistant.') }}">
        <meta name="keywords" content="{{ __('Calorize, Calorie Tracker, Nutrition, Health, Fitness') }}">
        <meta property="og:title" content="{{ __('Calorize') }}">
        <meta property="og:description"
              content="{{ __('Calorize - Your personal calorie tracker and nutrition assistant.') }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('path/to/your/image.jpg') }}">

        <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96"/>
        <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg"/>
        <link rel="shortcut icon" href="/favicon/favicon.ico"/>
        <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png"/>
        <link rel="manifest" href="/favicon/site.webmanifest"/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                padding-bottom: 10%;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .2rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .content img {
                margin-bottom: 50px;
            }

            .links-middle > a {
                font-size: 20px;
            }

            @media (max-width: 900px) {
                .links-middle > a {
                    display: block;
                    margin-bottom: 25px; /* Adjust the value to increase the distance */
                    font-size: 16px;
                }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @if (app()->getLocale() == 'en')
                    <a href="{{ route('switch-language', 'uk') }}">Мова — Українська</a>
                @else
                    <a href="{{ route('switch-language', 'en') }}">Language — English</a>
                @endif
                @auth
                @else
                    <a href="{{ route('login') }}">{{ __('auth.login') }}</a>
                    <a href="{{ route('register') }}">{{ __('auth.register') }}</a>
                @endauth
            </div>

            <div class="content">
                <img src="{{ asset('logo.png') }}" alt="Calorize" width="200" height="200">

                <div class="links links-middle">
                    <a href="{{ route('diary') }}">{{ __('welcome.diary') }}</a>
                    <a href="{{ route('personal') }}">{{ __('welcome.personal') }}</a>
                    <a href="{{ route('statistic') }}">{{ __('welcome.statistic') }}</a>
                    <a href="{{ route('product.index') }}">{{ __('welcome.productList') }}</a>
                    <a href="{{ route('blog') }}">{{ __('Blog') }}</a>
                    <a href="http://pariamonia.in.ua">{{ __('welcome.contacts') }}</a>
                </div>
            </div>
        </div>
    </body>
</html>