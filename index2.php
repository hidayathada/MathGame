<?php
    // include "kon.php";
    // session_start();
    if(empty($_COOKIE['angka'])){
        $angka = rand(1,10);
        setcookie('angka', $angka, time() + (100));
        // echo "angka" . $_COOKIE['angka'];
    }
?>

<!DOCTYPE html>
<head>
    <title>Form Isian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
</head>
<body>
    <?php if(empty($_COOKIE['username'])){?>
    <form role="form" method="post" action="index2.php">
        <div class="col-md-6 mt-4">
            <h2>Game Tebak Tebakan</h2>
            <hr>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-4 col-form-label">Silahkan Isi Username</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            </div>
            <div class="form-group row">
            <div class="offset-sm-4 col-sm-10">
                <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
            </div>
            </div>
        </div>
    </form>
        <?php
            if(isset($_POST['username'])){
                $username = $_POST['username'];
                $tanggal = date('d-M-Y');
                $skor = 0;
                $benar = $skor+10;
                $salah = $skor-2;
                $game_over = -20;
                setcookie('username', $username, time() + (1000), "/");
                setcookie('tanggal', $tanggal, time() + (1000), "/");
                setcookie('skor', $skor, time() + (1000), "/");
                setcookie('benar', $benar, time() + (1000), "/");
                setcookie('salah', $salah, time() + (1000), "/");
                // session_start();
                // $_SESSION['skor'] = 0;
                // $_SESSION['salah'] = $_SESSION['skor']-2;
                // $_SESSION['benar'] = $_SESSION['skor']+10;
                // $_SESSION['game_over'] = -20;
                // $this->cookies();
                header("location:index.php");
            }
        ?>
    <?php }else{ ?>
    <div class="col-md-6 mt-4">
        <h2>Selamat Datang <?php echo $_COOKIE['username'];?></h2><hr>
        <form role="form" method="post" action="index2.php">
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-4 col-form-label">Silahkan Tebak Angka</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="input_angka" placeholder="Input Angka">
            </div>
            </div>
            <div class="form-group row">
            <div class="offset-sm-4 col-sm-10">
                <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
            </div>
        </form>
        <div class="col-md-6 mt-4">
    <?php
        if(isset($_POST['input_angka'])){
            if($_POST['input_angka'] > $_COOKIE['angka']){
                $total_skor = $_COOKIE['salah'];
                setcookie('skor', $total_skor, time() + (1000), "/");
                echo "Tebakan Anda Salah ! " . "<br>" . "Tebakan Anda Terlalu Tinggi" . "<br>" . "Skor Anda" . " " . $total_skor;
                // echo $_COOKIE['angka'];
            }elseif($_POST['input_angka'] < $_COOKIE['angka']){
                $total_skor = $_COOKIE['salah'];
                setcookie('skor', $total_skor, time() + (1000), "/");
                echo "Tebakan Anda Salah ! " . "<br>" . "Tebakan Anda Terlalu Rendah" . "<br>" . "Skor Anda" . " " . $total_skor;
                // echo $_COOKIE['angka'];
            }else{
                echo "Tebakan anda betul";
                $skor = $_COOKIE['benar'];
                setcookie('skor', $skor, time() + (1000), "/");
                ?><br>
                <a href="index.php" class="btn btn-danger"/>Main Lagi?</a>
                <?php
                setcookie('username', $_COOKIE['username'], time() - (1000), "/");
                setcookie('tanggal', $_COOKIE['tanggal'], time() - (1000), "/");
                setcookie('skor', $_COOKIE['skor'], time() - (1000), "/");
                setcookie('benar', $_COOKIE['benar'], time() - (1000), "/");
                setcookie('salah', $_COOKIE['salah'], time() - (1000), "/");
                setcookie('angka', $_COOKIE['angka'], time() - (1000), "/");
                // header("location:index.php");
                exit();
            }
        }
    ?>
    <?php } ?>
        </div>
    <hr>
    </div>
</body>
<footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</footer>
</html>