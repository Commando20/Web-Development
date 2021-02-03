<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <title>Carlos' Webpage Project 6</title>
        <link rel="icon" type="image/x-icon" href="assets/img/Conversionfavicon.png" />
        
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" /> 
        
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/mycss.css" rel="stylesheet" />
    </head>
    
    <body id="page-top">  
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Conversion Website</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#Weight">Weight</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#Time">Time</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#Distance">Distance</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact Me</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Masthead-->
        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Conversion Website</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">A website constructed with PHP to bring you all your converting needs.</h2>
                    <a class="btn btn-primary js-scroll-trigger" href="#conversions">Start Conversions</a>
                    
                    <div>
                        <!-- Results PHP -->
                        <?php //Code that creates a button once user submits form and will once clicked will auto scroll to whichever unit they were using
                            if ($_SERVER["REQUEST_METHOD"] == "POST") { //If request is a postback
                                if (isset($_POST["weight"])) { //If there is a value in weight button will auto scroll down to weight results
                                    echo '<a class="mt-5 btn btn-primary js-scroll-trigger" href="#Weight">View results</a>';  
                                }
                                if (isset($_POST["time"])) { //If there is a value in time button will auto scroll down to time results
                                    echo '<a class="mt-5 btn btn-primary js-scroll-trigger" href="#Time">View results</a>';  
                                }
                                if (isset($_POST["distance"])) { //If there is a value in distance, button will auto scroll down to distance results
                                    echo '<a class="mt-5 btn btn-primary js-scroll-trigger" href="#Distance">View results</a>';  
                                }
                            }
                        ?>
                    </div>
                    
                </div>   
            </div>
        </header>
        
        <!-- Conversions-->
        <section class="projects-section bg-light" id="conversions">
            <div class="container">
                
            <!--Weight Conversion-->
            <div class="row align-items-center no-gutters mb-4 mb-lg-5" id="Weight">
                <div class="col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/weightConversionPic.jpg" alt="Weight Scale" /></div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4 class="heading">Weight</h4>

                        <form method="post" action="index.php">
                            <div>
                                <input type="number" name="weight" placeholder="Input weight" min="0" step="0.0000001" class="textBoxAdjustWeight" required>
                            </div>
                            <input type="submit" name="conversionKilograms" class="button" value="lbs to kg">
                            <span>
                                <input type="submit" name="conversionPounds" class="button" value="kg to lbs">
                            </span>
                        </form>

            <!--Weight Conversion PHP-->                        
            <?php

                function convertToKilograms($lbs_kg) { //Function to calc lbs-kg
                    $calc = $lbs_kg * 0.45359237;
                    return (round($calc, 2)); 
                }

                function convertToPounds($kg_lbs) { //Function to calc kg-lbs
                    $calc = $kg_lbs * 2.2046226218;
                    return(round($calc, 2)); 
                }

                if(isset($_POST["weight"])) { //Check if the input in num box has a value
                    $singularLbs = "pound";
                    $singularKg = "kilogram";
                    $weight = $_POST["weight"];
                    
                    if ($weight != 1) { //Condition if the value is not 1 so it will make the unit plural
                            $singularLbs = "pounds";
                            $singularKg = "kilograms";
                    }

                    // business logic
                    if(isset($_POST["conversionKilograms"]) && $_POST["conversionKilograms"] === "lbs to kg") { //Check if button is submit and if it strictly set to a button
                        
                        if (convertToKilograms($weight) != 1) { //If value is not singular
                            $output = $weight . " " . $singularLbs . " = " . convertToKilograms($weight) . " kilograms";
                        } else {
                            $output = $weight . " " . $singularLbs . " = " . convertToKilograms($weight) . " kilogram";
                        }
                    }

                    else if(isset($_POST["conversionPounds"]) && $_POST["conversionPounds"] === "kg to lbs") {
                        
                        if (convertToPounds($weight) != 1) { //If value is not singular
                            $output = $weight . " " . $singularKg . " = " . convertToPounds($weight) . " pounds";
                        } else {
                            $output = $weight . " " . $singularKg . " = " . convertToPounds($weight) . " pound";
                        }     
                    }
                    echo "<h5>$output</h5>"; //Prints the weight calculation
                }
            ?> 

                    </div>
                </div>
            </div>



            <!--Time Conversion-->
            <div class="row align-items-center no-gutters mb-4 mb-lg-5" id="Time">
                <div class="col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/timeConversionPic.jpg" alt="Clock"/></div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4 class="heading">Time</h4>

                        <form method="post" action="index.php">
                            <div>
                                <input type="number" name="time" placeholder="Input time" min="0" step="0.0000001" class="textBoxAdjustTime" required>
                            </div>
                            <input type="submit" name="conversionHours" class="button" value="sec to hours">
                            <span>
                                <input type="submit" name="conversionSeconds" class="button" value="hours to sec">
                            </span>
                        </form>

            <!--Time Conversion PHP-->                        
            <?php

                function convertToHours($sec_hr) { //Function that calc sec-hr
                    $calc = $sec_hr / 3600;
                    return (round($calc, 5)); 
                }

                function convertToSeconds($hr_sec) { //Function that calc hr-sec
                    $calc = $hr_sec * 3600;
                    return(round($calc, 2)); 
                }

                if(isset($_POST["time"])) { //Check if the input in num box has a value
                    $singularSec = "second";
                    $singularHour = "hour";
                    $time = $_POST["time"];
                    
                    if ($time != 1) { //Checks if value is 1 or not to set unit as plural
                            $singularSec = "seconds";
                            $singularHour = "hours";
                    }

                    // business logic
                    if(isset($_POST["conversionHours"]) && $_POST["conversionHours"] === "sec to hours") { 
                        
                        if (convertToHours($time) != 1) { //If value is not singular
                            $output = $time . " " . $singularSec . " = " . convertToHours($time) . " hours";
                        } else {
                            $output = $time . " " . $singularSec . " = " . convertToHours($time) . " hour";
                        }
                    }

                    else if(isset($_POST["conversionSeconds"]) && $_POST["conversionSeconds"] === "hours to sec") {
                        
                        if (convertToSeconds($time) != 1) { //If value is not singular
                            $output = $time . " " . $singularHour . " = " . convertToSeconds($time) . " seconds";
                        } else {
                            $output = $time . " " . $singularHour . " = " . convertToSeconds($time) . " second";
                        }
                    }
                    echo "<h5>$output</h5>"; //Prints the time calculation
                }
            ?>  

                    </div>
                </div>
            </div>



            <!--Distance Conversion-->
            <div class="row align-items-center no-gutters mb-4 mb-lg-5" id="Distance">
                <div class="col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/distanceConversionPic.jpg" alt="Running" /></div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4 class="heading">Distance</h4>

                        <form method="post" action="index.php">
                            <div>
                                <input type="number" name="distance" placeholder="Input distance" min="0" step="0.0000001" class="textBoxAdjustDistance" required>
                            </div>
                            <input type="submit" name="conversionKilometers" class="button" value="miles to km">
                            <span>
                                <input type="submit" name="conversionMiles" class="button" value="km to miles">
                            </span>
                        </form>

            <!--Distance Conversion PHP--> 
            <?php

                function convertToKilometers($mi_km) { //Function to calc miles-km
                    $calc = $mi_km * 1.609344;
                    return(round($calc, 2));  
                }

                function convertToMiles($km_mi) { //Function to calc km-miles
                    $calc = $km_mi * 0.62137119;
                    return(round($calc, 2)); 
                }

                if(isset($_POST["distance"])) { //Check if the input in num box has a value
                    $singularMi = "mile";
                    $singularKm = "kilometer";
                    $distance = $_POST["distance"];

                    if ($distance != 1) { //Checks if value is 1 or not to set unit as plural
                            $singularMi = "miles";
                            $singularKm = "kilometers";
                    }

                    // business logic
                    if(isset($_POST["conversionKilometers"]) && $_POST["conversionKilometers"] === "miles to km") {

                        if (convertToKilometers($distance) != 1) { //If value is not singular
                            $output = $distance . " " . $singularMi . " = " . convertToKilometers($distance) . " kilometers";
                        } else {
                            $output = $distance . " " . $singularMi . " = " . convertToKilometers($distance) . " kilometer";
                        }
                    }

                    else if(isset($_POST["conversionMiles"]) && $_POST["conversionMiles"] === "km to miles") {

                        if (convertToMiles($distance) != 1) { //If value is not singular
                            $output = $distance . " " . $singularKm . " = " . convertToMiles($distance) . " miles"; 
                        } else {
                            $output = $distance . " " . $singularKm . " = " . convertToMiles($distance) . " mile";
                        }
                    }
                    echo "<h5>$output</h5>"; //Prints the distance calculation
                }
            ?>          

                        </div>
                    </div>
                </div>

        </div>
    </section>

        <!-- Contact-->
        <section class="contact-section bg-black" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0"></div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100 card-hover">
                            <div class="card-body text-center">
                                <i class="fas fa-folder text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Portfolio</h4>
                                <hr class="my-4" />
                                <div class="text-black-50"><a href="https://lamp.cse.fau.edu/~csalazar2018/" target="_blank">My portfolio</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0"></div>
                </div>
            
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="mailto:csalazar2018@fau.edu"><i class="far fa-envelope fa-2x" target="_blank"></i></a>
                    <a class="mx-2" href="https://github.com/Commando20" target="_blank"><i class="fab fa-github fa-2x"></i></a> 
                    <a class="mx-2" href="https://www.linkedin.com/in/carlos-salazar-174b56196"><i class="fab fa-fw fa-linkedin-in fa-2x" target="_blank"></i></a>
                </div>
            </div>
        </section>
        
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container">Template courtesy of <a href="https://startbootstrap.com/themes/grayscale/" target="_blank">startbootstrap.com</a><br><br>Carlos Salazar 2021 © All Rights Reserved</div></footer>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>