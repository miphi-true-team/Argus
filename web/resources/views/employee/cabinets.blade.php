@extends('layouts.app')

@section('content')
<div class="row">
    <div class="fifteen wide column">
        <fieldset class="ui segment">
            <legend>Состояние камер</legend>
            <table class="ui table">
                <thead>
                    <tr>
                        <th>Аудитория</th>
                        <th>Камера</th>
                        <th>Активна</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabinets as $cabinet)
                        <tr>
                            <td>{{ $cabinet->name }}</td>
                            <td>{{ $cabinet->camera_address }}</td>
                            <td>
                                @if ( rand(0, 1) )
                                    <i class="smile green large icon"></i>
                                @else
                                    <i class="frown red large icon"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </fieldset>
    </div>
</div>
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
                        <div style="width: 100%; height: 500px;"></div>
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
