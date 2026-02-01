<?php

namespace App\Models;

use App\interfaces\PersonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model // implements PersonInterface
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'position',
        'company_id',
        'type_id',
        'onlyDeals',
    ];

    public function getAttributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'Электронная почта',
            'position' => 'Должность',
            'company_id' => 'Компания',
            'type_id' => 'Тип',
            'onlyDeals' => 'Только со сделками',
        ];
    }

    // Отношения
    public function status()
    {
        return $this->belongsTo(ContactType::class, 'type_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function deals(): HasMany
    {
        return $this->hasMany(Deal::class, 'contact_id');
    }

    public static function itemsCountByStatus($status)
    {
        return self::find()->joinWith('status s')->where(['s.name' => $status])->count();
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
    }

    public function scopeOrdered($query, ?string $orderBy, ?string $orderTo)
    {
        // разрешенные колонки
        $allowedColumns = ['id', 'name', 'created_at', 'updated_at'];
        $allowedDirections = ['asc', 'desc'];

        $orderBy = in_array($orderBy, $allowedColumns) ? $orderBy : 'id';
        $orderTo = in_array($orderTo, $allowedDirections) ? $orderTo : 'desc';

        return $query->orderBy($orderBy ?? 'id', $orderTo ?? 'desc');
    }

    public function getContactsCount()
    {
        return $this->count();
    }
}
