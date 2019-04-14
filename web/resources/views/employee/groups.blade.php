@extends('layouts.app')

@section('content')
<div class="row">
    <div class="fifteen wide column">
        <table class="ui table">
            <thead>
                <tr>
                    <th>Группа</th>
                    <th>Кол-во студентов</th>
                </tr>
            </thead>
            <tbody>
                @if (count($groups) > 0)
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->getCountStudents() }}</td>
                        </tr>
                    @endforeach
                @else
                    <h1>Не удалось найти группы</h1>
                    <i class="ui frown huge icon"></i>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="fifteen wide column">
        @if (count($groups) > 0)
            @foreach ($groups as $group)
                @if ($group->getStudents()->count() > 0)
                    <div class="ui styled accordion" style="width: 100%;">
                        <div class="title">{{ $group->name }}</div>
                        <div class="content">
                            @foreach ($group->getStudents() as $student)
                                <div class="styled accordion">
                                    <div class="title">
                                        {{ $student->sn." ".$student->fn." ".$student->pt }}
                                    </div>
                                    <div class="content">
                                        <div class="ui stackable grid">
                                            <div class="row">
                                                <div class="sixteen wide column">
                                                    <div class="ui small image">
                                                        <img src="https://semantic-ui.com/images/wireframe/image.png">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <h1>Не удалось найти группы</h1>
            <i class="ui frown huge icon"></i>
        @endif
    </div>
</div>

@endsection
