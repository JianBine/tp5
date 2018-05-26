<?php

namespace app\index\controller;

use think\Controller;
class Index extends Controller
{
    /**
     * 管理页主页
     */
    public function index()
    {
//        $title = 'money';
//        $this->view->assign('title',$title);
        return $this->fetch('Index/home');
    }

}
