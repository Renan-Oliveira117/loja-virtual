<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

 
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function clienteLogin()
    {
        return view('publico.auth.login');
    }

    public function adminLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt(array('email'=> $input['email'], 'password' => $input['password']))){
            if (auth()->user()->admin == 1){
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('publico.conta.index');
            }
        }else{
                return redirect()->route('login')
                        ->with('erro', 'Usuário ou senha estão incorretos');
            }
        }

    }

