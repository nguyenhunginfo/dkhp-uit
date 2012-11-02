<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

	
	 
	 function index()
	{
		$this->load->helper("url");
		$this->load->view('vajax_upload');
	}

	public function ajax_upload()
	{		
      
      $config["upload_path"]="C:\\xampp\\htdocs\\dkhp\\application\\uploads";
      $config['allowed_types'] = 'gif|jpg|png|doc|txt';
      $config['max_size']  = 1024 * 8;
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload("file_upload"))
      {
         $status = 'error';
         $msg = $this->upload->display_errors('', '');
      }
      else
      {
         $status = "success";
         $msg = "File successfully uploaded";
      }
      echo json_encode(array('status' => $status, 'msg' => $msg));
     
  
	
    }
}
?>
