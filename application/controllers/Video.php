<?php if(!defined('BASEPATH')) exit('no direct script access allowed');
	
class Video extends CI_Controller{
	function __construct(){
		parent:: __construct();
			$this->load->library('classlayout');
			$this->load->model('m_data');
	}
	
	function index(){
		$data_title="List Video";
		$data['data']=$this->m_data->show_video();
		$data['menu'] = 'video';
		$data['submenu'] = 'list_video';
		$template=array(
			'v_video/v_video_list'=>$data
		);
		
		$this->classlayout->masterview($template, $data_title);
	}
	
	function add(){
		$data_title="Tambah Video";
		$data['menu'] = 'video';
		$data['submenu'] = 'add_video';
		$template=array(
			'v_video/v_video_add'=>$data
		);
		$data_footer = '<script src="'.base_url().'plugin/ckeditor/ckeditor.js"></script>';
		$data_footer .= 
			'<script>
				$(function () {
					// Replace the <textarea id="editor1"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace("editor1");
					//bootstrap WYSIHTML5 - text editor
					$(".textarea").wysihtml5();
				  }); 
			</script>';
		
		$this->classlayout->masterview($template, $data_title, $data_footer);
	}
	
	function added(){
		$post=$this->input->post();
		$data=array(
			'videTitle'=>$post['title'],
			'videExcerpt'=>$post['about'],
			'videDetail'=>$post['editor1'],
			'videStreamUrl'=>$post['url']
		);
		
		$added = $this->m_data->videAdded($data);
		$this->session->set_flashdata('pesan',
							"<div class=\"col-md-12\" style=\"margin-top: 20px\">
								<div class=\"alert alert-success alert-dismissable\">
									<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
									<strong>Message!</strong> Data Video Berhasil Ditambah!!
								</div>
							</div>");
		redirect('video');
	}
	
	function edit($id){
		$data_title="Edit";
		$data['data']=$this->m_data->videEdit($id);
		
		$template=array(
			'v_video/v_video_edit'=>$data
		);
		
		$data_footer = '<script src="'.base_url().'plugin/ckeditor/ckeditor.js"></script>';
		$data_footer .= 
			'<script>
				$(function () {
					// Replace the <textarea id="editor1"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace("editor1");
					//bootstrap WYSIHTML5 - text editor
					$(".textarea").wysihtml5();
				  }); 
			</script>';
		
		$this->classlayout->masterview($template, $data_title, $data_footer);
	}
	
	function edited($id){
		$post=$this->input->post();
		$data=array(
			'videTitle'=>$post['title'],
			'videExcerpt'=>$post['about'],
			'videStreamUrl'=>$post['url'],
			'videDetail'=>$post['editor1']
		);
		
		$result=$this->m_data->videEdited($id, $data);
		$this->session->set_flashdata('pesan',
							"<div class=\"col-md-12\" style=\"margin-top: 20px\">
								<div class=\"alert alert-success alert-dismissable\">
									<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
									<strong>Message!</strong> Data Video Berhasil Diubah!!
								</div>
							</div>");
		redirect('video');
	}
	
	function delete($id){
		$data=array(
			'videStatus'=>2
		);
		
		$result=$this->m_data->videDel($id, $data);
		$this->session->set_flashdata('pesan',
							"<div class=\"col-md-12\" style=\"margin-top: 20px\">
								<div class=\"alert alert-success alert-dismissable\">
									<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
									<strong>Message!</strong> Data Video Berhasil Dihapus!!
								</div>
							</div>");
		redirect('video');
	}
}