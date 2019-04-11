@extends('layouts.app')

@section('content')
<div class="row">
    <div class="fifteen wide column">
        @if (count($groups) > 0)
            <div class="ui horizontal segments" style="flex-wrap: wrap;">
                @foreach ($groups as $group)
                    <div class="ui fluid segment">
                        <h1>{{ $group->name }}</h1>
                        @foreach ($group->getStudents() as $student)
                        <fieldset class="ui segment">
                            <legend class="black-text">{{ $student->sn." ".$student->fn." ".$student->pt }}</legend>
                                <div class="ui small image">
                                    <img src="https://semantic-ui.com/images/wireframe/image.png">
                                </div>
                                <div class="content">
                                    <a class="header"></a>
                                </div>
                        </fieldset>
                        @endforeach
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
