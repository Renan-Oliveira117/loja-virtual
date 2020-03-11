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
                    {!! Form::label('preco', 'Preço')!!}
                    {!! Form::text('preco',null, ['class'=>'form-control','required']) !!}
                    @error('preco') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('estoque', 'Estoque')!!}
                    {!! Form::number('estoque',null, ['class'=>'form-control','required']) !!}
                    @error('estoque') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>
                <div class="custom-file">
                    {!! Form::label('imagem', 'Imagem')!!}
                    {!! Form::file('imagem',null, ['class'=>'custom-file-input','required']) !!}
                    @error('imagem') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Categorias</label>
                    <select class="form-control" name="categorias[]" id="select-categorias"></select>
                </div>

                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

        </div>
    </div>
@stop

@section('css')
 
@stop

@section('js')
  <script>
      var catSelecionadas= [];

      @isset($produto)
        @foreach($produto->categorias as $cat)
            var c ={
                id:  {{$cat->id}},
                text: '{{$cat->nome}}',
                selected: true
            }
            catSelecionadas.push(c);
        @endforeach
    @endisset

    $('#select-categorias').select2({
        placeholder: 'Listar de categorias',
        multiple: true,
        data: catSelecionadas,
        ajax:{
            url: '{{ route('admin.lista.categorias')}}',
            dataType:'json',
            data: function (params){
                return {
                    searchTerm: params.term
            
                };
            },
            processResults: function (response)

                return{
                    results: response
                };
        },

    }

});
</script>
@stop