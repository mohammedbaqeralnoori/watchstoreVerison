<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * عرض صفحة التسجيل.
     */
    public function create(): View
    {
        // استخدم layout لوحة التحكم بدل Breeze guest-layout
        return view('admin.auth.register');
    }

    /**
     * معالجة طلب التسجيل.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // إنشاء مستخدم جديد مع كلمة مرور bcrypt
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // إطلاق حدث التسجيل
        event(new Registered($user));

        // تسجيل الدخول تلقائيًا
        Auth::login($user);

        // إعادة التوجيه إلى الصفحة الرئيسية للوحة التحكم
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
