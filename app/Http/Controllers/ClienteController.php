<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cliente $cliente)
    {
        $clientes = $cliente->all();
        return $clientes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, Cliente $cliente)
    {
        $clientes = $cliente->create($request->all());
        return $clientes;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Cliente  $cliente
     * @return Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cliente  $cliente
     * @return Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
