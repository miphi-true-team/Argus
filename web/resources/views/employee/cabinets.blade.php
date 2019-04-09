@extends('layouts.app')

@section('content')
<div class="row">
    <div class="fifteen wide column">
        @if (count($cabinets) > 0)
            <div class="ui horizontal segments" style="flex-wrap: wrap;">
            @foreach ($cabinets as $cabinet)
                <div class="ui fluid segment">
                    <h1>{{ $cabinet->name }}</h1>
                    <p>IP камеры: {{ $cabinet->camera_address }}</p>
                    <fieldset class="ui loading segment">
                        <legend class="black-text">Видео</legend>
                        <div style="width: 500px; height: 500px;"></div>
                    </fieldset>
                </div>
            @endforeach
        </div>
        @else
            <h1>Не удалось найти группы</h1>
            <i class="ui frown huge icon"></i>
        @endif
    </div>
</div>
@endsection
