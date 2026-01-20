<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    /**
     * Display the superadmin dashboard.
     */
    public function index()
    {
        $tittle = 'Super Admin Dashboard';
        $user = Auth::user();
        
        return view('admin.superadmin.index', compact('tittle', 'user'));
    }
}
