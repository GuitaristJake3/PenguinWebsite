<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />      <!--Relative, type of file, file location-->
    <?php
        foreach ($_POST as $x => $x_value){     //Sets the search term to query and table column to check against based on which text box was submitted
            if (!empty($x_value)){
                $searchName = $x_value;
                $columnName = $x;
                break;
            }
        }
        
        function FindData($searchTerm, $columnTerm){     //A function to perform an SQL query on the penguins database on localhost 
            $serverName = "localhost";                   //$searchTerm will be the searched text and $columnTerm will be the database column to search against
            $userName = "root";
            $password = "";
            $dbase = "penguins";
            $conn = new mysqli($serverName, $userName, $password, $dbase);      //Opens a connection to MySQL server
            $sql = "SELECT penguin.commonName, penguin.binomialName, habitat.habitatName FROM penguinhabitation, penguin, habitat 
            WHERE penguin.penguinID = penguinhabitation.penguinID AND habitat.habitatID = penguinhabitation.habitatID
            AND ".$columnTerm." LIKE '".$searchTerm."';";        //SQL query to run
            $result = $conn->query($sql);       //Runs the SQL query
            return $result;
        }
    ?>
</head>
<body>
    <h1>Database Search Results</h1>
    <?php
        $result = FindData($searchName, $columnName);        //Will return an array of results
        if ($result->num_rows > 0) {        //num_rows is the size of results array
            echo "<p>Search found ".$result->num_rows." matches to '".$searchName."' in ".$columnName.":</p>";
            while($row = $result->fetch_assoc()){       //fetch_assoc reads each line of results array
                echo "<p>Common Name: ".$row['commonName']."<br/>Binomial Name: ".$row['binomialName']."<br/>Habitat: ".$row['habitatName']."</p>";
                }
            }
        else{
            echo "<p>Search resulted in no matches to '".$searchName."' in ".$columnName.". Please try another search.</p>";
        }
    ?>
</body>
</html>