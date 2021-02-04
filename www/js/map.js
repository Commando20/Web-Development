var lat, long; //Global variables

$('#currentlocation').click(function () { //set click event for current location button
	document.addEventListener("deviceready", onDeviceReadyMap, false); //Event listener for cordova device
});

function onDeviceReadyMap() { //Once Cordova is fully loaded
	console.log("navigator.geolocation works well");
	navigator.geolocation.getCurrentPosition(onSuccess, onError,
		{ enableHighAccuracy: true, timeout: 20000 });
}

function onSuccess(position) { //Device API is safe to use
	lat = position.coords.latitude; //Set variables with current position
	long = position.coords.longitude;
	googleMaps(); //Google map function call
	
	document.getElementById('info').style.display = "none"; //Remove info if no input is entered
	var token = window.sessionStorage.getItem("token"); //Get token for Yahoo Weather API
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var object = JSON.parse(this.response); //Parse string value of request into JSON object
			lat = object.location.lat; //Change global variables to location that user inputs
			long = object.location.long;
			googleMaps(); //Call google maps to update map to location user inputs
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
	//Hide all items from the other pages upon entering
	$('#map-canvas').hide();
	$('#forecast').hide();
	$('#currencypage').hide();
	
	$('#home').click(function () { //When home button is clicked, hide all other pages and their contents except the content in the home screen
		$('#welcome').show();
		$('#login').show();
		$('#map-canvas').hide();
		$('#forecast').hide();
		$('#currencypage').hide();
		$('#content').css("background", "url('../img/homescreen.png') no-repeat center center fixed");
	});
	
	$('#map').click(function () { //When map button is clicked, hide all other pages and their contents except the content in the map screen.
		$('#welcome').hide();
		$('#login').hide();
		$('#map-canvas').show();
		$('#forecast').hide();
		$('#currencypage').hide();
		$('#content').css("background", "whitesmoke");
	});
	
	var getInfo = function () {
		var location = $('#box').val(); //Gets value of input from search box

		$('#search').click(function () { //Event when search button is clicked
				document.getElementById('info').style.display = "none";
				var token = window.sessionStorage.getItem("token"); //Get token for Yahoo Weather API
				var xhr = new XMLHttpRequest(); //Set a XML object into a variable
				xhr.onreadystatechange = function () { //When the readystate changes, load function for getting currency
					if (this.readyState == 4 && this.status == 200) { //If not a bad request or any other error, execute
						var object = JSON.parse(this.response); //parse string value of XML request into a JSON object
						lat = object.location.lat; //Change global variables to location that user inputs
						long = object.location.long;
						googleMaps(); //Call google maps to update map to location user inputs
					}
				};
				xhr.open('GET', 'https://weather-ydn-yql.media.yahoo.com/forecastrss?location=' + location + '&format=json'); //URL to connect to Yahoo Weather API

				//Set header for OAuth
				xhr.setRequestHeader("Authorization", "Bearer " + token);
				xhr.send();
		});		
	};

	$('#search').click(getInfo); //Add a click listener to the search button
	$('#currentlocation').click(getInfo); //Add a click listener to the current location button
});