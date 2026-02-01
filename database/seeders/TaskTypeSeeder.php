<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_types')->insert([
            ['name' => 'Разработка'],
            ['name' => 'Маркетинг'],
            ['name' => 'Дизайн'],
            ['name' => 'Аналитика'],
            ['name' => 'Копирайтинг'],
        ]);

    }
}
