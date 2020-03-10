@extends('adminlte::page')

@section('title', 'Formulário de Produto')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Formulário de Produto</h3>
        </div>
        <div class="card-body">

            @if(isset($produto))
                {!! Form::model($produto,['url' => route('admin.produto.update' ,$produto), 'method'=>'put'])!!}
            @else 
                {!! Form::open(['url'=>route('admin.produto.store')])!!}
            @endif
                <div class="form-group">
                    {!! Form::label('nome', 'Nome')!!}
                    {!! Form::text('nome',null, ['class'=>'form-control','required']) !!}
                    @error('nome') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('descricao', 'Descrição')!!}
                    {!! Form::text('descricao',null, ['class'=>'form-control','required']) !!}
                    @error('descricao') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('imagem', 'Imagem')!!}
                    {!! Form::text('imagem',null, ['class'=>'form-control','required']) !!}
                    @error('imagem') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('preco', 'Preço')!!}
                    {!! Form::text('preco',null, ['class'=>'form-control','required']) !!}
                    @error('preco') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('estoque', 'Estoque')!!}
                    {!! Form::text('estoque',null, ['class'=>'form-control','required']) !!}
                    @error('estoque') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>

                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

        </div>
    </div>
@stop

@section('css')
 
@stop

@section('js')
  
@stop