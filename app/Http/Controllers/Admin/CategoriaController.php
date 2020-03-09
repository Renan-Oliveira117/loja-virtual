<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoriaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use App\Services\CategoriaService;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
  
    public function index(CategoriaDataTable $categoriaDataTable)
    {
        return $categoriaDataTable->render('admin.categoria.index');
    }

    public function create()
    {
        return view('admin.categoria.form');
    }

   
    public function store(CategoriaRequest $request)
    {
        $categoria = CategoriaService::store($request->all());

        if ($categoria['status']){
          return redirect()->route('admin.categoria.index')
                      ->withSucesso('Usuário salvo com sucesso');
        }
  
        return back()->withInput()
                ->withFalha('Ocorreu um erro ao salvar');
    }

    public function show(Categoria $categoria)
    {
        //
    }

    public function edit($id)
    {
        $retorno = CategoriaService::getCategoriaPorId($id);

        if ($retorno['status']){
            return view('admin.categoria.form',[
                'categoria' => $retorno['categoria']
            ]);
        }
        return back()->witnFalha('Ocorreu u erro ao selecionar a categoria');

    }

   
    public function update(Request $request, $id)
    {
        $retorno =  CategoriaService::update($request->all(), $id);

        if ($retorno['status']){
            return redirect()->route('admin.categoria.index')
                    ->withSucesso('Categoria atualizada com sucesso');

        }
        return back()->withInput()
                ->withFalha('Ocorreu um erro ao atualizar');
    }

 
    public function destroy($id)
    {
      $categoria = CategoriaService::destroy($id);

        if ($categoria['status']){
            return 'Categoria excluida com sucesso';
        }

        abort(403,'Erro ao excluir,' .$categoria['erro']);
    }
}
