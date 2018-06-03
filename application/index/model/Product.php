<?php

namespace app\index\model;

use think\Model;

class Product extends Model
{
    public function Employee()
    {
        //多对一
        return $this->belongsTo('Employee','employee_id','id');
    }
    public function Order()
    {
        //多对一
        return $this->belongsTo('Order','order_id','id');
    }
    public function OrderDetail()
    {
        //多对一
        return $this->belongsTo('OrderDetail','order_detail_id','id');
    }
}
