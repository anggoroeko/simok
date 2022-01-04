<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> <?php //print_r($data); die; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data KB
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
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"> No KB : <?= $data['hits']['hits'][0]['_source']['number_of_kb'] ?> </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <dl>
                  <dt>Project Name</dt>
                  <dd> <?= $data['hits']['hits'][0]['_source']['project_name_kb'] ?> </dd><br>

                  <dt>Client Contract</dt>
                  <dd> <?= $data['hits']['hits'][0]['_source']['client_contract'] ?> </dd><br>
                  
                  <dt>Partner</dt>
                  <dd> <?= ucwords($data['hits']['hits'][0]['_source']['partner_name']) ?> </dd><br>

                  <dt>Value</dt>
                  <dd> Rp<?= number_format($data['hits']['hits'][0]['_source']['project_value'], 0, "", ".") ?> </dd>
                </dl>
              </div>
              
              <div class="col-md-6">
                <dl>
                  <dt>Contract Date</dt>
                  <dd> <?= date("D, d-M-Y", strtotime($data['hits']['hits'][0]['_source']['contract_date'])) ?> </dd><br>

                  <dt>Start Date</dt>
                  <dd> <?= date("D, d-M-Y", strtotime($data['hits']['hits'][0]['_source']['start_date'])) ?> </dd><br>
                  
                  <dt>End Date</dt>
                  <dd> <?= date("D, d-M-Y", strtotime($data['hits']['hits'][0]['_source']['end_date'])) ?> </dd><br>

                  <?php
                    if(!empty($data['hits']['hits'][0]['_source']['position_file'])){
                  ?>

                  <dt>File KB</dt>
                  <dd><a target=_blank href=/datakb/download?url=<?= $data['hits']['hits'][0]['_source']['position_file'] ?>><img width="10%" src="/assets/dist/img/documents-icon.png"></a></dd>
                  
                  <?php
                    }
                  ?>

                </dl>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-12">
          <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <h4>
              Data KL
              <!-- <small>Advanced form element</small> -->
              </h4>
              <div class="table-responsive">
                <table id="data_table_server_kl_on_kb" class="table table-bordered table-striped">
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
                    <th style="text-align: center;">CC</th>
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
                    <th style="text-align: center;">CC</th>
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