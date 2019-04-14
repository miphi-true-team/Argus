@php $i = 1 @endphp
@if (!empty($students))
    @foreach ($students as $key => $student)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $student['sn']." ".$student['fn']." ".$student['pt'] }}</td>
            <td>
                <div class="ui tag labels">
                    @if (!empty($student['pairs']))
                        @foreach ($student['pairs'] as $subject)
                            <a class="ui label">
                            {{ $subject }}
                            </a>
                        @endforeach
                    @endif
                </div>
            </td>
            <td>{{ number_format($student['precent'])."%" }}</td>
        </tr>
    @endforeach
@else
    <tr>
        <td><h1>Записи не найдены</h1></td>
    </tr>
@endif