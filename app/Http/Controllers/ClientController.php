<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $clients = Client::all();

            return response()->json([
               'rows'=>$clients 
            ]);
        }
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            try {
                $client = new Client;
                $client->fill($request->all());
                $client->save();
                return response('ok',200);
            } catch (\Illuminate\Database\QueryException $e) {
                return response($e->errorInfo);
            }
        }
    }

    public function show(Request $request)
    {

        if ($request->ajax()) {
            $client = Client::where('cedula',$request->cedula)->first();
            return response($client,200);
        }
    }

    public function update(Request $request, Client $client)
    {
        try {
            $client->fill($request->all());
            $client->save();
            return response('ok',200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response($e->errorInfo);
        }
    }

    public function destroy(Client $client,Request $request)
    {
        if($request->ajax()){
            $client->delete();
            return response('',200);
        }
    }

}
