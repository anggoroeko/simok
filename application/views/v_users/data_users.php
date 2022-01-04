 
 <!-- Data Table -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Users
        <small>list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-user"></i> User</li>
      </ol>
    </section>
	
	<?= $this->session->flashdata('pesan') ?>

    <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary">
					
				<!-- Box Header -->
				<div class="box-header with-border">
					<h3 class="box-title">User</h3>
					<div class="box-body">
						<div class="table-responsive">
						  <table id="data_table_server_user" class="table table-bordered table-striped">
							<thead>
								<tr>
								  <th><center>No</center></th>
								  <th><center>First Name</center></th>
								  <th><center>Last Name</center></th>
								  <th><center>Email</center></th>
								  <th><center>Created Date</center></th>
								  <th><center>Action</center></th>
								</tr>
							</thead>
							<tbody>
							<?php //print_r($this->session->userdata('isLogin')); exit;
									/*if(!empty($data)){
										$no=1;
										foreach ($data as $k_value => $n_value) {
											$disabled = '';
											/* if($n_value['userId'] == $this->session->userdata('isLogin')['userId']) {
												$disabled = "disabled";
											} 
											$image='';
											$width='';
											if($n_value['userImgName'] != '' && $n_value['userImgType'] != ''){
												$image="assets/dist/img/upload/".$n_value['userImgName'].$n_value['userImgType'];
												$width='50%';
											} else {
												$image="assets/dist/img/account_white.png";
												$width='10%';
											}*/
									?>
								<!--<tr>
								  <td style="text-align: center; width: 50px"> <?= $no++; ?> </td>
								  <td style="text-align: center"><?= ucwords($n_value['userFullName']) ?></td>
								  <td style="text-align: center"><?= $n_value['userName'] ?></td>
								  <td style="text-align: center"><?= $n_value['msUserSttsName'] ?></td>
								  <td style="text-align: center"><img style="width: <?=$width?>; background: black" src="<?= $image ?>"></td>
								  
								  <td style = "width: 100px"> 
									<a href="<?= base_url() ?>users/edit/<?= $n_value['userId'] ?>">
										<button <?= $disabled ?> style="margin-bottom: 5px" type="button" class="btn btn-block btn-primary btn-xs">Edit</button> 
									</a>
								  </td>
									
								  <td style = "width: 100px"> 
									<!-- data-id="<?=$n_value['userId']?>"
									<button <?= $disabled ?> type="button" data-toggle="modal" data-target="#idModal<?=$n_value['userId']?>" class="btn btn-block btn-danger btn-xs open-Confirm">Delete</button> 
								  </td>  
								</tr> 
							
							  <!-- Modal
							  <div class="modal fade" id="idModal<?=$n_value['userId']?>" role="dialog">
								<div class="modal-dialog modal-sm">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title">Hapus</h4>
									</div>
									
									<div class="modal-body">
									  <p>Mau Menghapus Data <?= $n_value['userFullName']?>?</p>
									</div>
									<div class="modal-footer">
										<a href="<?= base_url() ?>users/deleted/<?= $n_value['userId'] ?>">
											<button type="button" class="btn btn-default">Ya</button>
										</a>
										
										<a href="#">
											<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
										</a>
									</div>
									
								  </div>
								</div>
							  </div>
							 
							  <!-- Modal -->
								<?php
										//}
									//}
							?>
							
							</tbody>
							<tfoot>
								<tr>
									<th><center>No</center></th>
								  <th><center>First Name</center></th>
								  <th><center>Last Name</center></th>
								  <th><center>Email</center></th>
									<th><center>Created Date</center></th>
								  <th><center>Action</center></th>
								</tr>
							</tfoot>
							
						  </table>
						</div>
		              
		        	</div>
	            </div>
	            <!-- /.box-body -->
	          </div>
	          <!-- /.box -->
	      </div>
	      <!-- /.row -->
	    </section>
	   <!-- /.content -->
	   </div>
	  