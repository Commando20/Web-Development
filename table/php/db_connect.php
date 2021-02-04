<?php
// Do not change the following two lines.
$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER['PHP_SELF']);

// You will need to require this file on EVERY php file that uses the database.
// Be sure to use $db->close(); at the end of each php file that includes this!

$dbhost = 'localhost';  // Most likely will not need to be changed
$dbname = 'csalazar2018';   // Needs to be changed to your designated table database name
$dbuser = 'csalazar2018';   // Needs to be changed to reflect your LAMP server credentials
$dbpass = '83wont11wood'; // Needs to be changed to reflect your LAMP server credentials

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname); //Building an mysqli object to connect to database

if($db->connect_errno > 0) { //If cannot connect to database
    die('Unable to connect to database [' . $db->connect_error . ']'); //Exit program because something unexpected occured
}