<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UMKM | <?= $title ?></title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
 
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/bootstrap-datetimepicker.css">
  
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">

  
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">
  
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
  
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/select2.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">
  
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/flat/blue.css">
  
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/morris/morris.css">
  
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css">
  
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  
  <!-- Icon -->
  <link rel="icon" href="<?= base_url() ?>assets/dist/img/icon_header.png">
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
  <!--<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.css">-->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url() ?>dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>UM</b>KM</span>
     
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>UMKM</b> Room</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <?php //print_r($user); exit; ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user-circle-o"></i><span class="hidden-xs"><?= ucwords($this->session->userdata['isLogin']['userFullName']) ?></span>
            </a>
            <ul class="dropdown-menu">
			  <!-- User image -->
              <li class="user-header">
                <!--<img src="" class="img-circle" alt="User Image">-->
				<?php
					if(!empty($user[0]['userImgName'])){
						$image=base_url()."assets/dist/img/upload/".$user[0]['userImgName'].$user[0]['userImgType'];
						$style="width:80px; height:100px";
					}else{
						$image=base_url()."assets/dist/img/account_white.png";
						$style="";
					}
					?>
				<img class="img-circle" style= "<?= $style ?>" src="<?= $image ?>">
                <p>
                  <?= ucwords($this->session->userdata('isLogin')['userFullName']) ?>
                  <small>Usaha Mikro, Kecil, dan Menengah</small>
                </p>
              </li>
			  
              <!-- Menu Footer-->
              <li class="user-footer">
			  
			  <?php
					$disabled='';
					$href= base_url()."users";
					if($this->session->userdata('isLogin')['userStatus'] != 1){
						$disabled = "disabled = 'disabled'";
						$href = "#";
					}
				?>
			  
                <div class="pull-left">
                  <a <?= $disabled ?> href=<?= $href ?> class="btn btn-default btn-flat">Users</a>
                </div>
				<div class="pull-right">
                  <a href="<?= base_url() ?>dashboard/LogOut" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="position: fixed">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
	  <?= $cek_user_status = $this->session->userdata('isLogin')['userStatus']; //print_r($cek_user_status); exit;?>
	  
	  <!--Sidebar Navigasi Profile -->
	  <div class="user-panel" style="margin-bottom: 15px">
        <div class="pull-left image">
			<?php
				if(!empty($user[0]['userImgName'])){
					$image=base_url()."assets/dist/img/upload/".$user[0]['userImgName'].$user[0]['userImgType'];
				}else{
					$image=base_url()."assets/dist/img/account_white.png";
				}
			?>
          <img src="<?= $image ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= ucwords($this->session->userdata('isLogin')['userFullName']) ?></p>
          <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        
        <li class="treeview">
          <ul class="treeview-menu">
            <li><a href="<?= base_url() ?>layout/top_nav"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="<?= base_url() ?>layout/fixed"><i class="fa fa-circle-o"></i> Fixed</a></li>
          </ul>
        </li>
		
		<?php 
				if($this->session->userdata('isLogin')['userStatus'] == 1){
			?>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url() ?>users"><i class="fa fa-circle-o"></i> List Pengguna </a></li>
            <li><a href="<?= base_url() ?>users/add"><i class="fa fa-circle-o"></i> Tambah Pengguna </a></li>
          </ul>
        </li>
		
			<?php
				}
		?>
		
		<li class="treeview">
          <a href="#">
            <i class="fa fa-video-camera"></i> <span>Video</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?= base_url() ?>video"><i class="fa fa-circle-o"></i>List Video </a></li>
            <li><a href="<?= base_url() ?>video/add"><i class="fa fa-circle-o"></i> Tambah Video </a></li>
          </ul>
        </li>
		
		<li class="treeview">
          <a href="<?= base_url('setting') ?>">
            <i class="fa fa-gear"></i> <span>Pengaturan</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>