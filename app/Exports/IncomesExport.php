<?php

namespace App\Exports;

use App\Income;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class IncomesExport implements FromView
{
    public function view(): View
    {
        return view('reports.incomes', [
            'incomes' => Income::with(['User'])->get()
        ]);
    }
}
