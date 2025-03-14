<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return Auth::user()->tipo === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }

    public function admin()
    {
        return view('admindashboard');
    }

    public function user()
    {
        return view('userdashboard');
    }
}
