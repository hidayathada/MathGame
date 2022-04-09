<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_klinik";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function tambah(){
    $query = "INSERT INTO game (username, skor, tanggal)
    VALUES ('John', 'Doe', 'john@example.com')";
}

    $sql = "SELECT * FROM dokter";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo $row["id_dokter"] . " " . $row["nama"] . "<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?> 