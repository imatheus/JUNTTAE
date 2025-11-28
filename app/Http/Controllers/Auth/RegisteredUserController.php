<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'cpf_cnpj' => ['nullable', 'string', 'max:18'], // Validação do CPF/CNPJ
            'tipo_usuario' => ['required', 'in:usuario,curador'], // Validação do tipo (deve ser 'usuario' ou 'curador')
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf_cnpj' => $request->cpf_cnpj,    // Salva o CPF/CNPJ
            'tipo_usuario' => $request->tipo_usuario, // Salva o tipo de usuário
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redireciona baseado no tipo de usuário
        if ($user->tipo_usuario === 'curador') {
            return redirect()->route('curador.dashboard');
        }
        
        return redirect()->route('user.dashboard');
    }
}
