<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginForm extends Model
{
    public $email;

    public $password;

    private $_user;

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
            $user = $this->getUser();
            if (! $user || ! $user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неправильный email или пароль');
            }
        }
    }

    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::find(['email' => $this->email]);
        }

        return $this->_user;
    }
}
