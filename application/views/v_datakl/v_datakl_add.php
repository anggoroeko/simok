<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> <?php //echo($this->session->flashdata('validation_error'));?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        KL
        <!-- <small>Advanced form element</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/datakl"><i class="fa fa-cubes"></i> Data KL</a></li>
        <li class="active"><i class="fa fa-file"></i> Form</li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
				
	<form method="POST" action="<?= base_url() ?>datakl/added" enctype="multipart/form-data">
					<!-- <?php echo form_open('/datakl/added'); ?> -->

						<div class="box-body">
							<div class="row">
								<!--column-1--> 
								<!--<div class="col-md-12">
									<div class="alert alert-danger">-->
										<?php //print_r($validation_message); die;
												$valid_explode = explode(".", $validation_message);

												foreach($valid_explode as $k=>$v){
													$v_explode = explode(" ", $v);
													
													if(@$v_explode[1] == "Number" && @$v_explode[2] == "Of" && @$v_explode[3] == "KB"){
														$validation_nokb = "<div class='alert alert-danger'>".$v."</div>";
														
													}/*elseif(@$v_explode[1] == "Number" && @$v_explode[2] == "Of" && @$v_explode[3] == "KL"){
														$validation_nokl = "<div class='alert alert-danger'>".$v."</div>";

													}*/ elseif(@$v_explode[1] == "Project" && @$v_explode[2] == "Name"){
														$validation_project_name = "<div class='alert alert-danger'>".$v."</div>";
														
													} elseif(@$v_explode[1] == "CC" && @$v_explode[2] == "Number"){
														$validation_cc_number = "<div class='alert alert-danger'>".$v."</div>";
														
													} elseif(@$v_explode[1] == "Telkom" && @$v_explode[2] == "Number"){
														$validation_telkom_number = "<div class='alert alert-danger'>".$v."</div>";

													} elseif(@$v_explode[1] == "RAK" && @$v_explode[2] == "Number"){
														$validation_rak_number = "<div class='alert alert-danger'>".$v."</div>";

													} elseif(@$v_explode[1] == "SPK"){
														$validation_spk = "<div class='alert alert-danger'>".$v."</div>";

													} elseif(@$v_explode[1] == "Contract" &&  @$v_explode[2] == "Document" && @$v_explode[3] == "Status"){
														$validation_contract_doc_status = "<div class='alert alert-danger'>".$v."</div>";

													} elseif(@$v_explode[1] == "Contract" && @$v_explode[2] == "Date"){
														$validation_contract_date = "<div class='alert alert-danger'>".$v."</div>";

													} elseif(@$v_explode[1] == "Start" && @$v_explode[2] == "Date"){
														$validation_start_date = "<div class='alert alert-danger'>".$v."</div>";

													} elseif(@$v_explode[1] == "End" && @$v_explode[2] == "Date"){
														$validation_end_date = "<div class='alert alert-danger'>".$v."</div>";

													} elseif(@$v_explode[1] == "Segment"){
														$validation_segment = "<div class='alert alert-danger'>".$v."</div>";

													}
												}
												//echo $validation_message;
											?>
										<!--</div>
								</div> -->
								<div class="col-md-6"> <?php //print_r($datakb); die; ?>
									<div class="form-group">
										<?= @$validation_nokb ?>
										<label>KB Number</label>
										<select class="form-control number_of_kb_class" name="number_of_kb">
											<option value=""> -- KB	 Number -- </option>

											<?php
												if(!empty($datakb)){
													foreach($datakb['hits']['hits'] as $k => $v){
														$selected = " ";

														if(!empty($value_number_of_kb)){
															if($v['_source']['number_of_kb'] == $value_number_of_kb){
																$selected = "selected";
															} //print_r($v['_source']['number_of_kb'] ." ". $value_number_of_kb);
														}
												?>

												<option <?= $selected ?>  value="<?= $v['_source']['number_of_kb'] ?>" name="number_of_kb"> <?= $v['_source']['number_of_kb'] ?> </option>

												<?php
													} //die;
												}
											?>
										</select>
									</div> 

									<!-- <div class="form-group">
										<label for="product">KL Number</label>
										<?= @$validation_nokl ?>
										<input type="text" name="number_of_kl" class="form-control" placeholder="KL Number" value="<?php echo @$value_number_of_kl; ?>">
									</div> -->

									<div class="form-group" >
										<label for="Project Name">Project Name</label>
										<?= @$validation_project_name ?>
										<input type="text" name="project_name" class="form-control" placeholder="Project Name" value="<?php echo @$value_project_name; ?>">
									</div>

									<div class="form-group" >
										<label for="Project Name">CC Number</label>
										<?= @$validation_cc_number ?>
										<input type="text" name="cc_number" class="form-control" placeholder="CC Number" value="<?php echo @$value_cc_number; ?>">
									</div>

									<div class="form-group" >
										<label for="Project Name">KL Number</label>
										<?= @$validation_telkom_number ?>
										<input type="text" name="telkom_number" class="form-control" placeholder="KL Number" value="<?php echo @$value_telkom_number; ?>">
									</div>

									<div class="form-group" >
										<label for="Project Name">RAK Number</label>
										<?= @$validation_rak_number ?>
										<input type="text" name="number_of_rack" class="form-control" placeholder="RAK Number" value="<?php echo @$value_number_of_rack; ?>">
									</div>

									<div class="form-group">
										<label for="merk">SPK</label>
										<?= @$validation_spk ?>
										<input type="text" name="spk" class="form-control" placeholder="SPK" value="<?= @$value_spk ?>">
									</div> 
									
									<div class="form-group">
										<?= @$validation_contract_doc_status ?>
										<label>Contract Document Status</label>
										<select class="form-control" name="contract_doc_status">
											<option value=""> -- Contract Document Status-- </option>

											<?php 
												$data_contract_doc_status = array(
													array(
														"id_contract_doc_status" => 1,
														"contract_doc_status" => "Open"
													),
													array(
														"id_contract_doc_status" => 2,
														"contract_doc_status" => "Close Draft"
													),
													array(
														"id_contract_doc_status" => 3,
														"contract_doc_status" => "Close"
													)
												);
											?>

											<?php
												if(!empty($data_contract_doc_status)){
													foreach($data_contract_doc_status as $k => $v){
														$selected = " ";

														if(!empty($value_contract_doc_status)){
															if($v['id_contract_doc_status'] == $value_contract_doc_status){
																$selected = "selected";
															}
														}
												?>

												<option <?= $selected ?>  value="<?= $v['id_contract_doc_status'] ?>" name="contract_doc_status"> <?= $v['contract_doc_status'] ?> </option>

												<?php
													}
												}
											?>
										</select>
									</div> 

									<!--<div class="form-group">
										<?= @$validation_doc_position ?>
										<label>Document Position</label>
										<select class="form-control" name="status">
											<option value=""> -- Document Position -- </option>

											<?php 
												$data_doc_position = array(
													array(
														"id_doc_position" => 1,
														"doc_position" => "Open"
													),
													array(
														"id_doc_position" => 2,
														"doc_position" => "Close Draft"
													),
													array(
														"id_doc_position" => 3,
														"doc_position" => "Close"
													)
												);
											?>

											<?php
												if(!empty($data_doc_position)){
													foreach($data_doc_position as $k => $v){
														$checked = " ";

														if(!empty($value_doc_position)){
															if($v['id_contract_doc_status'] == $value_doc_position){
																$checked = "checked";
															}
														}
												?>

												<option <?= $checked ?>  value="<?= $v['id_doc_position'] ?>" name="doc_position"> <?= $v['doc_position'] ?> </option>

												<?php
													}
												}
											?>
										</select>

									</div> -->

									<div class="form-group"> 
										<label> Contract Date	</label>
										<?= @$validation_contract_date ?>
										<div class='input-group date'>
												<input type='text' class="form-control" name="contract_date"  id='contract_date' value="<?= @$value_contract_date ?>"/>
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
										</div>
									</div>
								</div>
								
								<!--column-1-->
								<!--column-2-->
								<div class="col-md-6">
									<div class="form-group">
										<label> Start Date	</label>
										<?= @$validation_start_date ?>
										<div class='input-group date'>
												<input type='text' class="form-control" name="start_date"  id='start_date' value="<?= @$value_start_date ?>" />
												<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
												</span>
										</div>
									</div>

									<div class="form-group" id='idtarget'>
										<label> End Date	</label>
										<?= @$validation_end_date ?>
										<div class='input-group date'>
												<input type='text' class="form-control" name="end_date"  id='end_date' value="<?= @$value_end_date ?>" />
												<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
												</span>
										</div>
									</div>

									<div class="form-group" >
										<label for="Project Duration"> Project Duration </label>
										<input type="text" name="project_duration" class="form-control" placeholder="Project Duration, ex : 1 month 5 day" value="<?= @$value_project_duration ?>">
									</div>

									<div class="form-group" id='idtarget'>
										<label> Project Value	(IDR)</label>
										<?= @$project_value ?>
										<input type="text" name="project_value" class="form-control amount" placeholder="Just Number. ex : 123.456.789" value="<?= @$value_project_value ?>">
									</div>

									<div class="form-group">
										<?= @$validation_segment ?>
										<label>Segment</label>
										<select class="form-control" name="segment">
											<option value=""> -- Segment -- </option>

											<?php 
												$data_segment = array(
													array(
														"id_segment" => 1,
														"segment" => "MPS"
													),
													array(
														"id_segment" => 2,
														"segment" => "LGS"
													),
													array(
														"id_segment" => 3,
														"segment" => "CGS"
													),
													array(
														"id_segment" => 4,
														"segment" => "GAS"
													)
												);
											?>

											<?php
												if(!empty($data_segment)){
													foreach($data_segment as $k => $v){
														$selected = " ";

														if(!empty($value_segment)){
															if($v['id_segment'] == $value_segment){
																$selected = "selected";
															}
														}
												?>

												<option <?= $selected ?>  value="<?= $v['segment'] ?>" name="segment"> <?= $v['segment'] ?> </option>

												<?php
													}
												}
											?>
										</select>

									</div> 

									<div class="form-group" id='idtarget'>
										<label> Client Contract </label>
										<input type="text" name="client_contract" class="form-control" placeholder="Client Contract, ex: Kementerian ESDM" value="<?= @$value_client_contract ?>">
									</div>

									<div class="form-group" id='idtarget'>
										<label> Partner Name </label> 
										<?= @$validation_partner_name ?>
										<input type="text" name="partner_name" class="form-control" placeholder="Partner Name, ex: PT. Telekomunikasi Indonesia" value="<?= @$value_partner_name ?>">
									</div>

									<div class="form-group" id='idtarget'>
										<label> File KL </label>
										<input type="file" name="file_kl" class="form-control">
									</div>

								</div>
								<!--column-2-->
							</div>

						</div> <!--Box-Body-->
					
						<div class="box-footer">
							<input type="submit" class="btn btn-primary" value="Submit">
						</div>
					</form>
          
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
