<?php if(!defined('BASEPATH')) exit('no direct script access allowed');
	
class Datakb extends CI_Controller{
	function __construct(){
		parent:: __construct();
			$this->load->library(array('classlayout', 'form_validation', 'additional', 'uploads'));
			//$this->load->model('m_data');

			if(empty($this->session->userdata('isLogin'))){
				echo "<script> window.location.href = '".base_url()."account' </script>";
			}
	}
	
	function index(){
		// phpInfo(); die;
		$data_title="List KB";
		$data['menu'] = 'datakb';
		$data['submenu'] = 'list_kb';
		//$data['data']=$this->m_data->show_product();

		$template=array(
			'v_datakb/v_datakb_list'=>$data
		);

		$footer = '<script src="'.base_url().'assets/dist/js/sweetalert.min.js"></script>';
		$footer .= '<script>var base_url = "'.base_url().'"</script>';
		$footer .= '<script src="'.base_url().'assets/dist/js/datatable_data.js?'.rand().'"></script>';
		$footer .= '<script> var status_user = '.$this->session->userdata['isLogin']['status_user'].'</script>';

		$this->classlayout->masterview($template, $data_title, $footer);
	}
	
	function add(){
		//print_r($this->session->userdata('validation')); die;
		if($this->session->userdata['isLogin']['status_user'] == 1){
			$data_title="Add KB";
			$data['menu'] = 'datakb';
			$data['submenu'] = 'add_kb';
			$data['validation_message'] = $this->session->userdata('validation')['validation_error'];
			$data['value_number_of_kb'] = $this->session->userdata('validation')['value_number_of_kb'];
			$data['value_project_name'] = $this->session->userdata('validation')['value_project_name'];
			$data['value_spbbj'] = $this->session->userdata('validation')['value_spbbj'];
			$data['value_number_of_rack'] = $this->session->userdata('validation')['value_number_of_rack'];
			$data['value_contract_date'] = $this->session->userdata('validation')['value_contract_date'];
			$data['value_start_date'] = $this->session->userdata('validation')['value_start_date'];
			$data['value_end_date'] = $this->session->userdata('validation')['value_end_date'];
			$data['value_project_duration'] = $this->session->userdata('validation')['value_project_duration'];
			$data['value_project_value'] = $this->session->userdata('validation')['value_project_value'];
			$data['value_segment'] = $this->session->userdata('validation')['value_segment'];
			$data['value_client_contract'] = $this->session->userdata('validation')['value_client_contract'];
			$data['value_partner_name'] = $this->session->userdata('validation')['value_partner_name'];

			//set auto number
			//checking auto number
			$esquery = ["query" => [
							"bool" => [
								"must" => [
											[
												"match" => ["table" => "datakb"]
											],
											[
												"match" => ["status" => "active"]
											]
								]
							]
						], 
						"sort" => [
							[
								"date" => [
											"order" => "desc"
											]
							]
						],
						"from" => 0,
						"size" => 1
					];
			$queryRecords = $this->elasticsearch->advancedquery('_doc', json_encode($esquery));
			
			$get_kb_numb = 0;
			$expl_kb_numb_now = 0;
			$year_data_kb = date("Y");
			$kb_numb_now = 0;
			//$year_data_kb = "2021";
			$year = date("Y");

			if(!empty($queryRecords['hits']['hits'][0]['_source']['number_of_kb'])){
				$get_kb_numb = $queryRecords['hits']['hits'][0]['_source']['number_of_kb'];
				$expl_kb_numb_1 = explode("/", $get_kb_numb); // separator "/"
				$expl_kb_numb_2 = explode(".", $expl_kb_numb_1[0]); // separator "."
				//$year_data_kb = isset($expl_kb_numb_1[3]) ? $expl_kb_numb_1[3] : " ";
				
				$get_date = $queryRecords['hits']['hits'][0]['_source']['date'];
				$year_data_kb = date("Y", strtotime($get_date)); 
			
				if($year != $year_data_kb){
					$kb_numb_now = $expl_kb_numb_now + 1;
				} else {
					if(empty($expl_kb_numb_2[2])){
						$expl_kb_numb_2 = explode("-", $expl_kb_numb_1[0]);
						$expl_kb_numb_now = $expl_kb_numb_2[1] + 1;
					} else {
						$expl_kb_numb_now = $expl_kb_numb_2[2];
					}
					$kb_numb_now = $expl_kb_numb_now + 1;
				}
			}

			$data['value_auto_numb'] = ".. ".$kb_numb_now."/.../.../".$year;

			$template=array(
				'v_datakb/v_datakb_add'=>$data
			);

			$footer = '<script>
						$(function () {
							$(\'#start_date\').datetimepicker({
								format : \'YYYY-MM-DD\'
							});
						});

						$(function () {
							$(\'#end_date\').datetimepicker({
								format : \'YYYY-MM-DD\'
							});
						});

						$(function () {
							$(\'#contract_date\').datetimepicker({
								format : \'YYYY-MM-DD\'
							});
						});
					</script>';
		
			$this->classlayout->masterview($template, $data_title, $footer, $header='');
		} else {
			redirect('/dashboard');
		}
	}
	
	function added($id=""){
		$post=$this->input->post(); 

		if($this->session->userdata['isLogin']['status_user'] == 1){
			$config = array(
				array(
						'field' => 'number_of_kb',
						'label' => 'Number Of KB',
						'rules' => 'required'
					),
				array(
						'field' => 'client_contract',
						'label' => 'Client Contract',
						'rules' => 'required'
					),
				array(
						'field' => 'start_date',
						'label' => 'Start Date',
						'rules' => 'required'
				),
				array(
						'field' => 'end_date',
						'label' => 'End Date',
						'rules' => 'required'
				),
				array(
						'field' => 'contract_date',
						'label' => 'Contract Date',
						'rules' => 'required'
				),
				array(
						'field' => 'segment',
						'label' => 'Segment',
						'rules' => 'required'
				),
				array(
						'field' => 'number_of_rack',
						'label' => 'Number Of Rack',
						'rules' => 'required'
				),
				array(
						'field' => 'project_value',
						'label' => 'Project Value',
						'rules' => 'required'
				),
				array(
						'field' => 'project_name_kb',
						'label' => 'Project Name',
						'rules' => 'required'
				)
			);
		
			$this->form_validation->set_rules($config);
		
			if(empty($id)){
				//from add data
				if($this->form_validation->run() == FALSE){
					$data_session = array(
						'validation_error' => validation_errors(),
						'value_number_of_kb' => set_value('number_of_kb'),
						'value_project_name' => set_value('project_name_kb'),
						'value_spbbj' => set_value('spbbj'),
						'value_number_of_rack' => set_value('number_of_rack'),
						'value_contract_date' => set_value('contract_date'),
						'value_start_date' => set_value('start_date'),
						'value_end_date' => set_value('end_date'),
						'value_project_duration' => set_value('project_duration'),
						'value_project_value' => set_value('project_value'),
						'value_segment' => set_value('segment'),
						'value_client_contract' => set_value('client_contract'),
						'value_partner_name' => set_value('partner_name')
					);
					$this->session->set_userdata('validation', $data_session);

					redirect("/datakb/add");

				} else {

					if(!empty($_FILES['file_kb']['name'])){
						$position_file_rand = rand(10,100);
						$position_file = implode("/", str_split($position_file_rand));
						$name = "file_kb";
						$path = "uploads/datakb/".$position_file;
						$file_name = strtotime(date("d-m-Y")).rand(10,100);
						$extension = pathinfo($_FILES['file_kb']['name'], PATHINFO_EXTENSION);
						
						$data=array(
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
						);
					} else {
						$data=array(
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
							"status" => "active"
						);
					}
					
					//print_r(json_encode($data)); die;
					$post_data = $this->elasticsearch->add_post('_doc', json_encode($data));
					// print_r($post_data); die;
					if($post_data['_shards']['failed'] == 0){
						//upload to server
						$upload_file = $this->uploads->upload_file($name, $path, $file_name);
						
						$this->session->set_flashdata('pesan',
											"<div class=\"col-md-12\" style=\"margin-top: 20px\">
												<div class=\"alert alert-success alert-dismissable\">
													<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
													<strong>Message!</strong> successfully add product data!!
												</div>
											</div>");
					} else {
						$this->session->set_flashdata('pesan',
											"<div class=\"col-md-12\" style=\"margin-top: 20px\">
												<div class=\"alert alert-danger alert-dismissable\">
													<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
													<strong>Message!</strong> failed to add product data, please try again later!!
												</div>
											</div>");
					}

					redirect("datakb");
				} 

			} else {
				
				//from edit data
				if($this->form_validation->run() == FALSE){

					$data_session = array(
						'validation_error' => validation_errors(),
						'value_number_of_kb' => set_value('number_of_kb'),
						'value_project_name' => set_value('project_name_kb'),
						'value_spbbj' => set_value('spbbj'),
						'value_number_of_rack' => set_value('number_of_rack'),
						'value_contract_date' => set_value('contract_date'),
						'value_start_date' => set_value('start_date'),
						'value_end_date' => set_value('end_date'),
						'value_project_duration' => set_value('project_duration'),
						'value_project_value' => set_value('project_value'),
						'value_segment' => set_value('segment'),
						'value_client_contract' => set_value('client_contract'),
						'value_partner_name' => set_value('partner_name')
					);
					$this->session->set_userdata('validation', $data_session);

					redirect("/datakb/edit/".$id);

				} else {
					
					if(!empty($_FILES['file_kb']['name'])){
						$position_file_rand = rand(10,100);
						$position_file = implode("/", str_split($position_file_rand));
						$name = "file_kb";
						$path = "uploads/datakb/".$position_file;
						$file_name = strtotime(date("d-m-Y")).rand(10,100);
						$extension = pathinfo($_FILES['file_kb']['name'], PATHINFO_EXTENSION);

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
					} else {
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
								"status" => "active"
							]
						);
					}
					

					$post_data = $this->elasticsearch->update_post('_doc', $id, json_encode($data));
					
					if($post_data['_shards']['failed'] == 0){
						//upload to server
						if(!empty($_FILES['file_kb']['name'])){
							$max_size = 1024*10;
							$upload_file = $this->uploads->upload_file($name,$path,$file_name,$max_size);
						}
						
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

					redirect("datakb");
				} 
			}
		} else {
			redirect('/dashboard');
		}
	}

	function preview($id){
		$data['menu'] = 'datakb';
		$data['submenu'] = 'datakb';

		$data['data'] = $this->getDataGlobal($id); //print_r($data['data']); die;
		$title = $this->additional->slugify($data['data']['hits']['hits'][0]['_source']['project_name_kb']);
	
		$template = array(
			'v_datakb/v_datakb_detail' => $data
		);
		
		$footer = '<script src="'.base_url().'assets/dist/js/datatable_data.js?'.rand().'"></script>';
		$footer .= '<script> var no_kb = \''.$data['data']['hits']['hits'][0]['_source']['number_of_kb'].'\' </script>';
		$footer .= '<script>var base_url = "'.base_url().'"</script>';
		

		$this->classlayout->masterview($template, $title, $footer);
	}
	
	function edit($id){
		if($this->session->userdata['isLogin']['status_user'] == 1){
			$data_title="Edit";
			$data['menu'] = 'datakb';
			$data['submenu'] = 'edit_kb';
			$data['validation_message'] = $this->session->userdata('validation')['validation_error'];
			$data['value_number_of_kb'] = $this->session->userdata('validation')['value_number_of_kb'];
			$data['value_project_name'] = $this->session->userdata('validation')['value_project_name'];
			$data['value_spbbj'] = $this->session->userdata('validation')['value_spbbj'];
			$data['value_number_of_rack'] = $this->session->userdata('validation')['value_number_of_rack'];
			$data['value_contract_date'] = $this->session->userdata('validation')['value_contract_date'];
			$data['value_start_date'] = $this->session->userdata('validation')['value_start_date'];
			$data['value_end_date'] = $this->session->userdata('validation')['value_end_date'];
			$data['value_project_duration'] = $this->session->userdata('validation')['value_project_duration'];
			$data['value_project_value'] = $this->session->userdata('validation')['value_project_value'];
			$data['value_segment'] = $this->session->userdata('validation')['value_segment'];
			$data['value_client_contract'] = $this->session->userdata('validation')['value_client_contract'];
			$data['value_partner_name'] = $this->session->userdata('validation')['value_partner_name'];
			//$data['master_category'] = $this->m_data->master_category();

			$esquery_data = ["query" => [
					"match" => ["_id" => $id] 
				]
			];

			$data['data'] = $this->elasticsearch->advancedquery('_doc', json_encode($esquery_data));

			$template=array(
				'v_datakb/v_datakb_edit'=>$data
			);

			$footer = '<script>
						$(function () {
							$(\'#start_date\').datetimepicker({
								format : \'YYYY-MM-DD\'
							});
						});

						$(function () {
							$(\'#end_date\').datetimepicker({
								format : \'YYYY-MM-DD\'
							});
						});

						$(function () {
							$(\'#contract_date\').datetimepicker({
								format : \'YYYY-MM-DD\'
							});
						});
					</script>';
			
			$this->classlayout->masterview($template, $data_title, $footer);
		} else {
			redirect('/dashboard');
		}
	}

	function download(){
		if(!empty($this->session->userdata('isLogin'))){
			$path = './'.$_GET['url']; // of course find the exact filename....
			$filenameEx = explode("/", $_GET['url']);
			$filename = end($filenameEx);
			
			/*$file_size = filesize($path);
			echo($file_size); die;

			/*if($file_size){
				$buffer = file_get_contents($filenameEx);
				header("Content-Transfer-Encoding: binary");
				header("Content-Disposition: attachment; filename=$filename");
				echo $buffer;
			} else {*/
				header("Content-Type: video/mp4");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Length: ".filesize($path));
				readfile($path);
			//}
		} else {
			$this->session->set_flashdata('message',
					'<div class=\'col-md-12 alertMsg\' style=\'position: fixed; z-index: 6; margin-top: 10%\'>
						<div class=\'alert alert-danger alert-dismissable\' style=\'text-align: center\'>
							<a style=\'text-decoration: none\' href=\'#\' class=\'close\' data-dismiss=\'alert\' aria-label=\'close\'>&times</a>
							<strong>Peringatan! </br></strong> Untuk mendownload anda harus masuk akun terlebih dahulu.
						</div>
					</div>');

			redirect('/account');
		}
	}
	
	/*function deleted($id){
		$data=array(
			'doc' => [
				'prodStatus' => 'not active'
			]
		);

		$result=$this->elasticsearch->update_post('docs', $id, json_encode($data));
		//print_r($result); die;
		/*$this->session->set_flashdata('pesan', 
							"<div class=\"col-md-12\" style=\"margin-top: 20px\">
								<div class=\"alert alert-success alert-dismissable\">
									<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
									<strong>Message!</strong> Data Produk Berhasil Dihapus!!
								</div>
							</div>");
		//redirect('product');
	}*/

	function getData(){
		$params = $columns = array();
		$params = $_REQUEST;
		//print_r($params); die;

		$table = "datakb";
		$field_1 = "project_name_kb.keyword";
		$field_2 = "number_of_kb.keyword";
		$field_3 = "contract_date.keyword";
		$field_4 = "start_date.keyword";

		//elasticsearch column definition
		$columns = array(
			2 => 'contract_date.keyword',
			3 => 'start_date.keyword',
			4 => 'end_date.keyword',
			6 => 'project_value.keyword',
			7 => 'segment.keyword',
			8 => 'client_contract.keyword',
			9 => 'partner_name.keyword',
			11 => 'date.keyword'
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

		if($this->input->post('filter_year')){
			$esquery = ["query" => [
						"bool" => [
							"must" => [
								[ "bool" => [
										"should" => [
											[ "wildcard" => [$field_3 => '*'.$this->input->post('filter_year').'*'] ],
											[ "wildcard" => [$field_4 => '*'.$this->input->post('filter_year').'*'] ]
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

			if(!empty($params['search']['value'])){
				$esquery = ["query" => [
								"bool" => [
									"must" => [
										[ "bool" => [
												"should" => [
													[ "wildcard" => [$field_1 => '*'.$params['search']['value'].'*'] ],
													[ "wildcard" => [$field_2 => '*'.$params['search']['value'].'*'] ],
													[ "match" => [$field_3 => '*'.$this->input->post('filter_year').'*'] ],
													[ "match" => [$field_4 => '*'.$this->input->post('filter_year').'*'] ]
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
		}

		$queryRecords = $this->elasticsearch->advancedquery('_doc', json_encode($esquery));
		// print_r($queryRecords); die;
    	//print_r(json_encode($esquery)); die;  
		$totalRecords = $queryRecords['hits']['total']['value'];
	
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

	function getDataKlonKb(){
		$params = $columns = array();
		$params = $_REQUEST;
		$no_kb = $this->input->post('no_kb');
		//print_r($params); die;

		$table = "datakl";
		$field_1 = "project_name_kb";
		$field_2 = "client_contract_number";

		//elasticsearch column definition
		$columns = array(
			2 => 'contract_date',
			3 => 'start_date',
			4 => 'end_date',
			6 => 'project_value',
			7 => 'segment',
			8 => 'client_contract',
			9 => 'partner_name',
			11 => 'date'
		);

		// $esquery = ["query" => [
		// 				"bool" => [
		// 					"must" => [
		// 								[
		// 									"match" => ["table" => $table]
		// 								],
		// 								[
		// 									"match" => ["number_of_kb" => $no_kb]
		// 								],
		// 								[
		// 									"match" => ["status" => "active"]
		// 								]
		// 					]
		// 				]
		// 	], 
		// 	"sort" => [
		// 		[
		// 			$columns[$params['order'][0]['column']] => [
		// 														"order" => $params['order'][0]['dir']
		// 														]
		// 		]
		// 	],
		// 	"from" => $params['start'],
		// 	"size" => $params['length']
		// ];

		$esquery = [
					"query"=> [
					"multi_match" => [
					"query"	=>      "datakl ".$no_kb,
					"type"	=>       "cross_fields",
					"fields"	=>     [ 'table.keyword', 'number_of_kb.keyword' ],
					"operator"	=>   "and"
						]
					]
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

	function getDataGlobal($id){
		$esquery = ["query" => [
						"match" => ["_id" => $id]
						]
					];

		$result = $this->elasticsearch->advancedquery('_doc', json_encode($esquery));
		return $result;
	}

	function export_excel(){
		$esquery = '{
						"query" : {
							"match" : {
								"table" : "datakb"
							}
						}, 
						"from" : "0",
  						"size" : "10000"
					}';

		$datakb = $this->elasticsearch->advancedquery('_doc',$esquery);

		$data = array( 
				'title' => 'Laporan Data KB',
				'datakb' => $datakb['hits']['hits']
			 );
 
           $this->load->view('v_datakb/export_excel', $data);
	}

	function delete($id){
		if($this->session->userdata['isLogin']['status_user'] == 1){
			$datakb = $this->elasticsearch->delete('_doc',$id);
			
			if($datakb['_shards']['failed'] == 0){
				$this->session->set_flashdata('pesan',
					"<div class=\"col-md-12\" style=\"margin-top: 20px\">
						<div class=\"alert alert-success alert-dismissable\">
							<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
							<strong>Message!</strong> successfully deleted the data kb!!
						</div>
					</div>");
			} else {
				$this->session->set_flashdata('pesan',
					"<div class=\"col-md-12\" style=\"margin-top: 20px\">
						<div class=\"alert alert-success alert-dismissable\">
							<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
							<strong>Message!</strong> failed deleted the data kb!!
						</div>
					</div>");
			}
		} else {
			$this->session->set_flashdata('pesan',
					"<div class=\"col-md-12\" style=\"margin-top: 20px\">
						<div class=\"alert alert-warning alert-dismissable\">
							<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
							<strong>Message!</strong> failed deleted the data kb (permission failed)!!
						</div>
					</div>");
		}

		redirect('/datakb');
	}
}
