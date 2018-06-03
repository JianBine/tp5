<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Order;
use app\index\model\OrderDetail;
use app\index\model\Product;
use app\index\model\Employee;
class ProductManager extends Controller
{
    /**
     * 显示产档页
     *
     * @return \think\Response
     */
    public function index()
    {
        //获取员工列表
        $employeeInfos = Employee::all();
        //获取订单列表
        $orderInfos = Order::all();
        //分页显示订单列表
        $list = Product::paginate(6);
        // 获取分页显示
        $page = $list->render();
        $this->assign('employeeInfos', $employeeInfos);
        $this->assign('orderInfos', $orderInfos);
        $this->assign('list', $list);
        $this->assign('page', $page);
        return $this->fetch('Product/index');
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
     * 保存产量信息
     *
     * @param  \think\Request  $request
     */
    public function save(Request $request)
    {
        $dataJson = $request->post('data');
        $info = array();
        if($dataJson){
            $dataArray = json_decode($dataJson,true);
            $employee_id = $dataArray['employee_id'];
            $order_id = $dataArray['order_id'];
            $order_detail_id = $dataArray['order_detail_id'];
            $number = $dataArray['number'];
            $Product = new Product();
            $Product->employee_id = $employee_id;
            $Product->order_id = $order_id;
            $Product->order_detail_id = $order_detail_id;
            $Product->number = $number;
            $res = $Product->save();
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
     * 显示产档详情.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $id = $id ? $id : -1;
        $info = array();
        if($id != -1){
            $result = Product::get($id);
            if($result){
                //获取员工列表
                $employeeInfos = Employee::all();
                //获取订单列表
                $orderInfos = Order::all();
                $orderDetailInfos = OrderDetail::where(array('order_id'=>$result->order_id))->select();
                $info['employeeInfos'] = $employeeInfos;
                $info['orderInfos'] = $orderInfos;
                $info['orderDetailInfos'] = $orderDetailInfos;
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
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
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
            $edit_employee_id = $dataArray['edit_employee_id'];
            $edit_order_id = $dataArray['edit_order_id'];
            $edit_order_detail_id = $dataArray['edit_order_detail_id'];
            $edit_number = $dataArray['edit_number'];
            $id = intval($id);
            $Product = Product::get($id);
            $Product->employee_id = $edit_employee_id;
            $Product->order_id = $edit_order_id;
            $Product->order_detail_id = $edit_order_detail_id;
            $Product->number = $edit_number;
            $res = $Product->save();
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
     * 删除指定资源
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        $id = $id ? $id : -1;
        $info = array();
        if($id != -1){
            $result = Product::destroy($id);
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

    /**
     * 获取对应订单对应的工序
     */
    public function getOrderDetail(){
        $id = input('id');
        $infos = OrderDetail::where(array('order_id'=>$id))->select();
        $info = array();
        $info['status'] = 'success';
        $info['data'] = $infos;
        echo json_encode($info);
    }
}
