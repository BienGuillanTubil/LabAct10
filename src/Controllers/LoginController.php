<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function showForm()
    {
        return $this->render('login-form', []);
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new User();
        if ($user->login($username, $password)) {
            // Set session variables and redirect to the home page
            $_SESSION['user'] = $username;
            header('Location: /');
        } else {
            return $this->render('login-form', ['error' => 'Invalid username or password']);
        }
    }
}
