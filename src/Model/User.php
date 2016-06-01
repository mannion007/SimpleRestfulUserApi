<?php

namespace UserApi\Model;

use UserApi\Model\Base\User as BaseUser;

class User extends BaseUser
{
    public function preInsert()
    {
        $this->setCreated(time());
        return true;
    }
    
    public function preUpdate()
    {
        $this->setUpdated(time());
        return true;
    }
}
