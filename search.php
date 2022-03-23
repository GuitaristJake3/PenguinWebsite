<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />      <!--Finds CSS to use: Relative, type of file, file location-->
    <?php
        $searchName = "";
        $columnName = "";
        foreach ($_POST as $x => $x_value){     //Sets the search term to query and table column to check against based on which text box was submitted
            if (!empty($x_value)){
                $searchName = $x_value;
                $columnName = $x;
                break;
            }
        }

        function EstablishConnection() {
            $serverName = "localhost";                   
            $userName = "root";
            $password = "";
            $dbase = "penguins";
            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_ALL;      //Throws exceptions for all errors
            try {
                $conn = new mysqli($serverName, $userName, $password, $dbase);      //Opens a connection to MySQL server
            }
            catch (mysqli_sql_exception $e){
                echo "Connection to database failed.\n";
                $conn = false;
            }
            catch (Exception $e){
                echo "Another exception occurred.\n";
                $conn = false;
            }
            return $conn;
        }

        function FindData($searchTerm, $columnTerm, $conn) {     //Performs SQL query on penguins database. $searchTerm is the searched text, $columnTerm is the database column to search in
            $sql = "SELECT penguin.commonName, penguin.binomialName, habitat.habitatName FROM penguinhabitation, penguin, habitat 
            WHERE penguin.penguinID = penguinhabitation.penguinID AND habitat.habitatID = penguinhabitation.habitatID
            AND ".$columnTerm." LIKE '".$searchTerm."';";        //SQL query to run
            if ($conn) {
                $result = $conn->query($sql);       //Runs the SQL query
                $conn->close();     //Closes connection to MySQL server
            }
            else {
                $result = false;
            }
            return $result;
        }
    ?>
</head>
<body>
    <h1>Database Search Results</h1>

    <img class="leftPic" id="chinPic" src="images/chinstrap.jpg" height="500" width="300" align="left" />
    <img class="rightPic" id="adeliePic" src="images/adelie.jpg" height="500" width="300" align="right" />

    <?php
        $result = FindData($searchName, $columnName, EstablishConnection());        //Will return an array of results
        if ($result != false && $result->num_rows > 0) {        //num_rows is the size of results array
            echo "<p>Your search found <strong><span style='color:green'>".$result->num_rows."</span></strong> matches to '".$searchName."' in ".$columnName.":</p>";
            $pengNum = 0;
            while($row = $result->fetch_assoc()){       //fetch_assoc reads each line of results array
                $pengNum ++;
                echo "<p><strong><ins>Penguin number ".$pengNum."</ins></strong><br/>Common Name: ".$row['commonName']."<br/>Binomial Name: ".$row['binomialName']."<br/>Habitat: ".$row['habitatName']."</p>";
                }
            }
        else{
            echo "<p>Your search resulted in <strong><span style='color:red'>no</span></strong> matches to '".$searchName."' in ".$columnName.". 
            Please try another search term or make an entry in the database for this penguin at the main menu.</p>";
        }
    ?>

    <form id="returnForm" action="index.html">
        <input class="button" id="returnButton" type="submit" value="Return to Search" />
    </form>
</body>
</html>