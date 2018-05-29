<?php

namespace app\index\model;

use think\Model;

class Employee extends Model
{
    public function department()
    {
        return $this->hasOne('Department',department_id,'id');
    }
}
