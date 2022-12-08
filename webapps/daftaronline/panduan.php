<?php

/***
* e-Pasien from version 0.1 Beta
* Last modified: 05 July 2018
* Author : drg. Faisol Basoro
* Email : dentix.id@gmail.com
*
* File : index.php
* Description : Panduan page
* Licence under GPL
***/
ob_start();
session_start();

require_once('config.php');


if(PRODUCTION == 'YES') {
  ini_set('display_errors', 0);
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
}

include_once ('layout/header.php');

?>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>PANDUAN<h2>
            </div>


            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <b><u>A. Tentang Aplikasi </u></b>
										<br><br>
										<p>1) Apa itu Daftar Online RS Syarif Hidayatullah?</p>
										<p>
                						Daftar Online RS Syarif Hidayatullah adalah Aplikasi Pasien diperuntukan bagi pasien yang ingin mendaftar secara online di RS Syarif Hidayatullah. 
										<!--<br>Selain itu ada fitur Informasi RS Syarif Hidayatullah, seperti : Identitas Pasien, Jadwal Dokter, Histori Kunjungan Rawat Jalan dan Rawat Inap, beserta Informasi / Promosi RS Syarif Hidayatullah.-->
										</p>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <div class="form-line">
										<p>2) Siapa saja yang bisa menggunakan?</p>
										<p>Penggunaan aplikasi ini hanya berlaku bagi Pasien yang sudah pernah berobat dan memiliki No Rekam Medis (RM) di RS Syarif Hidayatullah.
										</p>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <div class="form-line">
										<p>3) Bagaimana cara penggunannya?</p>
										<p>
										Jika anda membaca panduan ini, maka anda telah membuka website Daftar Online RS Syarif Hidayatullah di perangkat anda. 
										<br>Selanjutnya silahkan lakukan Sign In ke sistem RS Syarif Hidayatullah.
                						<br>Langkah-langkah Sign In :
                						<br>1. Masukkan Nomor Rekam Medis (RM) dan Tanggal Lahir Anda.
										<br>2. Lalu tekan Sign In.
                						<br>Jika Nomor Rekam Medis (RM) dan Tanggal Lahir anda terdaftar dalam sistem RS Syarif Hidayatullah maka selanjutnya anda akan dibawa kehalaman Beranda.
										</p>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <div class="form-line">
										<p>4) Bagaimana jika tidak bisa login?</p>
										<p>
										Jika mengalami kendala atau kesulitan dalam melakukan login, silahkan hubungi petugas RS Syarif Hidayatullah melalui WhatsApp chat di nomor <a href="https://api.whatsapp.com/send?phone=6281808193232" target="_blank"> +62 818-0819-3232 </a>
										</p>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <div class="form-line">
										5) Bagaimana jika tidak tahu Nomor Rekam Medis (RM)?
										<p>
										Silahkan hubungi petugas RS Syarif Hidayatullah melalui WhatsApp chat di nomor <a href="https://api.whatsapp.com/send?phone=6281808193232" target="_blank"> +62 818-0819-3232 </a> dengan melengkapi data Nama Lengkap Pasien dan Tanggal Lahir Pasien.
										</p>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <div class="form-line">
										6) Bagaimana jika belum pernah berobat (pasien baru)?
										<p>
										Silahkan mendaftar sebagai pasien baru dengan cara mendatangi petugas pendaftran RS Syarif Hidayatullah dengan melengkapi data Nama Lengkap, Tanggal Lahir, NIK, sesuai dengan identitas KTP anda.
										</p>
                                        </div>
                                    </div>
                                </div>
								
								<div class="col-sm-12">
								
								<div class="form-group">
                                        <div class="form-line">
                                        <b><u>B. Pelayanan Poliklinik RS Syarif Hidayatullah </u></b>
										<br><br>
										<p><p>1) Bagaimana cara melakukan Booking Pendaftaran Online?</p></p>
										<p>
                						Setelah anda Sign In ke sistem berikut cara melakukan booking pendaftaran online:
										<br>1. Silahkan pilih menu Booking Pendaftaran.
                						<br>2. Selanjutnya pilih tanggal kunjungan, lalu tekan tombol Pilih Poli.
										<br>3. Selanjutnya pilih poliklinik dan dokter yang dituju sesuai tanggal pilihan anda serta pilih cara bayar.
                						<br>4. Bila data sudah lengkap silahkan tekan tombol SUBMIT.
                						<br>5. Silahkan screenshot dan simpan bukti booking pendaftaran anda. 
										<br>Anda juga bisa melihat bukti booking di halaman menu Booking Pendaftaran.
										</p>
                                        </div>
                                </div>
									
									<div class="form-group">
                                        <div class="form-line">
										<p>2) Kapan pendaftaran bisa dilakukan?</p>
										<p>
										Booking Pendaftaran Online dapat dilakukan pada Jadwal H+1 s/d H+7 dari hari mendaftar dengan Sign In mengunakan Nomor RM dan Tanggal Lahir, 
										Lalu membuat Booking Pendaftaran dengan memilih Tanggal Kunjungan, Poliklinik Tujuan dan Dokter Tujuan serta pilih Cara Bayar.
										</p>
                                        </div>
                                    </div>
								
								
								</div>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php include_once ('layout/footer.php'); ?>
