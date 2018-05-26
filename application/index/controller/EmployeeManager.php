<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Department;
use app\index\model\Employee;
class EmployeeManager extends Controller
{
    /**
     * 显示员工列表
     *
     */
    public function index()
    {
        //部门数据显示
        $Department = new Department();
        $departInfosObj = $Department->all();
        $departInfos = array();
        foreach ($departInfosObj as $departInfoObj){
            $departInfo = array();
            $departInfo['id'] = $departInfoObj->id;
            $departInfo['name'] = $departInfoObj->name;
            array_push($departInfos,$departInfo);
        }
        $this->assign('departInfos',$departInfos);
        return $this->fetch('Employee/list');
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
     * 添加新人员
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
            $name = $dataArray['username'];
            $sex = $dataArray['sex'];
            $departId = $dataArray['departId'];
            $Employee = new Employee();
            $Employee->name = $name;
            $Employee->sex = $sex;
            $Employee->department_id = $departId;
            $Employee->create_time = date('Y-m-d H:i:s',time());
            $Employee->update_time = date('Y-m-d H:i:s',time());
            $res = $Employee->save();
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
