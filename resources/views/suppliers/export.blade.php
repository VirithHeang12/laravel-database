<table style="border: 2px solid #000; width: 100%; margin-top: 20px; background-color: #f9f9f9;">
    <thead style="background-color: #4CAF50; color: white;">
        <tr>
            <th>Genre</th>
            <th>Books</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($genreCategories as $genre => $data)
            <tr style="text-align: center;">
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $genre }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    <ul>
                        @foreach ($data['books'] as $book)
                            <li>{{ $book->title }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>