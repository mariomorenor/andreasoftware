<?php

namespace App\Http\Controllers;

use App\Client;
use App\Exports\ClientsExport;
use App\Exports\IncomesExport;
use App\Exports\ProductsExport;
use App\Income;
use App\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ReportController extends Controller
{
    public function index($model,Request $request)
    {   
        switch ($model) {
            case 'inventory':
                return $this->inventory($request->format, $request);
                break;
            case 'clients':
                return $this->clients($request->format, $request);
                break;
            case 'banks':
                return $this->banks($request->format, $request);
                break;
            case 'sellers':
                return $this->sellers($request->format, $request);
                break;
            default:
                # code...
                break;
        }
       
    }


    public function inventory($format, $request)
    {
        if ($format=='PDF') {
                if ($request->pageSize == 'Todos') {
                    $products = Product::with(['prices'])->get();
                }else{
                    $products = Product::with(['prices'])->skip(($request->pageSize*$request->pageNumber) - $request->pageSize)->take($request->pageSize)->get();
                };
                $isPDF = true;
            $pdf = \PDF::loadView('reports.inventory', compact(['products','isPDF']));
            return $pdf->download('inventario.pdf');
        }else{   
            return \Excel::download(new ProductsExport, 'inventario.xlsx');
        }
    }
    public function clients($format, $request)
    {
        if ($format=='PDF') {
                if ($request->pageSize == 'Todos') {
                    $clients = Client::all();
                }else{
                    $clients = Client::skip(($request->pageSize*$request->pageNumber) - $request->pageSize)->take($request->pageSize)->get();
                };
          
            $pdf = \PDF::loadView('reports.clients', compact('clients'));
            return $pdf->download('clients.pdf');
        }else{   
            return \Excel::download(new ClientsExport, 'clientes.xlsx');
        }
    }
    public function banks($format, $request)
    {
        if ($format=='PDF') {
                if ($request->pageSize == 'Todos') {
                    $incomes = Income::with(['User'])->get();
                }else{
                    $incomes = Income::with(['User'])->skip(($request->pageSize*$request->pageNumber) - $request->pageSize)->take($request->pageSize)->get();
                };
                $isPDF = true;
            $pdf = \PDF::loadView('reports.incomes', compact(['incomes','isPDF']));
            return $pdf->download('reporte_ingresos.pdf');
        }else{   
            return \Excel::download(new IncomesExport, 'ingresos.xlsx');
        }
    }

    public function sellers()
    {
        
    }

}
