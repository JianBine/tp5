<?php

namespace app\index\model;

use think\Model;

class OrderDetail extends Model
{
    public function Order()
    {
        //多对一
        return $this->belongsTo('Order','order_id','id');
    }
}
