<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengaturan
        <!-- <small>Advanced form element</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Setting</a></li>
      </ol>
    </section>
	
	<?= $this->session->flashdata('pesan') ?>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Logo</a></li>
              <li><a href="#tab_2" data-toggle="tab">Judul</a></li>
              <li><a href="#tab_3" data-toggle="tab">Konten Umum</a></li>
              <li><a href="#tab_4" data-toggle="tab">Tentang Kami</a></li>
            </ul>
            <div class="tab-content">
				<?php @require('v_logo.php') ?>
				<?php @require('v_title.php') ?>
				<?php @require('v_general_content.php') ?>
				<?php @require('v_about.php') ?>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
    </section>
   
    <!-- /.content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->