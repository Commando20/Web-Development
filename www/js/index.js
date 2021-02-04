/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

// Wait for the deviceready event before using any of Cordova's device APIs.
// See https://cordova.apache.org/docs/en/latest/cordova/events/events.html#deviceready
document.addEventListener('DOMContentLoaded', onDeviceReady, false);

function onDeviceReady() {
    // Cordova is now initialized. Have fun!
    console.log('Running cordova-' + cordova.platformId + '@' + cordova.version);

    //Disable button elements so if user is signed off, they cannot access them until signed in
    document.getElementById("map").disabled = true;
    document.getElementById("weather").disabled = true;
	document.getElementById("currency").disabled = true;

    //Add onclick listeners
    document.getElementById('login').addEventListener('click', toggleSignIn, false);
    initApp();

    //Make sure user is not signed in on page load.
    firebase.auth().signOut();
}

function toggleSignIn() {
  //If the current user object does not exist
  if (!firebase.auth().currentUser) {
    //Set the auth provider to yahoo
    var provider = new firebase.auth.OAuthProvider('yahoo.com');
    //And sign in with a popup
    firebase.auth().signInWithPopup(provider)
      .then(function (result) { //On Success save the token to session storage and output it to console
        var token = result.credential.accessToken;
        window.sessionStorage.setItem("token",token);
        console.log(result);
        var user = result.user;
        var ws = document.getElementById("userinfo");
        ws.innerHTML = "Signed in as: " + result.additionalUserInfo.profile.name; //Aware user of profile name to show that it is them in weather tab
		var info = document.getElementById("welcome"); //Welcomes user and shows profile name and directs them to navigate with the buttons
        info.innerHTML = "Welcome: " + result.additionalUserInfo.profile.name + "<br><p style='font-size: 25px;'>You may now navigate through the different buttons to view the weather, the map of an inputted location, or current exchange rates.</p>";
      })
      .catch(function (error) { //On failure alert user or report error to console
        var errorCode = error.code;
        var errorMessage = error.message;
        var email = error.email;
        var credential = error.credential;
        if (errorCode === 'auth/account-exists-with-different-credential') {
          	alert('You have already signed up with a different auth provider for that email.');
        } else {
          	console.error(error);
        }
      });
  } else {
    	firebase.auth().signOut();
  }
}

//Initializes the app
function initApp() {
  //Set listeners for Auth State Changed
  firebase.auth().onAuthStateChanged(function (user) {
    //if there is a user enable app functionality
    if (user) { //Enable all buttons so they can be clicked on and change button to say sign out
      	document.getElementById("login").innerHTML = 'Sign out';
		document.getElementById("map").disabled = false;
    	document.getElementById("weather").disabled = false;
		document.getElementById("currency").disabled = false;

    //else keep the app disabled or re-disabled it
    } else { //Disable all buttons so they cannot be clicked and have button revert back to sign in
		document.getElementById("welcome").innerHTML = "Welcome!<br>Please sign in to proceed."
		document.getElementById("map").disabled = true;
    	document.getElementById("weather").disabled = true;
		document.getElementById("currency").disabled = true;
      	document.getElementById("login").innerHTML = "<img src='img/yahoo-icon.png' width='25px' height='25px'/> Yahoo";
    }
  });
}