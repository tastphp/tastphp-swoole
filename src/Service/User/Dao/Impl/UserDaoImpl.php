<?php

namespace TastPHP\Service\User\Dao\Impl;

use TastPHP\Service\Common\BaseDao;
use TastPHP\Service\User\Dao\UserDao;

class UserDaoImpl extends BaseDao implements UserDao
{
    private static $table = 'user';

    public function getUser($id, $fields = '*')
    {
        return $this->get($id, $fields, self::$table);
    }

    public function getAllUser()
    {
        return $this->getAll(self::$table);
    }

    public function createUser($user)
    {
        return $this->create(self::$table, $user);
    }

    public function updateUser($id, $user)
    {
        return $this->update(self::$table, $user, $id);
    }

    public function deleteUser($id)
    {
        return $this->delete(self::$table, $id);
    }

}