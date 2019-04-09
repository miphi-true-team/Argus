@extends('layouts.app')

@section('content')
<div class="row">
    <div class="six wide column">
        <div class="ui blue segment">
            <h2>Вход в личный кабинет</h2>
            <form class="ui form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <div class="ui left icon input">
                        <i class="inbox icon"></i>
                        <input id="email" type="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                @if ($errors->has('password'))
                    <div class="ui red icon message">
                        <i class="exclamation triangle icon"></i>
                        <div class="content">
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                    </div>
                @endif
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input id="password" type="password" placeholder="Пароль" name="password" required>
                    </div>
                </div>
                @if ($errors->has('password'))
                    <div class="ui red icon message">
                        <i class="exclamation triangle icon"></i>
                        <div class="content">
                            <p>{{ $errors->first('password') }}</p>
                        </div>
                    </div>
                @endif
                <button type="submit" class="ui fluid large primary submit button">
                    @lang('auth.login')
                </button>
                <div class="ui error message"></div>
            </form>
        </div>
    </div>
</div>
@endsection
