<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // If you're using this concern


class CompletionReportExport implements FromView, ShouldAutoSize
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function view(): View
    {

        return view('admin.exports.completionReport', [
            'users' => $this->query->get(), // Replace with actual data
        ]);
    }
}
