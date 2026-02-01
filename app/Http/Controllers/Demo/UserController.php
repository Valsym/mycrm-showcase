<?php

namespace App\Http\Controllers\Demo;

use App\Models\User;

class UserController extends BaseDemoController
{
    protected $model = User::class;

    protected $viewPath = 'users';

    protected $entityName = 'user';

    public function index()
    {
        // Показываем только активных пользователей
        $users = User::where('is_active', true)
            ->orderBy('name')
            ->take(8)
            ->get();

        return view('demo.users.index', compact('users'));
    }
}
