<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        .header {
            width: 100%;

            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .header__profile {
            display: flex;
            flex-direction: row;
            gap: 48px;
        }

        .header__avatar {
            object-fit: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>

</head>

<body>
    <div class="header">
        <div class="logo"></div>
        <div class="header__text-data"></div>
        <div class="header__profile">

            @guest

                @if (Route::has('login'))
                    <a class="header--item" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif

                @if (Route::has('register'))
                    <a class="header--item" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            @else
                <img class="header__avatar" src="{{ Auth::user()->avatar_url }}">

                <a class="header--item" role="button" href="/user/settings">
                    {{ Auth::user()->name }}
                </a>

                <a class="header--item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @endguest
    </div>
    </div>

    <div id="app">
        @yield('content')
    </div>
</body>

</html>
