<?php

/***
* e-Pasien from version 0.1 Beta
* Last modified: 05 July 2018
* Author : drg. Faisol Basoro
* Email : dentix.id@gmail.com
*
* File : login.php
* Description : Login, cookie and session process
* Licence under GPL
***/

ob_start();
session_start();

require_once('config.php');

if(PRODUCTION == 'YES') {
  ini_set('display_errors', 0);
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
}

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) { redirect('index.php'); }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $dataSettings['nama_instansi']; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="css/roboto.css" rel="stylesheet">

    <!-- Material Icon Css -->
    <link href="css/material-icon.css" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/theme-green.css" rel="stylesheet" />
</head>

<body class="login-page">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Memproses data ke server.....</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <div class="login-box" style="margin: 20px;">
        <div class="logo">
            <p  class="align-center"><img src="images/logo.png"></p>
			
            <a href="index.php">Pendaftaran Online<br><?php echo $dataSettings['nama_instansi']; ?></a>
            <small><?php echo $dataSettings['alamat_instansi']; ?> - <?php echo $dataSettings['kabupaten']; ?>, <?php echo $dataSettings['propinsi']; ?></small>
        </div>

    <?php if(!isset($_GET['action'])){

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if (empty ($_POST['username']) || empty ($_POST['password'])) {
                $errors[] = 'Username or password empty';
            }

            if ($_POST['username'] !=="" || $_POST['password'] !=="") {

                $sql = "SELECT no_rkm_medis as username, tgl_lahir as password FROM pasien WHERE no_rkm_medis = '{$_POST['username']}'";
                $found = query($sql);

                if(num_rows($found) !== 1) {
                    $errors[] = 'Pasien tidak terdaftar.';
                }

                if(num_rows($found) == 1) {
                    $user = fetch_assoc($found);
        		    if($user['password'] !== $_POST['password']) {
                        $errors[] = 'Tanggal Lahir tidak valid.';
                    }
                }

            }

            if(!empty($errors)) {

                foreach($errors as $error) {
                    echo validation_errors($error);
                }

            } else {

                if (isset($_POST['remember'])) {
                    /* Set cookie to last 1 year */
                    setcookie('username', $_POST['username'], time()+60*60*24*365);
                    setcookie('password', $_POST['password'], time()+60*60*24*365);

                } else {
                    /* Cookie expires when browser closes */
                    setcookie('username', $_POST['username'], false);
                    setcookie('password', $_POST['password'], false);
                }

                redirect('index.php');

            }

        }
        ?>

        <div class="card">

            <div class="body">
                <form id="sign_in" method="POST">
                    <!--YANG LAMA<div class="msg">Silahkan login terlebih dahulu</div>-->
					<!--UPDATE OLEH AMELIA YAHYA TANGGAL 05-04-20222 -->
                    <div class="msg"><center>Silahkan Login dengan mengisikan Nomor Rekam Medis dan Tanggal Lahir anda sebagai kata kunci. 
					<br><br></center>

					<div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Nomor Rekam Medik" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <!--<input type="date" class="form-control" name="password" placeholder="dd-mm-yyyy" required>-->
							<!--<input name="password" id="tgl_lahir" placeholder="dd-mm-yyyy" class="form-control" type="text" onMouseOver="(this.type='date')" />-->
							<input name="password" id="tgl_lahir" placeholder="Tanggal Lahir" class="form-control text-align-center tgl_lahir" type="date" value="" min="1930-01-01" max="2050-12-31" />
						<!--<input name="password" id="tgl_lahir" type="text" value="2018-07-22" min="2018-01-01" max="2022-12-31">-->
						<!--
						masukkan kode dibawah ini
						
							<input type="date" name="password" id="tgl_lahir" placeholder="dd-mm-yyyy" value="" min="1945-01-01" max="2030-12-31">-->
						</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-4">
							<!--<input type="checkbox" name="remember" id="remember" class="filled-in chk-col-pink">
                            <label for="remember">Remember</label>	-->
							<!--<button class="btn btn-block bg-blue waves-effect" href="panduanaplikasi.php">Panduan</button>-->
							<a href="panduanaplikasi.php" class="btn btn-block bg-pink waves-effect">PANDUAN</a>
						</div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-green waves-effect" type="submit">SIGN IN</button>
                        </div>
						
						<br><br>
						
                    </div>
					
					<div class="msg"><center>Jika mengalami kesulitan silahkan hubungi petugas di Rumah Sakit melalui WhatsApp <br>di nomor <a href="https://api.whatsapp.com/send?phone=6281808193232" target="_blank"> +62 818-0819-3232 </a>
					</center></div>

					<!-- YANG LAMA <center>Apabila Anda Belum Mendaftarkan NIK, Anda dapat menghubungi kami Melalui WhatsApp di +62 818-0819-3232, Atau mendatangi Petugas Pendaftaran di <br>Rumah Sakit Syarif Hidayatullah
					</center>-->
					<!-- coddingan untuk registrasi pasien baru-->	
					<!-- ditutup sementara-->	
                    <?php// if(SIGNUP == 'ENABLE') { ?>
                    <!--<div class="m-t-25 m-b--5 align-center">
                        <a href="signup.php">Belum terdaftar sebagai pasien?</a>
                    </div>-->	
                    <?php //} ?>
					<!-- end-->	
                </form>
            </div>

    <?php } ?>

    <?php
    //logout
    if(isset($_GET['action']) == "logout"){

        setcookie('username', '', time()-60*60*24*365);
        setcookie('password', '', time()-60*60*24*365);

        unset($_SESSION['username']);
        unset($_SESSION['level']);
        unset($_SESSION['jenis_poli']);
        $_SESSION = array();
        session_destroy();

        redirect('login.php');

    }
    ?>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
</body>

</html>
