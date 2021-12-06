<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />      <!--Relative, type of file, file location-->
    <?php
        $commonName = $_POST['commonName'];
        $binominalName = $_POST['binomialName'];
        $habitatName = $_POST['habitatName'];
        
        function FindData($searchName){     //A function to perform an SQL query on the penguins database on localhost. $searchName will be the search term
            $serverName = "localhost";
            $userName = "root";
            $password = "";
            $dbase = "penguins";
            $conn = new mysqli($serverName, $userName, $password, $dbase);      //Opens a connection to MySQL server
            $sql = "Select * from penguin where commonName like '".$searchName."';";        //SQL query to run. Only uses commonName currently
            $result = $conn->query($sql);       //Runs the SQL query
            return $result;
        }
        function FindData1($searchName){     //A function to perform an SQL query on the penguins database on localhost. $searchName will be the search term
            $serverName = "localhost";
            $userName = "root";
            $password = "";
            $dbase = "penguins";
            $conn = new mysqli($serverName, $userName, $password, $dbase);      //Opens a connection to MySQL server
            $sql = "Select * from penguin where commonName like '".$searchName."';";        //SQL query to run. Only uses commonName currently
            $result = $conn->query($sql);       //Runs the SQL query
            return $result;
        }
    ?>
</head>
<body>
    <h1>Database Search Results</h1>
    <?php
        $result = FindData($commonName);        //Will return an array of results. Only uses commonName currently

        if ($result->num_rows > 0) {        //num_rows is the size of results array
            while($row = $result->fetch_assoc()){       //fetch_assoc reads each line of results array
                echo "<p>ID: ".$row['penguinID']."<p>Common Name: ".$row['commonName']."<p>Binomial Name: ".$row['binomialName'];//."<p>Habitat: ".$row['habitatName']."<br/>";
                }
            }
        else{
            echo "result is no matches to ".$commonName."<br/>";
        }
    ?>
</body>
</html>