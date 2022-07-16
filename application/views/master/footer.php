<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> public tester
    </div>
    <strong>Copyright &copy; 2019 <a href="https://www.telkom.co.id" target="_blank">SIMOK Telkom Indonesia</a></strong> All rights reserved.
    <a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>
</footer>
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  
<!-- jQuery 2.2.3 -->
<script src="<?= base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>

<!-- select2 option -->
<script src="<?= base_url() ?>assets/plugins/select2/select2.full.min.js"></script> 

<!-- InputMask -->
<script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Format Date Indonesia -->
<script src="<?= base_url() ?>assets/dist/js/moment-with-locales.js"></script>

<!-- DateTime Picker -->
<script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/dist/js/bootstrap-datetimepicker.js"></script>

<!-- bootstrap time picker -->
<script src="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>

<!-- SlimScroll 1.3.0 -->
<script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- iCheck 1.0.1 -->
<script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>

<!-- FastClick -->
<script src="<?= base_url() ?>assets/plugins/fastclick/fastclick.js"></script>

<!-- page script -->
<script src="<?= base_url() ?>/assets/dist/js/index.js"></script> 

<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- Slimscroll -->
<script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="<?=  base_url() ?>assets/plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/app.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>

<!-- Numeral Js -->
<script src="<?=base_url()?>assets/dist/js/numeral.min.js"></script>
<!--<script src="<?=base_url()?>assets/dist/js/elasticsearch.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/elasticsearch/10.0.1/elasticsearch.min.js"></script>
<script src="<?=base_url()?>assets/dist/js/jquery.elastic-datatables.js"></script>


    <?php  if(!empty($footer)){
            echo $footer;
        }
    ?>

    <script>
        //tambah titik tiap kelipatan 3 di input angka (jumlah uang)
        $('.amount').keyup(function(event) {
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40){
            event.preventDefault();
        }
        $(this).val(function(index, value) {
            return value
                .replace(/\D/g, '')
                //.replace(/([0-9])([0-9]{2})$/, '$1.$2')
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, '.')
            ;
            });
        });
    </script>


    <script>
        function deleteProduct(id){
            swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    buttons: true,
                    }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: '<?php echo base_url('product/deleted'); ?>/' + id,
                            type: "POST",
                            success:function(data, textStatus, xhr){
                                swal({
                                    title: "Message", 
                                    text: "Data Deleted!", 
                                    icon: "success"
                                    }).then(function(){ 
                                        location.reload();
                                    }
                                );
                                //$(location).attr('href','<?php echo base_url()?>product');
                            },

                            error:function(xhr, textStatus, errorThrown){
                                console.log(errorThrown)
                                swal({
                                        icon: 'error',
                                        title: 'Oops... Status : '+errorThrown,
                                        text: "Delete Failed"
                                    })
                            }
                        });
                    }
                });
        }
    </script>

    <script>
    /*var client = elasticsearch.Client({
        host: 'http://103.89.1.46:9238'
    })

    $('#data_table_server_2').DataTable({
        'bProcessing': true,
        'serverSide': true,
        'columns': [
            { 'sTitle': 'Product Name', 'sName': 'prodName' },
            { 'sTitle': 'Price', 'sName': 'prodPrice' },
            { 'sTitle': 'About', 'sName': 'prodSummary' },
            { 'sTitle': 'Detail', 'sName': 'prodDetail' },
            { 'sTitle': 'Saved', 'sName': 'timestamp' }
        ],
        'fnServerData': $.fn.dataTable.elastic_datatables({
            index: 'piltok',
            type: 'docs',
            client,
            body : { 
                query: {
                    match_all: {
                        table: 'product'
                    }
                }
            }
        })
    });*/

    </script>

</body>
</html>
