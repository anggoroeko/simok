<?php if(!defined('BASEPATH')) exit('no direct script access allowed');
	
class Datakl extends CI_Controller{
	function __construct(){
		parent:: __construct();
			$this->load->library(array('classlayout', 'form_validation', 'additional', 'uploads'));
			//$this->load->model('m_data');

			if(empty($this->session->userdata('isLogin'))){
				echo "<script> window.location.href = '".base_url()."account' </script>";
			}
	}
	
	function index(){
		$data_title="List KL";
		$data['menu'] = 'datakl';
		$data['submenu'] = 'list_kl';
		//$data['data']=$this->m_data->show_product();

		$template=array(
			'v_datakl/v_datakl_list'=>$data 
		);

		$footer = '<script src="'.base_url().'assets/dist/js/sweetalert.min.js"></script>';
		$footer .= '<script src="'.base_url().'assets/dist/js/datatable_data.js?'.rand().'"></script>';
		$footer .= '<script> var status_user = '.$this->session->userdata['isLogin']['status_user'].'</script>';

		$this->classlayout->masterview($template, $data_title, $footer);
	}
	
	function add(){
		//print_r($this->session->userdata('validation')['value_project_value']); die;
		if($this->session->userdata['isLogin']['status_user'] == 1){
			$data_title="Add KL";
			$data['menu'] = 'datakl';
			$data['submenu'] = 'add_kl';
			$data['validation_message'] = $this->session->userdata('validation')['validation_error'];
			$data['value_number_of_kb'] = $this->session->userdata('validation')['value_number_of_kb'];
			$data['value_number_of_kl'] = $this->session->userdata('validation')['value_number_of_kl'];
			$data['value_project_name'] = $this->session->userdata('validation')['value_project_name'];
			$data['value_cc_number'] = $this->session->userdata('validation')['value_cc_number'];
			$data['value_telkom_number'] = $this->session->userdata('validation')['value_telkom_number'];
			$data['value_number_of_rack'] = $this->session->userdata('validation')['value_number_of_rack'];
			$data['value_spk'] = $this->session->userdata('validation')['value_spk'];
			$data['value_contract_doc_status'] = $this->session->userdata('validation')['value_contract_doc_status'];
			$data['value_contract_date'] = $this->session->userdata('validation')['value_contract_date'];
			$data['value_start_date'] = $this->session->userdata('validation')['value_start_date'];
			$data['value_end_date'] = $this->session->userdata('validation')['value_end_date'];
			$data['value_project_duration'] = $this->session->userdata('validation')['value_project_duration'];
			$data['value_project_value'] = $this->session->userdata('validation')['value_project_value'];
			$data['value_segment'] = $this->session->userdata('validation')['value_segment'];
			$data['value_client_contract'] = $this->session->userdata('validation')['value_client_contract'];
			$data['value_partner_name'] = $this->session->userdata('validation')['value_partner_name'];
			//$data['master_category'] = $this->m_data->master_category();

			$esquery = 	'{
							"query" : {
								"match": {
									"table": "datakb"
								}
							},
							"from":"0",
      						"size":"10000"
						}';

			$data['datakb'] = $this->elasticsearch->advancedquery('_doc', $esquery);
			
			$template=array(
				'v_datakl/v_datakl_add'=>$data
			);

			$footer = '<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>';

			$footer .= '<script>
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

			$footer .= '<script>$(document).ready(function() {
									$(\'.number_of_kb_class\').select2();
								})
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
				/*array(
						'field' => 'number_of_kl',
						'label' => 'Number Of KL',
						'rules' => 'required'
					),*/
				array(
						'field' => 'project_name',
						'label' => 'Project Name',
						'rules' => 'required'
					),
				array(
						'field' => 'cc_number',
						'label' => 'CC Number',
						'rules' => 'required'
					),
				array(
						'field' => 'telkom_number',
						'label' => 'Telkom Number',
						'rules' => 'required'
					),
				array(
						'field' => 'number_of_rack',
						'label' => 'RAK Number',
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
				)
			);
		
			$this->form_validation->set_rules($config);
		
			if(empty($id)){
				//from add data
				if($this->form_validation->run() == FALSE){
					$data_session = array(
						'validation_error' => validation_errors(),
						'value_number_of_kb' => set_value('number_of_kb'),
						'value_number_of_kl' => set_value('number_of_kl'),
						'value_project_name' => set_value('project_name'),
						'value_cc_number' => set_value('cc_number'),
						'value_telkom_number' => set_value('telkom_number'),
						'value_number_of_rack' => set_value('number_of_rack'),
						'value_spk' => set_value('spk'),
						'value_contract_doc_status' => set_value('contract_doc_status'),
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
					
					redirect("/datakl/add");

				} else { //print_r($_FILES); die;

					if(!empty($_FILES['file_kl']['name'])){
						$position_file_rand = rand(10,100);
						$position_file = implode("/", str_split($position_file_rand));
						$name = "file_kl";
						$path = "uploads/datakl/".$position_file;
						$file_name = strtotime(date("d-m-Y")).rand(10,100);
						$extension = pathinfo($_FILES['file_kl']['name'], PATHINFO_EXTENSION);
						
						$data=array(
							"table" => "datakl", 
							"number_of_kb" => $post['number_of_kb'],
							"project_name_kb" => $post['project_name'],
							"client_contract_number" => $post['cc_number'],
							"contract_number" => $post['telkom_number'],
							"number_of_rack" => $post['number_of_rack'],
							"spk" => $post['spk'],
							"contract_doc_status" => $post['contract_doc_status'],
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
							"table" => "datakl", 
							"number_of_kb" => $post['number_of_kb'],
							"project_name_kb" => $post['project_name'],
							"client_contract_number" => $post['cc_number'],
							"contract_number" => $post['telkom_number'],
							"number_of_rack" => $post['number_of_rack'],
							"spk" => $post['spk'],
							"contract_doc_status" => $post['contract_doc_status'],
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
					//print_r($post_data); die;
					if($post_data['_shards']['failed'] == 0){
						//upload to server
						$upload_file = $this->uploads->upload_file($name,$path,$file_name);
						
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

					redirect("datakl");
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

					redirect("/datakl/edit/".$id);
				} else {

					if(!empty($_FILES['file_kl']['name'])){
						/*$dirname_ex = explode("/", $_GET['url']);
						$dirname = ".".URL_IMG_DATAKL.$dirname_ex[count($dirname_ex)-2]."/";
						$delete_directory = $this->additional->delete_directory($dirname);*/

						//$dirname_ex = explode("/", $_GET['url']);
						
						//$dirname = ".".URL_IMG_DATAKB.$dirname_ex[count($dirname_ex)-2]."/"; //print_r($dirname); die;
						//$delete_directory = $this->additional->delete_directory($dirname);
						
						//if($delete_directory == 1){
							// $position_file_rand = rand(10,100);
							// $position_file = implode("/", str_split($position_file_rand));
							// //$position_file = implode("/", str_split($position));
							// // if($_GET['nn'] == 1){
							// // 	$position_file = array_slice($dirname_ex, 3, -1);
							// // } else {
							// // 	$position_file = array_slice($dirname_ex, 3);
							// // }
							
							// $name = "file_kl";
							// $path_url = implode("/", $position_file); 
							// //print_r($path); die;
							// $path = "uploads/datakl/".$path_url;
							// $file_name = strtotime(date("d-m-Y")).rand(10,100);
							// $extension = pathinfo($_FILES['file_kl']['name'], PATHINFO_EXTENSION);

							$position_file_rand = rand(10,100);
							$position_file = implode("/", str_split($position_file_rand));
							$name = "file_kl";
							$path = "uploads/datakl/".$position_file;
							$file_name = strtotime(date("d-m-Y")).rand(10,100);
							$extension = pathinfo($_FILES['file_kl']['name'], PATHINFO_EXTENSION);
						/*} else {
							$path = "nn";
							$file_name = "nn";
							$extension = "nn";
						}*/
						
						$data=array( 
							"doc" => [
								"table" => "datakl", 
								"number_of_kb" => $post['number_of_kb'],
								"project_name_kb" => $post['project_name'],
								"client_contract_number" => $post['cc_number'],
								"contract_number" => $post['telkom_number'],
								"number_of_rack" => $post['number_of_rack'],
								"spk" => $post['spk'],
								"contract_doc_status" => $post['contract_doc_status'],
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
								"table" => "datakl", 
								"number_of_kb" => $post['number_of_kb'],
								"project_name_kb" => $post['project_name'],
								"client_contract_number" => $post['cc_number'],
								"contract_number" => $post['telkom_number'],
								"number_of_rack" => $post['number_of_rack'],
								"spk" => $post['spk'],
								"contract_doc_status" => $post['contract_doc_status'],
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
					// print_r($post_data); die;
					if($post_data['_shards']['failed'] == 0){
						//upload to server
						$max_size = 1024*10;
						$upload_file = $this->uploads->upload_file($name,$path,$file_name,$max_size);
						
						$this->session->set_flashdata('pesan',
											"<div class=\"col-md-12\" style=\"margin-top: 20px\">
												<div class=\"alert alert-success alert-dismissable\">
													<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
													<strong>Message!</strong> successfully edit KL data!!
												</div>
											</div>");
					} else {
						$this->session->set_flashdata('pesan',
											"<div class=\"col-md-12\" style=\"margin-top: 20px\">
												<div class=\"alert alert-danger alert-dismissable\">
													<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
													<strong>Message!</strong> failed to edit KL data, please try again later!!
												</div>
											</div>");
					}

					redirect("datakl");
				} 
			}
		} else {
			redirect('/dashboard');
		}
	}

	function preview($id){
		$data['menu'] = 'datakl';
		$data['submenu'] = 'datakl';

		$data['data'] = $this->getDataGlobal($id); //print_r($data['data']); die;
		$title = $this->additional->slugify($data['data']['hits']['hits'][0]['_source']['project_name_kb']);
		
		$template = array(
			'v_datakl/v_datakl_detail' => $data
		);
		
		$footer = '<script src="'.base_url().'assets/dist/js/datatable_data.js?'.rand().'"></script>';
		$footer .= '<script> var no_kb = \''.$data['data']['hits']['hits'][0]['_source']['number_of_kb'].'\' </script>';
		

		$this->classlayout->masterview($template, $title, $footer);
	}
	
	function edit($id){
		if($this->session->userdata['isLogin']['status_user'] == 1){
			$data_title="Edit";
			$data['menu'] = 'datakl';
			$data['submenu'] = 'edit_kl';
			$data['validation_message'] = $this->session->userdata('validation')['validation_error'];
			$data['value_number_of_kb'] = $this->session->userdata('validation')['value_number_of_kb'];
			$data['value_number_of_kl'] = $this->session->userdata('validation')['value_number_of_kl'];
			$data['value_project_name'] = $this->session->userdata('validation')['value_project_name'];
			$data['value_cc_number'] = $this->session->userdata('validation')['value_cc_number'];
			$data['value_telkom_number'] = $this->session->userdata('validation')['value_telkom_number'];
			$data['value_number_of_rack'] = $this->session->userdata('validation')['value_number_of_rack'];
			$data['value_spk'] = $this->session->userdata('validation')['value_spk'];
			$data['value_contract_doc_status'] = $this->session->userdata('validation')['value_contract_doc_status'];
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

			$esquery_datakb = 	'{
							"query" : {
								"match": {
									"table": "datakb"
								}
							},
							"from":"0",
							"size":"10000"
						}';

			$data['datakb'] = $this->elasticsearch->advancedquery('_doc', $esquery_datakb);

			$template=array(
				'v_datakl/v_datakl_edit'=>$data
			);

			$footer = '<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>';

			$footer .= '<script>
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

			$footer .= '<script>$(document).ready(function() {
						$(\'.number_of_kl_class\').select2();
								})
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
	
	/*function edited($id){
		$post=$this->input->post();
		$data=array(
			'productMsJnProdId'=>$post['classification'],
			//'productCategoryId'=>$post['productCategoryId'],
			'productName'=>$post['datakl'],
			'productPrice'=>str_replace('.', '', $post['price']),
			'productExcerpt'=>$post['excerpt'],
			'productDetail'=>$post['detail']
		);
		
		$result = ''; //$this->m_data->productEdited($id, $data);
		$this->session->set_flashdata('pesan', 
							"<div class=\"col-md-12\" style=\"margin-top: 20px\">
								<div class=\"alert alert-success alert-dismissable\">
									<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
									<strong>Message!</strong> Data Produk Berhasil Diubah!!
								</div>
							</div>");
		redirect("datakl");
	}*/
	
	// function deleted($id){
	// 	$data=array(
	// 		'doc' => [
	// 			'prodStatus' => 'not active'
	// 		]
	// 	);

	// 	$result=$this->elasticsearch->update_post('docs', $id, json_encode($data));
	// 	//print_r($result); die;
	// 	/*$this->session->set_flashdata('pesan', 
	// 						"<div class=\"col-md-12\" style=\"margin-top: 20px\">
	// 							<div class=\"alert alert-success alert-dismissable\">
	// 								<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
	// 								<strong>Message!</strong> Data Produk Berhasil Dihapus!!
	// 							</div>
	// 						</div>");
	// 	//redirect('product');*/
	// }
	
	/*function image($id){
		$data_title = "Image";
		$data['data'] = ''; //$this->m_data->show_images($id);
		
		foreach($data['data'] as $k_val => $v_val){
			if($v_val['arsipImgPos'] == 1){
				if($k_val > 0){
					//print_r($v_val);
					$data = array(
						'arsipImgStatus' => 0
					);
					//$this->m_data->updateArsipImg($v_val['arsipImgId'], $data);
					redirect('datakl/image/'.$id);
				}
			}
		}
		
		$template=array(
			'v_datakl/v_image/v_image_list'=>$data
		);
		
		$footer = "<script>
						function del_priority(iddatakl, idImage){
							$.ajax({
								url: '/datakl/del_priority/'+iddatakl,
								type: 'GET',
								dataType: 'TEXT',
								beforeSend: function (){
									$('#id-btn-'+idImage).hide();
									$('#id-spin-'+idImage).show();
								},
								success: function(data){
									priority(iddatakl, idImage);
								}, 
								error: function(data){
									console.log('error delete priority '+JSON.stringify(data))
								}
							})
						}
						
						function priority(iddatakl, idImage){
							$.ajax({
								url: '/datakl/priority/'+idImage,
								type: 'GET',
								dataType: 'TEXT',
								beforeSend: function (){
									$('#id-btn-'+idImage).hide();
									$('#id-spin-'+idImage).show();
								},
								success: function(data){
									window.location.href = '/datakl/image/'+iddatakl
								}, 
								error: function(data){
									console.log('error priority '+JSON.stringify(data))
								}
							})
						}
						
					</script>";
		
		$this->classlayout->masterview($template, $data_title, $footer);
	}
	
	function imgadd($id){
		$data_title = "Tambah Image";
		$data['data'] = ''; //$this->m_data->img_add($id);
		$template=array(
			'v_datakl/v_image/v_image_add'=>$data
		);
		
		$this->classlayout->masterview($template, $data_title);
	}
	
	function imgedit($id){
		$data_title = "Edit Image";
		$data['data'] = '';//$this->m_data->img_edit($id);
		
		
		$template = array(
			'v_datakl/v_image/v_image_edit' => $data
		);
		
		$this->classlayout->masterview($template, $data_title);
	}
	
	function imgedited($id, $id_datakl){
		$post = $this->input->post();
		$data = array(
			'arsipImgExcerpt' => $post['img_excerpt'],
			'arsipImgDetail' => $post['img_detail']
		);
		
		$result = ''; //$this->m_data->img_edited($id, $data);
		
			$this->session->set_flashdata('pesan', 
							"<div class=\"col-md-12\" style=\"margin-top: 20px\">
								<div class=\"alert alert-success alert-dismissable\">
									<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
									<strong>Message!</strong> Detail Image Berhasil Diperbaharui!!
								</div>
							</div>");
		redirect('datakl/image/'.$id_datakl);
	}
	
	function folder($id){
		if(!file_exists("assets/dist/img/".$id)){
			mkdir("assets/dist/img/".$id, 0755);
			$this->img_added($id);
		} else {
			$this->img_added($id);
		}
	}
	
	function img_added($id){
		/*Note : Jika upload img berulang dan nama image sama akan otomatis menambahkan angka di belakang sesuai upload yang berulang tsb.
		ex: upload ke-1 : 1.jpg, 2.jpg, 3.jpg. Upload ke-2 : 11.jpg, 21.jpg.
		$this->load->library('upload');
		$max_width = '10288';
		$max_height = '7068';
		$count=count($_FILES['dataklimage']['size']);
		
		//if($this->upload->do_upload('productimage')){
			//$this->upload->do_upload('productimage');
			foreach($_FILES as $k_val=>$n_val){
				for($s=0; $s<=$count-1; $s++){
					$_FILES['dataklimage']['name'] = $n_val['name'][$s];
					$_FILES['dataklimage']['type'] = $n_val['type'][$s];
					$_FILES['dataklimage']['tmp_name'] = $n_val['tmp_name'][$s];
					$_FILES['dataklimage']['error'] = $n_val['error'][$s];
					$_FILES['dataklimage']['size'] = $n_val['size'][$s];  
					$nm_file = $s+1;
					
					$config['upload_path'] = './assets/dist/img/'.$id;
					$config['allowed_types'] = "gif|jpg|png|jpeg|bmp";
					$config['max_size'] = '2048'; //max 2mb
					$config['max_width'] = $max_width; //max lebar
					$config['max_height'] = $max_height; //max tinggi
					$config['file_name'] = $nm_file;
					
					$this->upload->initialize($config);
					$this->upload->do_upload('dataklimage');
						$post = $this->input->post();
						$gbr=$this->upload->data(); // showing all data about image
						//print_r($gbr);
						//print_r($_FILES['productimage']); exit;
						$data = array(
							'arsipdataklId' => $id,
							'arsipImgPos' => $gbr['raw_name'],
							'arsipImgType' => $gbr['file_ext'],
							'arsipImgExcerpt' => $post['img_excerpt'],
							'arsipImgDetail' => $post['img_detail']
						);
						
					$result = ''; //$this->m_data->img_added($data);
				}
			}
		
		if($_FILES['dataklimage']['error'] == 0 && $this->upload->do_upload('dataklimage')){
			$this->session->set_flashdata('pesan', 
				"<div class=\"col-md-12\" style=\"margin-top: 20px\">
					<div class=\"alert alert-success alert-dismissable\">
						<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
						<strong>Message!</strong> Data Image KB Berhasil Diperbaharui!!
					</div>
				</div>");
			redirect('datakl/image/'.$id);
		} else {
			$this->session->set_flashdata('pesan', 
				"<div class=\"col-md-12\" style=\"margin-top: 20px\">
					<div class=\"alert alert-danger alert-dismissable\">
						<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
						<strong>Message!</strong> Terdapat ukuran Image yang melebihi batas Maksimum, batas Maksimum Image = 2MB. 
						Data Image KB Gagal Diperbaharui!!
					</div>
				</div>");
			redirect('datakl/imgadd/'.$id);
		}
	}
	
	function imgDeleted($id, $id_product, $id_priority){
		if($id_priority == 1){
			redirect('datakl/image/'.$id_datakl);
		}
		
		$data=array(
			'arsipImgStatus'=>2
		);
		$result = ''; //$this->m_data->imgDeleted($id, $data);
		$this->session->set_flashdata('pesan', 
							"<div class=\"col-md-12\" style=\"margin-top: 20px\">
								<div class=\"alert alert-success alert-dismissable\">
									<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
									<strong>Message!</strong> Image Berhasil Dihapus!!
								</div>
							</div>");
		redirect("datakl/image/".$id_datakl);
	}
	
	function masterMerk($id=''){
		$result = ''; //$this->m_data->master_merk($id);
		$data=array(
			'data'=>$result
		);
		print_r(json_encode($data));
	}
	
	function del_priority($id){
		//$this->m_data->del_priority($id);
	}
	
	function priority($id){
		//$this->m_data->priority($id);
	}*/

	function getData(){
		$params = $columns = array();
		$params = $_REQUEST;
		//print_r($params); die;

		$table = "datakl";
		$field_1 = "project_name_kb.raw";
		$field_2 = "contract_number.raw";
		$field_3 = "contract_date.raw";
		$field_4 = "start_date.raw";

		//elasticsearch column definition
		$columns = array(
			2 => 'contract_date',
			3 => 'start_date',
			4 => 'end_date',
			6 => 'project_value',
			7 => 'segment',
			8 => 'client_contract',
			9 => 'partner_name',
			11 => 'date.keyword'
		);

		$esquery = ["query" => [
						"bool" => [
							"must" => [
										[
											"match" => ["table" => $table]
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

									[ "match" => ["table" => $table] ],
									[ "match" => ["status" => "active"] ]
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

							[ "match" => ["table" => $table] ],
							[ "match" => ["status" => "active"] ]
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
	
										[ "match" => ["table" => $table] ],
										[ "match" => ["status" => "active"] ]
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
		//print_r(json_encode($esquery)); die;

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

	function getDataKbonKl(){
		$params = $columns = array();
		$params = $_REQUEST;
		$no_kb = $this->input->post('no_kb');
		//print_r($params); die;

		$table = "datakb";
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
						"query"	=>      "datakb ".$no_kb,
						"type"	=>       "cross_fields",
						"fields"	=>     [ 'table', 'number_of_kb' ],
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

									[ "match" => ["table" => $table] ],
									[ "match" => ["status" => "active"] ]
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
								"table" : "datakl"
							}
						}
					}';

		$datakl = $this->elasticsearch->advancedquery('_doc',$esquery);
		
		$data = array( 
				'title' => 'Laporan Data KL',
				'datakl' => $datakl['hits']['hits']
			 );
 
           $this->load->view('v_datakl/export_excel', $data);
	}

	function delete($id){
		$datakb = $this->elasticsearch->delete('_doc',$id);

		if($this->session->userdata['isLogin']['status_user'] == 1){
			if($datakb['_shards']['failed'] == 0){
				$this->session->set_flashdata('pesan',
					"<div class=\"col-md-12\" style=\"margin-top: 20px\">
						<div class=\"alert alert-success alert-dismissable\">
							<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
							<strong>Message!</strong> successfully deleted the data kl!!
						</div>
					</div>");
			} else {
				$this->session->set_flashdata('pesan',
					"<div class=\"col-md-12\" style=\"margin-top: 20px\">
						<div class=\"alert alert-success alert-dismissable\">
							<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
							<strong>Message!</strong> failed deleted the data kl!!
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

		redirect('/datakl');
	}
}
