<?php if(!defined('BASEPATH')) exit('No Direct Script Access Allowed');
	
class Setting extends CI_Controller{
	function __construct(){
		parent:: __construct();
			$this->load->library('classlayout');
			$this->load->model('m_data');
	}
	
	function index(){
		$data_title='Pengaturan';
		$data['data'] = $this->m_data->setting();
		
		$template=array(
			'v_setting/v_setting_site'=>$data
		);
		$data_footer = '<script src="'.base_url().'plugin/ckeditor/ckeditor.js"></script>';
		$data_footer .= 
			'<script>
				$(function () {
					// Replace the <textarea id="editor1"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace("editor1");
					CKEDITOR.replace("editor2");
					CKEDITOR.replace("editor3");
					//bootstrap WYSIHTML5 - text editor
					$(".textarea").wysihtml5();
				  }); 
			</script>';
		
		$this->classlayout->masterview($template, $data_title, $data_footer);
	}
	
	function update($view=''){
		$post = $this->input->post();
		
		if($view == 'v_title'){
			$data = array(
				'settTitle' => $post['title'],
				'settSlogan' => $post['slogan']
			);
		}
		
		if($view == 'v_general_content'){
			$data = array(
				'settAddress' => $post['nm-ft-about'],
				'settEmail' => $post['contact_email'],
				'settFacebook' => $post['contact_fb'],
				'settTwitter' => $post['contact_twit'],
				'settInstagram' => $post['contact_ig'],
				'settPhone' => $post['contact_phone'],
				'settFax' => $post['contact_fax']
			);
		}
		
		if($view == 'v_about'){
			$data = array(
				'settAbout' => $post['nm-ttg']	
			);
		}
		
		if($view == 'v_logo'){
			
		}
		
		$this->m_data->update_setting($data);
		
		$this->session->set_flashdata('pesan',
							"<div class=\"col-md-12\" style=\"margin-top: 20px\">
								<div class=\"alert alert-success alert-dismissable\">
									<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
									<strong>Message!</strong> Perubahan Sukses!!
								</div>
							</div>");
		
		redirect('setting');
	}
}