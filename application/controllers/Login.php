<?php if(!defined('BASEPATH')) exit('No direct Script Access Allowed');

/**
 * 
 */
class Login extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		//$this->load->model(array('m_login'));
	}

	public function add_user(){
		$this->elasticsearch->add_post('');
	}
}
