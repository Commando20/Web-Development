//**************************Weight Conversions**************************
var convertWeight = function (pounds, kilograms, option) {
    "use strict";
    var lbs = "pounds", kg = "kilograms";
    
    if (pounds === 1) {
        lbs = "pound";
    }
    if (kilograms === 1) {
        kg = "kilogram";
    }
    
    if (option === 1) { //option value to go from pounds to kilograms
        document.getElementById("resultWeight").innerHTML = pounds + " " + lbs + " = " + kilograms + " " + kg;
    }
    if (option === 2) { //option value to go from kilograms to pounds
        document.getElementById("resultWeight").innerHTML = kilograms + " " + kg + " = " + pounds + " " + lbs;
    }
};


document.getElementById("lbs_kg").onclick = function () {
    "use strict";
    var option, pounds = document.getElementById("weight").value, resultWeight;
    
    if (isNaN(pounds) || pounds === "") {
        document.getElementById("resultWeight").innerHTML = "<strong>Please input a valid number.</strong>";
        document.getElementById("resultWeight").style.setProperty("color", "#db2130");
    } else {
        document.getElementById("resultWeight").style.removeProperty("color");
        option = 1;
        resultWeight = (pounds * 0.45359237).toFixed(2);
        convertWeight(pounds, resultWeight, option);
    }
};


document.getElementById("kg_lbs").onclick = function () {
    "use strict";
    var option, kilograms = document.getElementById("weight").value, resultWeight;
    
    if (isNaN(kilograms) || kilograms === "") {
        document.getElementById("resultWeight").innerHTML = "<strong>Please input a valid number.</strong>";
        document.getElementById("resultWeight").style.setProperty("color", "#db2130");
    } else {
        document.getElementById("resultWeight").style.removeProperty("color");
        option = 2;
        resultWeight = (kilograms * 2.2046226218).toFixed(2);
        convertWeight(resultWeight, kilograms, option);
    }
};
//**********************************************************************




//***************************Time Conversions***************************
var convertTime = function (seconds, hours, option) {
    "use strict";
    var sec = "seconds", hr = "hours";
    
    if (seconds === 1) {
        sec = "second";
    }
    if (hours === 1) {
        hr = "hour";
    }
    
    if (option === 1) { //option value to go from seconds to hours
        document.getElementById("resultTime").innerHTML = seconds + " " + sec + " = " + hours + " " + hr;
    }
    if (option === 2) { //option value to go from hours to seconds
        document.getElementById("resultTime").innerHTML = hours + " " + hr + " = " + seconds + " " + sec;
    }
};


document.getElementById("sec_hr").onclick = function () {
    "use strict";
    var option, seconds = document.getElementById("time").value, resultTime;
    
    if (isNaN(seconds) || seconds === "") {
        document.getElementById("resultTime").innerHTML = "<strong>Please input a valid number.</strong>";
        document.getElementById("resultTime").style.setProperty("color", "#db2130");
    } else {
        document.getElementById("resultTime").style.removeProperty("color");
        option = 1;
        resultTime = (seconds / 3600).toFixed(2);
        convertTime(seconds, resultTime, option);
    }
};


document.getElementById("hr_sec").onclick = function () {
    "use strict";
    var option, hours = document.getElementById("time").value, resultTime;
    
    if (isNaN(hours) || hours === "") {
        document.getElementById("resultTime").innerHTML = "<strong>Please input a valid number.</strong>";
        document.getElementById("resultTime").style.setProperty("color", "#db2130");
    } else {
        document.getElementById("resultDistance").style.removeProperty("color");
        option = 2;
        resultTime = hours * 3600;
        convertTime(resultTime, hours, option);
    }
};
//**********************************************************************




//*************************Distance Conversions*************************
var convertDistance = function (miles, kilometers, option) {
    "use strict";
    var mi = "miles",  km = "kilometers";
    
    if (miles === 1) {
        mi = "mile";
    }
    if (kilometers === 1) {
        km = "kilometer";
    }
        
    if (option === 1) { //option value to go from miles to kilometers
        document.getElementById("resultDistance").innerHTML = miles + " " + mi + " = " + kilometers + " " + km;
    }
    if (option === 2) { //option value to go from kilometers to miles
        document.getElementById("resultDistance").innerHTML = kilometers + " " + km + " = " + miles + " " + mi;
    }
};


document.getElementById("miles_km").onclick = function () {
    "use strict";
    var option, miles = document.getElementById("distance").value, resultDistance;
    
    if (isNaN(miles) || miles === "") {
        document.getElementById("resultDistance").innerHTML = "<strong>Please input a valid number.</strong>";
        document.getElementById("resultDistance").style.setProperty("color", "#db2130");
    } else {
        document.getElementById("resultDistance").style.removeProperty("color");
        option = 1;
        resultDistance = (miles * 1.609344).toFixed(2);
        convertDistance(miles, resultDistance, option);
    }
};


document.getElementById("km_miles").onclick = function () {
    "use strict";
    var option, kilometers = document.getElementById("distance").value, resultDistance;
    
    if (isNaN(kilometers) || kilometers === "") {
        document.getElementById("resultDistance").innerHTML = "<strong>Please input a valid number.</strong>";
        document.getElementById("resultDistance").style.setProperty("color", "#db2130");
    } else {
        document.getElementById("resultDistance").style.removeProperty("color");
        option = 2;
        resultDistance = (kilometers * 0.62137119).toFixed(2);
        convertDistance(resultDistance, kilometers, option);
    }
};
//**********************************************************************