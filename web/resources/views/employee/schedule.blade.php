@extends('layouts.app')

@section('content')
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

    <script type="text/javascript">

        $('#showSchedule').on('click', function () {
            var group_id = $('#group').val();
            var csrf = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: 'schedule/schedule_by_group/' + group_id,
                type: 'GET',
                success: function (data) {
                    if (data != "") {
                        $("#scheduleTable > tbody").html(data);
                    } else {
                        $("#scheduleTable > tbody").html("<tr><td><h1>Расписание не найдено</h1></td></tr>");
                    }
                },
                error: function (errorString) {
                    alert(errorString.status);
                }
            })

        });

    </script>
@endsection