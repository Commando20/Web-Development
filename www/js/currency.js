$(document).ready(function () { //When DOM has been loaded
	$("#map-canvas").hide(); //Hides all pages upon loading
	$("#forecast").hide();
	$("#currencypage").hide();
	
	$("#home").click(function () { //When clicking to homepage, all other pages and their contents will be hidden except for whatever is in homepage
		$("#welcome").show();
		$("#login").show();
		$("#forecast").hide();
		$("#map-canvas").hide();
		$("#currencypage").hide();
		$("#content").css("background", "url('../img/homescreen.png')");
	});
	
	$("#currency").click(function () { //When clicking to currency, all other pages and their contents will be hidden except for whatever is in currency
		$("#welcome").hide();
		$("#login").hide();
		$("#map-canvas").hide();
		$("#forecast").hide();
		$("#currencypage").show();
		$("#content").css("background", "url('../img/homescreen.png')");
		
		console.log("GETTING CURRENCY"); //Outputs this to console log
		var xmlhttp = new XMLHttpRequest(); //Set a XML object into a variable
		xmlhttp.onreadystatechange = function () { //When the readystate changes, load function for getting currency
			if (this.readyState == 4 && this.status == 200) { //If not a bad request or any other error, execute
				var currency = JSON.parse(this.responseText); //parse string value of XML request into a JSON object
				console.log(currency);
				//Sets flag to currency along with its rate to USD
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/ca/shiny/24.png'>CAD</td><td>" + currency.rates.CAD.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/hk/shiny/24.png'>HKD</td><td>" + currency.rates.HKD.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/is/shiny/24.png'>ISK</td><td>" + currency.rates.ISK.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/ph/shiny/24.png'>PHP</td><td>" + currency.rates.PHP.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/dk/shiny/24.png'>DKK</td><td>" + currency.rates.DKK.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/hu/shiny/24.png'>HUF</td><td>" + currency.rates.HUF.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/cz/shiny/24.png'>CZK</td><td>" + currency.rates.CZK.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/gb/shiny/24.png'>GBP</td><td>" + currency.rates.GBP.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/ro/shiny/24.png'>RON</td><td>" + currency.rates.RON.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/se/shiny/24.png'>SEK</td><td>" + currency.rates.SEK.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/id/shiny/24.png'>IDR</td><td>" + currency.rates.IDR.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/in/shiny/24.png'>INR</td><td>" + currency.rates.INR.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/br/shiny/24.png'>BRL</td><td>" + currency.rates.BRL.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/ru/shiny/24.png'>RUB</td><td>" + currency.rates.RUB.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/hr/shiny/24.png'>HRK</td><td>" + currency.rates.HRK.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/jp/shiny/24.png'>JPY</td><td>" + currency.rates.JPY.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/th/shiny/24.png'>THB</td><td>" + currency.rates.THB.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/ch/shiny/24.png'>CHF</td><td>" + currency.rates.CHF.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/eu/shiny/24.png'>EUR</td><td>" + currency.rates.EUR.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/my/shiny/24.png'>MYR</td><td>" + currency.rates.MYR.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/bg/shiny/24.png'>BGN</td><td>" + currency.rates.BGN.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/tr/shiny/24.png'>TRY</td><td>" + currency.rates.TRY.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/cn/shiny/24.png'>CNY</td><td>" + currency.rates.CNY.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/no/shiny/24.png'>NOK</td><td>" + currency.rates.NOK.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/nz/shiny/24.png'>NZD</td><td>" + currency.rates.NZD.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/za/shiny/24.png'>ZAR</td><td>" + currency.rates.ZAR.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/us/shiny/24.png'>USD</td><td>" + currency.rates.USD.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/mx/shiny/24.png'>MXN</td><td>" + currency.rates.MXN.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/sg/shiny/24.png'>SGD</td><td>" + currency.rates.SGD.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/au/shiny/24.png'>AUD</td><td>" + currency.rates.AUD.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/il/shiny/24.png'>ILS</td><td>" + currency.rates.ILS.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/kr/shiny/24.png'>KRW</td><td>" + currency.rates.KRW.toFixed(4) + "</td></tr>");
				$("#customers").append("<tr><td><img src='https://www.countryflags.io/pl/shiny/24.png'>PLN</td><td>" + currency.rates.PLN.toFixed(4) + "</td></tr>");
			}
		};
		url = 'https://api.exchangeratesapi.io/latest?base=USD' //URL for API to view Object

		xmlhttp.open("GET", url, true); //Open request
		xmlhttp.send(); //Send request
	});
});