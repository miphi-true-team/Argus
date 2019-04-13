@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="fifteen wide column">
            <fieldset class="ui segment">
                <legend><h3>Контрольные цифры</h3></legend>
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
            <fieldset class="ui segment">
                <legend><h3>Процентное соотношение</h3></legend>
                <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
            </fieldset>
            <fieldset class="ui segment">
                <legend><h3>Посещаемость по дням</h3></legend>
                <div id="resizable" style="height: 370px">
                    <div id="chartContainer2" style="height: 100%; width: 100%;"></div>
                </div>
            </fieldset>
        </div>
    </div>

    <script type="text/javascript">

        window.onload = function () {

            var statOption1 = {
                data: [{
                    type: "pie",
                    startAngle: 40,
                    toolTipContent: "<b>{label}</b>: {y}%",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - {y}%",
                    dataPoints: [
                        { y: {{ 100-number_format(($count_admission_students * 100) / ($count_students > 0 ? $count_students : 1), 0) }}, label: "Непришло" },
                        { y: {{ number_format(($count_admission_students * 100) / ($count_students > 0 ? $count_students : 1), 0) }}, label: "Пришло" }
                    ]
                }]
            };

            $("#chartContainer1").CanvasJSChart(statOption1);


            var statOption2 = {
                data: [{
                    type: "column", //change it to line, area, bar, pie, etc
                    dataPoints: [
                        { label: "Понедельник", y: 10 },
                        { label: "Вторник",     y: 6 },
                        { label: "Среда",       y: 14 },
                        { label: "Четверг",     y: 12 },
                        { label: "Пятница",     y: 19 },
                        { label: "Суббота",     y: 14 },
                        { label: "Воскресенье", y: 26 }
                        ]
                    }]
            };

            $("#resizable").resizable({
                create: function (event, ui) {
                    $("#chartContainer2").CanvasJSChart(statOption2);
                },
                resize: function (event, ui) {
                    $("#chartContainer2").CanvasJSChart().render();
                }
            });

        }

    </script>
@endsection