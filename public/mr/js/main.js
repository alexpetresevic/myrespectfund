$(document).ready(function(){
	  $('.bxslider').bxSlider({
	    pager: true,
		autoStart:false,
	    controls: false
	  });
	  $('#mob_menu_main').meanmenu({
		meanMenuContainer: '.header_menu_area',
		meanScreenWidth: "767",
		meanRevealPosition: 'left'
	  });

	 
	$('a#searchkoro').click(function(){
		$('.topbar.mobile_search').slideToggle();
	});
	$('button.close_btn.mobile_clos').click(function(){
		$('.topbar.mobile_search').slideUp();
	});
		
		
	 $('a#search').click(function(){
		$('.topbar.desktop_search').slideToggle();
		});
		$('button.close_btn.desktop_clos').click(function(){
		$('.topbar.desktop_search').slideUp();
		});
		
	$('.dropdown-toggle').dropdown();	
	
	$('a.ReadMore').click(function(){
		event.preventDefault();
		$('.moredetails').toggle('slow');
	});
	
$('#footmenu ul > li.mobsecond_dropli>a').click(function(event){
		event.preventDefault();
		$(this).next('ul.menu_axpand').slideToggle().parents("#footmenu ul > li.mobsecond_dropli").toggleClass('active_plus');
		
	});	
	
	  $('.partner_bxslider').bxSlider({
	    pager: false,
		autoStart:true,
		nextText: '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>',
		prevText: '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>',
	    controls: true
	  });


// accordion
$('.accor_open').click(function(){
	$(this).addClass('acbtn_none').prev().addClass('acbtn_play').parents('.temp_accor_tab').next().slideDown().parent('.temp_accor_single').siblings().find('.temp_accor_tab_content').slideUp().prev().find('.accor_open').removeClass('acbtn_none').prev().removeClass('acbtn_play');
});

$('.accor_close').click(function(){
	$(this).removeClass('acbtn_play').next().removeClass('acbtn_none').parents('.temp_accor_tab').next('.temp_accor_tab_content').slideUp();
});
$('.temp_accor_single:first-child').find('.temp_accor_tab_content').slideDown().prev().find('.accor_open').addClass('acbtn_none').prev().addClass('acbtn_play');

	  
	
});


// sticky header
$(document).scroll(function(e){
    var scrollTop = $(document).scrollTop();
    if(scrollTop > 130){
        //console.log(scrollTop);
        $('#header_sticky').addClass('active_stick');
    } else {
        $('#header_sticky').removeClass('active_stick');
    }
});


	// scroll top
 $('#backtotop, #backtotop1').click(function(){
  $('html, body').animate({scrollTop : 0},800);
  return false;
 });
 
 $(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - $('#header').height()
        }, 500);
        return false;
      }
    }
  });
});
 
// With JQuery
$('#ex1, #ex2, #ex3, #ex4, #ex5, #ex6 , #ex7, #ex8').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});

$("#ex1").on("slide", function(slideEvt) {
	$("#ex1SliderVal").text(slideEvt.value);
});
$("#ex2").on("slide", function(slideEvt) {
	$("#ex2SliderVal").text(slideEvt.value);
});
$("#ex3").on("slide", function(slideEvt) {
	$("#ex3SliderVal").text(slideEvt.value);
});
$("#ex4").on("slide", function(slideEvt) {
	$("#ex4SliderVal").text(slideEvt.value);
});
$("#ex5").on("slide", function(slideEvt) {
	$("#ex5SliderVal").text(slideEvt.value);
});
$("#ex6").on("slide", function(slideEvt) {
	$("#ex6SliderVal").text(slideEvt.value);
});
$("#ex7").on("slide", function(slideEvt) {
	$("#ex7SliderVal").text(slideEvt.value);
});
$("#ex8").on("slide", function(slideEvt) {
	$("#ex8SliderVal").text(slideEvt.value);
});

// autofill 0.00
function fixit( obj ) {  obj.value = parseFloat( obj.value ).toFixed( 2 )  }

$('.testibxslider').bxSlider({
  mode: 'fade',
});


$('button.clickable_amount').click( function() {
   var get_value = $(this).val();
  $('.your_doncheckbox_titl_botm.fix h1 input.take_val').val(get_value);
});




/* custom js */

(function($){
	$(document).ready(function(){
		/*withdrew menu toogle js start 
		$(".withdraw").click(function(){
			$(".withdrw-sub").slideToggle();
		})
		withdrew menu toogle js start */


		/*left=sidebar menu toogle js start */
		$(".mobile-dash-menu").click(function(){
			$(".sdo").slideToggle();
		})
		/*left=sidebar menu toogle js start*/


		/*upload image disable js start 
		$(".cros").click(function(){
			$(this).css("display", "none");
		})
		*/

		$("#repbtnp").click(function(){
			$("#repextp").slideToggle();
		});

		$("#repbtnp2").click(function(){
			$("#repextp2").slideToggle();
		});

		$("#repbtnp3").click(function(){
			$("#repextp3").slideToggle();
		});

		// Gallery hide
		$("#crogal1").click(function(){
			$("#imggal1").hide('slow');
			$(this).hide('hide')
		});
		$("#crogal2").click(function(){
			$("#imggal2").hide('slow');
			$(this).hide('hide')
		});
		$("#crogal3").click(function(){
			$("#imggal3").hide('slow');
			$(this).hide('hide')
		});
		$("#crogal4").click(function(){
			$("#imggal4").hide('slow');
			$(this).hide('hide')
		});
		$("#crogal5").click(function(){
			$("#imggal5").hide('slow');
			$(this).hide('hide')
		});
		$("#crogal6").click(function(){
			$("#imggal6").hide('slow');
			$(this).hide('hide')
		});


	/* popup js start */
	$( ".popin" ).mouseenter(function() {
	$( ".popup" ).css("display", "block");
	});
	$( ".popin" ).mouseleave(function() {
	$( ".popup" ).css("display", "none");
	});	
		
	});
})(jQuery);

