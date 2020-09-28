<?php

namespace ImobiRodi\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ImobiRodi\Http\Controllers\Controller;
use ImobiRodi\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()){
            return redirect()->route('admin.home');
        }
        return view('admin.index');
    }

    public function home()
    {
        return view('admin.dashboard');
    }

    public function login(Request $req)
    {
        $ret['success'] = false;
        if (in_array('', $req->only('email', 'password'))){
            $ret['msg'] = "Todos os campos são obrigatórios.";
            return response()->json($ret);
        }

        if (!filter_var($req->email, FILTER_VALIDATE_EMAIL)) {
            $ret['msg'] = "O e-mail informado não é válido.";
            return response()->json($ret);
        }

        $credenciais = [
            'email' => $req->email,
            'password' => $req->password
        ];

        if(!Auth::attempt($credenciais)){
            $ret['msg'] = "Usuário ou/e senha não conferem.";
            return response()->json($ret);
        }

        $this->authenticated($req->getClientIp());

        $ret['success'] = true;
        $ret['redirect'] = route('admin.home');
        return response()->json($ret);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    private function authenticated(string $ip){
        $user =  User::where('id', Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip
        ]);
    }

}
