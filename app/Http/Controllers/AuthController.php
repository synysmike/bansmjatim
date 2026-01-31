<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    //

    public function index()
    {
        // $user = Auth::user();
        // if ($user->jabatan == 'kpa') {
        //     return redirect('/sekolah');
        // }elseif ($user->jabatan  == 'lembaga') {
        //     return redirect('/detilsekolah');
        // }    elseif ($user->jabatan  == 'bmps') {
        //     return redirect('/bmps');
        // }       

        // else{
        return view('auth.login');
        // }
    }
    public function login()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->trashed()) {
                Auth::logout();
                return view('auth.login2');
            }
            $redirectPath = $this->getRedirectPathForUser($user);
            return redirect()->to($redirectPath);
        }
        return view('auth.login2');
    }

    /**
     * Get redirect path after login (or when already logged in visiting login page).
     */
    protected function getRedirectPathForUser($user)
    {
        if ($user->jabatan == 'kpa') {
            return '/sekolah';
        }
        if ($user->jabatan == 'lembaga') {
            return '/detilsekolah';
        }
        if ($user->jabatan == 'bmps') {
            return '/bmps';
        }
        if ($user->jabatan == 'sekre') {
            return '/verifikasi';
        }
        if ($user->jabatan == 'admin') {
            return '/admin/dashboard';
        }
        if ($user->hasRole('admin') || $user->hasRole('staff')) {
            return '/admin/dashboard';
        }
        return '/verifikasi';
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        // Attempt authentication using username
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if user is soft deleted
            if ($user->trashed()) {
                Auth::logout();
                return back()->with('loginError', 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.');
            }

            $redirectPath = $this->getRedirectPathForUser($user);
            return redirect()->intended($redirectPath)->with('success', 'Login berhasil! Selamat datang, ' . $user->name);
        }

        return back()->with('loginError', 'Username atau password salah. Silakan coba lagi.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/loginbanpdm');
    }
}
