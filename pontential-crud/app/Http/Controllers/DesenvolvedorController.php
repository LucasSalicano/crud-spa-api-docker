<?php

namespace App\Http\Controllers;

use App\Models\Desenvolvedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesenvolvedorController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perpage') ?? 10;
        $developers = DB::table('desenvolvedores');

        if (!empty($request->input('nome'))) {
            $developers->where('nome', $request->input('nome'));
        }

        return response()->json($developers->paginate($perPage));
    }

    public function store(Request $request)
    {
        if (sizeof($request->all()) == 0){
            return response()->json('', 400);
        }

        Desenvolvedor::create($request->all());
        return response()->json('', 201);
    }

    public function update(Request $request, int $id)
    {
        $desenvolvedor = Desenvolvedor::find($id);

        if (empty($desenvolvedor)) {
            return response()->json(["Erro" => "desenvolvedor não encontrado"], 404);
        }

        $desenvolvedor->fill($request->all());
        $desenvolvedor->save();
        return response()->json($desenvolvedor);
    }

    public function show($id)
    {
        $devesenvolvedorId = filter_var($id, FILTER_VALIDATE_INT);

        if (empty($devesenvolvedorId)) {
            return response()->json(["Erro" => "o código do desenvolvedor é inválido"], 400);
        }

        $desenvolvedor = Desenvolvedor::find($id);

        if (empty($desenvolvedor)) {
            return response()->json(["Erro" => "desenvolvedor não encontrado"], 404);
        }

        return response()->json($desenvolvedor);
    }

    public function destroy($id)
    {
        $desenvolvedor = filter_var($id, FILTER_VALIDATE_INT);

        if (empty($desenvolvedor)) {
            return response()->json(["Erro" => "o código do desenvolvedor é inválido"], 400);
        }

        $desenvolvedor = Desenvolvedor::find($id);

        if (empty($desenvolvedor)) {
            return response()->json(["Erro" => "desenvolvedor não encontrado"], 404);
        }

        try {
            Desenvolvedor::destroy($id);
            return response()->json('', 204);
        } catch (\Exception $e) {
            return response()->json(["Erro" => "Erro ao remover desenvolvedor"], 500);
        }
    }
}
