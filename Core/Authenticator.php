<?php

namespace Core;

class Authenticator
{
    protected $errors = [];
    public function attempt(string $email, string $password): bool
    {
        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email,
        ])->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $this->login([
                'email' => $email,
                'id' => $user['id']
            ]);

            return true;
        }

        return false;
    }

    protected function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
            'id' => $user['id']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {

        Session::flush();
        Session::destroy();
        
        header('location: /');
        exit();
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error($key, $message): void
    {
        $this->errors[$key] = $message;
    }
}
