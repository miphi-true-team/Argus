@extends('layouts.app')

@section('content')
<div class="row">
    <div class="fifteen wide column">
        <div class="ui grid">
            <div class="row">
                <div class="eight wide column">
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
                </div>
                <div class="eight wide column">
                    <fieldset class="ui segment">
                        <legend>Статистка посещаемости</legend>
                        @php $count_admission_students = rand(1, $count_students) @endphp
                        <div class="ui three statistics">
                            <div class="statistic">
                                <div class="value">
                                    {{ $count_students }}
                                </div>
                                <div class="label">
                                    Всего студентов
                                </div>
                            </div>
                            <div class="statistic">
                                <div class="value">
                                    {{ number_format(($count_admission_students * 100) / $count_students, 0) }}%
                                </div>
                                <div class="label">
                                    Процент посещаемости
                                </div>
                            </div>
                            <div class="statistic">
                                <div class="value">
                                    {{ $count_admission_students }}
                                </div>
                                <div class="label">
                                    Пришедших студентов
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
