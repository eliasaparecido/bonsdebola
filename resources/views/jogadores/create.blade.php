@extends('welcome')

@section('content')

<a href="{{route('jogadores')}}" class="btn btn-secondary btn-sm float-right">
    <i class="fa fa-reply"></i> Voltar
</a>

<h4>Jogadores</h4><hr>
   
@include('alert.alert')

    <form method="POST" action="{{action('JogadoresController@save')}}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <div class="form-group col-md-12">
        <div class="row">
            <div class="col-md-4">
                <input class="form-control" type="text" name="nome" placeholder="Nome" required="required">
            </div>
            <div class="col-md-4">
                <select name="nivel" required="required" class="form-control">
                    <option value="">Escolha um Nível</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="col-md-4">
                <select name="goleiro" required="required" class="form-control">
                    <option value="">É Goleiro?</option>
                    <option value=1>Sim</option>
                    <option value=0>Não</option>
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


