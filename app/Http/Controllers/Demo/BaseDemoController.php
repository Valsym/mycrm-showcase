<?php

// Базовый демо-контроллер для всех сущностей

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;

abstract class BaseDemoController extends Controller
{
    protected $model;

    protected $viewPath;

    protected $entityName;

    public function index()
    {
        $items = $this->model::query()
            ->latest()
            ->take(10) // Ограничиваем количество в демо
            ->get();

        return view("demo.{$this->viewPath}.index", [
            'items' => $items,
            'demoMode' => true,
        ]);
    }

    public function show($id)
    {
        $item = $this->model::with($this->getRelations())->findOrFail($id);

        return view("demo.{$this->viewPath}.show", [
            $this->entityName => $item,
            'demoMode' => true,
        ]);
    }

    protected function getRelations()
    {
        return []; // По умолчанию без отношений
    }

    // Блокируем остальные методы
    public function create()
    {
        return $this->showDemoMessage("Создание {$this->entityName} доступно только в полной версии");
    }

    public function edit($id)
    {
        return $this->showDemoMessage("Редактирование {$this->entityName} доступно только в полной версии");
    }

    protected function showDemoMessage($message)
    {
        return back()->with('demo_message', $message);
    }
}
