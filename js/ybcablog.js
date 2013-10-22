(function($) {

	var isLegacy = $('html').hasClass('legacy');

	function doWeatherOverlay() {

		if ( $('.weather').hasClass('withoverlay') ) {
			// don't do
		} else {
			
			var icon = $.cookie('weathericon');
			var overlayColor = "";

			
			// clear-day, clear-night, rain, snow, sleet, wind, fog, cloudy, partly-cloudy-day, or partly-cloudy-night

			if ( icon == 'clear-night' ) {
				var overlayColor = "clear-night";
			} else if ( icon == 'clear-day' ) {
				var overlayColor = "clear-day";
			} else if ( icon == 'rain' ) {
				var overlayColor = "rain";
			} else if ( icon == 'snow' ) {
				var overlayColor = "snow";
			} else if ( icon == 'sleet' ) {
				var overlayColor = "sleet";
			} else if ( icon == 'wind' ) {
				var overlayColor = "wind";
			} else if ( icon == 'cloudy' || icon === 'fog' ) {
				var overlayColor = "fog";
			} else if ( 'partly-cloudy-day' ) {
				var overlayColor = "partly-cloudy-day";
			} else if ( icon == 'partly-cloudy-night' ) {
				var overlayColor = "partly-cloudy-night";
			} else {
				var overlayColor = "clear-day";
			}

			$('body').append('<div id="weatherOverlay" class="' + overlayColor + '"><div id="weatherBanner"></div></div>');

			$('.weather').addClass('withoverlay');
			$('.logo').addClass('withoverlay');	

			$.cookie('seenweather', true, { path: '/' });

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
		if ( weather ) {

			$('.weather').html(weather + ' on 3rd and Mission');
			
			var seenweather = $.cookie('seenweather');
			if ( !seenweather ) {
				doWeatherOverlay();
			}

		} else {

			// Set weather cookie
			$.getJSON('https://api.forecast.io/forecast/d80d090ce462f2c95ea1627fa7077ce6/' + 37.7857984 + ',' + -122.40242380000001 + "?callback=?", function(data1) {
				$.cookie('weather', data1.currently.summary, { path: '/' });
				$.cookie('weathericon', data1.currently.icon, { path: '/' });
				theWeather();
			});

		}

	}


	$(document).ready( function() {
		if ( !isLegacy ) {

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

		}
	});

	$(window).load( function() {
		if ( !isLegacy ) {

			$('.masonry').packery({
		        itemSelector: '.brick'
		    });
		}
	});





})(jQuery);
