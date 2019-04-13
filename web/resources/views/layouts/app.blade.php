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
        <script src="{{ asset('js/jquery.canvasjs.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.js') }}"></script>

        <!-- Semantic UI -->
        <link href="{{ asset('css/semantic/semantic.css') }}" rel="stylesheet">
        <script src="{{ asset('css/semantic/semantic.js') }}"></script>
        <script src="{{ asset('js/moment.js') }}"></script>
    </head>
    <body>
        <div class="ui menu">
            @auth
                <a class="header item" href="{{ route('home') }}">Главная</a>
                <a class="item" href="{{ route('schedule') }}">Расписание</a>
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
                    <div class="item"><i class="clock icon"></i><span id="datetime"></span></div>
                    <div class="ui dropdown item">
                        {{ Auth::user()->name }}
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <a href="{{ route('profile') }}" class="item">Профиль</a>
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

        <script type="text/javascript">
        
            $('.ui.dropdown').dropdown();
            $('.ui.accordion').accordion();

            var datetime = null,
            date = null;

            var update = function () {
                date = moment(new Date())
                datetime.html(date.format('DD.MM.YYYY H:mm:ss'));
            };

            $(document).ready(function(){
                datetime = $('#datetime')
                update();
                setInterval(update, 1000);
            });

        </script>
    </body>
</html>
