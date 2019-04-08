<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} | Главная</title>

        <!-- jQuery -->
        <script src="{{ asset('js/jquery.js') }}" ></script>

        <!-- Semantic UI -->
        <link href="{{ asset('css/semantic/semantic.css') }}" rel="stylesheet">
        <script src="{{ asset('css/semantic/semantic.js') }}" ></script>
    </head>
    <body>
        <div class="ui menu">
            <div class="header item">{{ config('app.name') }}</div>
            <div class="right menu">
                @guest
                    <a href="{{ route('login') }}" class="item">{{ __('Login') }}</a> 
			@if (Route::has('register'))
                        <a href="{{ route('register') }}" class="item">{{ __('Register') }}</a>
                    @endif
                @else
                    <div class="ui dropdown item">
                        {{ Auth::user()->name }}
                        <i class="dropdown icon"></i>
                        <div class="menu">
                                <a class="item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
        <div class="ui stackable center aligned internally grid">
            @yield('content')
        </div>

        <script>
        
            $('.ui.dropdown').dropdown();

        </script>
    </body>
</html>
