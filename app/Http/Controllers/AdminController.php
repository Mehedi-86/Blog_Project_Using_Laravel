<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                return view('admin.index'); // Ensure you have 'admin/home.blade.php'
            } else {
                return redirect('/dashboard');
            }
        }

        return redirect()->route('login');
    }
}
