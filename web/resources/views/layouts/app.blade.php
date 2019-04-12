<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} | Главная</title>

        <link href="{{ asset('css/index.css') }}" rel="stylesheet">

        <!-- jQuery -->
        <script src="{{ asset('js/jquery.js') }}" ></script>
        <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <!-- Semantic UI -->
        <link href="{{ asset('css/semantic/semantic.css') }}" rel="stylesheet">
        <script src="{{ asset('css/semantic/semantic.js') }}"></script>
    </head>
    <body>
        <div class="ui menu">
            @auth
                <a class="item" href="{{ route('groups') }}">Группы</a>
                <a class="item" href="{{ route('cabinets') }}">Аудитории</a>
            @else
                <a class="header item" href="{{ route('index') }}">Главная</a>
            @endauth
            <div class="right menu">
                @guest
                    <a href="{{ route('login') }}" class="item">@lang('auth.login')</a> 
			        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="item">@lang('auth.registration')</a>
                    @endif
                @else
                    <div class="ui dropdown item">
                        {{ Auth::user()->name }}
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <a href="{{ route('home') }}" class="item">Профиль</a>
                            <a class="item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                @lang('auth.logout')
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
        <div class="ui stackable internally centered aligned grid">
            @yield('content')
        </div>
        <div class="ui bottom fixed secondary menu">
            <div class="right menu">
                <a class="item">Все права защищены © 2019 | MTT (MIPHI True Team) </a>
            </div>
        </div>

        <script>
        
            $('.ui.dropdown').dropdown();
            $('.ui.accordion').accordion();

        </script>
    </body>
</html>
