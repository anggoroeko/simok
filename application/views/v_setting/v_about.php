<div class="tab-pane" id="tab_4">
	<form action="/setting/update/v_about" method="post" enctype="multipart/form-data">
	
	<?php
		if(!empty($data)){
		?>
	
	  <input type="hidden" name="id" value="">
	  <!--Footer About-->
	  <div class="box-header">
		<h3 class="box-title">Tentang Kami</h3>
	  </div>
	  <div class="box-body pad">
		<textarea id="editor2" name="nm-ttg" rows="10" cols="80"><?= $data[0]['settAbout'] ?></textarea>
	  </div>
	 

	  <!-- Buton -->
	  <div class="box-footer">
		  <div class="col-sm-2">
			<button type="submit"class="btn btn-block btn-primary">Submit</button>
		  </div>
	  </div>
	  
	  <!-- <div class="row">
		<div class="col-xs-2">
		  <button type="submit" class="btn btn-block btn-success btn-lg">Sign In</button>
		</div>
	  </div> -->
	  
		<?php
		}
	  ?>
	  
	</form>
</div>