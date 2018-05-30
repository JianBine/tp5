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
        $list = Order::paginate(6);
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
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
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
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
