<?php

namespace App\Models;

class User extends BaseModel
{
    public function register()
    {
        $sql = "INSERT INTO users (username, email, password_hash, first_name, last_name) VALUES (:username, :email, :password_hash, :first_name, :last_name)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'username' => $this->username,
            'email' => $this->email,
            'password_hash' => $this->password_hash,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            return true;
        }
        return false;
    }
}
