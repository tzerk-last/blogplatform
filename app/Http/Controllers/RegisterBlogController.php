<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterBlogController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
            'subdomain' => 'required|alpha_dash|min:3|unique:domains,domain',
            'blog_name' => 'required|string|max:255',
        ]);

        // 1. Crear usuario
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2. Crear el tenant (blog)
        $tenant = Tenant::create([
            'blog_name'    => $request->blog_name,
            'bg_color'     => '#ffffff',
            'text_color'   => '#111111',
            'accent_color' => '#3b82f6',
            'font'         => 'Inter',
            'is_active'    => true,
        ]);

        // 3. Crear dominio
        $tenant->domains()->create([
            'domain' => $request->subdomain . '.' . config('tenancy.central_domains')[0],
        ]);

        // 4. Asociar usuario al tenant
        $tenant->users()->attach($user->id);

        // 5. Login y redirigir al dashboard
        Auth::login($user);

        return redirect()->away(
            'http://' . $request->subdomain . '.' . config('tenancy.central_domains')[0] . '/dashboard'
        );
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            $tenant = $user->tenants()->first();

            return redirect()->away(
                'http://' . $tenant->domains()->first()->domain . '/dashboard'
            );
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}