<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> <?php //print_r($data); die;?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        KB
        <!-- <small>Advanced form element</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/datakb"><i class="fa fa-cubes"></i> Data KB</a></li>
        <li class="active"><i class="fa fa-file"></i> Form</li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">

		<?php
			if(empty($data['hits']['hits'][0]['_source']['position_file'])){
				$position_file = rand(10,100);
			} else {
				$position_file = $data['hits']['hits'][0]['_source']['position_file'];
			}
		?>

	  <form method="POST" action='<?= base_url() ?>datakb/added/<?= $data['hits']['hits'][0]['_id'] ?>?url=<?= $position_file ?>' enctype="multipart/form-data">
			<?php //echo form_open('/datakb/added/'.$data['hits']['hits'][0]['_id']); ?>
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

											} elseif(@$v_explode[1] == "Client" &&  @$v_explode[2] == "Contract"){
												$validation_cc = "<div class='alert alert-danger'>".$v."</div>";

											} elseif(@$v_explode[1] == "Project" && @$v_explode[2] == "Name"){
												$validation_project_name = "<div class='alert alert-danger'>".$v."</div>";

											} elseif(@$v_explode[1] == "Partner" && @$v_explode[2] == "Name"){
												$validation_partner_name = "<div class='alert alert-danger'>".$v."</div>";

											} elseif(@$v_explode[1] == "Contract" && @$v_explode[2] == "Date"){
												$validation_contract_date = "<div class='alert alert-danger'>".$v."</div>";

											} elseif(@$v_explode[1] == "Start" && @$v_explode[2] == "Date"){
												$validation_start_date = "<div class='alert alert-danger'>".$v."</div>";

											} elseif(@$v_explode[1] == "End" && @$v_explode[2] == "Date"){
												$validation_end_date = "<div class='alert alert-danger'>".$v."</div>";

											} elseif(@$v_explode[1] == "Segment"){
												$validation_segment = "<div class='alert alert-danger'>".$v."</div>";
											
											} elseif(@$v_explode[1] == "Number" && @$v_explode[2] == "Of" && @$v_explode[3] == "Rack"){
												$validation_number_of_rack = "<div class='alert alert-danger'>".$v."</div>";
											
											} elseif(@$v_explode[1] == "Project" && @$v_explode[2] == "Value"){
												$validation_project_value = "<div class='alert alert-danger'>".$v."</div>";
											
											}
										}
									?>
								<!--</div>
						</div> -->
						<div class="col-md-6">
							<div class="form-group" >
								<label for="No. KB">KB Number</label>
								<?= @$validation_nokb ?>
								<input type="text" name="number_of_kb" class="form-control" placeholder="KB Number" value="<?php echo @$data['hits']['hits'][0]['_source']['number_of_kb']; ?>">
							</div>

							<div class="form-group" >
								<label for="Project Name">Project Name</label>
								<?= @$validation_project_name ?>
								<input type="text" name="project_name_kb" class="form-control" placeholder="Project Name" value="<?php echo @$data['hits']['hits'][0]['_source']['project_name_kb']; ?>">
							</div>

							<div class="form-group" >
								<label for="spbbj">SPBBJ</label>
								<input type="text" name="spbbj" class="form-control" placeholder="spbbj" value="<?= @$data['hits']['hits'][0]['_source']['spbbj'] ?>">
							</div> 

							<div class="form-group" >
								<label for="Np. RAK">No. RAK</label>
								<?= @$validation_number_of_rack ?>
								<input type="text" name="number_of_rack" class="form-control" placeholder="No. RAK" value="<?= @$data['hits']['hits'][0]['_source']['number_of_rack'] ?>">
							</div> 
							
							<!--<div class="form-group">
								<?= @$validation_contract_doc_status ?>
								<label>Contract Status Document</label>
								<select class="form-control" name="status">
									<option value=""> -- Contract Status Document -- </option>

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
												$checked = " ";

												if(!empty($value_contract_doc_status)){
													if($v['id_contract_doc_status'] == $value_contract_doc_status){
														$checked = "checked";
													}
												}
										?>

										<option <?= $checked ?>  value="<?= $v['id_contract_doc_status'] ?>" name="contract_doc_status"> <?= $v['contract_doc_status'] ?> </option>

										<?php
											}
										}
									?>
								</select>
							</div> 

							<div class="form-group">
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
								<label for="Contract Date"> Contract Date	</label>
								<?= @$validation_contract_date ?>
								<div class='input-group date'>
										<input type='text' class="form-control" name="contract_date"  id='contract_date' value="<?= @$data['hits']['hits'][0]['_source']['contract_date'] ?>"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
								</div>
							</div>

							<div class="form-group">
								<label for="Start Date"> Start Date	</label>
								<?= @$validation_start_date ?>
								<div class='input-group date'>
										<input type='text' class="form-control" name="start_date"  id='start_date' value="<?= @$data['hits']['hits'][0]['_source']['start_date'] ?>"/>
										<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
										</span>
								</div>
							</div>

							<div class="form-group" >
								<label for="End Date"> End Date	</label>
								<?= @$validation_end_date ?>
								<div class='input-group date'>
										<input type='text' class="form-control" name="end_date"  id='end_date' value="<?= @$data['hits']['hits'][0]['_source']['end_date'] ?>"/>
										<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
										</span>
								</div>
							</div>

							<!--<div class="form-group">
								<label>Duration</label>
								<select class="form-control" name="status">
									<option value=""> -- Duration -- </option>

									<?php 
											for($i=1; $i<13; $i++){
										?>

										<option value="<?= $i ?>" name="duration"> <?= $i ?> month </option>

										<?php
											}
									?>

								</select>

							</div> -->

						</div>
						
						<!--column-1-->
						<!--column-2-->
						<div class="col-md-6">

							<div class="form-group" >
								<label for="Project Duration"> Project Duration </label>
								<input type="text" name="project_duration" class="form-control" placeholder="Project Duration, ex : 1 month 5 day" value="<?= @$data['hits']['hits'][0]['_source']['other_duration'] ?>">
							</div>

							<div class="form-group" >
								<label for="Project Value"> Project Value	(IDR)</label>
								<?= @$validation_project_value ?>
								<input type="text" name="project_value" class="form-control amount" placeholder="Just Number. ex : 123.456.789" value="<?= @number_format($data['hits']['hits'][0]['_source']['project_value'], 0,",",".") ?>">
							</div>

							<div class="form-group"> <?php //echo($value_segment); die; ?>
								<label for="Segment">Segment</label>
								<?= @$validation_segment ?>
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

									<?php //print_r($data_segment); die;
										if(!empty($data_segment)){
											foreach($data_segment as $k => $v){ //print_r($v['segment']);
												$selected = " ";

												//if(!empty($value_segment)){
													if($v['segment'] == $data['hits']['hits'][0]['_source']['segment']){
														$selected = "selected";
													}
												//}
										?>

										<option <?= $selected ?>  value="<?= $v['segment'] ?>" name="segment"> <?= $v['segment'] ?> </option>

										<?php
											}
										}
									?>
								</select>

							</div> 

							<div class="form-group" >
								<label for="Client Contract"> Client Contract </label>
								<?= @$validation_cc ?>
								<input type="text" name="client_contract" class="form-control" placeholder="Client Contract, ex: Kementerian ESDM" value="<?= @$data['hits']['hits'][0]['_source']['client_contract'] ?>">
							</div>

							<div class="form-group" >
								<label for="Partner Name"> Partner Name </label> 
								<?= @$validation_partner_name ?>
								<input type="text" name="partner_name" class="form-control" placeholder="Partner Name, ex: PT. Telekomunikasi Indonesia" value="<?= @$data['hits']['hits'][0]['_source']['partner_name'] ?>">
							</div>

							<div class="form-group" >
								<label> File KB </label>
								<input type="file" name="file_kb" class="form-control">
							</div>

							<?php 
								if(!empty($data['hits']['hits'][0]['_source']['position_file'])){
							?>
							
							<a target=_blank href="/datakb/download?url=<?= $data['hits']['hits'][0]['_source']['position_file'] ?>><img width="10%" src="/assets/dist/img/documents-icon.png"></a>
							
							<?php
								}
							?>
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
