var lat, long; //Global variables

$('#currentlocation').click(function () { //set click event for current location button
	document.addEventListener("deviceready", onDeviceReadyWeather, false); //Event listener for cordova device
});

function onDeviceReadyWeather() { //Once Cordova is fully loaded
	console.log("navigator.geolocation works well");
	navigator.geolocation.getCurrentPosition(onSuccess, onError,
		{ enableHighAccuracy: true, timeout: 20000 });
}

function onSuccess(position) { //Device API is safe to use (this function is for getting current location)
	lat = position.coords.latitude; //Set variables with current position
	long = position.coords.longitude;
	googleMaps(); //Google map function call
	
	document.getElementById('info').style.display = "none";
	var token = window.sessionStorage.getItem("token"); //Get token for Yahoo Weather API
	var xhr = new XMLHttpRequest(); //Set a XML object into a variable
	xhr.onreadystatechange = function () { //When the readystate changes, load function for getting currency
		if (this.readyState == 4 && this.status == 200) { //If not a bad request or any other error, execute
			var object = JSON.parse(this.response); //parse string value of XML request into a JSON object
			console.log(this.response);
			
			//Output necessary information from JSON object
			$('#area').html("<p style='font-size: 50px;'>" + object.location.city + "</p>");

			$('#main').html("<p style='margin-top: -35px; font-size: 30px;'>" + object.current_observation.condition.text + "</p>");

			$('#temp').html("<p style='margin-top: -35px;'>" + object.current_observation.condition.temperature + "&#176 F</p>");

			$('#maxmin').html("<p style='margin-top: -55px;font-size: 25px;'>" + object.forecasts[0].high + "&#176 F / " + object.forecasts[0].low + "&#176 F</p>");

			$('#wind').before("<hr class='line'>");
			$('#wind').html("<p>Wind: " + object.current_observation.wind.speed + " mi/hr</p>");

			$('#pressure').before("<hr class='line'>");
			$('#pressure').html("<p>Pressure: " + object.current_observation.atmosphere.pressure + " inch Hg</p>");

			$('#humidity').before("<hr class='line'>");
			$('#humidity').html("<p>Humidity: " + object.current_observation.atmosphere.humidity + "%</p>");

			$('#sun').before("<hr class='line'>");
			$('#sun').html("<p style='font-size: 27px;'>Sunrise: " + object.current_observation.astronomy.sunrise + "<span style='float: right;'>Sunset: " + object.current_observation.astronomy.sunset + "</span></p>");

			$('#coordinates').before("<hr class='line'>");
			$('#coordinates').html("<p>Coordinates: " + object.location.lat.toFixed(2) + "&#176 , " + object.location.long.toFixed(2) + "&#176</p>");
			$('#coordinates').after("<hr class='line'>");
		}
	};
	xhr.open('GET', 'https://weather-ydn-yql.media.yahoo.com/forecastrss?lat=' + lat + '&lon=' + long + '&format=json'); //URL to connect to Yahoo Weather API

	//Set header for OAuth
	xhr.setRequestHeader("Authorization", "Bearer " + token);
	xhr.send();
}

function onError(error) { //Function for when Cordova device is not safe to use
	alert('code: ' + error.code + '\n' +
		'message: ' + error.message + '\n');
}

function googleMaps() { //Function that gets google maps API
	//Google Maps
	var myLatlng = new google.maps.LatLng(lat, long);
	var mapOptions = {
		zoom: 15,
		center: myLatlng
	}
	
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
	});
}

$(document).ready(function () { //When DOM has been loaded
	$('#map-canvas').hide();
	$('#forecast').hide();
	$('#currencypage').hide();
	
	$('#home').click(function () {
		$('#welcome').show();
		$('#login').show();
		$('#forecast').hide();
		$('#map-canvas').hide();
		$('#currencypage').hide();
		$('#content').css("background", "url('../img/homescreen.png') no-repeat center center fixed");
	});
	
	$('#weather').click(function () {
		$('#welcome').hide();
		$('#login').hide();
		$('#map-canvas').hide();
		$('#forecast').show();
		$('#currencypage').hide();
		$('#content').css("background", "url('../img/clearsky.jpg')");
	});

	var getInfo = function () {
		var location = $('#box').val(); //Gets value of input from search box

		$('#search').click(function () { //Event when search button is clicked 
			if (location === '') { //If user did not insert anything
				$('#info').html("<h4>It seems that you have entered nothing</h4>");
			} else { 
				document.getElementById('info').style.display = "none";
				var token = window.sessionStorage.getItem("token"); //Get token for Yahoo Weather API
				var xhr = new XMLHttpRequest(); //Set a XML object into a variable
				xhr.onreadystatechange = function () { //When the readystate changes, load function for getting currency
					if (this.readyState == 4 && this.status == 200) { //If not a bad request or any other error, execute
						var object = JSON.parse(this.response); //parse string value of XML request into a JSON object
						console.log(this.response);
						
						//Output necessary information from JSON object	
						$('#area').html("<p style='font-size: 50px;'>" + object.location.city + "</p>");

						$('#main').html("<p style='margin-top: -35px; font-size: 30px;'>" + object.current_observation.condition.text + "</p>");

						$('#temp').html("<p style='margin-top: -35px;'>" + object.current_observation.condition.temperature + "&#176 F</p>");

						$('#maxmin').html("<p style='margin-top: -55px;font-size: 25px;'>" + object.forecasts[0].high + "&#176 F / " + object.forecasts[0].low + "&#176 F</p>");

						$('#wind').before("<hr class='line'>");
						$('#wind').html("<p>Wind: " + object.current_observation.wind.speed + " mi/hr</p>");

						$('#pressure').before("<hr class='line'>");
						$('#pressure').html("<p>Pressure: " + object.current_observation.atmosphere.pressure + " inch Hg</p>");

						$('#humidity').before("<hr class='line'>");
						$('#humidity').html("<p>Humidity: " + object.current_observation.atmosphere.humidity + "%</p>");
						
						$('#sun').before("<hr class='line'>");
						$('#sun').html("<p style='font-size: 27px;'>Sunrise: " + object.current_observation.astronomy.sunrise + "<span style='float: right;'>Sunset: " + object.current_observation.astronomy.sunset + "</span></p>");

						$('#coordinates').before("<hr class='line'>");
						$('#coordinates').html("<p>Coordinates: " + object.location.lat.toFixed(2) + "&#176 , " + object.location.long.toFixed(2) + "&#176</p>");
						$('#coordinates').after("<hr class='line'>");
					}
				};
				xhr.open('GET', 'https://weather-ydn-yql.media.yahoo.com/forecastrss?location=' + location + '&format=json'); //URL to connect to Yahoo Weather API

				//Set header for OAuth
				xhr.setRequestHeader("Authorization", "Bearer " + token);
				xhr.send();
			}
		});		
	};

	$('#search').click(getInfo); //Add a click listener to the search button
	$('#currentlocation').click(getInfo); //Add a click listener to the current location button

});