<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;


class LoginForm extends FormRequest
{
    public $email;

    public $password;

    private ?User $_user = null;

    private array $errors = [];

        public static function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email|max:128',
            'password' => [
                'required',
                'string',
                'max:255',
                //                $this->getUniqRule(),
            ],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (! $this->hasErrors()) {
            $user = $this->getAuthUser();
            if (!$user || !Hash::check($this->password, $user->password)) {
            //if (! $user || ! $user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неправильный email или пароль');
            }
        }
    }

    public function getAuthUser(): ?User
    {
        if ($this->_user === null) {
            $this->_user = User::find(['email' => $this->email]);
        }

        return $this->_user;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function addError(string $field, string $message): void
    {
        $this->errors[$field] = $message;
    }
}
