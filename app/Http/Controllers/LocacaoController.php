<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Locacao;

class LocacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Locacao $locacao)
    {
        $locacoes = $locacao->all();
        return $locacoes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, Locacao $locacao)
    {
        $locacoes = $locacao->create($request->all());
        dd($locacoes);
        return $locacoes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Locacao  $locacao
     * @return Response
     */
    public function edit(Locacao $locacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Locacao  $locacao
     * @return Response
     */
    public function update(Request $request, Locacao $locacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Locacao  $locacao
     * @return Response
     */
    public function destroy(Locacao $locacao)
    {
        //
    }
}
