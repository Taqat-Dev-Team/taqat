<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GeneratorSubscriptionsExport implements FromView, ShouldAutoSize
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function view(): View
    {

        return view('admin.exports.generatorSubsriptions', [
            'generatorSubsriptions' => $this->query->get(), // Replace with actual data
        ]);
    }
}
