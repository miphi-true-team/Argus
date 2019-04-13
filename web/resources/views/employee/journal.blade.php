@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="fifteen wide column">
            <fieldset class="ui segment">
                <legend><h3>Фильтр</h3></legend>
                <form class="ui form" type="POST">
                    @csrf
                    <div class="field">
                        <label for="">Группа</label>
                        <select name="" id="group" class="ui dropdown">
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label for="">Дата</label>
                        <input type="date" id="date" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="field">
                        <button type="button" id="applyFilter" class="ui primary button">Применить</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="fifteen wide column">
            <fieldset class="ui segment">
                <legend><h3>Посещаемость</h3></legend>
                <table class="ui table" id="journalTable">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>ФИО</th>
                            <th>Посещённые пары</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>1</td>
                            <td>Вася пупкин</td>
                            <td>
                                <div class="ui tag labels">
                                    <a class="ui label">
                                        Английский
                                    </a>
                                    <a class="ui label">
                                        Алгебра и геометрия
                                    </a>
                                    <a class="ui label">
                                        История
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Вася пупкин</td>
                            <td>
                                <div class="ui tag labels">
                                    <a class="ui label">
                                        Английский
                                    </a>
                                    <a class="ui label">
                                        Алгебра и геометрия
                                    </a>
                                    <a class="ui label">
                                        История
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Вася пупкин</td>
                            <td>
                                <div class="ui tag labels">
                                    <a class="ui label">
                                        Английский
                                    </a>
                                    <a class="ui label">
                                        Алгебра и геометрия
                                    </a>
                                    <a class="ui label">
                                        История
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Вася пупкин</td>
                            <td>
                                <div class="ui tag labels">
                                    <a class="ui label">
                                        Английский
                                    </a>
                                    <a class="ui label">
                                        Алгебра и геометрия
                                    </a>
                                    <a class="ui label">
                                        История
                                    </a>
                                </div>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>

    <script type="text/javascript">


        $('#applyFilter').on('click', function () {
            var group = $('#group').val();
            var date = $('#date').val();
            
            $.ajax({
                url: "journal/getJournalByDate/" + group + '/' + date,
                type: 'GET',
                success: function (data) {
                    $('#journalTable > tbody').html(data);
                    // alert(data);
                },
                error: function (error) {
                    alert(error.status);
                    
                }
            });

        });

    </script>

@endsection