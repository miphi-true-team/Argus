@extends('layouts.app')



@section('content')



<div class="row">
    <div class="fifteen wide column">
        <div class="ui stackable grid">
            <div class="row">
                <div class="eight wide column">
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
                <div class="eight wide column">
                    <fieldset class="ui segment">
                        <legend>Статистка посещаемости</legend>
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
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
                                    {{ $count_admission_students }}
                                </div>
                                <div class="label">
                                    Пришло студентов
                                </div>
                            </div>
                            <div class="statistic">
                                <div class="value">
                                    {{ $count_students-$count_admission_students }}
                                </div>
                                <div class="label">
                                    Не пришло студентов
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="fifteen wide column">
        <fieldset class="ui segment">
            <legend>Расписание</legend>
            <form class="ui form">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <select class="ui dropdown" id="group">
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <button type="button" id="showSchedule" class="ui fluid primary button">Показать расписание</button>
                    </div>
                </div>
            </form>
            <table id="scheduleTable" class="ui table">
                <thead>
                    <tr>
                        <th>День</th>
                        <th>Пара</th>
                        <th>Кабинет</th>
                        <th>Преподаватель</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </fieldset>
    </div>
</div>

<script>

        
    window.onload = function () {

        var options = {
            title: {
                text: "Процент посещаемости"
            },
            subtitles: [{
                text: "{{ date('d.m.Y') }}"
            }],
            animationEnabled: true,
            data: [{
                type: "pie",
                startAngle: 40,
                toolTipContent: "<b>{label}</b>: {y}%",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - {y}%",
                dataPoints: [
                    { y: {{ 100-number_format(($count_admission_students * 100) / $count_students, 0) }}, label: "Непришло" },
                    { y: {{ number_format(($count_admission_students * 100) / $count_students, 0) }}, label: "Пришло" }
                ]
            }]
        };

        $("#chartContainer").CanvasJSChart(options);

    }

    $('#showSchedule').on('click', function () {
        var group_id = $('#group').val();
        var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: 'schedule/schedule_by_group/' + group_id,
            type: 'GET',
            success: function (data) {
                $("#scheduleTable > tbody").html(data);
                // alert(data[0]['id']);
            },
            error: function (errorString) {
                alert(errorString.status);
            }
        })

    });

</script>
@endsection