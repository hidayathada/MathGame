<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Math Game</title>
</head>
<body>
	<h1>Welcome to Math Game</h1>

	<?php
		if (!isset($_COOKIE['username'])){

	?>
			<form method="post" action="math.php">
				Masukkan nama Anda <input type="text" name="username"> 
				<input type="submit" name="submitname" value="Submit">
			</form>
	<?php		

			if (isset($_POST['submitname'])){
				// baca nama user dari form
				$username = $_POST['username']; 
				// simpan nama user ke cookie
				setcookie("username", $username, time()+3*30*24*3600);
				// redirect to math.php?mode=start
				header("location:math.php?mode=start");
			}

		} else {

			if ($_GET['mode']=="play"){

				if (isset($_POST['submitans'])){
					// cek jawaban user
					// jika jawaban benar -> score +10
					// jika jawaban salah -> score -2
					//                    -> lives -1

					// update score, lives di session	
					if ($_POST['hasil'] == $_SESSION['hasil']){
						$_SESSION['score'] += 10;
					} else {
						$_SESSION['score'] -= 2;
						$_SESSION['lives'] -= 1;
					}

					// redirect to math.php?mode=play
					header("location:math.php?mode=play");
				} else if ($_SESSION['lives'] > 0) {

					// muncul pertanyaan

					$bil1 = rand(0, 10);
					$bil2 = rand(0, 10);
					$_SESSION['hasil'] = $bil1+$bil2;

					// cetak score dan lives
					echo "<p>Score: ".$_SESSION['score']." | Lives: ".$_SESSION['lives']."</p>"; 
	?>
					<form method="post" action="math.php?mode=play">
	<?php
					echo $bil1." + ".$bil2." = ";
	?>
					<input type="text" name="hasil">
					<input type="submit" name="submitans">				
					</form>
	<?php
				} else {
					// simpan data score ke db
					$conn = mysqli_connect($host, $user, $pass, $db);

					$sql = "INSERT INTO scores (username, score, tgl) VALUES ('".$_COOKIE['username']."', '".$_SESSION['score']."', '".date("Y-m-d H:i:s")."')";
					mysqli_query($conn, $sql);

					// cetak game over
					echo "Game Over<br>";
					
					// munculkan link: Main lagi -> mode=start | Hall of Fame -> mode=halloffame
					echo "<a href='math.php?mode=start'>Main Lagi</a> | <a href='math.php?mode=halloffame'>Hall of fame</a>";
				}
			}

			if ($_GET['mode']=="start"){
				// simpan score dan lives ke session
				// set score -> 0
				$_SESSION['score'] = 0;
				// set lives -> 3
				$_SESSION['lives'] = 3;
				
				// redirect to math.php?mode=play
				header("location:math.php?mode=play");
			}

			if ($_GET['mode']=="halloffame"){
				// tampilkan data score dari db sort by score limit 10

			}
		}
	?>
</body>
</html>