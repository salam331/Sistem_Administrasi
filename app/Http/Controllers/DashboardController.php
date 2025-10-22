<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menentukan dashboard yang akan ditampilkan
     * berdasarkan role user yang sedang login.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Jika tidak ada user login
        if (!$user) {
            return redirect('/login');
        }

        // Redirect berdasarkan role
        if ($user->hasRole('admin')) {
            // Admin diarahkan ke halaman admin
            return redirect('/admin');

        } elseif ($user->hasRole('guru')) {
            // Guru diarahkan ke halaman guru
            return redirect('/guru');

        } elseif ($user->hasRole('siswa')) {
            // Siswa diarahkan ke halaman siswa
            return redirect('/siswa');

        } else {
            // Jika user tidak memiliki role yang valid
            Auth::logout();
            return redirect('/login')->withErrors([
                'login_error' => 'Akun Anda tidak memiliki peran yang valid.'
            ]);
        }
    }
}
