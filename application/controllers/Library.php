<?php if(!defined('BASEPATH')) exit('no direct script access allowed');
	
class Library extends CI_Controller{
	function __construct(){
		parent:: __construct();
			$this->load->library(array('classlayout', 'form_validation', 'additional'));
			//$this->load->model('m_data');

			if(empty($this->session->userdata('isLogin'))){
				echo "<script> window.location.href = '".base_url()."account' </script>";
			}
	}
	
	function index(){
		$data_title="List Library";
		$data['menu'] = 'library';
		$data['submenu'] = 'list_library';
		//$data['data']=$this->m_data->show_product();

		$template=array( 
			'v_library/v_library_list'=>$data
		);

		$footer = '<script src="'.base_url().'assets/dist/js/sweetalert.min.js"></script>';
		$footer .= '<script src="'.base_url().'assets/dist/js/datatable_data.js"></script>';

		$this->classlayout->masterview($template, $data_title, $footer);
	}
	
	function add(){
		//print_r($this->session->userdata('validation')); die;
		$data_title="Add Library";
		$data['menu'] = 'library';
		$data['submenu'] = 'add_library';
		
		
		$template=array(
			'v_product/v_product_add'=>$data
		);

		//$data_header = '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/select2.min.css">';

		$data_footer = '<script src="'.base_url().'plugin/ckeditor/ckeditor.js"></script>';
		$data_footer .= 
			'<script>
				$(function () {
					// Replace the <textarea id="editor2"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace("editor2");
					//bootstrap WYSIHTML5 - text editor
					$(".textarea").wysihtml5();
				  }); 
			</script>';

		$data_footer.="<script>
							$('#id_ctg').change(function(){
								$('#id_merk').empty();
								$('#id_merk').append('<option value=> -- Merk -- </option>');
								$.ajax({
									type: 'GET',
									dataType: 'json',
									url: '/product/masterMerk/'+ $(this).val(),
									success: function(res){
										$.each(res.data, function(k, v){
											//console.log(v);
											$('#id_merk').append('<option value='+v.masterJnProdId+'>'+v.msmrkName+'</option>')
										})
									}
								})
							})
					  </script>";

		//<script src=".base_url()."assets/plugins/select2/select2.full.min.js></script>
		$data_footer .= "<script>
								$(document).ready(function() {
									$('.select2').select2({
										placeholder: \"Select a Keyword\",
										allowClear: true,
										maximumSelectionLength: 3
									});
								});
							</script>";
		
		$this->classlayout->masterview($template, $data_title, $data_footer, $data_header='');
	}
	
	function added($id=""){
		$post=$this->input->post(); 

		$config = array(
			array(
					'field' => 'product',
					'label' => 'Product Name',
					'rules' => 'required'
				),
			array(
					'field' => 'merk',
					'label' => 'Merk',
					'rules' => 'required'
				),
			array(
					'field' => 'owner',
					'label' => 'Owner',
					'rules' => 'required'
			),
			array(
					'field' => 'excerpt',
					'label' => 'About',
					'rules' => 'required'
			),
			array(
					'field' => 'price',
					'label' => 'Price',
					'rules' => 'required'
			),
			array(
					'field' => 'keyword[]',
					'label' => 'Category',
					'rules' => 'required'
			),
			array(
					'field' => 'detail',
					'label' => 'Detail',
					'rules' => 'required'
			)
		);
	
		$this->form_validation->set_rules($config);
		//$this->form_validation->set_rules('product', 'Product', 'required');

		if(empty($id)){
			//from add data
			if($this->form_validation->run() == FALSE){

				$data_session = array(
					'validation_error' => validation_errors(),
					'value_product' => set_value('product'),
					'value_merk' => set_value('merk'),
					'value_owner' => set_value('owner'),
					'value_about' => set_value('excerpt'),
					'value_price' => set_value('price'),
					'value_category' => set_value('keyword'),
					'value_detail' => set_value('detail')
				);
				$this->session->set_userdata('validation', $data_session);

				redirect("/product/add");
			} else {
				$table = 'product';
				$status = 'actived';
				$approval = 'pending';
				$timestamp = date("Y-m-d")."T".date("H:i:s");
				$prodPrice = str_replace(".", "", $post['price']);
				$category_implode = implode(", ", $post['keyword']);
				$category = [$category_implode];

				$data=array(
					"table" => $table, 
					"prodName" => $post['product'],
					"prodPrice" => $prodPrice,
					"prodSummary" => $post['excerpt'],
					"prodOwner" => $post['owner'],
					"prodRate" => 0,
					"prodStatus" => "active",
					"prodMerk" => $post['merk'],
					"prodDetail" => $post['detail'],
					"prodApproval" => "pending",
					"prodCategory" => $category,
					"timestamp" => $timestamp
				);

				$post_data = $this->elasticsearch->add_post('docs', json_encode($data));
				
				if($post_data['_shards']['successful'] == 1 && $post_data['_shards']['failed'] == 0){
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

				redirect("product");
			} 

		} else {

			//from edit data
			if($this->form_validation->run() == FALSE){

				$data_session = array(
					'validation_error' => validation_errors(),
					'value_product' => set_value('product'),
					'value_merk' => set_value('merk'),
					'value_owner' => set_value('owner'),
					'value_about' => set_value('excerpt'),
					'value_price' => set_value('price'),
					'value_category' => set_value('keyword'),
					'value_detail' => set_value('detail')
				);
				$this->session->set_userdata('validation', $data_session);

				redirect("/product/edit/".$id);
			} else {
				$table = 'product';
				$status = 'actived';
				$approval = 'pending';
				$timestamp = date("Y-m-d")."T".date("H:i:s");
				$prodPrice = str_replace(".", "", $post['price']);
				$category_implode = implode(", ", $post['keyword']);
				$category = [$category_implode];

				$data=array( 
					"doc" => [
						"table" => $table, 
						"prodName" => $post['product'],
						"prodPrice" => $prodPrice,
						"prodSummary" => $post['excerpt'],
						"prodOwner" => $post['owner'],
						"prodRate" => 0,
						"prodStatus" => "active",
						"prodMerk" => $post['merk'],
						"prodDetail" => $post['detail'],
						"prodApproval" => "pending",
						"prodCategory" => $category,
						"timestamp" => $timestamp
					]
				);

				$post_data = $this->elasticsearch->update_post('docs', $id, json_encode($data));
				
				if($post_data['_shards']['successful'] == 1 && $post_data['_shards']['failed'] == 0){
					$this->session->set_flashdata('pesan',
										"<div class=\"col-md-12\" style=\"margin-top: 20px\">
											<div class=\"alert alert-success alert-dismissable\">
												<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
												<strong>Message!</strong> successfully edit product data!!
											</div>
										</div>");
				} else {
					$this->session->set_flashdata('pesan',
										"<div class=\"col-md-12\" style=\"margin-top: 20px\">
											<div class=\"alert alert-danger alert-dismissable\">
												<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
												<strong>Message!</strong> failed to edit product data, please try again later!!
											</div>
										</div>");
				}

				redirect("product");
			} 
		}
	}

	function preview($id){
		$data['menu'] = 'product';
		$data['submenu'] = 'list_product';

		$data['data'] = $this->getDataGlobal($id); //print_r($data); die;
		$title = $this->additional->slugify($data['data']['hits']['hits'][0]['_source']['prodName']);
	
		$template = array(
			'v_product/v_product_detail' => $data
		);
		$footer = "<script src=".base_url()."assets/dist/js/jquery.sticky-kit.js></script>";
		$footer .= "<script>
						$(document).ready(function(){
							$('.sidebar_parent').stick_in_parent({
								offset_top: 60
							});
						});
					</script>";
		
		$footer .= "//show hide scroll top
					<script> 
						$(window).scroll(function(){
							if($(this).scrollTop()>200){
								$('.go-top').fadeIn(200);
							} else {
								$('.go-top').fadeOut(200);
							}
							
							if($(this).scrollTop()>50){
								$('.nav-top').hide(500);
							} else {
								$('.nav-top').show(500);
							}
						});
					</script>";

		$footer .= "<script>
						//animated scroll top
						$('.go-top').click(function(e){
							e.preventDefault();
							//$('.nav-top').show(500);
							$('html, body').animate({scrollTop: 0}, 1000);
						})
					</script>";

		$footer .= "<script>
					$(window).resize(function(){
						console.log('resize called');
						var width = $(window).width();
						if(width > 760){
							$('.add_class').addClass('sidebar_parent');
						}
					})
					.resize();//trigger the resize event on page load.
					</script>";

		$this->classlayout->masterview($template, $title, $footer);
	}
	
	function edit($id){
		$data_title="Edit";
		$data['menu'] = 'product';
		$data['validation_message'] = $this->session->userdata('validation')['validation_error'];
		$data['value_product'] = $this->session->userdata('validation')['value_product'];
		$data['value_merk'] = $this->session->userdata('validation')['value_merk'];
		$data['value_owner'] = $this->session->userdata('validation')['value_owner'];
		$data['value_about'] = $this->session->userdata('validation')['value_about'];
		$data['value_category'] = $this->session->userdata('validation')['value_category'];
		$data['value_detail'] = $this->session->userdata('validation')['value_detail'];
		//$data['master_category'] = $this->m_data->master_category();

		$esquery_category = 	["query" => [
										"match" => ["table" => "category"]
									]
								];

		$esquery_data = ["query" => [
							"match" => ["_id" => $id] 
							]
						];

		$data['category'] = $this->elasticsearch->advancedquery('docs', json_encode($esquery_category));
		$data['data'] = $this->elasticsearch->advancedquery('docs', json_encode($esquery_data));

		$template=array(
			'v_product/v_product_edit'=>$data
		);

		$data_footer = '<script src="'.base_url().'plugin/ckeditor/ckeditor.js"></script>';
		$data_footer .= 
			'<script>
				$(function () {
					// Replace the <textarea id="editor2"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace("editor2");
					//bootstrap WYSIHTML5 - text editor
					$(".textarea").wysihtml5();
				  }); 
			</script>';

		$data_footer.="<script>
							$('#id_ctg').change(function(){
								$('#id_merk').empty();
								$('#id_merk').append('<option value=> -- Merk -- </option>');
								$.ajax({
									type: 'GET',
									dataType: 'json',
									url: '/product/masterMerk/'+ $(this).val(),
									success: function(res){
										$.each(res.data, function(k, v){
											//console.log(v);
											$('#id_merk').append('<option value='+v.masterJnProdId+'>'+v.msmrkName+'</option>')
										})
									}
								})
							})
					  </script>";

		//<script src=".base_url()."assets/plugins/select2/select2.full.min.js></script>
		$data_footer .= "<script>
							$(document).ready(function() {
								$('.select2').select2({
									placeholder: \"Select a Keyword\",
									allowClear: true,
									maximumSelectionLength: 3
								});
							});
						</script>";

		//version mysql
		/*$data['data']=$this->m_data->productEdit($id);
		$data['master_category']=$this->m_data->master_category();
		//$data['master_merk']=$this->m_data->master_merk($id='');
		$template=array(
			'v_product/v_product_edit'=>$data
		);
		
		$data_footer = '<script src="'.base_url().'plugin/ckeditor/ckeditor.js"></script>';
		$data_footer .= 
			'<script>
				$(function () {
					// Replace the <textarea id="editor2"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace("editor2");
					//bootstrap WYSIHTML5 - text editor
					$(".textarea").wysihtml5();
				  }); 
			</script>';
		
		$data_footer.="<script>
							$.ajax({
								url: '/product/masterMerk/'+$('#id_ctg').val(),
								dataType: 'json',
								success: function(res){
									var productMsJnProdId = '".$data['data'][0]['productMsJnProdId']."';
									var select=' ';
									
									$.each(res.data, function(k,v){
										if(v.masterJnProdId == productMsJnProdId){
											var select = 'selected';
										}
										
										$('#id_merk').append('<option ' + select + ' value='+v.masterJnProdId+'>'+toUpperFirst(v.msmrkName)+'</option>')
									})
								}
							})
							
							$('#id_ctg').change(function(){
								$('#id_merk').empty();
								$('#id_merk').append('<option value=> -- Merk -- </option>');
								$.ajax({
									url: '/product/masterMerk/'+$(this).val(),
									dataType: 'json',
									success: function(res){
										$.each(res.data, function(k,v){
										//console.log(res)
										$('#id_merk').append('<option value='+v.masterJnProdId+'>'+v.msmrkName+'</option>')
										})
									}
								})
							})
					   </script>";*/

		$this->classlayout->masterview($template, $data_title, $data_footer);
	}
	
	function edited($id){
		$post=$this->input->post();
		$data=array(
			'productMsJnProdId'=>$post['classification'],
			//'productCategoryId'=>$post['productCategoryId'],
			'productName'=>$post['product'],
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
		redirect("product");
	}
	
	function deleted($id){
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
		//redirect('product');*/
	}
	
	function image($id){
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
					redirect('product/image/'.$id);
				}
			}
		}
		
		$template=array(
			'v_product/v_image/v_image_list'=>$data
		);
		
		$footer = "<script>
						function del_priority(idProduct, idImage){
							$.ajax({
								url: '/product/del_priority/'+idProduct,
								type: 'GET',
								dataType: 'TEXT',
								beforeSend: function (){
									$('#id-btn-'+idImage).hide();
									$('#id-spin-'+idImage).show();
								},
								success: function(data){
									priority(idProduct, idImage);
								}, 
								error: function(data){
									console.log('error delete priority '+JSON.stringify(data))
								}
							})
						}
						
						function priority(idProduct, idImage){
							$.ajax({
								url: '/product/priority/'+idImage,
								type: 'GET',
								dataType: 'TEXT',
								beforeSend: function (){
									$('#id-btn-'+idImage).hide();
									$('#id-spin-'+idImage).show();
								},
								success: function(data){
									window.location.href = '/product/image/'+idProduct
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
			'v_product/v_image/v_image_add'=>$data
		);
		
		$this->classlayout->masterview($template, $data_title);
	}
	
	function imgedit($id){
		$data_title = "Edit Image";
		$data['data'] = '';//$this->m_data->img_edit($id);
		
		
		$template = array(
			'v_product/v_image/v_image_edit' => $data
		);
		
		$this->classlayout->masterview($template, $data_title);
	}
	
	function imgedited($id, $id_product){
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
		redirect('product/image/'.$id_product);
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
		ex: upload ke-1 : 1.jpg, 2.jpg, 3.jpg. Upload ke-2 : 11.jpg, 21.jpg.*/
		$this->load->library('upload');
		$max_width = '10288';
		$max_height = '7068';
		$count=count($_FILES['productimage']['size']);
		
		//if($this->upload->do_upload('productimage')){
			//$this->upload->do_upload('productimage');
			foreach($_FILES as $k_val=>$n_val){
				for($s=0; $s<=$count-1; $s++){
					$_FILES['productimage']['name'] = $n_val['name'][$s];
					$_FILES['productimage']['type'] = $n_val['type'][$s];
					$_FILES['productimage']['tmp_name'] = $n_val['tmp_name'][$s];
					$_FILES['productimage']['error'] = $n_val['error'][$s];
					$_FILES['productimage']['size'] = $n_val['size'][$s];  
					$nm_file = $s+1;
					
					$config['upload_path'] = './assets/dist/img/'.$id;
					$config['allowed_types'] = "gif|jpg|png|jpeg|bmp";
					$config['max_size'] = '2048'; //max 2mb
					$config['max_width'] = $max_width; //max lebar
					$config['max_height'] = $max_height; //max tinggi
					$config['file_name'] = $nm_file;
					
					$this->upload->initialize($config);
					$this->upload->do_upload('productimage');
						$post = $this->input->post();
						$gbr=$this->upload->data(); // showing all data about image
						//print_r($gbr);
						//print_r($_FILES['productimage']); exit;
						$data = array(
							'arsipProductId' => $id,
							'arsipImgPos' => $gbr['raw_name'],
							'arsipImgType' => $gbr['file_ext'],
							'arsipImgExcerpt' => $post['img_excerpt'],
							'arsipImgDetail' => $post['img_detail']
						);
						
					$result = ''; //$this->m_data->img_added($data);
				}
			}
		
		if($_FILES['productimage']['error'] == 0 && $this->upload->do_upload('productimage')){
			$this->session->set_flashdata('pesan', 
				"<div class=\"col-md-12\" style=\"margin-top: 20px\">
					<div class=\"alert alert-success alert-dismissable\">
						<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
						<strong>Message!</strong> Data Image Product Berhasil Diperbaharui!!
					</div>
				</div>");
			redirect('product/image/'.$id);
		} else {
			$this->session->set_flashdata('pesan', 
				"<div class=\"col-md-12\" style=\"margin-top: 20px\">
					<div class=\"alert alert-danger alert-dismissable\">
						<a style=\"text-decoration: none\" href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</a>
						<strong>Message!</strong> Terdapat ukuran Image yang melebihi batas Maksimum, batas Maksimum Image = 2MB. 
						Data Image Product Gagal Diperbaharui!!
					</div>
				</div>");
			redirect('product/imgadd/'.$id);
		}
	}
	
	function imgDeleted($id, $id_product, $id_priority){
		if($id_priority == 1){
			redirect('product/image/'.$id_product);
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
		redirect("product/image/".$id_product);
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
	}

	function getData(){
		//print_r($params['order'][0]); die;
		$params = $columns = array();
		$params = $_REQUEST;

		$table = "product";
		$field_1 = "prodName";
		$field_2 = "prodSummary";

		//elasticsearch column definition
		$columns = array(
			0 => '_id',
			1 => 'prodName',
			2 => 'prodPrice',
			3 => 'prodSummary',
			//4 => 'prodDetail',
			4 => 'timestamp'
		);

		$type = 'docs';

		$esquery = ["query" => [
						"bool" => [
							"must" => [
										[
											"match" => ["table" => $table]
										],
										[
											"match" => ["prodStatus" => "active"]
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
									[ "match" => ["prodStatus" => "active"] ]
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

		$queryRecords = $this->elasticsearch->advancedquery($type, json_encode($esquery));
		//return $queryRecords;

		$totalRecords = $queryRecords['hits']['total'];
	
		$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $queryRecords['hits']['hits']   // total data array
			//"data"            => $queryRecords  // total data array
			);

		echo json_encode($json_data);  // send data as json format
	}

	function getDataGlobal($id){
		$esquery = ["query" => [
						"match" => ["_id" => $id]
						]
					];

		$result = $this->elasticsearch->advancedquery('docs', json_encode($esquery));
		return $result;
	}
}