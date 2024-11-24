<table>
    <thead>
        <tr>
            <th style="background-color: #273848; color: white; font-weight: 500; font-size: 12px;" valign="center" align="center" height="30px">No</th>
            <th style="background-color: #273848; color: white; font-weight: 500; font-size: 12px;" valign="center" align="center" height="30px" width="150px">Specialty</th>
            <th style="background-color: #273848; color: white; font-weight: 500; font-size: 12px;" valign="center" align="center" height="30px">Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($specialties as $index => $specialty)
            <tr>
                <td height="25px" valign="center" align="center">{{ $index + 1 }}</td>
                <td height="25px" valign="center">{{ $specialty->specialty }}</td>
                <td height="25px" valign="center" align="center">{{ $specialty->count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
