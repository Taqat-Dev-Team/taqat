<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvoiceExport implements  FromView, ShouldAutoSize
{
    protected $query;

    public function __construct($query)
{
    $this->query = $query;
}

    public function view(): View
{
    // dd($this->query->count());
    return view('admin.exports.invoices', [
        'invoices' => $this->query->get() // Replace with actual data
    ]);
}
}
