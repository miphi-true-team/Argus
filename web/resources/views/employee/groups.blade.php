@extends('layouts.app')

@section('content')
<div class="row">
    <div class="fifteen wide column">
        @if (count($groups) > 0)
            <div class="ui horizontal segments" style="flex-wrap: wrap;">
                @foreach ($groups as $group)
                    <div class="ui fluid segment">
                        <h1>{{ $group->name }}</h1>
                        <fieldset class="ui segment">
                            <legend class="black-text">Список студентов</legend>
                            <div class="ui items">
                                @for ($i = 0; $i < 10; $i++)
                                    <div class="item">
                                        <div class="image">
                                            <img src="https://semantic-ui.com/images/wireframe/image.png">
                                        </div>
                                        <div class="content">
                                            <a class="header">ФИО</a>
                                        </div>
                                    </div>
                                @endfor
                            </div>
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
