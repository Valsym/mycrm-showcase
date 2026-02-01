<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DealStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('deal_statuses')->insert([
            ['name' => 'Новый', 'alias' => 'new'],
            ['name' => 'Презентация', 'alias' => 'presentation'],
            ['name' => 'В работе', 'alias' => 'in-work'],
            ['name' => 'Завершен', 'alias' => 'completed'],
        ]);
    }
}
