<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ProductsExport implements FromView
{
    public function view(): View
    {
        return view('reports.inventory', [
            'products' => Product::with(['prices'])->get()
        ]);
    }
}
