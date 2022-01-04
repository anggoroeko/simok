$(function(){ 

	// $(document).ready(function() {
	// 	$('#idBtLang').click(function() {
	// 		$.ajax({
	// 			type : 'POST',
	// 			url : 'index.php/e_sosial/login_ind',
	// 			cache: false
	// 		});
	// 	});
	// });

	//show registration
	$('#show-regis').click(function(){
		$('#form-regis').delay(100).fadeIn(100);
		$('#form-login').fadeOut(100);
		// $('#show-login').removeClass('active');
	})
	//show registration

	//show login
	$('#show-login').click(function(){
		$('#form-login').delay(100).fadeIn(100);
		$('#form-regis').fadeOut(100);
		// $('#show-regis').removeClass('active');
	})
	//show login

	$('#caret-rotate').click(function(){
 			$('.rotate').toggleClass('down'); 
	})

	$('#navbar-full').click(function(){
		$('.rotate').toggleClass('down');
	})

	$(document).click(function(){
		$('.rotate').removeClass('down'); //Remove rotate if click function in window
	})

	//Add Dropdown Effect
		$('.dropdown').on('show.bs.dropdown', function(){
		  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
		});
	
		$('.dropdown').on('hide.bs.dropdown', function(){
		  $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
		});
	//Add Dropdown Effect
	
	//sidebar animation
		$(document).ready(function(){
			$(".btSidebar").click(function(){
				$("#openSidebar").toggle("slide");
				$(this).toggleClass('clicked');
				$("#openSidebar").show();
	         });
		});
    //sidebar animation
});

