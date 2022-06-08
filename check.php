<?php
$servername = "localhost";
$username = "u679696964_clgadmin";
$password = "College@2021";


try {
  $conn = new PDO("mysql:host=$servername;dbname=u679696964_college", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>