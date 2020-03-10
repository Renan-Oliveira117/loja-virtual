<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch($this->method())
            {
                 case 'POST':
                {
                        return[
                            'nome' => 'required',
                            'descricao' => 'required',
                            'estoque' => 'required',
                            'preco' => 'required',
                            'imagem' => 'required',
                        ];
                }
                 case 'PUT':
                {
                    return[
                        'nome' => 'required',
                        'descricao' => 'required',
                        'estoque' => 'required',
                        'preco' => 'required',
                        'imagem' => 'required',
                     ];
                }
            
            }
    }
}
