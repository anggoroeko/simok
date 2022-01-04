<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Video
        <!-- <small>Advanced form element</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Video</a></li>
        <li class="active">Tambah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <form action="/video/added" method="post" enctype="multipart/form-data">
            
            <!-- Judul Video -->
            <div class="box-header">
              <h3 class="box-title">Judul Video</h3>
            </div>
            <div class="box-body pad">
              <input required name="title" class="form-control" type="text" placeholder="Judul Video">
            </div>
			
			<!-- Tentang Video -->
			<div class="box-header">
              <h3 class="box-title">Tentang Video</h3>
            </div>
            <div class="box-body pad">
              <textarea style="width:50%; height:100px" name="about" class="form-control" type="text" placeholder="Tentang Video"></textarea>
            </div>

            <!-- Url Video -->
            <div class="box-header">
              <h3 class="box-title">Url Video</h3>
            </div>
            <div class="box-body pad">
              <input required name="url" class="form-control" type="text" placeholder="Url Video">
            </div>
			
            <!-- konten video -->
            <div class="box-header">
              <h3 class="box-title">Detail Video</h3>
            </div>
             <div class="box-body pad">
				<textarea id="editor1" name="editor1" rows="10" cols="80"><strong><span style="color: #999"></span></strong>&nbsp; </textarea>
            </div>
           
            <!-- Buton -->
            <div class="box-header">
              <div class="row">
                <div class="col-sm-2">
                  <button type="submit"class="btn btn-block btn-primary">Submit</button>
                </div>
              </div>
            </div>
            
            <!-- <div class="row">
              <div class="col-xs-2">
                <button type="submit" class="btn btn-block btn-success btn-lg">Sign In</button>
              </div>
            </div> -->
          </form>
          
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