<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                return view('admin.adminhome'); // Ensure you have 'admin/home.blade.php'
            } else {
                return redirect('homepage');
            }
        }

        return redirect()->route('login');
    }

    public function homepage()
  {
    return view('home.homepage'); 
  }

}
