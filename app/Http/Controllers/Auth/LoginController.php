<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Importez cette ligne

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if (session()->has('previous_url')) {
            return redirect(session('previous_url'));
        }

        return redirect('/home');
    }

    protected function showLoginForm()
    {
        session(['previous_url' => url()->previous()]);
        return view('auth.login'); // Assurez-vous de mettre le bon chemin vers votre vue de connexion
    }
}
