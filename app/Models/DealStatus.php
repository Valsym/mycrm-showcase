<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $alias
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deal> $deals
 * @property-read int|null $deals_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealStatus whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DealStatus extends Model
{
    protected $fillable = ['name'];

    public function getAttributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Валидация (можно использовать в FormRequest)
     */
    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:deal_statuses,name',
        ];
    }

    public function getNextStatus()
    {
        return self::where('id', '>', $this->id)
            ->orderBy('id', 'ASC')
            ->first();
    }

    public function getPrevStatus()
    {
        return self::where('id', '<', $this->id)
            ->orderBy('id', 'DESC')
            ->first();
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'status_id');
    }

    /**
     * Сумма бюджетов всех сделок в этом статусе
     */
    public function getDealsAmount()
    {
        return $this->deals()->sum('budget_amount');
    }

    /**
     * Количество сделок в этом статусе
     */
    public function getDealsCount()
    {
        return $this->deals()->count();
    }
}
