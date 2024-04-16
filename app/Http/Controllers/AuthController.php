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
            'username'=>'required',
            'password'=>'required'
        ]);
        $credentials = $request->only('username','password');
        if(auth::attempt($credentials)){
            $user = Auth::user();
            if($user->jabatan == 'kpa'){
                $request->session()->regenerate();
                return redirect()->intended('/sekolah');
            }elseif($user->jabatan == 'lembaga'){
                $request->session()->regenerate();
                return redirect()->intended('/detilsekolah');
            }elseif($user->jabatan == 'bmps'){
                $request->session()->regenerate();
                return redirect()->intended('/bmps');
            }elseif($user->jabatan == 'sekre'){
                $request->session()->regenerate();
                return redirect()->intended('/verifikasi');
            }elseif($user->jabatan == 'admin'){
                $request->session()->regenerate();
                return redirect()->intended('/verifikasi');
            }
        }
        return back()->with('loginError','Login Gagal');
    }
    public function logout(Request $request){
        Auth::logout(); 
        $request->session()->invalidate();    
        $request->session()->regenerateToken();    
        return redirect('/loginbansm');
    }
}
