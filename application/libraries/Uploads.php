<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Uploads {
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('image_lib');
	}

	public function upload_image($name="",$path="",$file_name="",$max_size="")
	{
		ini_set('post_max_size', '100M');
		ini_set('upload_max_filesize', '100M');

		empty($path) ? $path = "assets/uploads" : $path = $path;
		$max_size = empty($max_size) ? 1024*100 : $max_size;
		
		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}

		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = $max_size;
		if($file_name!=""){
			$config['file_name'] = $file_name;
		} else {
			$config['encrypt_name'] = TRUE;
		}

		$this->ci->load->library('upload', $config);

		if (!$this->ci->upload->do_upload($name))
		{
			$data = array('error' => $this->ci->upload->display_errors());
		}
		else
		{
			$data = $this->ci->upload->data();
		}

		return $data;
	}

	function resize_image($source="",$path="",$width="",$height="", $ratio = TRUE) {
		empty($path) ? $path = "assets/uploads" : $path = $path;
		empty($height) ? $height = "125" : $height = $height;
		empty($width) ? $width = "140" : $width = $width;

		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}

		$config['source_image'] = $source;
		$config['new_image'] = $path;
		$config['maintain_ratio'] = $ratio;
		$config['width'] = $width;
		$config['height'] = $height;

		$this->ci->image_lib->initialize($config);
		$res = $this->ci->image_lib->resize();
		$this->ci->image_lib->clear();

		if (!$res) {
			$data =  'thumb' . $this->ci->image_lib->display_errors();
		}else{
			$data = $res;
		}

		return $data;

	}


	public function upload_file($name="",$path="",$file_name="",$max_size=""){
		ini_set('post_max_size', '64M');
		ini_set('upload_max_filesize', '64M');
		
		empty($path) ? $path = "assets/uploads" : $path = $path;
		empty($max_size) ? $max_size = "2000" : $max_size = $max_size;
		
		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}

		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
		$config['max_size'] = $max_size;
		if($file_name!=""){
			$config['file_name'] = $file_name;
		} else {
			$config['encrypt_name'] = TRUE;
		}

		$this->ci->load->library('upload', $config);

		if (!$this->ci->upload->do_upload($name))
		{
			$data = array('error' => $this->ci->upload->display_errors());
		}
		else
		{
			$data = $this->ci->upload->data();
		}

		return $data;
	}

}
