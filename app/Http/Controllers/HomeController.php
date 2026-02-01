<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    use HasFactory;
    public function index()
    {
        // Если пользователь уже авторизован - редирект на демо-дашборд
        if (Auth::check()) {
            return redirect()->route('demo.dashboard.index');
        }

        // Всегда показываем демо-лендинг для неавторизованных пользователей
        return view('demo.welcome');
    }

    /**
     * Авторизация под демо-пользователем
     */
    public function demoLogin(Request $request)
    {
        // Ищем или создаем демо-пользователя
        $user = User::firstOrCreate(
            ['email' => 'demo@demo.ru'],
            [
                'name' => 'Димон',
                'password' => Hash::make('demo'),
                //                'position' => 'Админ',
                //                'company' => 'ООО Демо',
            ]
        );

        // Авторизуем пользователя
        Auth::login($user, true); // true = "запомнить меня"

        // Редирект на демо-дашборд
        return redirect()->route('demo.dashboard.index')
            ->with('success', 'Вы вошли в демо-режим под учетной записью demo@demo.ru');
    }

    /**
     * Выход из демо-режима
     */
    public function demoLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('info', 'Вы вышли из демо-режима');
    }
}
