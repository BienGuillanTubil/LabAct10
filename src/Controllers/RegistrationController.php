<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\BaseController;

class RegistrationController extends BaseController
{
    public function showForm()
    {
        return $this->render('registration-form', []);
    }

    public function register()
    {
        // Collect user input
        $payload = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'password' => $_POST['password'],
            'password_confirmation' => $_POST['password_confirmation'],
        ];

        // Validate the input
        $validationErrors = $this->validate($payload);
        if (!empty($validationErrors)) {
            return $this->render('registration-form', ['errors' => $validationErrors]);
        }

        // Hash the password
        $payload['password_hash'] = password_hash($payload['password'], PASSWORD_DEFAULT);

        // Save to database
        $user = new User();
        $user->fill($payload);
        $user->register();

        return $this->render('registration-success', []);
    }

    private function validate($data)
    {
        $errors = [];

        // Add validation rules
        if (empty($data['username'])) {
            $errors['username'] = 'Username is required';
        }
        // Other validation rules...

        return $errors;
    }
}
