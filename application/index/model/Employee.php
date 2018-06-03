<?php

namespace app\index\model;

use think\Model;

class Employee extends Model
{
    public function Department()
    {
        //多对一
        return $this->belongsTo('Department','department_id','id');
    }
}
