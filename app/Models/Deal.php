<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property int|null $company_id
 * @property int|null $status_id
 * @property int|null $contact_id
 * @property int|null $executor_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property string|null $description
 * @property int $budget_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\User|null $executor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Feed> $feed
 * @property-read int|null $feed_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \App\Models\User|null $owner
 * @property-read \App\Models\DealStatus|null $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @method static \Database\Factories\DealFactory factory($count = null, $state = [])
 * @method static Builder<static>|Deal filter(array $filters)
 * @method static Builder<static>|Deal newModelQuery()
 * @method static Builder<static>|Deal newQuery()
 * @method static Builder<static>|Deal onlyTrashed()
 * @method static Builder<static>|Deal query()
 * @method static Builder<static>|Deal search($search)
 * @method static Builder<static>|Deal sort(string $sortBy = 'created_at', string $sortOrder = 'desc')
 * @method static Builder<static>|Deal whereBudgetAmount($value)
 * @method static Builder<static>|Deal whereCompanyId($value)
 * @method static Builder<static>|Deal whereContactId($value)
 * @method static Builder<static>|Deal whereCreatedAt($value)
 * @method static Builder<static>|Deal whereDeletedAt($value)
 * @method static Builder<static>|Deal whereDescription($value)
 * @method static Builder<static>|Deal whereDueDate($value)
 * @method static Builder<static>|Deal whereExecutorId($value)
 * @method static Builder<static>|Deal whereId($value)
 * @method static Builder<static>|Deal whereName($value)
 * @method static Builder<static>|Deal whereStatusId($value)
 * @method static Builder<static>|Deal whereUpdatedAt($value)
 * @method static Builder<static>|Deal whereUserId($value)
 * @method static Builder<static>|Deal withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|Deal withoutTrashed()
 * @mixin \Eloquent
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

    /**
     * @param Builder $query
     * @param string $sortBy
     * @param string $sortOrder
     * @return \Illuminate\Database\Eloquent\Builder<\App\Models\Deal>
     */
    public function scopeSort(\Illuminate\Database\Eloquent\Builder $query, string $sortBy = 'created_at', string $sortOrder = 'desc'): Builder
    {
        // поля для сортировки
        $validSortFields = ['created_at', 'budget_amount', 'name'];
        $validSortOrders = ['asc', 'desc'];

        $sortBy = in_array($sortBy, $validSortFields) ? $sortBy : 'created_at';
        $sortOrder = in_array($sortOrder, $validSortOrders) ? $sortOrder : 'desc';

        // Выполняем сортировку через query builder
        $query->getQuery()->orderBy($sortBy, $sortOrder);

        // Возвращаем Eloquent Builder
        return $query;

    }
}
