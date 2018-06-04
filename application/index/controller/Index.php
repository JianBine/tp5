<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\User;
use think\Session;

class Index extends Controller
{
    /**
     * 管理页主页
     */
    public function index()
    {
        return $this->fetch('Index/login');
    }
    /**
     * 管理页主页
     */
    public function home()
    {
        return $this->fetch('Index/home');
    }
    /**
     * 登陆
     *
     */
    public function login()
    {
        $username = input('username');
        $password = input('password');
        $whereArray = array();
        $whereArray['username'] = $username;
        $whereArray['password'] = md5($password);
        $user = User::where($whereArray)->find();
        $info = array();
        if(count($user) == 0){
            $info['message'] = '密码错误，或用户不存在！';
            $info['status'] = 'failure';
            echo json_encode($info);
            exit();
        }
        Session::set('user',$user);
        $info['message'] = '添加成功';
        $info['status'] = 'success';
        echo json_encode($info);
    }

    /**
     * 退出
     */
    public function logout(){
        Session::delete('user');
        return $this->fetch('Index/login');
    }

}
