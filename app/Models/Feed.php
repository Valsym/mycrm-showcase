<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|Feed find($id)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed findOrFail($id)
 */
class Feed extends Model
{
    use HasFactory;

    const TYPE_NEW = 'new';

    const TYPE_STATUS = 'status';

    const TYPE_NOTE = 'note';

    const TYPE_EXECUTOR = 'executor';

    protected $fillable = ['type', 'value', 'user_id', 'deal_id', 'created_at'];

    protected $casts = [
        'created_at' => 'datetime', // Явное указание типа
    ];

    /**
     * Правила валидации (для использования в FormRequest)
     */
    public static function rules(): array
    {
        return [
            'type' => 'required|string',
            'value' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'deal_id' => 'required|exists:deals,id',
        ];
    }

    public function getAttributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'created_at' => 'Дата создания',
            'user_id' => 'Пользователь',
            'deal_id' => 'Сделка',
            'value' => 'Значение',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    /**
     * Scope для фильтрации по типу
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope для конкретной сделки
     */
    public function scopeForDeal($query, int $dealId)
    {
        return $query->where('deal_id', $dealId);
    }

    /**
     * Создание записи в ленте (helper метод)
     */
    public static function createRecord(string $type, int $dealId, $value, ?int $userId = null): self
    {
        return self::create([
            'type' => $type,
            'deal_id' => $dealId,
            'value' => (string) $value,
            'user_id' => $userId ?? auth()->id(),
            'created_at' => now(),
        ]);
    }
}
