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

        //分页显示订单列表
        $list = Order::paginate(6);
        // 获取分页显示
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return $this->fetch('Order/index');
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
     */
    public function save(Request $request)
    {

        $dataJson = $request->post('data');
        $info = array();
        if($dataJson){
            $dataArray = json_decode($dataJson,true);
            $ordername = $dataArray['ordername'];
            $max_num = $dataArray['max_num'];
            $order = new Order();
            $order->name = $ordername;
            $order->max_num = $max_num;
            $order->create_time = date('Y-m-d H:i:s',time());
            $order->update_time = date('Y-m-d H:i:s',time());
            $res = $order->save();
            if($res != 0){
                $info['message'] = '添加成功';
                $info['status'] = 'success';
            }else{
                $info['message'] = '添加失败';
                $info['status'] = 'failure';
            }
        }else{
            $info['message'] = '添加失败';
            $info['status'] = 'failure';
        }
        echo json_encode($info);
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
     * 显示订单详情
     * edit?id=2
     * @param  int  $id
     */
    public function edit($id)
    {
        $id = $id ? $id : -1;
        $info = array();
        if($id != -1){
            $result = Order::get($id);
            if($result){
                $info['message'] = '返回成功';
                $info['data'] = $result;
                $info['status'] = 'success';
            }else{
                $info['message'] = '返回失败';
                $info['status'] = 'failure';
            }
        }else{
            $info['message'] = '用户不存在';
            $info['status'] = 'failure';
        }
        echo json_encode($info);
    }

    /**
     * 修改订单的名称和警报值
     *
     * @param  \think\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $dataJson = $request->post('data');
        $info = array();
        if(empty($id)){
            $info['message'] = '订单不存在';
            $info['status'] = 'failure';
            echo json_encode($info);
            exit();
        }
        if($dataJson){
            $dataArray = json_decode($dataJson,true);
            $ordername = $dataArray['ordername'];
            $max_num = $dataArray['max_num'];
            $id = intval($id);
            $Order = Order::get($id);
            $Order->name = $ordername;
            $Order->max_num = $max_num;
            $Order->update_time = date('Y-m-d H:i:s',time());
            $res = $Order->save();
            if($res != 0){
                $info['message'] = '编辑成功';
                $info['status'] = 'success';
            }else{
                $info['message'] = '编辑失败';
                $info['status'] = 'failure';
            }
        }else{
            $info['message'] = '编辑失败';
            $info['status'] = 'failure';
        }
        echo json_encode($info);
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
        $id = $id ? $id : -1;
        $info = array();
        if($id != -1){
            $result = Order::destroy($id);
            if($result != 0){
                $info['message'] = '删除成功';
                $info['status'] = 'success';
            }else{
                $info['message'] = '删除失败';
                $info['status'] = 'failure';
            }
        }else{
            $info['message'] = '删除失败';
            $info['status'] = 'failure';
        }
        echo json_encode($info);
    }
}
