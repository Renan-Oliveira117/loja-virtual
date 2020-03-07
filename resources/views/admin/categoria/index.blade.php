@extends('adminlte::page')

@section('title', 'Lista de Categoria')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Lista de Categoria</h3>
        </div>
        <div class="card-body">
            {{$dataTable->table() }}

        </div>
    </div>
@stop

@section('css')
 
@stop

@section('js')
    {{ $dataTable->scripts()}}
  
@stop