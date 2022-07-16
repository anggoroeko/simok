<?php if(!defined('BASEPATH')) exit('No direct Script Allowed');

/**
 * 
 */
class Dashboard extends CI_Controller {
	
	function __construct() {
		parent::__construct();
			$this->load->model('m_data');
			$this->load->library(array('classlayout', 'elasticsearch'));
	}

	public function index(){
		if(empty($this->session->userdata('isLogin'))){
			echo "<script>window.location.href = '".base_url()."account'</script>";
		}
		$data_title = "Dashboard";
		/*$table = "user";
		$field_param_1 = "fisrtName";
		$field_param_2 = "email"
		$result = $this->m_data->getDataGlobalOr($table, $field_param_1, $field_param_2, $param_1, $param_2);

		print_r($result); exit;*/

		$data['menu'] = 'dashboard';
		$template = array(
			'v_home/index' 		=> $data,
		);
		$this->classlayout->masterview($template, $data_title);	
	}
	
	public function Loginvalidate(){
		$email = $this->input->post('txUsername');
		$password = base64_encode(hash('sha256', sha1($this->input->post('txPassword'))));
		
		//echo $user.' '.$pass; exit;
		$dataUser = array(
				'email' 	=>	$email,
				'password'	=>	$password
			);
		
		$esquery = [
					"query" => [
						"bool" => [
							"must" => [[
							"match" => [
								"table" => "users"
							]],[
								"match" => [
								"email" => $email
							]],[
								"match" => [
								"password" => $password
							]]
								]
						]
					]
				];

		$value = $this->elasticsearch->advancedquery('_doc', json_encode($esquery));
		if(!empty($value['hits']['hits'])){
			$userPassword = $value['hits']['hits'][0]['_source']['userPassword'];
			foreach ($value['hits']['hits'] as $n_value) {
				$data_session = array(
					'userId' => $n_value['_id'],
					'firstName' => $n_value['_source']['first_name'],
					'lastName' => $n_value['_source']['last_name'],
					'status_user' => $n_value['_source']['status_user'],
					'userFullName' => $n_value['_source']['first_name'] .' '. $n_value['_source']['last_name']
				);
				$session = $this->session->set_userdata('isLogin', $data_session);

				redirect('dashboard');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Failed!</strong> Username and Password not match.
				</div>');
		}

		/*redirect('account');
		$data_session = array(
			'userId' => 1,
			'firstName' => "anggoro",
			'lastName' => "eko",
			'status_user' => 1, //0:admin; 1:super admin
			'userFullName' => "anggoro" .' '. "eko"
		);*/
		$session = $this->session->set_userdata('isLogin', $data_session);
		redirect('dashboard');

	}
	
	public function listed(){
		if(empty($this->session->userdata('isLogin'))){
			echo "<script>window.location.href='".base_url()."account'</script>";
		}
		
		$data_title = "List Detail";
		$asset = '' ; //$this->m_data->showAsset();
		$result['dataAsset'] = $asset;
		//print_r($result['dataAsset']); exit;
		$template = array(
			'v_asset/data_asset' => $result
		);
		
		$this->classlayout->masterview($template, $data_title);
	}

	public function LogOut(){
		$this->session->sess_destroy();
		redirect('dashboard', 'refresh');
	}
}
