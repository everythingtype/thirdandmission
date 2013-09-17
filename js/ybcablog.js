(function($) {

	function doWeatherOverlay() {

		if ( $('.weather').hasClass('withoverlay') ) {
			// don't do
		} else {
			
			var icon = $.cookie('weathericon');

			// clear-day, clear-night, rain, snow, sleet, wind, fog, cloudy, partly-cloudy-day, or partly-cloudy-night

			if ( icon === 'fog' ) {
				var overlayColor = "fog";
			} else if ( icon === 'clear-night' ||  icon === 'partly-cloudy-night' ) {
				var overlayColor = "clear-night";
			} else {
				var overlayColor = "clear-day";
			}

			$('body').append('<div id="weatherOverlay" class="' + overlayColor + '"><div id="weatherBanner"></div></div>');
	//		$.cookie('seenweather', true, { path: '/' });

			$('.weather').addClass('withoverlay');
			$('.logo').addClass('withoverlay');	
					
		}

	}

	function removeWeatherOverlay() {
		$('#weatherOverlay').remove();
		$('.weather').removeClass('withoverlay');
		$('.logo').removeClass('withoverlay');
	
	}

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

	function theWeather() {
		
		var weather = $.cookie('weather');
//		var weather = false;
		if ( weather ) {

//			console.log("Have cookie");
			$('.weather').html(weather + ' on 3rd and Mission');
			
		} else {

//			console.log("No cookie");

			// Set weather cookie
			$.getJSON('https://api.forecast.io/forecast/d80d090ce462f2c95ea1627fa7077ce6/' + 37.7857984 + ',' + -122.40242380000001 + "?callback=?", function(data1) {
				$.cookie('weather', data1.currently.summary, { path: '/' });
				$.cookie('weathericon', data1.currently.icon, { path: '/' });
				theWeather();
			});			



		}

		var seenweather = $.cookie('seenweather');

		if ( !seenweather ) {
			doWeatherOverlay()
		}


	}

	$(document).ready( function() {

		initialize();
		theWeather();

		$('.weather').live('click', function() {
			doWeatherOverlay();
		});

		$('#weatherOverlay').live('click', function() {
			removeWeatherOverlay();
		});

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


	// $(".myBox").click(function(){
	//      window.location=$(this).find("a").attr("href"); 
	//      return false;
	// });

})(jQuery);
