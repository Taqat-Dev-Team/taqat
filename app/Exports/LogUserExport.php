<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class LogUserExport implements FromCollection
{
    private $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function collection()
    {
        return $this->logs->map(function ($log) {
        return [
            'Name' => $log->name ?? '-', // Add the Name column
            'User Name' => $log->users?->name ?? '-',
            'Date' => $log->date,
            'Time In' => $log->time_in,
            'Time Out' => $log->time_out,
            'Duration (Hours)' => $log->duration,
        ];
        });
    }

    public function headings(): array
    {
        return ['Name', 'User Name', 'Date', 'Time In', 'Time Out', 'Duration (Hours)'];
    }
}
