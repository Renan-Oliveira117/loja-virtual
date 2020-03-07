<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $userDataTable)
      {  
        return $userDataTable->render('admin.user.index');
      }
      
    public function create()
    {
      return view('admin.user.form');
    }

    public function store(UserRequest $request)
    {
      $user = UserService::store($request->all());

      if ($user['status']){
        return redirect()->route('admin.user.index')
                    ->withSucesso('Usuário salvo com sucesso');
      }

      return back()->withInput()
              ->withFalha('Ocorreu um erro ao salvar');

    }

    public function edit($id)
    {
        $user = UserService::getUserPorId($id);

        if ($user['status']){
          return view('admin.user.form',[
            'user' => $user['user']
          ]);
        }

        return back()->withFalha('Ocorreu um erro ao selecionar o usuário');
    }

    public function update(UserRequest $request, $id)
    {
      $user = UserService::update($request->all(), $id);

      if ($user['status'])
      {
          return redirect()->route('admin.user.index')
              ->withSucesso('Usuário atualizado com sucesso');
      }

      return back()->withInput()
                ->withFalha('Ocorreu um erro ao atualizar');
    }

    public function destroy($id)
    {
      $user = UserService::destroy($id);

      if ($user['status']){
        return 'Usuário excluido com sucesso';
      }
      abort(403,'Erro ao excluir,' .$user['erro']);
    }
    
 }