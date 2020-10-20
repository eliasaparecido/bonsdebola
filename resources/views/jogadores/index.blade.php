@extends('welcome')

@section('content')
    <a href="{{route('jogadores.create')}}" class="btn btn-secondary btn-sm float-right">
        <i class="fa fa-user-plus"></i> Novo
    </a>
    <h4>Jogadores</h4><hr>
       
@include('alert.alert')
   
    <jogadores v-bind:jogadores="{{$jogadores}}"></jogadores>

@endsection


