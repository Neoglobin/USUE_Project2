<?php
session_start();

require 'C:/xampp/htdocs/vendor/autoload.php';

use Valitron\Validator;

Validator::langDir('C:/xampp/htdocs/lang');
Validator::lang('ru');

class ValidationRules
{
    public $login;
    public $password;
    public $password_confirm;

    public $labels = [
        'login' => 'Логин',
        'password' => 'Пароль',
        'password_confirm' => 'Пароли',
    ];

    public $rules = [
        'required' => ['login', 'password'],
        'lengthMin' => [
            ['password', 8],
        ],
        'regex' => [
            ['password', '/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[_*$]).+$/'],
        ],
        'equals' => [
            ['password_confirm', 'password'],
        ],
        'alphaNum' => [
            ['login']
        ]
    ];

    public function __construct($login, $password, $password_confirm = 'default')
    {
        $this->login = $login;
        $this->password = $password;
        $this->password_confirm = $password_confirm;
    }
}
