<?php

/***
* e-Pasien from version 0.1 Beta
* Last modified: 05 July 2018
* Author : drg. Faisol Basoro
* Email : dentix.id@gmail.com
*
* File : includes/jadwal-dokter.php
* Description : Datatable ajax file for dokter schedule
* Licence under GPL
***/

ob_start();
session_start();

include ('../config.php');

$table = <<<EOT
 (
    SELECT
        dokter.nm_dokter,
        poliklinik.nm_poli,
        DATE_FORMAT(jadwal.jam_mulai, '%H:%i') AS jam_mulai,
        DATE_FORMAT(jadwal.jam_selesai, '%H:%i') AS jam_selesai
    FROM jadwal
    INNER JOIN dokter
    INNER JOIN poliklinik on dokter.kd_dokter=jadwal.kd_dokter
    AND jadwal.kd_poli=poliklinik.kd_poli
    WHERE jadwal.hari_kerja='$namahari'
	AND
		jadwal.kd_poli NOT IN ('U0062') 
	AND
		jadwal.kd_poli NOT IN ('U0063')
	AND
		jadwal.kd_poli NOT IN ('U0057')		
	AND
		jadwal.kd_poli NOT IN ('RO')
	AND
		jadwal.kd_poli NOT IN ('U0050')			
	AND
		jadwal.kd_poli NOT IN ('LAB')	
	AND
		jadwal.kd_poli NOT IN ('U0023')
	ORDER BY jadwal.jam_mulai ASC 
 ) temp
EOT;

$primaryKey = 'nm_dokter';
$columns = array(
    array( 'db' => 'nm_poli','dt' => 0 ),
    array( 'db' => 'nm_dokter','dt' => 1 ),
	array( 'db' => 'jam_mulai','dt' => 2 ),
    array( 'db' => 'jam_selesai','dt' => 3 ),
);

$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db'   => DB_NAME,
    'host' => DB_HOST
);
require('ssp.class.php');
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
?>
