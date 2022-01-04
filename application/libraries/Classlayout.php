<?php if(!defined('BASEPATH')) exit('No Direct Script Access Allowed');

/**
 * 
 */
class Classlayout {

	public function masterview($content, $data_title, $data_footer='', $data_header=''){
		$CI =& get_instance();
		//$CI->load->model('m_data');
		$data['user'] = ''; //$CI->m_data->data_user($CI->session->userdata('isLogin')['userId']);
		if(!empty($CI->uri->segment(3))){
			//$data['count_image'] = count($CI->m_data->show_images($CI->uri->segment(3)));
		}
		//print_r($data['count_image']); exit;
		
		$data['content'] = '';
		$data['title'] = $data_title;
		$data['header'] = $data_header;
		$data['footer'] = $data_footer;
		
		if(is_array($content)){
			foreach ($content as $k_value => $n_value) {
				$data['content'] .= $CI->load->view($k_value, $n_value, true);
			}
		}
		
		$CI->load->view('master/master', $data);
	}
}

