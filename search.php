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
        echo $searchName."<br/>";
        echo $columnName;
        
        function FindData($searchTerm, $columnTerm){     //A function to perform an SQL query on the penguins database on localhost. $searchTerm will be the search term
            $serverName = "localhost";
            $userName = "root";
            $password = "";
            $dbase = "penguins";
            $conn = new mysqli($serverName, $userName, $password, $dbase);      //Opens a connection to MySQL server
            $sql = "Select * from penguin where ".$columnTerm." like '".$searchTerm."';";        //SQL query to run. Only uses commonName currently
            echo $sql;
            $result = $conn->query($sql);       //Runs the SQL query
            return $result;
        }

        function FindData1($searchTerm){     //A function to perform an SQL query on the penguins database on localhost. $searchTerm will be the search term
            $serverName = "localhost";
            $userName = "root";
            $password = "";
            $dbase = "penguins";
            $conn = new mysqli($serverName, $userName, $password, $dbase);      //Opens a connection to MySQL server
            $sql = "Select * from penguin where commonName like '".$searchTerm."';";        //SQL query to run. Only uses commonName currently
            $result = $conn->query($sql);       //Runs the SQL query
            return $result;
        }
    ?>
</head>
<body>
    <h1>Database Search Results</h1>
    <?php
        $result = FindData($searchName, $columnName);        //Will return an array of results. Only uses commonName currently
        echo var_dump($_POST)."<br/>";
        echo var_dump($result)."<br/>";
        if ($result->num_rows > 0) {        //num_rows is the size of results array
            while($row = $result->fetch_assoc()){       //fetch_assoc reads each line of results array
                echo var_dump($row);
                echo "<p>ID: ".$row['penguinID']."<p>Common Name: ".$row['commonName']."<p>Binomial Name: ".$row['binomialName'];//."<p>Habitat: ".$row['habitatName']."<br/>";
                }
            }
        else{
            echo "result is no matches to ".$searchName." in ".$columnName."<br/>";
        }
    ?>
</body>
</html>