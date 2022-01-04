<div class="tab-pane" id="tab_2">
	<form action="/setting/update/v_title" method="post" enctype="multipart/form-data">
	
	<?php
		if(!empty($data)){
		?>
	
		<div class="row">
			<div class="col-md-6">
			  <h4>Judul</h4>
			  <textarea style="width:500px; height: 90px" id="id_txt_title" name="title" type="text" class="form-control"> <?= $data[0]['settTitle'] ?> </textarea>
			</div>
			
			<div class="col-md-6">
			  <h4>Slogan</h4>
			  <textarea style="width:500px; height: 90px" id="id_txt_slogan" name="slogan" type="text" class="form-control"> <?= $data[0]['settSlogan'] ?> </textarea>
			</div>
		</div>
		<br>
	  <div class="box-footer">
		  <div class="col-sm-2">
			<button type="submit"class="btn btn-block btn-primary">Update Judul</button>
		  </div>
	  </div>
	  
		<?php
		}
	  ?>
	  
	</form>
</div>