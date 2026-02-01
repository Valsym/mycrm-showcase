<?php

namespace App\Http\Controllers\Demo;

use App\Models\Task;

class TaskController extends BaseDemoController
{
    protected $model = Task::class;

    protected $viewPath = 'tasks';

    protected $entityName = 'task';

    protected function getRelations()
    {
        return ['deal', 'executor', 'type'];
    }

    public function index()
    {
        // Показываем только активные задачи
        $tasks = Task::with(['deal', 'executor'])
            ->where('due_date', '>=', now()->subDays(7))
            ->orderBy('due_date')
            ->take(10)
            ->get();

        return view('demo.tasks.index', compact('tasks'));
    }
}
