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
        $whereArray = array();
        if(input('fromtime') && input('totime')){
            $fromtime = input('fromtime');
            $totime = input('totime');
            $fromtime = date('Y-m-d 00:00:00',strtotime($fromtime));
            $totime = date('Y-m-d 23:59:59',strtotime($totime));
            $whereArray['create_time'] = array('between',array($fromtime,$totime));
        }
        $list = Product::where($whereArray)
            ->with(['Employee','Order','OrderDetail'])
            ->order('create_time desc')
            ->paginate(6);
        // 获取分页显示
        $page = $list->render();
        $this->assign('employeeInfos', $employeeInfos);
        $this->assign('orderInfos', $orderInfos);
        $this->assign('list', $list);
        $this->assign('page', $page);
        return $this->fetch('Product/index');
    }
    /**
     * 详情订单工序详情导出
     */
    public function export(){
        //导出的数据
        $whereArray = array();
        if(input('fromtime') && input('totime')){
            $fromtime = input('fromtime');
            $totime = input('totime');
            $fromtime = date('Y-m-d 00:00:00',strtotime($fromtime));
            $totime = date('Y-m-d 23:59:59',strtotime($totime));
            $whereArray['create_time'] = array('between',array($fromtime,$totime));
        }
        $list = Product::where($whereArray)
            ->with(['Employee','Order','OrderDetail'])
            ->order('employee_id asc,create_time desc')
            ->select();
        //导出excel
        $objPHPExcel = new \PHPExcel();
        //Set document properties
        $objPHPExcel->getProperties()->setCreator('mibine')
            ->setLastModifiedBy('mibine')
            ->setTitle('This is a Excel file')
            ->setSubject('xxx')
            ->setDescription('a describe')
            ->setKeywords('mibine`s datas')
            ->setCategory('Test result file');
        //Merge cells
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','订单详细报表');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //Setting title bar
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setSize(24);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);//设置行高度
        //所有单元格（列）默认宽度
        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(11);
        //行高
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
        //员工	订单名	工序号	工序名称	单价	数量	创建时间	操作
        //添加th
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2','姓名')
            ->setCellValue('B2','订单名')
            ->setCellValue('C2','工序号')
            ->setCellValue('D2','工序名称')
            ->setCellValue('E2','单价')
            ->setCellValue('F2','数量')
            ->setCellValue('G2','时间');
        $objPHPExcel->getActiveSheet()->getStyle('A1:G2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //Setting border
        $styleThinBlackBorderOutline = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000')
                ),
            ),
        );//outline-allborders
        $objPHPExcel->getActiveSheet()->getStyle('A1:G2')->applyFromArray($styleThinBlackBorderOutline);
        foreach ($list as $key => $value){
            $index = $key + 3;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$index,$value['employee']['name'])
                ->setCellValue('B'.$index,$value['order']['name'])
                ->setCellValue('C'.$index,$value['order_detail']['order_num'])
                ->setCellValue('D'.$index,$value['order_detail']['name'])
                ->setCellValue('E'.$index,$value['order_detail']['price'])
                ->setCellValue('F'.$index,$value['number'])
                ->setCellValue('G'.$index,date('Y-m-d',strtotime($value['create_time'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$index.':G'.$index)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $objPHPExcel->getActiveSheet()->getStyle('A'.$index.':G'.$index)->applyFromArray($styleThinBlackBorderOutline);
        }
        //Rename bottom worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Salary');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $path = config('excel_path').'order_detail.xlsx';
        $objWriter->save($path);
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="'.basename($path) .'"');
        header("Content-Length: ".filesize($path));
        readfile($path);
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
            $number = intval($dataArray['number']);
            //判断是否超过报警数(该订单下，该道工序)
            $max_num = Order::get($order_id)->max_num;
            $count = Product::where(array('order_id' => $order_id ,'order_detail_id' => $order_detail_id))->sum('number');
            if($count + $number > $max_num){
                $info['value'] = $count + $number - $max_num;//超过多少
                $info['message'] = '添加失败';
                $info['status'] = 'failure';
                echo json_encode($info);
                exit();
            }
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
            //判断是否超过报警数(该订单下，该道工序)
            $max_num = Order::get($edit_order_id)->max_num;
            $count = Product::where(array('id' => array('neq',$id),'order_id' => $edit_order_id ,'order_detail_id' => $edit_order_detail_id))->sum('number');
            if($count + $edit_number > $max_num){
                $info['value'] = $count + $edit_number - $max_num;//超过多少
                $info['message'] = '编辑失败';
                $info['status'] = 'failure';
                echo json_encode($info);
                exit();
            }
            $Product = Product::get($id);
            $Product->employee_id = $edit_employee_id;
            $Product->order_id = $edit_order_id;
            $Product->order_detail_id = $edit_order_detail_id;
            $Product->number = $edit_number;
            $res = $Product->save();
            $info['message'] = '编辑成功';
            $info['status'] = 'success';
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
