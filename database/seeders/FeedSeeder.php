<?php

namespace Database\Seeders;

use App\Models\Deal;
use App\Models\Feed;
use Illuminate\Database\Seeder;

class FeedSeeder extends Seeder
{
    public function run(): void
    {
        $deals = Deal::all();

        foreach ($deals as $deal) {
            // Добавляем запись о создании сделки
            Feed::create([
                'type' => Feed::TYPE_NEW,
                'deal_id' => $deal->id,
                'value' => (string) $deal->id,
                'user_id' => $deal->user_id,
                'created_at' => $deal->created_at,
            ]);

            // Если статус не "Новая" (ID=1), добавляем запись о текущем статусе
            if ($deal->status_id != 1) {
                Feed::create([
                    'type' => Feed::TYPE_STATUS,
                    'deal_id' => $deal->id,
                    'value' => (string) $deal->status_id,
                    'user_id' => $deal->user_id, // или random user для демо
                    'created_at' => $deal->created_at->addHours(rand(1, 24)),
                ]);
            }
        }
    }
}
