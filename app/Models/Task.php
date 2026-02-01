<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $description
 * @property int $type_id
 * @property int $deal_id
 * @property int|null $executor_id
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property int $is_completed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Deal $deal
 * @property-read \App\Models\User|null $executor
 * @property-read \App\Models\TaskType $type
 * @method static \Database\Factories\TaskFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task ordered(?string $orderBy, ?string $orderTo)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDealId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereExecutorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereIsCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = ['description', 'executor_id', 'due_date',
        'type_id', 'created_at', 'deal_id', 'is_completed'];

    protected $casts = [
        'due_date' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function getAttributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Описание',
            'executor_id' => 'Исполнитель',
            'due_date' => 'Срок исполнения',
            'type_id' => 'Тип',
            'created_at' => 'Дата создания',
            'deal_id' => 'Сделка',
        ];
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('description', 'like', "%{$search}%");
        //            ->orWhere('phone', 'like', "%{$search}%")
        //            ->orWhere('email', 'like', "%{$search}%");
    }

    public function scopeOrdered($query, ?string $orderBy, ?string $orderTo)
    {
        // разрешенные колонки
        $allowedColumns = ['id', 'created_at', 'due_date'];
        $allowedDirections = ['asc', 'desc'];

        $orderBy = in_array($orderBy, $allowedColumns) ? $orderBy : 'id';
        $orderTo = in_array($orderTo, $allowedDirections) ? $orderTo : 'desc';

        return $query->orderBy($orderBy ?? 'id', $orderTo ?? 'desc');
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    public function executor()
    {
        return $this->belongsTo(User::class, 'executor_id');
    }

    public function type()
    {
        return $this->belongsTo(TaskType::class);
    }

    public static function getExpiredCount()
    {
        return self::where('due_date', '<', now())->count();
    }

    public function getTasksCount()
    {
        return $this->count();
    }

    public function count()
    {
        return $this->count();
    }
}
