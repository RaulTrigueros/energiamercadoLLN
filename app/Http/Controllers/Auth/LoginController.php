<?php

namespace App\Http\Controllers\Auth;

use App\Bitacora;
use App\Http\Controllers\Controller;
use App\Services\BitacoraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $bitacoraService;

    public function __construct(BitacoraService $bitacoraService)
    {
        $this->bitacoraService = $bitacoraService;
    }


    public function showLoginForm(){
        return view('auth.login'); //Muestra la vista del login
    }

    public function login(Request $request){
        $this->validateLogin($request);

        if (Auth::attempt(['usuario' => $request->usuario,'password' => $request->password,'condicion'=>1])){
            $this->bitacoraService->store('Inicio de sesión', null);
            return redirect()->route('main');
        }

        return back()->withErrors(['usuario' => trans('auth.failed')])
        ->withInput(request(['usuario']));

    }

    protected function validateLogin(Request $request){
        $this->validate($request,[
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);

    }

    public function logout(Request $request){
        $this->bitacoraService->store('Finalización de sesión', null);
        Auth::logout();
        $request->session()->invalidate();
        return redirect(\URL::previous());
        //return redirect('/');
    }
}
