@extends('welcome')

@section('content')

<a href="{{route('jogadores')}}" class="btn btn-secondary btn-sm float-right">
    <i class="fa fa-reply"></i> Voltar
</a>

<h4>Jogadores</h4><hr>
   
@include('alert.alert')

    <form method="post" action="{{action('JogadoresController@update', $jogador->id)}}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <div class="form-group col-md-12">
        <input type="hidden" name="_method" value="put" />
        <div class="row">
            <div class="col-md-4">
                <input class="form-control" type="text" name="nome" placeholder="Nome" value="{{$jogador->nome}}" required="required">
            </div>
            <div class="col-md-4">
                <select name="nivel" required="required" class="form-control">
                    <option value="">Escolha um Nível</option>
                    <option value=1 {{($jogador->nivel == 1) ? 'selected':''}}>1</option>
                    <option value=2 {{($jogador->nivel == 2) ? 'selected':''}}>2</option>
                    <option value=3 {{($jogador->nivel == 3) ? 'selected':''}}>3</option>
                    <option value=4 {{($jogador->nivel == 4) ? 'selected':''}}>4</option>
                    <option value=5 {{($jogador->nivel == 5) ? 'selected':''}}>5</option>
                </select>
            </div>

            <div class="col-md-4">
                <select name="goleiro" required="required" class="form-control">
                    <option value="">É Goleiro?</option>
                    <option value=1  {{($jogador->goleiro == 1) ? 'selected':''}}>Sim</option>
                    <option value=0  {{($jogador->goleiro == 0) ? 'selected':''}}>Não</option>
                </select>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" title="Salvar" class="btn btn-primary">Salvar</button>
        </div>
    </div>  
     
    </form>

@endsection


