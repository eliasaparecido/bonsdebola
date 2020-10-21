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

        shuffle( $jogadores );//misturo jogares

        //separo os goleiros dos jogadores
        $filterGoleiros = 1; 

        $goleiros = array_filter($jogadores, function ($var) use ($filterGoleiros) {
            return ($var['goleiro'] == $filterGoleiros);
        });

        $filterJogadores= 0; 

        $jogadoreslinha = array_filter($jogadores, function ($var) use ($filterJogadores) {
            return ($var['goleiro'] == $filterJogadores);
        });
       

        while($CountTime < $qtdetimes)
        {
            $booleangoleiro = false;
            $times[$CountTime] = [];
            $nrjogadores = 0;
            
            foreach($goleiros as $key => $goleiro)
            {
                if($nrjogadores < $qtde)
                {
                    if($booleangoleiro == false)
                    {
                        array_push( $times[$CountTime],  $goleiro);
                        unset($goleiros[$key]);
                        $booleangoleiro = true;
                        $nrjogadores++;
                    } 
                }
            }

            foreach($jogadoreslinha as $key => $jogadorlinha)
            {
                if($nrjogadores < $qtde)
                {
                    array_push( $times[$CountTime],  $jogadorlinha);
                    unset($jogadoreslinha[$key]);
                    $nrjogadores++;
                }
            }


            $CountTime++;
        }

        return response()->json( $times , 200);
    }
}
