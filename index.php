<?php 
 require 'connect.php';//  connecting to the php page with personal info
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="ISO8859-1">
        <title></title>
    </head>
    <body>
        <?php
        echo "<h3>   Cities with Population</h3>";
        ?>
        <form action="" method="GET">
            <label>From:</label>
            <input type="number" name="max" min="1"> 
             <label>To:</label>
             <input type="number" name="min" min="1">
             <input type="submit" name="submit" value="Submit">
        </form>
    </body>
</html>
<?php
//Establishing  connection to database
try{
    $dbConn = new PDO("mysql:host=$hostname;dbname=novikovy_Lesson11",$user,$passwd);
               
}catch (PDOException $e){
    echo 'Connection error: ' .$e->getMessage();
}
// Global variables 
$population= $_GET["max"];
$population1= $_GET["min"];

           //Setting up the condition to retrieve required parametrs 
            $command = "SELECT * FROM City WHERE Population BETWEEN '$population' AND '$population1'";
        
            $stmt = $dbConn ->prepare($command);
        
            $execok = $stmt->execute();
            if($execok){
                //Creating table with header
                echo "<br>  Cities Selected:<br><br>";
                echo "<table>";
                echo"<tr><th> City Name: </th> <th>Country: </th><th> Population:</th></tr>";
                //Fetchin the row
            while($row = $stmt->fetch()){
         
                //Echoing the required information from the database 
                echo 
                 "<tr>"
                        . "<td>".$row[Name]."</td>"
                        . "<td>" .$row[CountryCode]."</td>"
                        . "<td> " .$row[Population]. "</td>"
                        . "</tr>"
                       ;}
                        echo "</table><br>";
            }
            
               else {
            echo "Error executing query";
            }
            
?>