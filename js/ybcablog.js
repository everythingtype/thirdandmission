(function($) {

	function doListView() {
		$('#viewgrid').removeClass('selected');
		$('#viewlist').addClass('selected');
		
		$('.masonry').addClass('listview');

		$('.masonry').packery({
	        itemSelector: '.brick'
	    });

		$.cookie('listview', true, { path: '/' });
	}

	function doGridView() {
		$('#viewlist').removeClass('selected');
		$('#viewgrid').addClass('selected');

		$('.masonry').removeClass('listview');

		$('.masonry').packery({
	        itemSelector: '.brick'
	    });

		$.removeCookie('listview', { path: '/' });
	}

	function initialize() {

		var listview = $.cookie('listview');

		if ( listview ) {
			doListView();
		}

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

		$('#viewgrid').live('click', function() {
			doGridView();
		});

		$('#viewlist').live('click', function() {
			doListView();
		});


	});

	$(window).load( function() {
		$('.masonry').packery({
	        itemSelector: '.brick'
	    });
	});


})(jQuery);