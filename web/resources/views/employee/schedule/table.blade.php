@foreach ($pairsByDay as $day => $pairs)
    <tr>
        <td rowspan="{{ count($pairs)+1 }}">{{ $day }}</td>
    </tr>
    @foreach ($pairs as $pair)
    <tr>
            <td>{{ $pair->para_num }}</td>
            <td>{{ $pair->predmet }}</td>
            <td>{{ $pair->cabinet_id }}</td>
            <td>{{ $pair->prepod }}</td>
        </tr>
        @endforeach
@endforeach