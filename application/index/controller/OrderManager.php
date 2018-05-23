<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Order;
class OrderManager extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = Order::all();
        $list = $list ? collection($list)->toArray() : '';
        foreach ($list as $order) {
        	echo $order->name.'</br>';
        }
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 
     * 增加新的订单和警报值
     *
     * @param  \think\Request  $request
     * @return \think\Response//
     */
    public function save(Request $request)
    {
    	$name = $request->request('name');
    	$max_num = $request->request('max_num');
        $order = new Order();
        $order->name = 'ST7890';
        $order->max_num = '1000';
        $order->create_time = date('Y-m-d H:i:s',time());
        $order->update_time = date('Y-m-d H:i:s',time());
        $order->save();
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示订单详情页
     * edit?id=2
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $order = Order::get(['id' => $id]);
        echo $order->name;
        echo $order->max_num;
        echo $order->id;
    }

    /**
     * 修改订单的名称和警报值
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->request('name');
    	$max_num = $request->request('max_num');
    	$update_time = date('Y-m-d H:i:s',time());
    	$order = new Order();
    	$order->where('id',$id)->update(['name' => $name,'max_num' => $max_num,'update_time' => $update_time]);
    }
//
    /**
     * 删除订单
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
       $res = Order::destroy(['id' => $id]);//成功条数
       if($res == 0){
       		echo '失败';
       }else{
       		echo '成功';
       }
    }
}
