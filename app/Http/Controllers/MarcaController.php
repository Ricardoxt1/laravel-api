<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class MarcaController extends Controller
{
    private $marca;
    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$marcas = Marca::all();
        $marcas = $this->marca->all();
        return response()->json($marcas, 200, ['msg' => 'Recurso listado com sucesso']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request  $request
     * @return Response
     */
    public function store(Request $request, Marca $marca)
    {
        //$marca = Marca::create($request->all());

        $request->validate($this->marca->rules(), $this->marca->feedback());
        $image = $request->file('imagem');
        $image_urn = $image->store('imagens', 'public');

        $marca = $this->marca->create([
            'nome' => $request->nome,
            'imagem' => $image_urn
        ]);

        // $marca = $this->marca->create($request->all());
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return Response
     */
    public function show($id)
    {
        $marca = $this->marca->find($id);
        if ($marca === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }

        return response()->json($marca, 200);
    }

    /**
     * Update the specified resource in storage.
     * @param  Storage $storage
     * @param  Request  $request
     * @param  Integer $id
     * @return Response
     */
    public function update(Storage $storage, Request $request, $id)
    {
        $marca = $this->marca->find($id);

        if ($marca === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        
        if ($request->method() === 'PATCH') {
            $marca->update($request->only($this->marca->fillable));
        } else {
            $request->validate($this->marca->rules(), $this->marca->feedback());
            $marca->update($request->all());
        }
        
        if($request->file('imagem')){
            $storage->disk('public')->delete($marca->imagem);
        }

        $image = $request->file('imagem');
        $image_urn = $image->store('imagens', 'public');

        $marca->update([
            'nome' => $request->nome,
            'imagem' => $image_urn
        ]);

        return response()->json(['msg' => 'Recurso atualizado com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request $request
     * @param Storage $storage
     * @param  Integer $id
     * @return Response 
     */
    public function destroy(Storage $storage, Request $request, $id)
    {
        $marca = $this->marca->find($id);

        if ($marca === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        if($request->file('imagem')){
            $storage->disk('public')->delete($marca->imagem);
        }

        $marca->delete();
        return response()->json(['msg' => 'Recurso excluído com sucesso'], 200);
    }
}
