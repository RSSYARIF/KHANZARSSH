<?php

/***
* e-Pasien from version 0.1 Beta
* Last modified: 05 July 2018
* Author : drg. Faisol Basoro
* Email : dentix.id@gmail.com
*
* File : pendaftaran.php
* Description : Pendaftaran page
* Licence under GPL
***/

include_once ('layout/header.php');

?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>PENDAFTARAN PASIEN</h2>
            </div>


    <?php
    $date_now   = date_create($date);
    date_add($date_now, date_interval_create_from_date_string(HARIDAFTAR.' days'));
    $date_next  = date_format($date_now, 'Y-m-d');

    $action     = isset($_GET['action'])?$_GET['action']:null;

    if(!$action){

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if($_POST['tgl_registrasi'] == $date && $time > LIMITJAM) {
                echo '<div class="alert bg-pink alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Jam pendaftaran anda sudah lewat jam '.LIMITJAM.' WIB. Silahkan pilih tanggal periksa yang lain.</div>';
            } else if($_POST['tgl_registrasi'] < $date) {
                echo '<div class="alert bg-pink alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Tanggal pendaftaran anda sudah lewat. Silahkan pilih tanggal periksa yang lain.</div>';
            } else if($_POST['tgl_registrasi'] > $date_next) {
                echo '<div class="alert bg-pink alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Tanggal pendaftaran anda lebih dari hari yang ditentukan. Silahkan pilih tanggal periksa yang lain.</div>';
            } else {
                redirect("pendaftaran.php?action=pilih-poli&tgl_registrasi=$_POST[tgl_registrasi]");
            }
        }

    ?>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form id="form_validation" action="" method="POST">
                                <label for="email_address">Nama Lengkap</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        $pasien = fetch_array(query("
                                            SELECT
                                                *
                                            FROM
                                                pasien
                                            WHERE
                                                no_rkm_medis = '{$_SESSION['username']}'
                                        "));
                                        ?>
                                       <input type="text" id="nama_lengkap" value="<?php echo $pasien['nm_pasien']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <label for="email_address">Nomor Rekam Medik (RM)</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="nomor_rm" value="<?php echo $_SESSION['username']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <label for="email_address">Tanggal Rencana Kunjungan <br>( Booking Pendaftaran Online dapat dilakukan pada H-7 s/d H-1 dari jadwal praktek dokter yang dipilih )</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="tgl_registrasi" placeholder="Pilih Tanggal" class="datepicker form-control">
					</div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit" name="pilihpoli">PILIH POLI</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"> 
                    <div class="card">
                        <div class="header bg-indigo">
                            <h2 align="center">INFORMASI</h2>
                        </div>
			<div class="body">
                        <p class="font-15" style="text-align: justify;"
						>1. Pasien diharapkan hadir 30 menit sebelum jadwal praktek dokter yang di Pilih.</p>
                        <p class="font-15" style="text-align: justify;"
						>2. Bila pasien datang dan nomor antriannya sudah terlewati (terlambat) maka silahkan konfirmasi kedatangan kepada perawat dan akan dilakukan pemanggilan setelah 2 nomor antrian.</p>
                        <P class="font-15" style="text-align: justify;"
						>3. Bila pasien memilih kunjungan ke poli anak dengan rencana vaksinasi, maka silahkan konfirmasi dahulu untuk ketersediaan jenis vaksin yang diharapkan menghubungi WhatsApp chat di nomor <a href="https://api.whatsapp.com/send?phone=628179125960" target="_blank"> +62 817-9125-960</a></P>
                        <P class="font-15" style="text-align: justify;"
						>4. Pasien yang melakukan pendaftaran online, akan di konfirmasi kehadirannya oleh petugas rumah sakit pada H-1 tanggal kunjungan. Pastikan nomor kontak yang tercantum pada data pasien aktif/dapat dihubungi.</P>
                        <hr>
                        <div align="center" class="font-10">UPDATE DATA TERBARU PROFIL ANDA DENGAN MENGUNJUNGI UNIT PENDAFTARAN RUMAH SAKIT</div>
			</div>
		</div>
          </div>


            <!-- #END# Basic Validation -->

    <?php } ?>

    <?php
    //edit
    if($action == "pilih-poli"){

        $tanggal=$_GET['tgl_registrasi'];
        $tentukan_hari=date('D',strtotime($tanggal));
		 $day = array(
			'Sun' => 'AKHAD',
			'Mon' => 'SENIN',
			'Tue' => 'SELASA',
			'Wed' => 'RABU',
			'Thu' => 'KAMIS',
			'Fri' => 'JUMAT',
			'Sat' => 'SABTU'
			);
			$hari=$day[$tentukan_hari];

if($_SERVER['REQUEST_METHOD'] == "POST") {

    //cek biar ga double datanya
	
    $cek = fetch_array(query("SELECT no_reg FROM booking_registrasi WHERE no_rkm_medis='$_SESSION[username]' AND tanggal_periksa='$_POST[tgl_registrasi]'"));
    //edit tanggal 27-05-2022
	//$cek = fetch_array(query("SELECT no_reg FROM booking_registrasi WHERE no_rkm_medis='$_SESSION[username]' AND kd_dokter='$_POST[kd_dokter]' AND kd_poli='$_POST[kd_poli]' AND tanggal_periksa='$_POST[tgl_registrasi]'"));
    if($cek == ''){

      $tentukan_hari=date('D',strtotime($_POST['tgl_registrasi']));
      $day = array(
        'Sun' => 'AKHAD',
        'Mon' => 'SENIN',
        'Tue' => 'SELASA',
        'Wed' => 'RABU',
        'Thu' => 'KAMIS',
        'Fri' => 'JUMAT',
        'Sat' => 'SABTU'
      );
      $hari=$day[$tentukan_hari];

      $sql = "SELECT a.kd_dokter, c.nm_dokter, a.kuota FROM jadwal a, poliklinik b, dokter c WHERE a.kd_poli = b.kd_poli AND a.kd_dokter = c.kd_dokter AND a.kd_poli = '{$_POST['kd_poli']}' AND a.hari_kerja LIKE '%$hari%'";

      $result = fetch_assoc(query($sql));

        $check_kuota = fetch_assoc(query("SELECT COUNT(*) AS count FROM booking_registrasi WHERE kd_poli = '{$_POST['kd_poli']}' AND tanggal_periksa = '{$_POST['tgl_registrasi']}'"));
        $curr_count = $check_kuota['count'];
        $curr_kuota = $result['kuota'];
        $online = $curr_kuota / LIMIT;


        if(empty($_POST['tgl_registrasi'])) {
	    $errors[] = 'Tanggal registrasi tidak boleh kosong';
        }
        if(empty($_POST['kd_poli'])) {
	    $errors[] = 'Poliklinik tujuan tidak boleh kosong';
        }
        if(empty($_POST['kd_dokter'])) {
	    $errors[] = 'Dokter tujuan tidak boleh kosong';
        }
        if ($_POST['kd_pj'] == KODE_BPJS &&  $_POST['no_rujukan'] == "") {
        $errors[] = 'Anda memilih cara bayar BPJS. Silahkan masukkan nomor rujukan anda.';
        }

        if($curr_count == $online) {
          $errors[] = 'Limit pendaftaran online telah terpenuhi. Silahkan pilih hari lain.';
        }
		
        if(!empty($_POST['no_rujukan'])) {
          // Check no rujukan not empty
  		  ini_set("default_socket_timeout","05");
  		  set_time_limit(5);
  		  $f=fopen(BpjsApiUrl,"r");
  		  $r=fread($f,1000);
  		  fclose($f);

  		  $no_rujukan = trim($_REQUEST['no_rujukan']);

  		  $Rujukan = array();

  		  if(strlen($r)>1) {
    		date_default_timezone_set('UTC');
    		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
    		$signature = hash_hmac('sha256', ConsID."&".$tStamp, SecretKey, true);
    		$encodedSignature = base64_encode($signature);
    		$ch = curl_init();
    		$headers = array(
     			'X-cons-id: '.ConsID.'',
     			'X-timestamp: '.$tStamp.'' ,
     			'X-signature: '.$encodedSignature.'',
     			'Content-Type:application/json',
    		);
    		curl_setopt($ch, CURLOPT_URL, BpjsApiUrl."Rujukan/".$no_rujukan);
    		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    		curl_setopt($ch, CURLOPT_HTTPGET, 1);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    		$content = curl_exec($ch);
    		$err = curl_error($ch);

    		curl_close($ch);
    		//print_r($content);
    		$result = json_decode($content, true);
    		$cek_rujukan = $result['metaData']['message'];
  		  } else {
    		$cek_rujukan = "offline";
  		  }

          if ($cek_rujukan !== "OK") {
        	$errors[] = 'Nomor rujukan BPJS anda tidak ditemukan. Silahkan gunakan cara bayar sebagai Pasien UMUM.';
          } else if ($cek_rujukan == "offline") {
        	$errors[] = 'Sambungan ke server BPJS sedang ada gangguan. Silahkan ulangi beberapa saat lagi.';
          }
        }

        if(!empty($errors)) {
	        foreach($errors as $error) {
	            echo validation_errors($error);
	        }
        } else {

		$get_pasien = fetch_array(query("SELECT * FROM pasien WHERE no_rkm_medis = '{$_SESSION['username']}'"));

	    //mencari no reg terakhir
	    $no_reg_akhir = fetch_array(query("SELECT max(no_reg) FROM booking_registrasi WHERE kd_dokter='$_POST[kd_dokter]' and tanggal_periksa='$_POST[tgl_registrasi]'"));
        $no_urut_reg = substr($no_reg_akhir[0], 0, 3);
        $no_reg = sprintf('%03s', ($no_urut_reg + 1));

        $no_rkm_medis = $_SESSION['username'];
        $tanggal_periksa = $_POST['tgl_registrasi'];
        $kd_dokter = $_POST['kd_dokter'];
        $kd_poli = $_POST['kd_dokter'];
        $nm_poli = $_POST['nm_poli'];
        $nm_dokter = $_POST['nm_dokter'];


	    $insert = query("
            INSERT INTO booking_registrasi
            SET no_rkm_medis    = '$no_rkm_medis',
            	tanggal_periksa = '$tanggal_periksa',
                kd_poli         = '{$_POST['kd_poli']}',
                kd_dokter       = '{$_POST['kd_dokter']}',
                kd_pj           = '{$_POST['kd_pj']}',
                no_reg          = '$no_reg',
                tanggal_booking = '$date',
                jam_booking 	= '$time',
                waktu_kunjungan = '$date_time',
                limit_reg 		= '1',
                status 			= 'Belum'
        ");

	    if($insert) {
	        redirect("pendaftaran.php?action=selesai&tanggal_periksa=$tanggal_periksa&no_reg=$no_reg");
	    }

        }
} else {
    echo '<div class="alert bg-pink alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Anda sudah terdaftar untuk tanggal '.$_POST[tgl_registrasi].'. <br> Silahkan pilih Tanggal berobat yang lain.</div>';
    //echo '<div class="alert bg-pink alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Anda sudah terdaftar untuk tanggal '.$_POST[tgl_registrasi].', dengan Poliklinik Tujuan dan Dokter Tersebut. <br> Silahkan pilih Poliklinik atau Dokter Tujuan yang lain.</div>';
}
}


    ?>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form id="form_validation" name="pilihan" action="" method="POST"  enctype="multipart/form-data">
                                <input type="hidden" name="tgl_registrasi" value="<?php echo $tanggal; ?>">
                                <label for="email_address">Poliklinik Tujuan</label>
                                <div class="form-group">
                                    <div class="form-line">
            							<select class="form-control show-tick" name="kd_poli" onchange="showDokter()">
										    <option value="" selected >-- Pilih Poliklinik --</option>
									    	<?php
											//Source code Aslinya
											/*$result = query("
                                                SELECT
                                                    jadwal.kd_poli,poliklinik.nm_poli,
                                                    DATE_FORMAT(jadwal.jam_mulai, '%H:%i') AS jam_mulai,
                                                    DATE_FORMAT(jadwal.jam_selesai, '%H:%i') AS jam_selesai
                                                FROM
                                                    jadwal,
                                                    poliklinik,
                                                    dokter
                                                WHERE
                                                    jadwal.kd_poli = poliklinik.kd_poli
                                                AND
                                                    jadwal.kd_dokter = dokter.kd_dokter
                                                AND
                                                    hari_kerja LIKE '%$hari%'
                                                GROUP BY
                                                    poliklinik.kd_poli
                                            ");
											while($data = fetch_array($result)){
											    echo "<option value='".$data['kd_poli']."'>".$data['nm_poli']." [".$data['jam_mulai']." - ".$data['jam_selesai']."]</option>";
											}
                                            */?>
											
											<?php
											//Source Code Di Edit Oleh Amelia Yahya 06/01/2022
											//Kecuali 
											//U0062 OPTIK, U0063 Resume, U0057 Legalisir, RO Radiologi, U0050 Apotek, LAB Laboratorium, BKIA U0023
											$result = query("
                                                SELECT
                                                    jadwal.kd_poli,poliklinik.nm_poli
                                                FROM
                                                    jadwal,
                                                    poliklinik,
                                                    dokter
                                                WHERE
                                                    jadwal.kd_poli = poliklinik.kd_poli
                                                AND
                                                    jadwal.kd_dokter = dokter.kd_dokter
                                                AND
                                                    hari_kerja LIKE '%$hari%'
												AND
													poliklinik.kd_poli NOT IN ('U0062') 
												AND
													poliklinik.kd_poli NOT IN ('U0063')
												AND
													poliklinik.kd_poli NOT IN ('U0057')		
												AND
													poliklinik.kd_poli NOT IN ('RO')
												AND
													poliklinik.kd_poli NOT IN ('U0050')			
												AND
													poliklinik.kd_poli NOT IN ('LAB')	
												AND
													poliklinik.kd_poli NOT IN ('U0023')
												AND
													poliklinik.kd_poli NOT IN ('U0053')													
                                               							 AND
													poliklinik.kd_poli NOT IN ('IGDK')
												AND
													poliklinik.kd_poli NOT IN ('FIS')
												AND
													jadwal.kd_dokter NOT IN ('dr0051')
												AND
													jadwal.kd_dokter NOT IN ('dr0039')
												
												GROUP BY
                                                    							poliklinik.kd_poli
												ORDER BY poliklinik.nm_poli ASC 
                                            ");
											while($data = fetch_array($result)){
												echo "<option value='".$data['kd_poli']."'>".$data['nm_poli']." </option>";
											}
                                            ?>
										</select>
                                    </div>
                                </div>
								
								<!--//Source code Aslinya-->
								<!--<script language="JavaScript" type="text/JavaScript">
                                function showDokter() {-->
                                <?php
                                /*$result = query("
                                    SELECT
                                        jadwal.kd_poli
                                    FROM
                                        jadwal,
                                        poliklinik,
                                        dokter
                                    WHERE
                                        jadwal.kd_poli = poliklinik.kd_poli
                                    AND
                                        jadwal.kd_dokter = dokter.kd_dokter
                                    AND
                                        jadwal.hari_kerja LIKE '%$hari%'
                                ");
                                while ($data = fetch_array($result)) {
                                    $idPoli = $data['kd_poli'];
                                    echo "if (document.pilihan.kd_poli.value == \"".$idPoli."\") {";
                                    $hasil2 = query("
                                        SELECT
                                            jadwal.kd_dokter,
                                            dokter.nm_dokter
                                        FROM
                                            jadwal,
                                            poliklinik,
                                            dokter
                                        WHERE
                                            jadwal.kd_poli = poliklinik.kd_poli
                                        AND
                                            jadwal.kd_dokter = dokter.kd_dokter
                                        AND
                                            jadwal.kd_poli = '$idPoli'
                                        AND
                                            jadwal.hari_kerja LIKE '%$hari%'
                                    ");
                                    $content = "document.getElementById('dokter').innerHTML = \"<div style='padding-left:10px;margin-right:24px;'><select name='kd_dokter' class='form-control show-tick'>";
                                        while ($data2 = fetch_array($hasil2)) {
                                            $content .= "<option value='".$data2['kd_dokter']."'>".$data2['nm_dokter']."</option>";
                                        }
                                        $content .= "</select></div>\";";
                                    echo $content;
                                echo "}\n";
                                }
                                */?>
                                <!--}
                                </script> -->
								
								<!--Source Code Di Edit Oleh Amelia Yahya 06/01/2022 -->
                                <script language="JavaScript" type="text/JavaScript">
                                function showDokter() {
                                <?php
                                $result = query("
                                    SELECT
                                        jadwal.kd_poli
                                    FROM
                                        jadwal,
                                        poliklinik,
                                        dokter
                                    WHERE
                                        jadwal.kd_poli = poliklinik.kd_poli
                                    AND
                                        jadwal.kd_dokter = dokter.kd_dokter
                                    AND
                                        jadwal.hari_kerja LIKE '%$hari%'
					AND
					jadwal.kd_dokter NOT IN ('dr0051')
					AND
					jadwal.kd_dokter NOT IN ('dr0039')
					

                                ");
                                while ($data = fetch_array($result)) {
                                    $idPoli = $data['kd_poli'];
                                    echo "if (document.pilihan.kd_poli.value == \"".$idPoli."\") {";
                                    $hasil2 = query("
                                        SELECT
                                            jadwal.kd_dokter,
                                            dokter.nm_dokter,
											DATE_FORMAT(jadwal.jam_mulai, '%H:%i') AS jam_mulai,
											DATE_FORMAT(jadwal.jam_selesai, '%H:%i') AS jam_selesai
                                        FROM
                                            jadwal,
                                            poliklinik,
                                            dokter
                                        WHERE
                                            jadwal.kd_poli = poliklinik.kd_poli
                                        AND
                                            jadwal.kd_dokter = dokter.kd_dokter
                                        AND
                                            jadwal.kd_poli = '$idPoli'
                                        AND
                                            jadwal.hari_kerja LIKE '%$hari%'
					AND
					jadwal.kd_dokter NOT IN ('dr0051')
				     AND
					jadwal.kd_dokter NOT IN ('dr0039')
					

										ORDER BY jadwal.jam_mulai ASC 
                                    ");
                                    $content = "document.getElementById('dokter').innerHTML = \"<div style='padding-left:10px;margin-right:24px;'><select name='kd_dokter' class='form-control show-tick'>";
                                        while ($data2 = fetch_array($hasil2)) {
                                            $content .= "<option value='".$data2['kd_dokter']."'>".$data2['nm_dokter']. " [".$data2['jam_mulai']." - ".$data2['jam_selesai']."]</option>";
                                        }
                                        $content .= "</select></div>\";";
                                    echo $content;
                                echo "}\n";
                                }
                                ?>
                                }
                                </script>
                                <label for="email_address">Dokter Tujuan</label>
                                <div class="form-group">
                                    <div class="form-line" id="dokter">
                                    <select class="form-control show-tick">
                                        <option>-- Pilih Dokter --</option>
                                    </select>
                                    </div>
                                </div>
                                <label for="email_address">Cara Bayar</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="kd_pj" id="getFname" onchange="admSelectCheck(this);">
											<?php
											//Source Code di Edit Amelia Yahya Tanggal 07/01/2022 DAN 05-07-2022
											// CARA BAYAR yang dipilih 
                                            $result=query("
                                                SELECT
                                                    *
                                                FROM
                                                    penjab
												WHERE
													kd_pj IN ('A09','A77','A10','RS', 'C22') ORDER BY kd_pj asc
                                            ");
                                            while($row=fetch_array($result)){
											    echo "<option id='$row[png_jawab]' value='$row[kd_pj]'>$row[png_jawab]</option>";
											}?>
                                        </select>
                                        <div id="admDivCheck" style="display:none;">
                                          		<div class="alert bg-green alert-dismissible" role="alert">Anda memilih cara bayar BPJS. <br/>Apakah anda memiliki surat rujukan atau surat kontrol? <br/>Jika tidak, silahkan pilih cara bayar umum. <br/>Jika ya, silahkan lanjutkan pendaftaran anda dengan memasukkan nomor rujukan.</div>
                                                <input name="no_rujukan" id="inputFile" type="text" class="form-control" placeholder="Masukkan nomor rujukan BPJS"/>
                                        </div>
                                    </div>
									<!-- SOURCE CODE ASLINYA
									<div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="kd_pj" id="getFname" onchange="admSelectCheck(this);">
											<?php
											// Kecuali
											// - kosong, OB1 Obat Bebas, E48 VIDIO COM, PIU ASURANSI/UMUM/PERUSAHAAN, E28 BPJS / JAMSOSTEK KETENAGA KERJAAN, D68 PND, 
                                            /*$result=query("
                                                SELECT
                                                    *
                                                FROM
                                                    penjab
												WHERE
													kd_pj NOT IN ('-')
												AND
													kd_pj NOT IN ('OB1')
												AND
													kd_pj NOT IN ('E48')
												AND
													kd_pj NOT IN ('PIU')	
												AND
													kd_pj NOT IN ('E28')
												AND
													kd_pj NOT IN ('D68')
                                            ");
                                            while($row=fetch_array($result)){
											    echo "<option id='$row[png_jawab]' value='$row[kd_pj]'>$row[png_jawab]</option>";
											}*/?>
                                        </select>
                                        <div id="admDivCheck" style="display:none;">
                                          		<div class="alert bg-green alert-dismissible" role="alert">Anda memilih cara bayar BPJS. <br/>Apakah anda memiliki surat rujukan atau surat kontrol? <br/>Jika tidak, silahkan pilih cara bayar umum. <br/>Jika ya, silahkan lanjutkan pendaftaran anda dengan memasukkan nomor rujukan.</div>
                                                <input name="no_rujukan" id="inputFile" type="text" class="form-control" placeholder="Masukkan nomor rujukan BPJS"/>
                                        </div>
                                    </div>
                                </div>-->
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox" required>
                                    <label for="checkbox">Saya menyetujui ketentuan dan persyaratan</label>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit" name="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
    <?php } ?>

    <?php
    //edit
    $action      =isset($_GET['action'])?$_GET['action']:null;
    if($action  == "selesai"){
    $reg_det = fetch_array(query("
    SELECT
      f.nm_pasien,
      a.tanggal_periksa,
      a.no_reg,
      b.nm_poli,
      c.nm_dokter,
      a.status,
      d.png_jawab
    FROM booking_registrasi a
    LEFT JOIN poliklinik b ON a.kd_poli = b.kd_poli
    LEFT JOIN dokter c ON a.kd_dokter = c.kd_dokter
    LEFT JOIN penjab d ON a.kd_pj = d.kd_pj
    LEFT JOIN pasien f ON a.no_rkm_medis = f.no_rkm_medis
    WHERE a.no_reg = '{$_GET['no_reg']}'
    AND a.tanggal_periksa = '{$_GET['tanggal_periksa']}'
    AND a.no_rkm_medis = '{$_SESSION['username']}'
    "));
    ?>


            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                                <label for="email_address">Nama Lengkap</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo $reg_det['nm_pasien']; ?>
                                    </div>
                                </div>
                                <label for="email_address">Nomor Rekam Medik</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo $_SESSION['username']; ?>
                                    </div>
                                </div>
                                <label for="email_address">Tanggal Periksa</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo $reg_det['tanggal_periksa']; ?>
                                    </div>
                                </div>
                                <label for="email_address">Nomor Urut</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo $reg_det['no_reg']; ?>
                                    </div>
                                </div>
                                <label for="email_address">Poliklinik Tujuan</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo $reg_det['nm_poli']; ?>
                                    </div>
                                </div>
                                <label for="email_address">Dokter Tujuan</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo $reg_det['nm_dokter']; ?>
                                    </div>
                                </div>
                                <label for="email_address">Cara Bayar</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo $reg_det['png_jawab']; ?>
                                    </div>
                                </div>
                                <label for="email_address">Status Pendaftaran</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php if($reg_det['status'] == 'Belum') { echo "Belum divalidasi"; } else { echo "Sudah divalidasi"; } ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->

            <div class="alert bg-green alert-dismissible" role="alert">
            Terimakasih Atas kepercayaan Anda terhadap Rumah Sakit Syarif Hidayatullah.<br>
			
			Untuk konfirmasi kedatangan pasien pada tanggal berobat yang telah dipilih / dibooking, <br> 
			silahkan Bapak/Ibu/Saudara/i datang langsung ke bagian Pendaftaran.<br>
			
			Jika memilih cara bayar Asuransi, bawalah kartu asuransi dan tunjukkan pada petugas Pendaftaran.<br>
			Jika memilih cara bayar UMUM, silahkan melakukan pembayaran di kasir terlebih dahulu sebelum ke Poliklinik tujuan anda.
            <!-- Bawalah kartu Berobat anda dan datang 1 jam sebelumnya.<br>-->
            <!--Jika memilih cara bayar UMUM, lakukan pembayaran di kasir terlebih dahulu sebelum ke Poliklinik tujuan anda.<br>
            Jika memilih cara bayar ASURANSI, lakukan konfirmasi di Pendaftaran terlebih dahulu sebelum ke Poliklinik tujuan anda.<br>-->
            <!--Jika memilih cara bayar BPJS, bawalah surat rujukan atau surat kontrol asli dan tunjukkan pada petugas di Lobby resepsionis.-->
            </div>

    <?php } ?>

        </div>
    </section>

<?php include_once ('layout/footer.php'); ?>
