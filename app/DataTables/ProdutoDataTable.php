<?php

namespace App\DataTables;

use App\Models\Produto;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProdutoDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query) 

            ->editColumn('created_at', function($produto){
                return $produto->created_at->format('d/m/Y');
            })
            ->editColumn('updated_at', function($produto){
                return $produto->updated_at->format('d/m/Y');
            })

            ->addColumn('action', function($produto){

                $acoes = link_to(
                    route('admin.produto.edit', $produto),
                    'Editar',
                    ['class' => 'btn btn-sm btn-primary']
                );

                $acoes .= FormFacade::button(
                    'Excluir',
                    ['class' =>
                        'btn btn-sm btn-danger ml-1',
                        'onclick' =>"excluir('" . route('admin.produto.destroy', $produto) ."')"
                        ]
                );

                return $acoes;

            });
    }


    public function query(Produto $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('produto-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->text('Novo Usuário'),
                        Button::make('export')->text('Exportar'),
                        Button::make('print')->text('Imprimir'),
                      
                    )
                    ->parameters([
                        'language' => ['url'=>'//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json']
                    ]);
    }


    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false),
            Column::make('id'),
            Column::make('nome')->text('Nome'),
            Column::make('preco')->text('Preço'),
            Column::make('estoque')->text('Estoque'),
            Column::make('created_at'),
            Column::make('updated_at'),
            
        ];
    }

  
    protected function filename()
    {
        return 'Produto_' . date('YmdHis');
    }
}
