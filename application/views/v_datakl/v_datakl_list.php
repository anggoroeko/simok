<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data KL
        <!-- <small>Advanced form element</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><i class="fa fa-cubes"></i> KB </a></li>
      </ol>
    </section>
	
	<?=$this->session->flashdata('pesan')?>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div style="border-bottom:1px solid #f4f4f4">
              <div class="panel-body ">
                <form id="form-filter" class="form-horizontal">
                    <div class="form-group">
                        <label for="year" class="col-sm-1 control-label">Year</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="filter_by_year" id="filter_year"> 
                              <option value=""> -- Select Year -- </option>

                              <?php
                                  for($a=2009; $a<2021; $a++){
                                    ?>

                                    <option value="<?= $a ?>"> <?= $a ?> </option>

                                    <?php
                                  }
                                ?>

                            </select>
                        </div>
                    </div>
                        <label for="LastName" class="col-sm-1 control-label"></label>
                        <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                        <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                        <a target="_blank" href="datakl/export_excel">
                          <button type="button" class="btn btn-success">Export KL</button>
                        </a>
                </form>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
              <table id="data_table_server_kl" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Identity Project</th>
                    <th style="text-align: center;">Contract Date</th>
                    <th style="text-align: center;">Start</th>
                    <th style="text-align: center;">End</th>
                    <th style="text-align: center;">Project</th>
                    <th style="text-align: center;">Value</th>
                    <th style="text-align: center;">Segment</th>
                    <th style="text-align: center;">Client Contract</th>
                    <th style="text-align: center;">Partner</th>
                    <th style="text-align: center;">File</th>
                    <th style="text-align: center; max-width: 12%">Saved</th>
                    <th style="text-align: center">Action</th>
                  </tr>
                  </thead>

                  <tbody>
                
                  </tbody>
                  
                  <tfoot>
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Identity Project</th>
                    <th style="text-align: center;">Contract Date</th>
                    <th style="text-align: center;">Start</th>
                    <th style="text-align: center;">End</th>
                    <th style="text-align: center;">Project</th>
                    <th style="text-align: center;">Value</th>
                    <th style="text-align: center;">Segment</th>
                    <th style="text-align: center;">Client Contract</th>
                    <th style="text-align: center;">Partner</th>
                    <th style="text-align: center;">File</th>
                    <th style="text-align: center; max-width: 12%">Saved</th>
                    <th style="text-align: center">Action</th>
                  </tfoot>
                </table>
              </div>
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
