<table>
    <thead>
    <tr>
        <th >{{ __('label.name') }}</th>
        <th >{{ __('label.branch') }}</th>

        <th >{{ __('label.amount') }}</th>
        <th>{{ __('label.status') }}</th>
        <th>{{ __('label.created_at') }}</th>
        <th>تاريخ اخر اجراء على الفاتورة</th>

    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $value)
        <tr>
            <td>{{ $value->users?$value->users->name:'' }}</td>
            <td>{{ $value->users?$value->users?->branch?->name:'' }}</td>

            <td>{{ $value->amount ?? '-' }}</td>

                    <th>{!! $value->getStatus() !!}</th>

            <td>{{ $value->created_at->format('Y-m-d') ?? '-' }}</td>
            <td>{{ $value->updated_at->format('Y-m-d') ?? '-' }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
