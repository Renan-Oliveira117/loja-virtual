<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
                        ];
                }
                 case 'PUT':
                {
                    return[
                        'nome' => 'required',
                     ];
                }
            
            }
    }
}
