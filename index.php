<?php
    require_once './table/php/db_connect.php'; //Including credentials to login 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Carlos' Webpage Project 7</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/mycss.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Sailor - v2.1.0
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">
      <h1 class="logo"><a href="index.html">Favorite Baby Names</a></h1>
    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        
        <div class="carousel-item active">
            <video autoplay muted loop>
                <source src="./assets/img/baby.mp4" type="video/mp4">
            </video>
            <div class="carousel-container">
                <div class="container">
                    <h2 class="animate__animated animate__fadeInDown">Vote for Your Favorite Baby Names</h2>
                    <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Start Voting</a>
                </div>
            </div>
        </div>
        
    </div>
  </section>
  <!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="content">
            
          <div>          
            <?php
              $createStmtM = 'CREATE TABLE IF NOT EXISTS BABYNAMESMALES (' . PHP_EOL
                            . '  `id` integer NOT NULL AUTO_INCREMENT,' . PHP_EOL
                            . '  `name` varchar(50) DEFAULT NULL,' . PHP_EOL
                            . '  `count` integer,' .PHP_EOL
                            . '  PRIMARY KEY (`id`)' . PHP_EOL
                            . ') ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;'; //PHP_EOL = End of line

              $createStmtF = 'CREATE TABLE IF NOT EXISTS BABYNAMESFEMALES (' . PHP_EOL
                            . '  `id` integer NOT NULL AUTO_INCREMENT,' . PHP_EOL
                            . '  `name` varchar(50) DEFAULT NULL,' . PHP_EOL
                            . '  `count` integer,' .PHP_EOL
                            . '  PRIMARY KEY (`id`)' . PHP_EOL
                            . ') ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;';
              
              if(!($db->query($createStmtF) && $db->query($createStmtM))) {
                    echo '<div class="alert alert-danger">Value insertion failed: (' . $db->errno . ') ' . $db->error . '</div>' . PHP_EOL;
                    exit();
              }
              
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //Get rows from the table
                $selectStmtM = 'SELECT DISTINCT * FROM BABYNAMESMALES;';
                $selectStmtF = 'SELECT DISTINCT * FROM BABYNAMESFEMALES;';
                $resultM = $db->query($selectStmtM);
                $resultF = $db->query($selectStmtF); 

                $gender = $_POST["radio"];
                $babyname = $_POST["babyname"];
                $count = 1;

                if (isset($babyname) && !(preg_match('/[^A-Za-z0-9\-]/', $babyname)) && !(preg_match('/[0-9]/', $babyname))) {
                    trim($babyname, " ");
                    $babyname = strtolower($babyname);
                    $babyname = ucfirst($babyname);

                    if ($gender == "boy") { 
                        if($resultM->num_rows > 0) {
                            while($row = $resultM->fetch_assoc()) {
                                
                                if (strtolower($babyname) == strtolower($row["name"])) {
                                    $count++;
                                    $update = "UPDATE count = '$count'";
                                }
                            }
                            $db->query($insertStmtM = "INSERT INTO BABYNAMESMALES (id, name, count) VALUES (NULL, '$babyname', '$count')");
                        } else {
                            $db->query($insertStmtM = "INSERT INTO BABYNAMESMALES (id, name, count) VALUES (NULL, '$babyname', '$count')"); 
                        }
                        
                    } else if ($gender == "girl") {
                        //while ($count === 1) {
                          if($resultF->num_rows > 0) {
                              while($row = $resultF->fetch_assoc()) { //Output data of each row 
                                  if (strtolower($babyname) == strtolower($row["name"])) {
                                      $count++;
                                      $update = "UPDATE count = '$count'";
                                  }
                              }
                              $db->query($insertStmtF = "INSERT INTO BABYNAMESFEMALES (id, name, count) VALUES (NULL, '$babyname', '$count')");
                          } else {
                              $db->query($insertStmtF = "INSERT INTO BABYNAMESFEMALES (id, name, count) VALUES (NULL, '$babyname', '$count')"); 
                          }
                       // }
                    }
                } else {echo "<p class='center alert alert-warning'><b>The name you have entered should not contain any numbers or special characters. Please try again.</b></p>";}
                                   
               //Output everything   
              } 
            ?> 

            <span>
              <table class="table tablem" style="float:left;">
                  <tr><th colspan="3" class="text-center">Top 10 Male Baby Names</th></tr>
                  <tr>
                      <th>Rank</th>
                      <th>Name</th>
                      <th>Votes</th>
                  </tr>
            <?php
              //Get rows from the table
              $selectStmtM = 'SELECT * FROM BABYNAMESMALES
			  			      GROUP BY name HAVING COUNT(name) > 1
                              ORDER BY count DESC, id ASC 
                              LIMIT 10';
              $selectStmtF = 'SELECT DISTINCT * FROM BABYNAMESFEMALES 
                              ORDER BY count DESC, id ASC 
                              LIMIT 10';
              $resultM = $db->query($selectStmtM);
              $resultF = $db->query($selectStmtF);         
                      
              if($resultM->num_rows > 0) {
                  $i = 1;
                  while($row = $resultM->fetch_assoc()) { //Output data of each row ?>
                      <tr>
                          <td><?php echo $i ?></td>
                          <td><?php echo $row["name"] ?></td>
                          <td><?php echo $row["count"] ?></td>
                      </tr>
            <?php      
                      $i++;
                    } 
                } 
            ?>      
                </table>

                <table class="table tablef" style="float:right;">
                    <tr><th colspan="3" class="text-center">Top 10 Female Baby Names</th></tr>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Votes</th>
                    </tr>
            <?php
                if($resultF->num_rows > 0) {
                    $i = 1;
                    while($row = $resultF->fetch_assoc()) { //Output data of each row ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["count"] ?></td>
                        </tr>
            <?php      
                      $i++;
                    } 
                } 
            ?>
              </table></span>  
          </div>
                       
          <h2 class="center">Time to Vote</h2>  
          <form method="post" action="index.php">
            <div class="center">
                <span>
                    <label>Male  
                        <input type="radio" name="radio" value="boy" required class="containerRadio">
                    </label>
                    <label >Female
                        <input type="radio" name="radio" value="girl" required class="containerRadio">
                    </label>

                    <input type="text" name="babyname" placeholder="Insert baby name" class="textbox" required>
                    <input type="submit" name="insertbabyname" class="btn-get-started" value="Enter">
                </span>
            </div>
          </form>
            
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>  
        </div>
      </div>
    </section>    
  </main>
  <!-- End main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
        
      <div class="container">
        <div class="center">
            <h3>Contact Me</h3>
            <div class="social-links mt-3">
                <a href="https://lamp.cse.fau.edu/~csalazar2018/" target="_blank"><i class="bx bx-folder" style="text-align: center"></i></a>
                <a href="mailto:csalazar2018@fau.edu"><i class='bx bx-envelope'></i></a>
                <a href="https://github.com/Commando20" target="_blank"><i class='bx bxl-github'></i></a>
                <a href="https://www.linkedin.com/in/carlos-salazar-174b56196" target="_blank"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">Carlos Salazar 2021 © All Rights Reserved</div>
      <div class="credits">Template courtesy of <a href="https://bootstrapmade.com/sailor-free-bootstrap-theme/" target="_blank">BootstrapMade</a></div>
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>