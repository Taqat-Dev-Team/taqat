<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Total Hours</th>
        <th>Total Contracts</th>
        <th>Total Movements</th>
        <th>Movements Count</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->total_hours ?? '-' }}</td>
            <td>{{ $user->totalContracts() }}</td>
            <td>{{ $user->totalIncome() }}</td>
            <td>{{ $user->IncomeCount() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
