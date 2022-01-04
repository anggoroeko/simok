<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> <?php //print_r($data); die; ?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    User 
	    <small>Edit</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="<?= base_url() ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?= base_url() ?>/realization"><i class="fa fa-user"></i> User </a></li>
	    <li class="active"><i class="fa fa-file"> </i> Form</a></li>
	  </ol>
	</section>
	
	<?= $this->session->flashdata('pesan') ?>
		
	<!--Main Content-->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary">
					
					<!-- Box Header -->
			        <div class="box-header with-border">
			          <h3 class="box-title">User</h3>
			          <div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
			        </div>
			        <!-- /.box-header -->
					<form enctype="multipart/form-data" method="POST" action="<?= base_url() ?>users/edited/<?= $data['hits']['hits'][0]['_id'] ?>">
						<div class="box-body">
							<div class="row">
								<!--column-1--> 
								<div class="col-md-12">
									<div class="form-group" id='idtarget'>
										<label>First Name</label>
										<input required type="text" name="txFirst_name" class="form-control" placeholder="First Name" value="<?= $data['hits']['hits'][0]['_source']['first_name'] ?>">
									</div>
									<div class="form-group" id='idtarget'>
										<label>Last Name</label>
										<input required type="text" name="txLast_name" class="form-control" placeholder="Last Name" value="<?= $data['hits']['hits'][0]['_source']['last_name'] ?>">
									</div>
									<div class="form-group">
										<label>Permission</label>
										<select class="form-control" name="permission">

										<?php
											$selected_0 = '';
											$selected_1 = '';
											if($data['hits']['hits'][0]['_source']['status_user'] == 1){
												$selected_1 = 'selected';
											} else {
												$selected_0 = 'selected';
											}
										?>

											<option value=""> -- Select Permission Role -- </option>
											<option <?= $selected_0 ?> value="0"> Admin </option>
											<option <?= $selected_1 ?> value="1"> Super Admin </option>
										</select>
									</div>
									<div class="form-group" id='idtarget'>
										<label>email</label>
										<input required type="email" name="txEmail" class="form-control" placeholder="Email" value="<?= $data['hits']['hits'][0]['_source']['email'] ?>">
									</div>
									
									<!--<div class="form-group">
										<label>User Image</label>
										<input type="file" name="userimage" class="form-control">
									</div> -->
								 </div>
								 
								 <!--column-1-->
								 <!--column-2-->
								<div class="col-md-12">
									<div class="form-group" id='idtarget'>
										<label>Password</label>
										<input type="password" name="txPassword" class="form-control" placeholder="Password">
									</div>
									
									<!--<div class="form-group">
										<label>Status</label>
										<select required class="form-control" name="status">
											<option value=""> -- Status -- </option>
											
											<?php //print_r($data); exit; 
												if(!empty($data)){
													foreach($data as $k_val => $n_val){
												?>
											
											<option value="<?= $n_val['msUserSttsId'] ?>"> <?= $n_val['msUserSttsName'] ?> </option>
											
												<?php
													}
												}
											?>
										</select>
									</div>-->
									
								 </div>
								 <!--column-2-->
							</div>
						</div> <!--Box-Body-->
					
						<div class="box-footer">
						   <input type="submit" class="btn btn-primary" value="Submit">
						</div>
					</form>
				</div> <!--Box-Primary-->
			</div> <!--col-sm-12-->
		</div> <!--Row-->
	</section> <!--Main Content-->
</div>	<!--Content Wrapper-->