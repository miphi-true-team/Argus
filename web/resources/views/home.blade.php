@extends('layouts.app')

@section('content')
<div class="row">
    <div class="fifteen wide column">
        <div class="ui grid">
            <div class="row">
                <div class="eight wide column">Hello</div>
                <div class="eight wide column">
                    <fieldset class="ui green segment">
                        <legend>Аудитории</legend>
                        <table class="ui striped table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Номер</th>
                                    <th>IP камеры</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach ($cabinets as $cabinet)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $cabinet->name }}</td>
                                        <td>{{ $cabinet->camera_address }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
