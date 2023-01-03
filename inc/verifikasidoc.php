<?php
session_start();
error_reporting(0);
include "../inc/inc.koneksi.php";
include "../inc/library.php";
$tgl1=$_GET[tgl1];
$tgl2=$_GET[tgl2];
$cecksts=$_GET[cecksts];
$tampil=mysql_query("SELECT * FROM upload a, upload_d b where a.nomtrak=b.nomtrak AND a.inputtgl BETWEEN '$tgl1' AND '$tgl2'");
$x=mysql_fetch_array($tampil);
?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: REPORT DOCUMENT IN ::</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
	<link rel="stylesheet" href="style.css" /> 
</head>
<body>


     <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
					<div class="card-header">
                            <strong class="card-title">Verifikasi Document</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
				  <?PHP
    echo "<tr><th>NO</th><th>Nomtrak</th><th>Nama Nasabah</th><th>No Transaksi</th><th>File Name</th><th>FILE</th><th>Transaction Date</th><th>Retention Date</th><th>PIC Documents</th>";
	
    $tampil=mysql_query("SELECT * FROM upload a, upload_d b where a.nomtrak=b.nomtrak AND a.inputtgl BETWEEN '$tgl1' AND '$tgl2' AND a.status='$cecksts' ORDER BY a.docid ASC");

    $no = $posisi+1;
//$no2=0;	
	while ($r=mysql_fetch_array($tampil)){
	 echo   "<tr><td align=center>$no</td>
				<td>$r[nomtrak] </td>
				<td>$r[namanasabah] </td>
				<td>$r[notransaksi] </td>
				<td>$r[filename] </td>
				<td>$r[fileimage]</a></td>
				<td>$r[inputtgl]</td>
				<td>$r[retentiondate]</td>
				<td>$r[pic]</td></tr>";
		$no++;		
    }
	
    echo "</fieldset></table></div></div></div></div></div>";?>

</body>
</html>