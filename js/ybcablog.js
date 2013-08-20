(function($) {

	function initialize() {

		$('body').addClass('js');

		$('.navcontainer').before('<div class="menutoggle"><span class="amp">+</span> <span class="goto">Go to...</span></div>');

	}

	$(document).ready( function() {

		initialize();


		$('.masonry').packery({
	        itemSelector: '.brick'
	    });


		$('.menutoggle').live('click', function() {
			$(this).hide();
			$('.navcontainer').show();
		});

		$('.search label').live('click', function() {
			$(this).hide();
			$('.searchinput').show();
		});


	});

	$(window).load( function() {
		$('.masonry').packery({
	        itemSelector: '.brick'
	    });
	});


})(jQuery);