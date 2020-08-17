<?php

namespace App\Http\Controllers;

use App\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomeController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $income = Income::whereBetween('date',[
                Carbon::parse($request->since)->toDateString(),
                Carbon::parse($request->until)->toDateString()
                ])
                ->with(['User:id,name'])->orderBy('date','desc')->orderBy('time','desc')->get();
            return response($income,200);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
    
        if ($request->ajax()) {
            $income = new Income;
            $income->fill($request->all());
            $income->save();
            return response('ok',200);
        }
    }

    public function show(Income $income)
    {
        //
    }

    public function edit(Income $income)
    {
        //
    }

    public function update(Request $request, Income $income)
    {
        if ($request->ajax()) {
            $income->fill($request->all());
            $income->save();
            return response('',200);
        }
    }

    public function destroy(Request $request,Income $income)
    {
        if ($request->ajax()) {
            $income->delete();
            return response('',200);
        }
    }
}
