<?php

namespace App\Http\Controllers;

use App\Jogadores;
use Illuminate\Http\Request;

class JogadoresController extends Controller
{
    public function index()
    {
        $jogadores = Jogadores::orderBy('nivel', 'asc')->get();

        return view('jogadores.index', compact('jogadores'));
    }

    public function create()
    {
        return view('jogadores.create');
    }

    public function save(Request $request)
    {
        $input = $request->all();

        if(Jogadores::create($input))
        {
            return redirect()->route('jogadores')->with('Sucesso', 'Salvo com sucesso.');
        } else {
            return redirect()->route('jogadores')->with('Erro', 'Erro ao salvar.');
        }
    }

    public function edit($id)
    {
        $jogador = Jogadores::find($id);
        return view('jogadores.edit', compact('jogador'));
    }

    public function update(Request $request, $id)
    {
        $jogador = Jogadores::find($id);

        if ($jogador->update($request->all())) {
            return redirect()->route('jogadores')
                ->with('Sucesso', 'Editado com sucesso.');
        } else {
            return redirect()->route('jogadores')
                ->with('Erro', 'Erro ao editar.');
        }
    }

    public function delete($id)
    {
        $jogador = Jogadores::find($id);

        if($jogador->delete()){
            return redirect()->route('jogadores')
                ->with('Sucesso', 'Excluido com sucesso.');
        } else {
            return redirect()->route('jogadores')
                ->with('Erro', 'Erro ao excluir.');
        }
    }

    public function montartime(Request $request, $qtde)
    {
        $jogadores =  $request->all();
        $qtdejogadores = ceil(count($jogadores));

        if($qtdejogadores == 0)
        {
            return response()->json('Nenhum jogador selecionado para participar da partida.', 422);
        }

        if($qtde == 0)
        {
            return response()->json('Escolha a quantidade de jogadores que terão por times.', 422);
        }

        if($qtdejogadores  < $qtde * 2) 
        {
            return response()->json('Número de jogadores confirmados insuficiente.', 422);
        }
      
        $times = [];
        $qtdetimes = ($qtdejogadores / $qtde);
        $CountTime = 0;
        $goleiro = false;
        shuffle($jogadores);

        while ($CountTime < $qtdetimes) {
            $times[$CountTime] = [];
            $qtdejogadoresadd = 0;
            $goleiro = false;

            foreach($jogadores as $key => $jogador)
            {
                if($qtdejogadoresadd <  $qtde) {

                    if($goleiro == false and  $jogador['goleiro'] == 1){
                        $goleiro = true;
                        array_push( $times[$CountTime], $jogador);
                        unset($jogadores[$key]);
                        $qtdejogadoresadd++;
                    } else {
                        if($jogador['goleiro'] == 0){
                            array_push( $times[$CountTime], $jogador);
                            unset($jogadores[$key]);
                            $qtdejogadoresadd++;
                        }  
                    }
                }
            }
           
            $CountTime++;
        }

        return response()->json($times, 200);
    }
}
