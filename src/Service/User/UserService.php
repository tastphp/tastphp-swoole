<?php

namespace TastPHP\Service\User;

interface UserService
{
    public function getUser($id, $fields);

    public function getAllUser();

    public function addUser($user);

    public function removeUser($id);

    public function updateUser($id, $user);

}