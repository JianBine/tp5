<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Order;
use app\index\model\OrderDetail;
use app\index\model\Product;
use app\index\model\Employee;
use think\Db;
class Salary extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        // 获取分页显示
        $whereArray = array();
        if(input('fromtime') && input('totime')){
            $fromtime = input('fromtime');
            $totime = input('totime');
            $fromtime = date('Y-m-d 00:00:00',strtotime($fromtime));
            $totime = date('Y-m-d 23:59:59',strtotime($totime));
            $whereArray['p.create_time'] = array('between',array($fromtime,$totime));
        }
        $list = Db::table('mibine_product p')
            ->where($whereArray)
            ->join('mibine_order o','p.order_id=o.id')
            ->join('mibine_employee e','p.employee_id=e.id')
            ->join('mibine_order_detail od','p.order_detail_id=od.id')
            ->group('p.employee_id,p.order_id')
            ->field('o.name as order_name,e.name as e_name,od.price*p.number as total_money,DATE_FORMAT(p.create_time,\'%Y-%m-%d\') as create_time')
            ->paginate(12);
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return $this->fetch('Salary/index');
    }

    public function export(){
        //导出的数据
        $whereArray = array();
        if(input('fromtime') && input('totime')){
            $fromtime = input('fromtime');
            $totime = input('totime');
            $fromtime = date('Y-m-d 00:00:00',strtotime($fromtime));
            $totime = date('Y-m-d 23:59:59',strtotime($totime));
            $whereArray['p.create_time'] = array('between',array($fromtime,$totime));
        }
        $list = Db::table('mibine_product p')
            ->where($whereArray)
            ->join('mibine_order o','p.order_id=o.id')
            ->join('mibine_employee e','p.employee_id=e.id')
            ->join('mibine_order_detail od','p.order_detail_id=od.id')
            ->group('p.employee_id,p.order_id')
            ->field('o.name as order_name,e.name as e_name,od.price*p.number as total_money,DATE_FORMAT(p.create_time,\'%Y-%m-%d\') as create_time')
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
        $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','报表');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //Setting title bar
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setSize(24);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);//设置行高度
        // $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFill()->getStartColor()->setARGB('FF808080');

        //所有单元格（列）默认宽度
        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
        //行高
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
        //添加th
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2','编号')
            ->setCellValue('B2','姓名')
            ->setCellValue('C2','金额')
            ->setCellValue('D2','日期');
        $objPHPExcel->getActiveSheet()->getStyle('A1:D2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A2:D2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        ///Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3','01')
            ->setCellValue('B3','mibine')
            ->setCellValue('C3','100.0')
            ->setCellValue('D3','2018-05-29');
        $objPHPExcel->getActiveSheet()->getStyle('A3:D3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //Rename bottom worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');

        //Setting border
        $styleThinBlackBorderOutline = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000')
                ),
            ),
        );//outline-allborders
        $objPHPExcel->getActiveSheet()->getStyle('A1:D4')->applyFromArray($styleThinBlackBorderOutline);

        //Save Excel 2017 file
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $path = '/home/text1.xlsx';
        $objWriter->save($path);
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
