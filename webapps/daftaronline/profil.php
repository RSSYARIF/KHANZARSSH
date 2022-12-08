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
                <h2><b><font color='red'>PASTIKAN DATA TERCANTUM ADALAH DATA YANG TERBARU</font></b></h2>
            </div>

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
								<label for="email_address">Namor Telpon/Handphone</label>
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
                                       <input type="text" id="nama_telpon" value="<?php echo $pasien['no_tlp']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
								<label for="email_address">KARTU TANDA PENDUDUK</label>
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
                                       <input type="text" id="ktp" value="<?php echo $pasien['no_ktp']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
								<label for="email_address">Tanggal Lahir</label>
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
                                       <input type="text" id="tanggal_lahir" value="<?php echo $pasien['tgl_lahir']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <label for="email_address">Nomor Rekam Medik (RM)</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="nomor_rm" value="<?php echo $_SESSION['username']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
								<label for="email_address">Alamat</label>
										
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
                                       <input type="text" id="alamat" value="<?php echo $pasien['alamatpj']; ?>" class="form-control" disabled> 
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
			
            <!-- #END# Basic Validation -->
            <div class="alert bg-green alert-dismissible" role="alert">
            Terimakasih Atas kepercayaan Anda terhadap Rumah Sakit Syarif Hidayatullah.<br>
			untuk konfirmasi Perubahan Data Pasien terbaru/Mengubah Data Pasien<br> 
			silahkan Bapak/Ibu/Saudara/i datang langsung ke bagian Pendaftaran.<br>
            </div>

  

        </div>
    </section>

<?php include_once ('layout/footer.php'); ?>
