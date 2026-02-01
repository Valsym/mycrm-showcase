<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestUserSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'email' => 'demo@demo.ru',
            'password' => static::$password ??= Hash::make('demo'),
            'company' => 'ООО Демо',
            'name' => 'Димон',
            'position' => 'Админ',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

    }
}
