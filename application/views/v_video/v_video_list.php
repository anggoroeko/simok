<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Video
        <!-- <small>Advanced form element</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Video</a></li>
        <li class="active">List</li>
      </ol>
    </section>
	
	<?=$this->session->flashdata('pesan')?>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box">
            <!-- <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="text-align: center">No</th>
                  <th style="text-align: center">Judul</th>
				  <th style="text-align: center">Tentang</th>
				  <th style="text-align: center">Detail</th>
                  <th style="text-align: center">URL</th>
				  <th style="text-align: center">Image</th>
                  <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
				
				<?php
					if(!empty($data)){
						$no=1;
						foreach($data as $k_val=>$n_val){
					?>
                
					<tr>
					  <td style="text-align: center"><?=$no++?></td>
					  <td style="text-align: center"><?=ucwords($n_val['videTitle'])?></td>
					  <td style="text-align: center"><?=$n_val['videExcerpt']?></td>
					  <td style="text-align: center"><?=$n_val['videDetail']?></td>
					  <td style="text-align: center"><a href="<?=$n_val['videStreamUrl']?>" target="_blank"><?=$n_val['videStreamUrl']?></a></td>
					  <?php
						$FirstUrl=$n_val['videStreamUrl'];
						$SecondUrl=str_replace('watch?v=','embed/',$FirstUrl);
						$ExplodeUrl=explode('/',$SecondUrl);
						$Url="https://img.youtube.com/vi/".$ExplodeUrl[4]."/hqdefault.jpg";
						?>
					  <td style="text-align: center;"><img width="250px" src="<?=$Url?>"></td>
					  <td> 
						<a href="/video/edit/<?=$n_val['videId']?>">
							<button style="margin-bottom: 5px" type="button" class="btn btn-block btn-primary btn-xs">Edit</button> 
						</a>
							<button type="button" data-toggle="modal" data-target="#idModal<?=$n_val['videId']?>" class="btn btn-block btn-danger btn-xs open-Confirm">Hapus</button> 
					  </td>
					</tr>
				   <!-- Modal -->
						  <div class="modal fade" id="idModal<?=$n_val['videId']?>" role="dialog">
							<div class="modal-dialog modal-sm">
							  <div class="modal-content">
								<div class="modal-header">
								  <button type="button" class="close" data-dismiss="modal">&times;</button>
								  <h4 class="modal-title">Hapus</h4>
								</div>
								
								<div class="modal-body">
								  <p>Mau Menghapus Data <strong><?= $n_val['videTitle']?>?</strong></p>
								</div>
								<div class="modal-footer">
									<a href="/video/delete/<?= $n_val['videId'] ?>">
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
							}
						} else {
						?>
						
						<tr>
						</tr>
					
						<?php
						}
					?>
                </tbody>
                <tfoot>
                  <th style="text-align: center">No</th>
                  <th style="text-align: center">Judul</th>
				  <th style="text-align: center">Tentang</th>
				  <th style="text-align: center">Detail</th>
                  <th style="text-align: center">URL</th>
				  <th style="text-align: center">Image</th>
                  <th>Action</th>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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