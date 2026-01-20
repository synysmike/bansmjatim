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
        // $user = Auth::user();
        // if ($user->jabatan == 'kpa') {
        //     return redirect('/sekolah');
        // }elseif ($user->jabatan  == 'lembaga') {
        //     return redirect('/detilsekolah');
        // }    elseif ($user->jabatan  == 'bmps') {
        //     return redirect('/bmps');
        // }       

        // else{
            return view('auth.login2');
        // }
    }
    public function authenticate(Request $request){
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

            // Redirect based on jabatan
            if ($user->jabatan == 'kpa') {
                $redirectPath = '/sekolah';
            } elseif ($user->jabatan == 'lembaga') {
                $redirectPath = '/detilsekolah';
            } elseif ($user->jabatan == 'bmps') {
                $redirectPath = '/bmps';
            } elseif ($user->jabatan == 'sekre') {
                $redirectPath = '/verifikasi';
            } elseif ($user->jabatan == 'admin') {
                $redirectPath = '/admin/home'; // Changed to admin home page
            } else {
                $redirectPath = '/verifikasi';
            }

            return redirect()->intended($redirectPath)->with('success', 'Login berhasil! Selamat datang, ' . $user->name);
        }

        return back()->with('loginError', 'Username atau password salah. Silakan coba lagi.');
    }
    public function logout(Request $request){
        Auth::logout(); 
        $request->session()->invalidate();    
        $request->session()->regenerateToken();    
        return redirect('/loginbansm');
    }
}
