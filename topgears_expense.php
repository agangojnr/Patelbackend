<?php
ob_start();
session_start();
include_once('../core/class.manageData.php');

$m_init = new ManageData;

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;






$spreadsheet = new Spreadsheet();
$rows=3;
 
                                           
 

                        $result = $m_init->selectDateBetween('lean_master_table','2020-01-01','2020-12-31', 'entry_date', 'purchasetype','2');
                                    
                                    
                                    
                            
                                    
                                    
                                                                           foreach($result as $row){
       $rows++;	                                
                                       // $otherName = $m_init->getValue('parents','othernames','phonenumber',$classrow['parentId']);					
// $supplier= $m_init->getValue('ac_clients','client_name','client_id',$row['supplier']);
 //$supplier_pin= $m_init->getValue('ac_clients','taxpin','client_id',$row['supplier']);
 //$project_name= $m_init->getValue('ac_projects','project_name','id',$row['project_id']);
  $category= $m_init->getValue('lean_expenses','expense_name','id',$row['client_supplier_id']);

 //$client_id= $m_init->getValue('ac_projects','client_code','id',$row['project_id']);
 //$branch= $m_init->getValue('ac_clients','client_name','client_id',$client_id);
 // $client_code= $m_init->getValue('ac_clients','client_code','client_id',$client_id);
 //$main= $m_init->getValueTwo('ac_clients','client_name','client_code',$client_code,'client_type','0');

      // $sub_category= $m_init->getValue('ac_products_category','name','id',$row['sub_category']);
               
             //  if($sub_category==""){
       //   $sub_category="N/A";
        // }
       


                                          
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A'.$rows, $row['entry_date']);
$sheet->setCellValue('B'.$rows,$category);
$sheet->setCellValue('C'.$rows, $row['sale_purchase_description']);
$sheet->setCellValue('D'.$rows, $row['amount']);
//$sheet->setCellValue('E'.$rows,  $row['subTotal']);
//$sheet->setCellValue('F'.$rows, $row['invoice_amount']);
//$sheet->setCellValue('G'.$rows, $row['invoice_date']);
//$sheet->setCellValue('H'.$rows, $row['invoice_enddate']);
//$sheet->setCellValue('I'.$rows, $row['amount']);
//$sheet->setCellValue('J'.$rows, $row['date_incurred']);





	}
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
//$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
//$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
//$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
//$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
//$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
//$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);


//headinggs
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A2', ' 2020 JAN-DEC : TOPGEARS EXPENSE  ');
$sheet->setCellValue('A3', 'DATE ');
$sheet->setCellValue('B3', 'CATEGORY ');
$sheet->setCellValue('C3', 'DESCRIPTION');
$sheet->setCellValue('D3', 'AMOUNT');
//$sheet->setCellValue('E3', 'AMOUNT EXCL');
//$sheet->setCellValue('F3', 'AMOUNT INCL');
//$sheet->setCellValue('G3', 'INVOICE DATE');
//$sheet->setCellValue('H3', 'DUE DATE');
//$sheet->setCellValue('I3', 'INVOICE DATE ');
//$sheet->setCellValue('J3', 'DUE DATE ');
//$sheet->setCellValue('H3', 'CREDIT');


$spreadsheet->getActiveSheet()->mergeCells('A2:K2');
$spreadsheet->getActiveSheet()->getstyle('A2')->applyFromArray(
array(
'font'=>array(
'size'=>24,
)
)
);
$spreadsheet->getActiveSheet()->getstyle('A2:K2')->applyFromArray(
array(
'font'=>array(
'bold'=>TRUE,
),
'borders'=>array(
'outline'=>array(
'style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
)
)
)
);

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
$writer = new Xlsx($spreadsheet);
ob_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="topgearsexpenses.xlsx"');
    $writer->save("php://output");
exit;

//$writer->save('hello world.xlsx');
?>