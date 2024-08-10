<?php

namespace CheckPoint;

class CheckToken
{
    public $token;
    public $url;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function verify_token()
    {
        $middleware = "http://localhost:/app/models/middleware.php";

        $options = [
            'http' => [
                'header' => "Authorization: Bearer $this->token"
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($middleware, false, $context);

        if ($response === FALSE) {
            return $_SESSION['auth_failed'] = 'Invalid token';
            $_SESSION['access_denied'] = true;
        } else {
            $_SESSION['access_accepted'] = true;
            $_SESSION['access_denied'] = false;
            return $response;
        }
    }
}
