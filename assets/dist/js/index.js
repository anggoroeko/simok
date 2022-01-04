
  $(function () {
  	//initialize select2 elements
    $(".select2").select2();
    
     $("#datepicker_realisasi").datepicker({ 
     	format: "yyyy-mm-dd",
     	autoclose: true
     });
     
     $('#datepicker_realisasi2').datepicker({
     	format: "yyyy-mm-dd",
     	autoclose: true
     });
     
     $('#datepicker_filter').datetimepicker({
     	locale:'id',
   		format:'MMMM YYYY',
     });
	 
	 $('#id_awal2').datepicker({
		 format: "yyyy-mm-dd",
		 autoclose: true
	 });
	 
	 $('#id_akhir2').datepicker({
		 format: "yyyy-mm-dd",
		 autoclose: true
	 });
     
     $("#id_tempo").datepicker({
     	format: "yyyy-mm-dd",
     	autoclose: true
     });
     
     $("#id_tempo2").datepicker({
     	format: "yyyy-mm-dd",
     	autoclose: true
     });
	 
	  $("#id_purchase").datepicker({
     	format: "yyyy-mm-dd",
     	autoclose: true
     });
     
     $("#date_progress").datepicker({
     	format: "yyyy-mm-dd",
     	autoclose: true	
     });
     
     $("#date_progress2").datepicker({
     	format: "yyyy-mm-dd",
     	autoclose: true	
     });
	 
	 $("#datepicker_date_accepted").datepicker({
		 format: "yyyy-mm-dd",
		 autoclose: true
	 });
	 
	  
	 $("#datepicker_date_paid").datepicker({
		 format: "yyyy-mm-dd",
		 autoclose: true
	 });
    
    $("#example1").DataTable({
    	"responsive" : true	
    });
	
	$("#tab_ar").DataTable({
    	"responsive" : true	
    });
	
	$("#tab_detail_ar").DataTable({
		"responsive" : true
	});
	
	$("#tab_bd").DataTable({
		"responsive" : true
	});
	
	$("#tab_detail_bd").DataTable({
		"responsive" : true
	});
	
	$("#tab_sd").DataTable({
		"responsive" : true
	});
	
	$("#tab_tdd").DataTable({
		"responsive" : true
	});
	
	$("#tab_detail_tdd").DataTable({
		"responsive" : true
	});
	
	$("#tab_st").DataTable({
		"responsive" : true,
		"ordering" : true
	});
	
	$("#table_pbb").DataTable({
		"responsive" : true
	});
	
    //iCheck for checkbox and radio inputs
    $('input[type="radio"].minimal').iCheck({
      radioClass: 'iradio_minimal-blue'
    });
    
    //tooltip
    $('[data-toggle="tooltip"]').tooltip();
    
    /*$('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true
    });*/
    
     // jQuery update a column title from the demo table to contain a long description
    // You would not need to do this in your own code.
    //$('#example1 thead tr:eq(0) th:eq(2)').html("This is a really long column title!");
     
    // Wrap the colspan'ing header cells with a span so they can be positioned
    // absolutely - filling the available space, and no more.
   //$('#example1 thead th[colspan]').wrapInner( '<span/>' ).append( '&nbsp;' );
  });
  
  function toUpperFirst(str){
	var str = str.replace(/\b[a-z]/g, function(textUpper){
		return textUpper.toUpperCase();
	})
	return str;
}
