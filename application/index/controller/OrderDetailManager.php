<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Order;
use app\index\model\OrderDetail;

class OrderDetailManager extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //获取订单列表
        $orderInfos = Order::all();
        //分页显示订单列表
        $list = OrderDetail::paginate(6);
        // 获取分页显示
        $page = $list->render();
        $this->assign('orderInfos', $orderInfos);
        $this->assign('list', $list);
        $this->assign('page', $page);
        return $this->fetch('OrderDetail/index');
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
     * 保存订单工序
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $dataJson = $request->post('data');
        $info = array();
        if($dataJson){
            $dataArray = json_decode($dataJson,true);
            $order_id = $dataArray['order_id'];
            $order_num = $dataArray['order_num'];
            $order_name = $dataArray['order_name'];
            $price = $dataArray['price'];
            $OrderDetail = new OrderDetail();
            $OrderDetail->order_id = $order_id;
            $OrderDetail->order_num = $order_num;
            $OrderDetail->name = $order_name;
            $OrderDetail->price = $price;
            $res = $OrderDetail->save();
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
     * 显示工序编辑资页.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $id = $id ? $id : -1;
        $info = array();
        if($id != -1){
            $result = OrderDetail::get($id);
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
     * 更新工序详情
     *
     * @param  \think\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $dataJson = $request->post('data');
        $info = array();
        if(empty($id)){
            $info['message'] = '工序不存在';
            $info['status'] = 'failure';
            echo json_encode($info);
            exit();
        }
        if($dataJson){
            $dataArray = json_decode($dataJson,true);
            $edit_order_id = $dataArray['edit_order_id'];
            $edit_order_num = $dataArray['edit_order_num'];
            $edit_order_name = $dataArray['edit_order_name'];
            $edit_price = $dataArray['edit_price'];
            $id = intval($id);
            $OrderDetail = OrderDetail::get($id);
            $OrderDetail->order_id = $edit_order_id;
            $OrderDetail->order_num = $edit_order_num;
            $OrderDetail->name = $edit_order_name;
            $OrderDetail->price = $edit_price;
            $res = $OrderDetail->save();
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

    /**
     * 删除工序
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        $id = $id ? $id : -1;
        $info = array();
        if($id != -1){
            $result = OrderDetail::destroy($id);
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
