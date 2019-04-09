@extends('layouts.app')

@section('content')
<div class="row">
    <div class="fifteen wide column">
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
    </div>
</div>
@endsection
