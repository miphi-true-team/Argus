@php $i = 1 @endphp
@foreach ($students as $key => $student)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $student['sn']." ".$student['fn']." ".$student['pt'] }}</td>
        <td>
            <div class="ui tag labels">
                @foreach ($student['pairs'] as $subject)
                    <a class="ui label">
                       {{ $subject }}
                    </a>
                @endforeach
            </div>
        </td>
    </tr>
@endforeach