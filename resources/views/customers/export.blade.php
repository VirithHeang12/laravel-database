
<table>
    <!-- Define column widths -->
    <colgroup>
        <col style="width: 60px;">
        <col style="width: 150px;">
        <col style="width: 150px;">
        <col style="width: 150px;">
    </colgroup>

    <!-- Empty rows for spacing -->
    <tr></tr><tr></tr>

    <!-- Table Head -->
    <thead>
        <tr>
            <th colspan="4" style="color: black; font-weight: 1000; font-size: 20px;" valign="center" align="center" height="50px">Customer Report</th>
        </tr>
        <tr>
            <th style="background-color: #273848; color: white; font-weight: 500; font-size: 12px;" valign="center" align="center" height="30px">No</th>
            <th style="background-color: #273848; color: white; font-weight: 500; font-size: 12px;" valign="center" align="center" height="30px">Customer Name</th>
            <th style="background-color: #273848; color: white; font-weight: 500; font-size: 12px;" valign="center" align="center" height="30px">Gender</th>
            <th style="background-color: #273848; color: white; font-weight: 500; font-size: 12px;" valign="center" align="center" height="30px">Phone Number</th>
        </tr>
    </thead>

    <!-- Table Body -->
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td height="25px" valign="center" align="center">{{ $customer->id }}</td>
                <td height="25px" valign="center">{{ $customer->name }}</td>
                <td height="25px" valign="center" align="center">{{ $customer->gender }}</td>
                <td height="25px" valign="center">{{ $customer->phone }}</td>
            </tr>
        @endforeach
    </tbody>

    <!-- Table Footer -->
    <tfoot>
        <tr>
            <td valign="center" align="center" height="40px" colspan="2" style="font-weight: bold;">Total Customers: {{ $totalCustomers }}</td>
            <td valign="center" align="center" height="40px" style="font-weight: bold;">Female Customers: {{ $femaleCustomers }}</td>
            <td valign="center" align="center" height="40px" style="font-weight: bold;">Male Customers: {{ $maleCustomers }}</td>
        </tr>
    </tfoot>
</table>
