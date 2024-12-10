<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Calorize</title>

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
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('products') }}">{{__('welcome.productList')}}</a>
                <a href="{{ url('/recipes') }}">{{__('welcome.recipes')}}</a>
                <a href="{{ url('/create-recipe') }}">{{__('welcome.createRecipe')}}</a>
                <a href="{{ route('product.create') }}">{{__('welcome.createProduct')}}</a>
                <a href="{{route('personal')}}">{{__('welcome.personal')}}</a>
            @else
                <a href="{{ route('login') }}">{{ __('auth.login') }}</a>
                <a href="{{ route('register') }}">{{ __('auth.register') }}</a>
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Calorize
        </div>

        <div class="links">
            {{--<a href="{{route('measurement')}}">{{__('welcome.measuring')}}</a>--}}
            <a href="{{route('diary')}}">{{__('welcome.diary')}}</a>
            <a href="{{route('personal')}}">{{__('welcome.personal')}}</a>
            <a href="{{route('statistic')}}">{{__('welcome.statistic')}}</a>
            <a href="http://pariamonia.in.ua">{{__('welcome.contacts')}}</a>
        </div>
    </div>
</div>
</body>
</html>
