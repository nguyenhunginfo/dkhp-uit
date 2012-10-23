<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	
	 
	public function index()
	{
 	  //load our new PHPExcel library
        $this->load->library('PHPExcel');
        $this->load->library("form_validation");
         $this->load->model("mtest");
        $this->form_validation->set_rules("submit","Submit","requried");
        if($this->form_validation->run())
        {
             // require_once APPPATH."/third_party/PHPExcel.php"; 
            $objPHPExcel = new PHPExcel();
            
            // Set document properties option
            $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            							 ->setLastModifiedBy("Maarten Balliauw")
            							 ->setTitle("Office 2007 XLSX Test Document")
            							 ->setSubject("Office 2007 XLSX Test Document")
            							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            							 ->setKeywords("office 2007 openxml php")
            							 ->setCategory("Test result file");
            
            
            // Add some data
            $query=$this->mtest->_get();
            $fields=$query->list_fields();
            $ncol=0;
            $nrow=1;
            $sheet_dsmh=$objPHPExcel->setActiveSheetIndex(0);
            foreach($query->result_object() as $row)
            {
                $ncol=0;
                foreach($fields as $field)
                {
                    $sheet_dsmh->setCellValueByColumnAndRow($ncol,$nrow,$row->$field) ;                     
                $ncol++;
                }                
                $nrow++;
            }
           
            
           
            
            // Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('Danh Sach Mon Hoc');
            
            
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            
            
            
           header('Content-Type: application/vnd.ms-excel');
    		header('Content-Disposition: attachment;filename="0simple.xls"');
    		header('Cache-Control: max-age=0');
    
    		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    		$objWriter->save('php://output');   
        }
        else
        {
            echo "Danh sách môn học";
           
            $result=$this->mtest->_get();
            $data["result"]=$result;
		    $this->load->view('vtest',$data);
              
        }
       
       
	   /*
	   $this->load->model("mtest");
       $result=$this->mtest->_get();
       $data["result"]=$result;
		$this->load->view('vtest',$data);
        */
	}
}
?>
