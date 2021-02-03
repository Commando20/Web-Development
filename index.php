<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <title>Carlos' Webpage Project 5</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/mycss.css" rel="stylesheet" />
    </head>
    
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">The Guessing Game</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Game</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact Me</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        
        
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <img class="mb-3" src="assets/img/question.png" alt="question mark">
                <div class="masthead-heading">The Guessing Game</div>
                <div class="masthead-subheading mb-5">Here I will ask you what number I am thinking of, and if you guess correctly, you win!</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Start Playing</a>
            </div>
        </header>
        
        
        
        <!-- Game-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">A Numbers Chance</h2>
                    <h3 class="section-subheading">Guess which number I am thinking of!</h3>
                    <span class="fa-stack fa-4x mb-3">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-hashtag fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                
                <div class="text-center">
                        
                    <!-- PHP -->                    
                    <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") { //If request is a postback
                            $counter = $_POST["counter"]; //Collect form data of counter
                            $randNum = $_POST["correctNum"]; //Collect form data of the correct number
                            $random2Num = $_POST["currentNum"]; //Collect form data of the last digit of the set of numbers given to user
                            $guess = $_POST["num"]; //Collects form data of user's guess
                            echo "<p><i>I'm thinking of a number between <b>1</b> and <b>$random2Num</b>. What number is it?</i></p>";

                            if ($randNum == $_POST["num"]) { //If the user's number is the same as the correct number
                                if ($counter === 1) { //Condition for attempts
                                    $attempt = "It only took you <b>$counter</b> attempt! Amazing!";
                                } else if ($counter >=1 && $counter <= 3) {
                                    $attempt = "It only took you <b>$counter</b> attempts! Amazing!";
                                } else if ($counter >=4 && $counter <= 7) { 
                                    $attempt = "It only took you <b>$counter</b> attempts! Not bad!"; 
                                } else if ($counter >= 8) {
                                    $attempt = "It took you <b>$counter</b> attempts! You can do better than that!"; 
                                } else {
                                    $attempt = "You got it on your <b>first</b> attempt! That was amazing!";
                                }
                                echo "<h3><b>You are correct!</b></h3> 
                                <p>The correct number is <h2><b>$randNum</b></h2> $attempt
                                <br><i>Press reset to get a different set of numbers!</i></p>";
                                
                            } else { //If user does not guess correctly
                                $counter++;
                                if (($randNum + 7) < $guess) { //If they are way off
                                    echo "<p>The number you seek is <b>a lot lower</b> than your guess.</p>";
                                } else if ($randNum < $guess) { //If they are close
                                    echo "<p>The number you seek is <b>lower</b> than your guess.</p>";     
                                } else if ($randNum > ($guess + 7)) {
                                    echo "<p>The number you seek is <b>a lot higher</b> than your guess.</p>";
                                } else if ($randNum > $guess) {
                                    echo "<p>The number you seek is <b>higher</b> than your guess.</p>";
                                }
                                echo "<h4>Attempts: $counter</h4><p>Try again!</p>";
                            }          
                        } else { //If request is not a postback, reset everything
                            $counter = 0;
                            $random2Num = rand(10, 20);
                            $randNum = rand(1, $random2Num);   
                            echo "<p><i>I'm thinking of a number between <b>1</b> and <b>$random2Num</b>. What number is it?</i></p>";
                        }
                    ?>
                    <!-- End PHP -->

                    <form method="post" action="index.php">
                        <div class="text-center mt-4">
                            Your guess:
                            <input type="hidden" name="correctNum" value="<?= htmlentities($randNum)?>">

                            <input type="hidden" name="currentNum" value="<?= htmlentities($random2Num)?>">

                            <input type="hidden" name="counter" value="<?= htmlentities($counter)?>">

                            <input class="form-control hoverNumBox" type="number" name="num" placeholder="Input number" min="1" max="<?= htmlentities($random2Num)?>" required>
                        </div>
                        <span>
                            <input type="submit" name="Guess" value="Guess" class="btn btn-primary btn-xl text-uppercase mt-4 mr-4">

                            <input type="button" value="Reset" onclick="window.location.href = 'http://lamp.cse.fau.edu/~csalazar2018/p5/'" class="btn btn-primary btn-xl text-uppercase mt-4">
                        </span>
                    </form>
                </div>
            </div>
        </section>

        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Me</h2>
                </div>
            </div>
            
            <footer class="footer py-4">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg my-3">
                            <a class="btn btn-dark btn-social mx-2" href="https://lamp.cse.fau.edu/~csalazar2018/" target="_blank"><i class="far fa-folder fa-2x"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="mailto:csalazar2018@fau.edu"><i class="far fa-envelope fa-2x"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="https://github.com/Commando20" target="_blank"><i class="fab fa-github fa-2x"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="https://www.linkedin.com/in/carlos-salazar-174b56196" target="_blank"><i class="fab fa-linkedin-in fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="mt-3" style="color:white">Template courtesy of <a href="https://startbootstrap.com/themes/agency/" target="_blank">startbootstrap.com</a><br><br>Carlos Salazar 2021 © All Rights Reserved</div>
                </div>
            </footer>
        </section>
       
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>