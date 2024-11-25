<table>
    <thead>
        <tr>
            <th>Category Genre</th>
            <th>Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($genreCategories as $genre => $data)
            <tr>
                <td>{{ $genre }}</td>
                <td>{{ $data['count'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
