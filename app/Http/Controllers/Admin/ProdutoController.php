<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoriaDataTable;
use App\DataTables\ProdutoDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(ProdutoDataTable $produtoDataTable)
    {
        return $produtoDataTable->render('admin.produto.index');
    }

    public function create()
    {
        return view('admin.produto.form');
    }


    public function store (ProdutoRequest $request)
    {
        $produto = ProdutoService::store($request->all());

        if ($produto['status']){
            return redirect()->route('admin.produto.index')
                                ->withSucesso('Produto salvo com sucesso');
        }
        return back()->withInput()
                    ->withFalha('Ocorreu um erro ao salvar');
    }

    public function edit($id)
    {
        $produto = ProdutoService::getProdutoPorId($id);

        if($produto['status']){
            return view('admin.produto.form',[
            'produto' => $produto['produto']
            ]);
        }

        return back()->withFalha('Ocorreu erro ao selecionar o produto');
    } 

    public function update(ProdutoRequest $request, $id)
    {
        $produto = ProdutoService::update($request->all(), $id);

        if($produto['status'])
        {
            return redirect()->route('admin.produto.index')
                ->withSucesso('Produto atualizado com sucesso');
        }

        return back()->withInput()
                    ->withFalha('Ocorreu um erro ao atualizar');
    }

    public function destroy($id)
    {
        $produto = ProdutoService:: destroy($id);

        if ($produto['status']){
            return 'Produto excluido com sucesso';
        }
        abort(403,'Erro ao excluir,' .$produto['erro']);
    }

}
