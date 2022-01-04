<div class="tab-pane active" id="tab_1">
  <form action="<?= base_url('setting'); ?>" method="post" enctype="multipart/form-data">
  
  <?php //print_r(URL_IMG); exit;
		if(!empty($data)){
		?>
  
	<h4>Logo</h4>
	<center>
		<img src="<?= URL_IMG ?>assets/dist/img/<?= $data[0]['settImgHeader'] ?>" id="gambar_nodin" alt="Preview Gambar" style="width:35%;height:35%"/>
	</center>
	
	<br>
	
	<input id="preview_gambar" name="gambar" type="file" class="form-control">
	
	<br><hr>
	
	<h4>Favicon</h4>
	<center>
		<img src="<?= URL_IMG ?>assets/dist/img/<?= $data[0]['settImgFavicon'] ?>" id="gambar_nodin" alt="Preview Gambar" style="width:35%;height:35%"/>
	</center>
	
	<br>
	
	<input id="preview_gambar" name="gambar" type="file" class="form-control">
	
	<br>
	
	<div class="box-footer">
		<div class="col-sm-2">
			<button type="submit"class="btn btn-block btn-primary">Update Logo</button>
		</div>
	</div>
	
		<?php
		}
	?>
	
  </form>
</div>