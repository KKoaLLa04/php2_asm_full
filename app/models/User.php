<?php

namespace App\Models;

class User extends BaseModel
{
    public function getAllUser()
    {
        $sql = "SELECT * FROM users";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function addUser($fullname, $phone, $email, $password, $status)
    {
        $sql = "INSERT INTO `users`(`fullname`, `phone`, `email`, `password`, `status`) VALUES ('$fullname','$phone','$email','$password','$status')";
        $this->setQuery($sql);
        $this->execute();
    }

    public function checkEmail($email)
    {
        $sql = "SELECT * FROM users WHERE `email`='$email'";
        $this->setQuery($sql);
        return $this->loadRow();
    }

    public function checkEmailUpdate($email, $id)
    {
        $sql = "SELECT * FROM users WHERE `email`='$email' AND id<>$id";
        $this->setQuery($sql);
        return $this->loadRow();
    }

    public function getUserDetail($id)
    {
        $sql = "SELECT * FROM users WHERE id=$id";
        $this->setQuery($sql);
        return $this->loadRow();
    }

    public function updateUser($id, $fullname, $phone, $email, $status, $password = '')
    {
        if (!empty($password)) {
            $sql = "UPDATE `users` SET `fullname`='$fullname',`phone`='$phone',`email`='$email',`password`='$password',`status`='$status' WHERE `id`=$id";
        } else {
            $sql = "UPDATE `users` SET `fullname`='$fullname',`phone`='$phone',`email`='$email',`status`='$status' WHERE `id`=$id";
        }

        $this->setQuery($sql);
        $this->execute();
    }
}