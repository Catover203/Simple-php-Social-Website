<?php
// Establish Connection to Database
$host = 'localhost';//database host
$username = 'Yourusername';//database user name
$dbpassword = 'Yourdatabasepassword';//database password
$dbdata = 'yourdatabasetoconnect';//database
function connect() {
    static $conn;
    if ($conn === NULL){ 
        $conn = mysqli_connect($host, $username, $dbpassword, $dbdata);
    }
    return $conn;
}

?>