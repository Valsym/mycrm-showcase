<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealStatus;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index(Request $request)
    {
        // ✅ Оставить только базовую валидацию
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'sort_by' => 'nullable|in:created_at,budget_amount,name',
            'sort_order' => 'nullable|in:asc,desc',
            'show_all' => 'nullable|boolean',
        ]);

        $deals = Deal::query()
            ->when(! empty($validated['search']), function ($q) use ($validated) {
                $q->search($validated['search']);
            })
            ->when(! empty($validated['date_from']) || ! empty($validated['date_to']), function ($q) use ($validated) {
                $q->filter($validated);
            })
            ->with(['company', 'contact', 'executor', 'owner'])
            ->orderBy($validated['sort_by'] ?? 'created_at', $validated['sort_order'] ?? 'desc')
            ->paginate(15); // Вместо сложной канбан-логики

        // ✅ Получаем статусы просто для отображения
        $dealStatuses = DealStatus::withCount('deals')->get();

        // ✅ Очень простая статистика
        $totalDeals = Deal::count();
        $totalAmount = Deal::sum('budget_amount');

        return view('demo.deals.index', compact(
            'deals',
            'dealStatuses',
            'totalDeals',
            'totalAmount'
        ));

        $deals = Deal::with(['company', 'owner', 'status'])
            ->latest()
            ->paginate(10);

        return view('demo.deals.index', compact('deals'));
    }

    public function create()
    {
        // Просто показываем сообщение, что создание не доступно в демо
        return redirect()->route('demo.deals.index')
            ->with('demo_message', 'Создание новых сделок доступно только в полной версии CRM');
    }

    public function show(Deal $deal)
    {
        // Только базовые отношения - не нагружаем демо
        $deal->load(['company', 'contact', 'owner', 'executor', 'status']);

        // Минимальные данные для отображения
        $statuses = DealStatus::all(); // Для демонстрации возможных статусов

        return view('demo.deals.show', compact('deal', 'statuses'));
    }

    public function edit(Deal $deal)
    {
        // Показываем только форму просмотра с сообщением
        return redirect()->route('demo.deals.show', $deal)
            ->with('demo_message', 'Редактирование доступно только в полной версии');
    }
}
