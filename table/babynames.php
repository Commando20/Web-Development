<?php
    require_once './php/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DB Table Test</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
      
      <link href="assets/css/mycss.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="page-header"><h1>Database Table Test</h1></div>

    <form method="post" action="index.php">
                <div>
                    <span>
                        <label >Male
                          <input type="radio" checked="checked" name="male">
                          <span class="checkmark"></span>
                        </label>
                        <label >Female
                          <input type="radio" name="female">
                          <span class="checkmark"></span>
                        </label>
                        
                        <input type="text" name="babyname" placeholder="Insert baby name" value="babyname">
                        <input type="submit" name="insertbabyname" class="button" value="Enter">
                    </span>
                </div>
              </form>  
              
              
              
            <?php 
                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $male = $_POST["male"];
                    $female = $_POST["female"];
                }
              
                // Create table with two columns: id and value
                $createStmtM = 'CREATE TABLE BABYNAMESMALES (' . PHP_EOL //PHP_EOL = End of line
                                . '  `id` integer NOT NULL AUTO_INCREMENT,' . PHP_EOL
                                . '  `name` varchar(50) DEFAULT NULL,' . PHP_EOL
                                . '  `count` integer,' .PHP_EOL
                                . '  PRIMARY KEY (`id`)' . PHP_EOL
                                . ') ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;';

                $createStmtF = 'CREATE TABLE BABYNAMESFEMALES (' . PHP_EOL
                                . '  `id` integer NOT NULL AUTO_INCREMENT,' . PHP_EOL
                                . '  `name` varchar(50) DEFAULT NULL,' . PHP_EOL
                                . '  `count` integer,' .PHP_EOL
                                . '  PRIMARY KEY (`id`)' . PHP_EOL
                                . ') ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;';
              
                if(!($db->query($createStmtF) && $db->query($createStmtM))) { //Gets query for database
                    echo '<div class="alert alert-danger">Table creation failed: (' . $db->errno . ') ' . $db->error . '</div>' . PHP_EOL;
                    exit(); // Prevents the rest of the file from running
                }
              
              
                   
                //Insert rows
                $babyfile = fopen("baby_names.txt", "r");

                while(!feof($babyfile)) {
                    $line = fgets($babyfile); //returns a line from file
                    $parts = explode(",", $line); //Splits string into array separated by commas
                    if($parts[1] === 'M' || $parts[1] === 'M') {
                        $name = $parts[0];
                        $count = $parts[2];
                        $db->query($insertStmtM = "INSERT INTO BABYNAMESMALES (id, name, count) VALUES (NULL, '$name', '$count')");
                    }
                    if($parts[1] === 'F' || $parts[1] === 'f') {
                        $name = $parts[0];
                        $count = $parts[2];
                        $db->query($insertStmtF = "INSERT INTO BABYNAMESFEMALES (id, name, count) VALUES (NULL, '$name', '$count')");
                    }
                }
                fclose($babyfile);
              
                if(!($db->query($insertStmtF) && $db->query($insertStmtM))) {
                    echo '<div class="alert alert-danger">Value insertion failed: (' . $db->errno . ') ' . $db->error . '</div>' . PHP_EOL;
                    exit();
                }
              
              
              
                //Get rows from the table
                $selectStmtM = 'SELECT * FROM BABYNAMESMALES;';
                $selectStmtF = 'SELECT * FROM BABYNAMESFEMALES;';
                $resultM = $db->query($selectStmtM);
                $resultF = $db->query($selectStmtF); 
            ?> 
              
            <span>
                <table class="table tablem" style="float:left;">
                    <tr><th colspan="3" class="text-center">Male Baby Names</th></tr>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Votes</th>
                    </tr>
            
            <?php
                if($resultM->num_rows > 0) {
                    while($row = $resultM->fetch_assoc()) { //Output data of each row ?>
                       <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["count"] ?></td>
                       </tr>
            <?php } } ?>      
                </table>
                
            <?php         
                if (!($resultM->num_rows > 0)) {
                    echo '<div class="alert alert-success">No Results</div>' . PHP_EOL;
                } 
            ?>
                  
                <table class="table tablef" style="float:right;">
                    <tr><th colspan="3" class="text-center">Female Baby Names</th></tr>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Votes</th>
                    </tr>
            <?php
                if($resultF->num_rows > 0) {
                    while($row = $resultF->fetch_assoc()) { //Output data of each row ?>
                       <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["count"] ?></td>
                       </tr>
            <?php } } ?>
                  </table></span>
              
            <?php         
                if (!($resultF->num_rows > 0)) {
                    echo '<div class="alert alert-success">No Results</div>' . PHP_EOL;
                } 
              

                // Drop the table
                $dropStmtM = 'DROP TABLE BABYNAMESMALES;';
                $dropStmtF = 'DROP TABLE BABYNAMESFEMALES;';

                if(!($db->query($dropStmtM) && $db->query($dropStmtF))) {
                    echo '<div class="alert alert-danger">Table drop failed: (' . $db->errno . ') ' . $db->error . '</div>' . PHP_EOL;
                    exit();
                }
              
            ?> 

    </div>
  </body>
</html>