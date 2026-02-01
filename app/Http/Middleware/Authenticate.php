<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Если запрос ожидает JSON, возвращаем null
        if ($request->expectsJson()) {
            return null;
        }

        // Проверяем, если это демо-маршрут
        if (str_contains($request->path(), 'demo')) {
            return route('demo.welcome'); // Перенаправляем на демо-лэндинг
        }

        // По умолчанию на главную страницу
        return route('home');
    }
}
