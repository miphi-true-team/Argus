@extends('layouts.app')

@section('content')


<div class="row">
    <div class="six wide column">
        <div class="ui blue segment">
            <h2>Регистрация</h2>
            <form class="ui form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" placeholder="Имя" name="name" value="{{ old('name') }}" required autofocus>
                        
                        @if ($errors->has('name'))
                            <div class="ui red icon message">
                                <i class="exclamation triangle icon"></i>
                                <div class="content">
                                    <p>{{ $errors->first('name') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="inbox icon"></i>
                        <input type="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required autofocus>
                        
                        @if ($errors->has('email'))
                            <div class="ui red icon message">
                                <i class="exclamation triangle icon"></i>
                                <div class="content">
                                    <p>{{ $errors->first('email') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" placeholder="Пароль" name="password" required autofocus>
                            
                            @if ($errors->has('password'))
                                <div class="ui red icon message">
                                    <i class="exclamation triangle icon"></i>
                                    <div class="content">
                                        <p>{{ $errors->first('password') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" placeholder="Повторите пароль" name="password_confirmation" required autofocus>
                        </div>
                    </div>
                </div>

                <button type="submit" class="ui fluid large primary submit button">
                    {{ __('Register') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection