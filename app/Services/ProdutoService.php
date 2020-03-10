<?php

namespace App\Services;

use App\Models\Produto;
use Exception;

class ProdutoService
{
    public static function store($request)
    {
        try{
            $produto = Produto::create($request);
            return [
                'status' => true,
                'produto' => $produto
            ];
        }catch(Exception $err){
            dd($err->getMessage());
            return[
            'status' => false,
            'erro' => $err->getMessage()
            ];
        }
    }

    public static function getProdutoPorId($id)
    {
        try{
            $produto = Produto::findOrfail($id);

            return[
                'status' => true,
                'produto' => $produto
            ];
        }catch(Exception $err){
            return[
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function update($request, $id)
    {
        try{
            $produto = Produto::findOrFail($id);
            $produto ->update($request);

            return[
                'status' => true,
                'categoria' => $produto
            ];
        }catch(Exception $err){
            return[
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function destroy($id)
    {
        try{
            $produto = Produto::findOrFail($id);
            $produto-> delete();
            return[
                'status'=>true
            ];
        }catch(Exception $err){
            return[
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }
}