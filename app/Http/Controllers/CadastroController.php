<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Cadastro;
use Illuminate\Http\Request;
use App\Http\Resources\Cadastro as CadastroResource;

class CadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cadastros = Cadastro::orderBy('created_at', 'DESC')->paginate(5);

        // Retorna coleção de cadastro ao template
        return CadastroResource::collection($cadastros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cadastro = $request->isMethod('PUT') ? Cadastro::findOrFail($request->cadastro_id) : new Cadastro;
        $cadastro->id = $request->input('cadastro_id');
        $cadastro->title = $request->input('title');
        $cadastro->body = $request->input('body');

        if ($cadastro->save()) {
            return new CadastroResource($cadastro);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cadastro = Cadastro::findOrFail($id);

        // retorna um unico cadastro no templete
        return new CadastroResource($cadastro);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cadastro = Cadastro::findOrFail($id);

        if ($cadastro->delete()) {
            return new CadastroResource($cadastro);
        }
    }
}
