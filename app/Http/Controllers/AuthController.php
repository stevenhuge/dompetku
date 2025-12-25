<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login(Request $request)
    {
        // 1. Ambil data input
        $email = $request->input('email');
        $password = $request->input('password');

        // 2. Pengecekan Manual (Hardcode)
        if ($email === 'admin@dompetku.com' && $password === 'admin') {

            // 3. Jika cocok, simpan sesi
            session(['is_logged_in' => true]);

            // Alihkan ke Dashboard
            return redirect('/dashboard');

        } else {
            // 4. Jika salah, kembali ke login dengan pesan error
            return back()->with('error', 'Email atau password salah!');
        }
    }
}
