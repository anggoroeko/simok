<?php if(!defined('BASEPATH')) exit('No direct Script Allowed');

/**
 * 
 */
class Users extends CI_Controller {
	
	function __construct() {
		parent::__construct();
			//$this->load->model('m_users');
			$this->load->library('classlayout');
			
			if(empty($this->session->userdata('isLogin'))){
				echo "<script>window.location.href = '".base_url()."account'</script>";
			}
			
			if($this->session->userdata('isLogin')['status_user'] != 1 ){
				echo "<script> window.location.href = '".base_url()."dashboard' </script>";
				exit();
			}
	}

	public function index(){
		$data_title = "Data Users";
		$result = '';
		
		$data = array(
			'data' => $result
		);
		
		$template = array(
			'v_users/data_users' => $data,
		);

		$footer = '<script src="'.base_url().'assets/dist/js/datatable_data.js?'.rand().'"></script>';
		
		$this->classlayout->masterview($template, $data_title, $footer);	
	}
	
	public function add(){
		if($this->session->userdata['isLogin']['status_user'] == 1){
			$data_title = "Add Users";
			$data['data'] = ''; //$this->m_users->master_status();
			//print_r($result); exit;
			$template = array(
				'v_users/v_add' => $data
			);
			
			$this->classlayout->masterview($template, $data_title);
		} else {
			redirect('/dashboard');
		}
	}

	public function added($id=""){ //print_r($id); die;
		$post=$this->input->post(); 
		if($this->session->userdata['isLogin']['status_user'] == 1){
			$pass = base64_encode(hash('sha256', sha1($post['txPassword'])));
			
			if(empty($id)){
				//from add data
				$data=array(
					"table" => "users", 
					"first_name" => $post['txFirst_name'],
					"last_name" => $post['txLast_name'],
					"email" => $post['txEmail'],
					"password" => $pass,
					"status_user" => $post['permission'],
					"status" => "active"
				);
					
					
				//print_r(json_encode($data)); die;
				$post_data = $this->elasticsearch->add_post('_doc', json_encode($data));
				//print_r($post_data); die;
				if($post_data['_shards']['failed'] == 0){
					$this->session->set_flashdata('pesan',
										"<div class=\"col-md-12\" style=\"margin-top: 20px\">
											<div class=\"alert alert-success alert-dismissable\">
												<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
												<strong>Message!</strong> successfully add user data!!
											</div>
										</div>");
				} else {
					$this->session->set_flashdata('pesan',
										"<div class=\"col-md-12\" style=\"margin-top: 20px\">
											<div class=\"alert alert-danger alert-dismissable\">
												<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
												<strong>Message!</strong> failed to add user data, please try again later!!
											</div>
										</div>");
				}

				redirect("users");

			} else {

				//from edit data
				$data=array( 
					"doc" => [
						"table" => "datakb", 
						"number_of_kb" => $post['number_of_kb'],
						"project_name_kb" => $post['project_name_kb'],
						"spbbj" => $post['spbbj'],
						"number_of_rack" => $post['number_of_rack'],
						"contract_date" => $post['contract_date'],
						"start_date" => $post['start_date'],
						"end_date" => $post['end_date'],
						"other_duration" => $post['project_duration'],
						"project_value" => str_replace(".", "", $post['project_value']),
						"segment" => $post['segment'],
						"client_contract" => $post['client_contract'],
						"partner_name" => $post['partner_name'],
						"date" => date("Y-m-d H:i:s"),
						"status" => "active",
						"position_file" => $path."/".$file_name.".".$extension
					]
				);

				$post_data = $this->elasticsearch->update_post('_doc', $id, json_encode($data));
				//print_r($post_data); die;
				if($post_data['_shards']['failed'] == 0){
					//upload to server
					$upload_file = $this->uploads->upload_file($name,$path,$file_name);
					
					$this->session->set_flashdata('pesan',
										"<div class=\"col-md-12\" style=\"margin-top: 20px\">
											<div class=\"alert alert-success alert-dismissable\">
												<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
												<strong>Message!</strong> successfully edit KB data!!
											</div>
										</div>");
				} else {
					$this->session->set_flashdata('pesan',
										"<div class=\"col-md-12\" style=\"margin-top: 20px\">
											<div class=\"alert alert-danger alert-dismissable\">
												<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
												<strong>Message!</strong> failed to edit KB data, please try again later!!
											</div>
										</div>");
				}

				redirect("users");
			}
		} else {
			redirect('/dashboard');
		}
	}

	public function edit($id){
		$data_title = "Edit Users";
		$esquery_data = ["query" => [
								"match" => ["_id" => $id] 
							]
						];

		$data['data'] = $this->elasticsearch->advancedquery('_doc', json_encode($esquery_data));

		$template = array(
			'v_users/v_edit' => $data
		);
		
		$this->classlayout->masterview($template, $data_title);
	}

	public function edited($id=""){ //print_r($id); die;
		$post=$this->input->post(); 
		if($this->session->userdata['isLogin']['status_user'] == 1){
			$pass = base64_encode(hash('sha256', sha1($post['txPassword'])));
			
				if(!empty($post['txPassword'])){
					$data=array(
						"doc" => [
							"first_name" => $post['txFirst_name'],
							"last_name" => $post['txLast_name'],
							"email" => $post['txEmail'],
							"status_user" => $post['permission'],
							"password" => $pass
						]
					);
				} else {
					$data=array(
						"doc" => [
							"first_name" => $post['txFirst_name'],
							"last_name" => $post['txLast_name'],
							"email" => $post['txEmail'],
							"status_user" => $post['permission'],
						]
					);
				}	
				
				$post_data = $this->elasticsearch->update_post('_doc', $id, json_encode($data));
				//print_r($post_data); die;
				if($post_data['_shards']['failed'] == 0){
					$this->session->set_flashdata('pesan',
										"<div class=\"col-md-12\" style=\"margin-top: 20px\">
											<div class=\"alert alert-success alert-dismissable\">
												<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
												<strong>Message!</strong> successfully edit user data!!
											</div>
										</div>");
				} else {
					$this->session->set_flashdata('pesan',
										"<div class=\"col-md-12\" style=\"margin-top: 20px\">
											<div class=\"alert alert-danger alert-dismissable\">
												<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
												<strong>Message!</strong> failed to edit user data, please try again later!!
											</div>
										</div>");
				}

				redirect("users");
		} else {
			redirect('/dashboard');
		}
	}
	
	public function added_old(){
		$this->load->library('upload');
		
		$max_width = '10288';
		$max_height = '7068';
		$nm_file = "img_".time();
		$config['upload_path'] = './assets/dist/img/upload/';
		$config['allowed_types'] = "gif|jpg|png|jpeg|bmp";
		$config['max_size'] = '2048'; //max 2mb
		$config['max_width'] = $max_width; //max lebar
		$config['max_height'] = $max_height; //max tinggi
		$config['file_name'] = $nm_file;
		
		$this->upload->initialize($config);
		//print_r($_FILES); exit;
		if($_FILES['userimage']['error'] == 0){
			if($this->upload->do_upload('userimage')){
				$post = $this->input->post();
				$gbr=$this->upload->data(); // showing all data about image
				//print_r($gbr); exit;
				
				$data = array(
					'userMsSttsId' => $post['status'],
					'userName' => $post['username'],
					'userFullName' => $post['name'],
					'userImgName' => $gbr['raw_name'],
					'userImgType' => $gbr['file_ext'],
					'userPassword' => sha1($post['password'])
				);
				$result = ''; //$this->m_users->add($data);
				
				$this->session->set_flashdata('pesan', 
					"<div class=\"col-md-12\" style=\"margin-top: 20px\">
						<div class=\"alert alert-success alert-dismissable\">
							<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
							<strong>Message!</strong> Data User Berhasil Ditambah!!
						</div>
					</div>");
				//echo "<script> alert('Data User Berhasil Ditambah') </script>";
				//echo "<script> window.location.href = '".base_url()."users' </script>";
				redirect('users');
				
			}else{
				$cek_img=getimagesize($_FILES['userimage']['tmp_name']); //cek ukuran image
				if($cek_img[0] > $max_width){
					$display_error = "Ukuran lebar image melebihi maksimum, maksimum lebar image " .$max_width."px";
				}if($cek_img[1] > $max_height){
					$display_error = "Ukuran tinggi image melebihi maksimum, maksimum tinggi image " .$max_height."px";
				}if($cek_img[0] > $max_width && $cek_img[1] > $max_height){
					$display_error = "Ukuran lebar dan tinggi image melebihi maksimum, maksimum ukuran image " .$max_width."px X ". $max_height."px";
				}
				
				$this->session->set_flashdata("pesan", 
					"<div class=\"col-md-12\" style=\"margin-top: 20px\">
						<div class=\"alert alert-danger alert-dismissable\">
							<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
							<strong>Warning!</strong> Gagal upload image. ". $display_error."!!
						</div>
					</div>");  //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                redirect('/users/add'); //jika gagal maka akan ditampilkan form upload
			}
			
		}elseif($_FILES['userimage']['error']==1){
			
			$_FILES['userimage']['error_message'] = 'Ukuran terlalu besar, batas maksimum ukuran image yang diupload adalah 2MB';
			$this->session->set_flashdata('pesan', 
				"<div class=\"col-md-12\" style=\"margin-top: 20px\">
					<div class=\"alert alert-danger alert-dismissable\">
						<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
						<strong>Warning!</strong> Gagal upload image. ".$_FILES['userimage']['error_message']."!!
					</div>
				</div>");
			redirect('/users/add');
			
		}elseif($_FILES['userimage']['error']==4){
			
			$post = $this->input->post();
			$data = array(
				'userMsSttsId' => $post['status'],
				'username' => $post['username'],
				'userFullName' => $post['name'],
				'userPassword' => sha1($post['password'])
			);
			$result = ''; //$this->m_users->add($data);
			
			$this->session->set_flashdata('pesan', 
				"<div class=\"col-md-12\" style=\"margin-top: 20px\">
					<div class=\"alert alert-success alert-dismissable\">
						<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
						<strong>Message!</strong> Data User Berhasil Ditambah!!
					</div>
				</div>");
			//echo "<script> alert('Data User Berhasil Ditambah') </script>";
			//echo "<script> window.location.href = '".base_url()."users' </script>";
			redirect('users');
		}
	}
	
	public function deleted($idUser){
		//print_r($idUser); exit;
		$data = array(
			'userStatus' => 2
		);
		$result = ''; //$this->m_users->deleted($idUser, $data);
		echo "<script> alert('Data User Berhasil Dihapus') </script>";
		echo "<script> window.location.href = '".base_url()."users' </script>";
	}

	function getData(){
		$params = $columns = array();
		$params = $_REQUEST;
		//print_r($params); die;

		$table = "users";
		$field_1 = "first_name.keyword";
		$field_2 = "last_name.keyword";

		//elasticsearch column definition
		$columns = array(
			1 => 'first_name.keyword',
			2 => 'last_name.keyword',
			3 => 'email.keyword',
			4 => 'date.keyword',
		);

		$esquery = ["query" => [
						"bool" => [
							"must" => [
										[
											"match" => ["table.keyword" => $table]
										],
										[
											"match" => ["status.keyword" => "active"]
										]
							]
						]
			], 
			"sort" => [
				[
					$columns[$params['order'][0]['column']] => [
																"order" => $params['order'][0]['dir']
																]
				]
			],
			"from" => $params['start'],
			"size" => $params['length']
		];

		if(!empty($params['search']['value'])){
			$esquery = ["query" => [
							"bool" => [
								"must" => [
									[ "bool" => [
											"should" => [
												[ "wildcard" => [$field_1 => '*'.$params['search']['value'].'*'] ],
												[ "wildcard" => [$field_2 => '*'.$params['search']['value'].'*'] ]
											]
										] ],

									[ "match" => ["table.keyword" => $table] ],
									[ "match" => ["status.keyword" => "active"] ]
								]
							]
					],
					"sort" => [
						[
							$columns[$params['order'][0]['column']] => [
																		"order" => $params['order'][0]['dir']
																		]
						]
					],
					"from" => $params['start'],
					"size" => $params['length']
				];
		}
		//print_r(json_encode($esquery)); die;
		
		$queryRecords = $this->elasticsearch->advancedquery('_doc', json_encode($esquery));
		//return $queryRecords;

		$totalRecords = $queryRecords['hits']['total'];
	
		$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $queryRecords['hits']['hits']   // total data array
			//"data"            => $queryRecords  // total data array
			);
		//print_r(json_encode($esquery)); die;
		echo json_encode($json_data);  // send data as json format
	}
}