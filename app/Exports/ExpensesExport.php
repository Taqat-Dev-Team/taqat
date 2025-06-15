<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpensesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $expenses;

    public function __construct($expenses)
    {
        $this->expenses = $expenses;
    }

    public function collection()
    {
        return collect($this->expenses)->map(function ($expense) {
            return [
                'User Name' => $expense->users?->name,
                'Amount' => $expense->amount,
                'Start Date' => $expense->start_date,
                'End Date' => $expense->end_date,
                'Payment Type' => $expense->paymentTypes?->name,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'User Name',
            'Amount',
            'Start Date',
            'End Date',
            'Payment Type'
        ];
    }
}

