<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // В демо-версии показываем ТОЛЬКО статические/фейковые данные
        return view('demo.dashboard.index', [
            'hotTasks' => $this->getDemoHotTasks(),
            'newestCompanies' => $this->getDemoNewestCompanies(),
            'financeOverview' => $this->getDemoFinanceOverview(),
            'dealsCounters' => $this->getDemoDealsCounters(),
            'commonCounters' => $this->getDemoCommonCounters(),
            'weekPerformance' => $this->getDemoWeekPerformance(),
            'dealsByMonth' => $this->getDemoDealsByMonth(),
            'demoMode' => true, // Флаг для демо-режима в шаблоне
        ]);
    }

    private function getDemoHotTasks($limit = 5)
    {
        // Статические данные для демо
        return [
            (object) [
                'id' => 1,
                'deal_id' => 1,
                'deal' => (object) ['name' => 'Разработка сайта'],
                'type' => (object) ['name' => 'Звонок'],
                'executor' => (object) ['name' => 'Иван Иванов'],
                'due_date' => Carbon::tomorrow(),
            ],
            (object) [
                'id' => 2,
                'deal_id' => 2,
                'deal' => (object) ['name' => 'SEO продвижение'],
                'type' => (object) ['name' => 'Встреча'],
                'executor' => (object) ['name' => 'Петр Петров'],
                'due_date' => Carbon::today(),
            ],
        ];
    }

    private function getDemoNewestCompanies($limit = 2)
    {
        return [
            (object) [
                'id' => 1,
                'name' => 'ООО Кванта',
                'address' => 'г. Москва, ул. Пушкина, 1',
                'url' => '#',
            ],
            (object) [
                'id' => 2,
                'name' => 'АО "СтройМир"',
                'address' => 'г. Санкт-Петербург, Невский пр., 10',
                'url' => '#',
            ],
        ];
    }

    private function getDemoFinanceOverview()
    {
        // Возвращаем массив [потенциал, заработано]
        return [1250000, 850000];
    }

    private function getDemoDealsCounters()
    {
        // Статические счетчики сделок по статусам
        return [
            'Новые' => 12,
            'В работе' => 8,
            'Переговоры' => 5,
            'Завершено' => 15,
            'Архив' => 3,
        ];
    }

    private function getDemoCommonCounters()
    {
        return [
            'tasks' => 42,
            'users' => 8,
            'companies' => 25,
            'contacts' => 120,
            'complete_deals' => 15,
        ];
    }

    private function getDemoWeekPerformance()
    {
        // Статические данные для графика недельной активности
        return [
            'labels' => ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            'data' => [12, 19, 8, 15, 22, 18, 10],
        ];
    }

    private function getDemoDealsByMonth()
    {
        // Статические данные для графика по месяцам
        $months = [];
        $monthNames = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];

        $currentMonth = (int) date('n');
        $currentYear = date('Y');

        for ($i = 5; $i >= 0; $i--) {
            $month = $currentMonth - $i;
            $year = $currentYear;

            if ($month < 1) {
                $month += 12;
                $year -= 1;
            }

            $months[] = (object) [
                'month' => $year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT),
                'count' => rand(5, 20),
                'total' => rand(100, 500),
            ];
        }

        return $months;
    }
}
