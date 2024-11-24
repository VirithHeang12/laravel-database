
<table >
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->id }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->email }}</td>
                <td>{{ $supplier->phone }}</td>
                <td>{{ $supplier->address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<table>
    <h3>Supplier Email Categories</h3>
    <thead>
        <tr>
            <th>Category</th>
            <th>Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($emailCategories as $category => $count)
            <tr>
                <td>{{ $category }}</td>
                <td>{{ $count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


