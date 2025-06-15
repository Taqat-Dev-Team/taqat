<table>
    <thead>
    <tr>
        <th>{{ __('label.name') }}</th>
        <th>{{ __('label.mobile') }}</th>
        <th>{{ __('label.current_reading') }}</th>
        <th>{{ __('label.paid_amount') }}</th>
        <th>{{ __('label.remaining_amount') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($generatorSubsriptions as $value)
        <tr>
            <td>{{ $value->name }}</td>
            <td>{{ $value->mobile }}</td>
            <td>
                {{ optional($value->readingGenerator()
                    ->orderBy('id', 'desc')
                    ->first())->current_reading ?? $value->initial_reading }}
            </td>
            <td>{{ $value->generatorReceipt()->sum('amount') }}</td>
            <td>{{ $value->readingGenerator()->sum('consumption_value') - $value->generatorReceipt()->sum('amount') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
