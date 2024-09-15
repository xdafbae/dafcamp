<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\User\AfterRegister;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.user.login');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        // Ambil data dari Google callback
        $callback = Socialite::driver('google')->stateless()->user();

        // Mapping data ke variabel
        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => now(),
        ];

        // Cek apakah user sudah ada di database berdasarkan email
        $user = User::whereEmail($data['email'])->first();

        // Jika user belum ada, buat user baru
        if (!$user) {
            $user = User::create($data);

            // Kirim email setelah registrasi
            Mail::to($user->email)->send(new AfterRegister($user));
        }

        // Login user
        Auth::login($user, true);

        // Redirect ke halaman setelah login
        return redirect(route('welcome'));
    }
}
