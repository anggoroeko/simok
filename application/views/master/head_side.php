<!DOCTYPE html> <?php //print_r($menu); die; ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sila | <?= $title ?></title>
  
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
  <link rel="shortcut icon" href="<?=base_url()?>assets/dist/img/logo_telkom_2.png">
  
  <!-- bootstrap wysihtml5 - text editor
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
  <!--<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.css">-->
  
  <?php 
    if(!empty($header)) {
      echo $header;
    }
  ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    @media (min-width:360px) and (max-width:800px){
      .logo-piltok{
        max-width:80%; 
        background-color: white; 
        padding: 5px; 
        border-radius: 5px;
      }
      .logo-2{
        line-height: 45px!important;
      }
    }
    @media (min-width:900px){
      .logo-piltok{
        max-width:100%; 
        background-color: white; 
        padding: 5px; 
        border-radius: 5px
      }
      .logo-2{
        line-height: 46px!important;
      }
    }

    .go-top{
      position: fixed;
      bottom: 25px;
      right: 25px;
      text-decoration: none;
      color: #fff;
      padding: 15px 15px;
      background: rgba(0,0,0,0.2);
      font-size: 12px;
      display: none;
    }

    .main-footer a:hover{
      background-color : #069E98;
      color: white;
    }

    .main-footer a:focus{
      color: white;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url() ?>dashboard" class="logo logo-2">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>MK</span>
     
      <!-- logo for regular state and mobile devices 
      <span class="logo-lg"><b>UMKM</b> Room</span> --> 
      <div style="max-height: 90%; margin-top: 2px;" class="logo-piltok">
        <img style="max-width: 40%; margin-top: -16px;" src="<?=base_url()?>assets/dist/img/logo_telkom.png" alt="Mountain View" class="">
      </div>
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
              <i class="fa fa-user-circle-o"></i><span class="hidden-xs"><?= ucwords(@$this->session->userdata['isLogin']['userFullName']) ?></span>
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
                  <small>Simok Telkom Indonesia</small>
                </p>
              </li>
			  
              <!-- Menu Footer-->
              <li class="user-footer">
			  
			  <?php
					$disabled='';
					$href= base_url()."users";
					if($this->session->userdata['isLogin']['status_user'] != 1){
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
      <?= $cek_user_status = $this->session->userdata('isLogin')['status_user']; //print_r($cek_user_status); exit;?>
      
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
          <li class="<?= @$menu == 'dashboard' ? 'active' : '' ?>">
            <a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
          </li>
          
          <li class="treeview">
            <ul class="treeview-menu">
              <li><a href="<?= base_url() ?>layout/top_nav"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
              <li><a href="<?= base_url() ?>layout/fixed"><i class="fa fa-circle-o"></i> Fixed</a></li>
            </ul>
          </li>
      
      <?php 
          if($this->session->userdata('isLogin')['status_user'] == 1){
        ?>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= base_url() ?>users"><i class="fa fa-circle-o"></i>List User</a></li>
                <li><a href="<?= base_url() ?>users/add"><i class="fa fa-circle-o"></i>Add User</a></li>
              </ul>
            </li>
          
        <?php
          }
      ?>
      
        <li class="treeview <?= @$menu == 'datakb' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-cubes"></i> <span>Data KB</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= @$submenu == 'list_kb' ? 'active' : '' ?>"><a href="<?=base_url()?>datakb"><i class="fa fa-circle-o active"></i>List KB </a></li>
            
            <?php 
                  if($this->session->userdata['isLogin']['status_user'] == 1){
                ?>

            <li class="<?= @$submenu == 'add_kb' ? 'active' : '' ?>"><a href="<?=base_url()?>datakb/add"><i class="fa fa-circle-o"></i>Add KB</a></li>
        
            <?php
                  }
              /*if((!empty($this->uri->segment(3))) and $this->uri->segment(2) == "image"){
                if($count_image <= 6){*/
              ?>
            
              <!--<li>
                <a href="/datakb/imgadd/<?= $this->uri->segment(3)?>"><i class="fa fa-circle-o"></i>Add Image </a>
              </li>-->
            
              <?php
                /*}
              }*/
            ?>
          </ul>
        </li>

        <li class="treeview <?= @$menu == 'datakl' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-cubes"></i> <span>Data KL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= @$submenu == 'list_kl' ? 'active' : '' ?>"><a href="<?=base_url()?>datakl"><i class="fa fa-circle-o active"></i>List KL </a></li>
            
            <?php 
              if($this->session->userdata['isLogin']['status_user'] == 1){
            ?>

            <li class="<?= @$submenu == 'add_kl' ? 'active' : '' ?>"><a href="<?=base_url()?>datakl/add"><i class="fa fa-circle-o"></i>Add KL</a></li>
        
            <?php
              }
              /*if((!empty($this->uri->segment(3))) and $this->uri->segment(2) == "image"){
                if($count_image <= 6){*/
              ?>
            
              <!--<li>
                <a href="/datakb/imgadd/<?= $this->uri->segment(3)?>"><i class="fa fa-circle-o"></i>Add Image </a>
              </li>-->
            
              <?php
                /*}
              }*/
            ?>
          </ul>
        </li>
      
        
      </ul>
  </section>
  <!-- /.sidebar -->
</aside>
