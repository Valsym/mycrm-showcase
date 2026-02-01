<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|Feed find($id)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed findOrFail($id)
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
