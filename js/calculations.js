/*eslint-env browser*/

//***************************************Calculations***************************************
function calculations(num1, num2, num3) { //function to reveal cards with values and performs calculations and stores values in those cards
    document.getElementById("card1").style.visibility = "visible";
    document.getElementById("card2").style.visibility = "visible";
    document.getElementById("card3").style.visibility = "visible";
    document.getElementById("card4").style.visibility = "visible";
    document.getElementById("card5").style.visibility = "visible";
    
    var max = Math.max(num1, num2, num3);
    var min = Math.min(num1, num2, num3);
        
    var numList = [num1, num2, num3];
    numList.sort(function (a, b) { return a - b; });
            
    document.getElementById("max").innerHTML = max;
    document.getElementById("min").innerHTML = min;
    document.getElementById("range").innerHTML = max - min;
    document.getElementById("mean").innerHTML = ((+num1 + +num2 + +num3) / 3).toFixed(2);
    document.getElementById("median").innerHTML = numList[1];
}
//******************************************************************************************


//*****************************************Invalids*****************************************
function invalid1() { //function for if first input is invalid (empty or NaN)
    document.getElementById("incorrect1").style.visibility = "visible"; //Reveals error
    document.getElementById("incorrect1").innerHTML = "<strong>Please input a valid number.</strong>";
    document.getElementById("incorrect1").style.setProperty("color", "#db2130");
	document.getElementById("incorrect1").style.setProperty("text-align", "center");
}

function invalid2() { //function for if second input is invalid (empty or NaN)
    document.getElementById("incorrect2").style.visibility = "visible"; //Reveals error
    document.getElementById("incorrect2").innerHTML = "<strong>Please input a valid number.</strong>";
    document.getElementById("incorrect2").style.setProperty("color", "#db2130");
	document.getElementById("incorrect2").style.setProperty("text-align", "center");
}

function invalid3() { //function for if third input is invalid (empty or NaN)
    document.getElementById("incorrect3").style.visibility = "visible"; //Reveals error
    document.getElementById("incorrect3").innerHTML = "<strong>Please input a valid number.</strong>";
    document.getElementById("incorrect3").style.setProperty("color", "#db2130"); 
	document.getElementById("incorrect3").style.setProperty("text-align", "center");
}
//******************************************************************************************


document.getElementById("button1").onclick = function () { //Upon clicking button1 (button to perform operations)
    var num1 = document.getElementById("num1").value;
    var num2 = document.getElementById("num2").value;
    var num3 = document.getElementById("num3").value;
    
    if ( (isNaN(num1) || num1 === "")  || (isNaN(num2) || num2 === "") || (isNaN(num3) || num3 === "") ) { //Condition that reads: if any of the inputs are invalid (empty or NaN), cards will disappear and check each input
        document.getElementById("card1").style.visibility = "hidden"; //Hide every operation card
        document.getElementById("card2").style.visibility = "hidden";
        document.getElementById("card3").style.visibility = "hidden";
        document.getElementById("card4").style.visibility = "hidden";
        document.getElementById("card5").style.visibility = "hidden";
        
        if (isNaN(num1) || num1 === "") { //Condition that checks to see if ONLY input1 has an error
            var timer1 = setTimeout(invalid1, 1); //Call to invalid function to display error
        } else document.getElementById("incorrect1").style.visibility = "hidden"; //If input2 does NOT have an error, error display will disappear
        
        if (isNaN(num2) || num2 === "") { //Condition that checks to see if ONLY input2 has an error
            var timer2 = setTimeout(invalid2, 1); //Call to invalid function to display error
        } else document.getElementById("incorrect2").style.visibility = "hidden"; //If input2 does NOT have an error, error display will disappear
        
        if (isNaN(num3) || num3 === "") { //Condition that checks to see if ONLY input3 has an error
            var timer3 = setTimeout(invalid3, 1); //Call to invalid function to display error
        } else document.getElementById("incorrect3").style.visibility = "hidden"; //If input2 does NOT have an error, error display will disappear
    }
    
    if ( (isNaN(num1) || num1 === "")  && (isNaN(num2) || num2 === "") && (isNaN(num3) || num3 === "") ) { //Condition that reads: if ALL inputs are invalid (empty or NaN), all cards disappear and errors display
        
        timer1 = setTimeout(invalid1, 1); //Displays error under every textbox
        timer2 = setTimeout(invalid2, 1);
        timer3 = setTimeout(invalid3, 1);

    } else if ( !(isNaN(num1) || num1 === "")  && !(isNaN(num2) || num2 === "") && !(isNaN(num3) || num3 === "") ) { //If ALL textboxes have valid values, errors disappear and calculations are performed  
        document.getElementById("incorrect1").style.visibility = "hidden"; //Hide errors
        document.getElementById("incorrect2").style.visibility = "hidden";
        document.getElementById("incorrect3").style.visibility = "hidden";
        calculations(num1, num2, num3); //Call function to perform calculations
    }  
};