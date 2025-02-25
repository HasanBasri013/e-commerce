<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // Tampilan form login
    }

    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register'); // Tampilan form registrasi
    }

    // Menampilkan halaman About (atau halaman publik lainnya)
    public function showAboutPage()
    {
        return view('about'); // Tampilan halaman about
    }
}
