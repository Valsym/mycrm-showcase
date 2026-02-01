<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['email', 'name', 'url', 'phone', 'address'];

    /**
     * Аналог attributeLabels из Yii2 (для форм)
     *
     * @return string[]
     */
    public function getAttributeLabels()
    {
        return [
            'name' => 'Имя',
            'address' => 'Адрес',
            'email' => 'Рабочий email',
            'phone' => 'Рабочий телефон',
            'url' => 'Сайт',
        ];
    }

    /**
     * Scope для поиска (аналог search из Yii2)
     *
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%");
    }

    /**
     * Добавление сортировки.
     * Улучшенная версия scope с валидацией
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     *
     * @codeCoverageIgnore - Игнор для покрытия тестами, если метод не используется
     */
    public function scopeOrdered($query, ?string $orderBy, ?string $orderTo)
    {
        // разрешенные колонки
        $allowedColumns = ['id', 'name', 'created_at', 'updated_at'];
        $allowedDirections = ['asc', 'desc'];

        $orderBy = in_array($orderBy, $allowedColumns) ? $orderBy : 'id';
        $orderTo = in_array($orderTo, $allowedDirections) ? $orderTo : 'desc';

        return $query->orderBy($orderBy ?? 'id', $orderTo ?? 'desc');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'company_id');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'company_id');
    }

    public function activeContacts()
    {
        return $this->getContacts()->where(['status' => '1'])->orderBy(['dt_add' => SORT_ASC]);
    }

    public function getCompanyCount()
    {
        return $this->count();
    }
}
