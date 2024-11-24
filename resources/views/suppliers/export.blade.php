<table>
    <h3>Supplier Email Categories</h3>
    <thead>
        <tr>
            <th style="background-color: #2c4d6c; color: white; font-weight: 500; font-size: 12px;" valign="center"
                align="center" height="30px" width="150px">Category Email</th>
            <th style="background-color: #2c4d6c; color: white; font-weight: 500; font-size: 12px;" valign="center"
                align="center" height="30px">Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($emailCategories as $category => $count)
            <tr>
                <td height="25px" valign="center" align="center">{{ $category }}</td>
                <td height="25px" valign="center" align="center">{{ $count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
