<?php

namespace TastPHP\Service\User\Impl;

use TastPHP\Service\Common\BaseService;
use TastPHP\Service\User\UserService;

class UserServiceImpl extends BaseService implements UserService
{
    public function getUser($id, $fields = "*")
    {
        return $this->getUserDao()->getUser($id, $fields);
    }

    public function addUser($user)
    {
        return $this->getUserDao()->createUser($user);
    }

    public function removeUser($id)
    {
        return $this->getUserDao()->deleteUser($id);
    }

    public function updateUser($id, $user)
    {
        return $this->getUserDao()->updateUser($id, $user);
    }

    public function getAllUser()
    {
        return $this->getUserDao()->getAllUser();
    }

    private function getUserDao()
    {
        return $this->registerDao('User.UserDao');
    }
}