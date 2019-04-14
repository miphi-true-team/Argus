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
                <form class="ui form">
                    <div class="field">
                        <select name="" id="selectStudent" multiple="" class="ui dropdown">
                            @foreach ($studentsByGroup as $group => $students)
                                <optgroup label="{{ $group }}">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->sn }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </form>
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

        }

        
        $('#selectStudent').on('change', function () {
            var students = $(this).val();
            
            $.ajax({
                url: "journal/getStatisticByStudent/" + students,
                type: 'GET',
                success: function (data) {
                    
                    var statOption2 = {
                        data: [{
                            type: "column",
                            dataPoints: JSON.parse(data)
                        }]
                    };
                    
                    $("#chartContainer2").CanvasJSChart(statOption2);
                    // $("#resizable").resizable({
                    //     create: function (event, ui) {
                    //         $("#chartContainer2").CanvasJSChart(statOption2);
                    //     },
                    //     resize: function (event, ui) {
                    //         $("#chartContainer2").CanvasJSChart().render();
                    //     }
                    // });

                },
                error: function (error) {
                    alert(error.status);
                }
            });
            

        });

    </script>
@endsection