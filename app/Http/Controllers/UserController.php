<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'dokter') {
            return view('doctor.dashboard');
        } elseif ($user->role == 'apoteker') {
            return view('pharmacist.dashboard');
        } else {
            abort(403, "Anda tidak memiliki akses");
        }
    }
}
