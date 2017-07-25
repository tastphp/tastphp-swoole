<?php

namespace TastPHP\Service\User\Dao;

interface UserDao
{
    public function getUser($id, $fields);

    public function getAllUser();

    public function createUser($user);

    public function updateUser($id, $user);

    public function deleteUser($id);

}