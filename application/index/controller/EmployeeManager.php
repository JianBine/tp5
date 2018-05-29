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
        //分页显示员工
        $list = Employee::paginate(6);
        // 获取分页显示
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
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
     * 显示员工详情.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $id = $id ? $id : -1;
        $info = array();
        if($id != -1){
            $result = Employee::get($id);
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
     * 更新员工资料
     *
     * @param  \think\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $dataJson = $request->post('data');
        $info = array();
        if(empty($id)){
            $info['message'] = '员工不存在';
            $info['status'] = 'failure';
            echo json_encode($info);
            exit();
        }
        if($dataJson){
            $dataArray = json_decode($dataJson,true);
            $name = $dataArray['username'];
            $sex = $dataArray['sex'];
            $departId = $dataArray['departId'];
            $id = intval($id);
            $Employee = Employee::get($id);
            $Employee->name = $name;
            $Employee->sex = $sex;
            $Employee->department_id = $departId;
            $Employee->update_time = date('Y-m-d H:i:s',time());
            $res = $Employee->save();
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
     * 删除员工
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        $id = $id ? $id : -1;
        $info = array();
        if($id != -1){
            $result = Employee::destroy($id);
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
