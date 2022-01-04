<div class="tab-pane" id="tab_3">
	<form action="/setting/update/v_general_content" method="post" enctype="multipart/form-data">
	
	<?php //print_r($data); exit;
		if(!empty($data)){
		?>
	
	  <input type="hidden" name="id" value="">
	  <!--Footer Address-->
	  <div class="box-header">
		<h3 class="box-title">Footer Address</h3>
	  </div>
	  <div class="box-body pad">
		<textarea id="editor1" name="nm-ft-about" rows="10" cols="80"><?= $data[0]['settAddress'] ?></textarea>
	  </div>

	  <!-- Contact Email -->
	  <div class="box-header">
		<h3 class="box-title">Email</h3>
	  </div>
	  <div class="box-body pad">
		<input required name="contact_email" class="form-control" type="email" placeholder="Email" value="<?= $data[0]['settEmail'] ?>">
	  </div>   

	  <!-- Contact Facebook -->
	  <div class="box-header">
		<h3 class="box-title">Facebook</h3>
	  </div>
	  <div class="box-body pad">
		<input name="contact_fb" class="form-control" type="text" placeholder="Facebook" value="<?= $data[0]['settFacebook'] ?>">
	  </div>
	  
	  <!-- Contact Twitter -->
	  <div class="box-header">
		<h3 class="box-title">Twitter</h3>
	  </div>
	  <div class="box-body pad">
		<input name="contact_twit" class="form-control" type="text" placeholder="Twitter" value="<?= $data[0]['settTwitter'] ?>">
	  </div>
	  
	  <!-- Contact Instagram -->
	  <div class="box-header">
		<h3 class="box-title">Instagram</h3>
	  </div>
	  <div class="box-body pad">
		<input name="contact_ig" class="form-control" type="text" placeholder="Instagram" value="<?= $data[0]['settInstagram'] ?>">
	  </div>

	  <!-- Contact Phone -->
	  <div class="box-header">
		<h3 class="box-title">Phone</h3>
	  </div>
	  <div class="box-body pad">
		<input maxlength="20" required name="contact_phone" class="form-control" type="text" placeholder="Phone" value="<?= $data[0]['settPhone'] ?>">
	  </div>
	  
	  <!-- Contact Fax -->
	  <div class="box-header">
		<h3 class="box-title">Fax</h3>
	  </div>
	  <div class="box-body pad">
		<input name="contact_fax" class="form-control" type="text" placeholder="Fax" value="<?= $data[0]['settFax'] ?>">
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