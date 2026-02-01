<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|Feed find($id)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed findOrFail($id)
 */
class Deal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'company_id', 'status_id', 'user_id',
        'status_id', 'user_id', 'contact_id', 'executor_id',
        'due_date', 'description', 'budget_amount',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * @return string[]
     */
    public function getAttributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'company_id' => 'Компания',
            'status_id' => 'Этап',
            'user_id' => 'Создатель',
            'contact_id' => 'Контакт',
            'executor_id' => 'Исполнитель',
            'due_date' => 'Дата исполнения',
            'description' => 'Описание',
            'budget_amount' => 'Стоимость работ',
            'created_at' => 'Дата создания',
        ];
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function executor()
    {
        return $this->belongsTo(User::class, 'executor_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function status()
    {
        return $this->belongsTo(DealStatus::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function feed()
    {
        return $this->hasMany(Feed::class)->orderBy('created_at');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        // Фильтрация по дате создания
        if (! empty($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (! empty($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to'].' 23:59:59');
        }

        return $query;
    }

    public function scopeSort(Builder $query, string $sortBy = 'created_at', string $sortOrder = 'desc'): Builder
    {
        // поля для сортировки
        $validSortFields = ['created_at', 'budget_amount', 'name'];
        $validSortOrders = ['asc', 'desc'];

        $sortBy = in_array($sortBy, $validSortFields) ? $sortBy : 'created_at';
        $sortOrder = in_array($sortOrder, $validSortOrders) ? $sortOrder : 'desc';

        return $query->orderBy($sortBy, $sortOrder);
    }
}
