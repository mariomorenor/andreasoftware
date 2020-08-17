<?php

namespace App\Exports;

use App\Client;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ClientsExport implements FromView
{
    public function view(): View
    {
        return view('reports.clients', [
            'clients' => Client::all()
        ]);
    }
}
