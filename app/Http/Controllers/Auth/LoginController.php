<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/concluir';
    
    public function showLoginForm()
    {
        return view('auth.login-modern');
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Se for candidato, usar celular como credencial
        if ($request->has('number')) {
            return $this->loginWithCelular($request);
        }

        // Se for empregador, usar email como credencial
        return $this->loginWithEmail($request);
    }

    /**
     * Login usando celular (para candidatos)
     */
    protected function loginWithCelular(Request $request)
    {
        $celular = $request->input('number');
        $password = $request->input('password');

        // Buscar usuário pelo celular
        $user = DB::table('users')
            ->where('celular', $celular)
            ->where('privilegio', 'candidato')
            ->first();

        if ($user && password_verify($password, $user->password)) {
            // Fazer login do usuário
            Auth::loginUsingId($user->id);
            
            $request->session()->regenerate();
            
            return redirect()->intended($this->redirectPath());
        }

        return back()->withErrors([
            'number' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->withInput($request->only('number'));
    }

    /**
     * Login usando email (para empregadores)
     */
    protected function loginWithEmail(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Buscar usuário pelo email
        $user = DB::table('users')
            ->where('email', $email)
            ->whereIn('privilegio', ['empregador', 'admin'])
            ->first();

        if ($user && password_verify($password, $user->password)) {
            // Fazer login do usuário
            Auth::loginUsingId($user->id);
            
            $request->session()->regenerate();
            
            return redirect()->intended($this->redirectPath());
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->withInput($request->only('email'));
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        if ($request->has('number')) {
            $request->validate([
                'number' => 'required|string',
                'password' => 'required|string',
            ]);
        } else {
            $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ]);
        }
    }

    /**
     * Get the post-login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/concluir';
    }
}