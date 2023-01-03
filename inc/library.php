<?php
date_default_timezone_set("Asia/Bangkok");
// echo date_default_timezone_get();

$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];


$tgl_sekarang = date("Ymd");
$tgl_sekarang1 = date("Y-m-d");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");
$thn_jam_sekarang = date("Y-m-d H:i:s");
$thn_jam_sekarang1 = date("YmdHis");
$recmod = date("Y-m-d H:i:s");
//$tgl		= $tgl_sekarang $jam_sekarang;

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");


?>
