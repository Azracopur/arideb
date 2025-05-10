<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|digits_between:10,15|unique:users,phone',
            'birthday' => 'nullable|date',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->save();

            // Role atama işlemi
       $role = \App\Models\Role::where('name', 'student')->first(); // Burada role ismi 'student'
       $user->roles()->attach($role); // Kullanıcıya rolü ata

        // Kullanıcıyı kaydettikten sonra giriş işlemi yapılabilir veya ana sayfaya yönlendirebilirsin
        return redirect()->route('login')->with('success', 'User registered successfully!');
    }

    public function login(Request $request)
    {
        // Gelen giriş bilgilerini doğrula
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kullanıcıyı al
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Laravel Auth sistemini kullanarak oturum aç
            Auth::login($user);

            // Kullanıcının rolünü kontrol et
            if ($user->roles()->where('name', 'superadmin')->exists()) {
                // Eğer kullanıcı süperadmin ise admin paneline yönlendir
                return redirect()->route('roles.index');
            } elseif ($user->roles()->where('name', 'student')->exists()) {
                // Eğer kullanıcı öğrenci ise öğrenci paneline yönlendir
                return redirect()->route('roles.index');
            } else {
                // Genel yönlendirme
                return redirect()->route('roles.index');
            }
        }

        // Eğer giriş başarısızsa hata mesajı göster
        return back()->withErrors(['email' => 'Geçersiz giriş bilgileri']);
    }

    // Giriş yapmış kullanıcıyı çıkartmak için logout fonksiyonu
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
