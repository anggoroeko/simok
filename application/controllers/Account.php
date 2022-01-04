<?php if(!defined('BASEPATH')) exit('No direct Script Access Allowed');

/**
 * 
 */
class Account extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}

	public function index(){
		$this->load->view('doAuth/login');
	}
}
