<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\interfaces\PersonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements PersonInterface
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'company',
        'phone',
        'telegram_chat_id',
        'telegram_temp_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAttributeLabels()
    {
        return [
            'email' => 'Электронная почта',
            'position' => 'Должность',
            'company' => 'Название компании',
            'phone' => 'Рабочий телефон',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
        ];
    }

    public function personName()
    {
        return $this->name;
    }

    public function personPosition()
    {
        return $this->position;
    }

    public function personCompany()
    {
        return $this->company ?? null;
    }
}
