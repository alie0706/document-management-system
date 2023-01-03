<?php
session_start();
error_reporting(0);
include "../inc/inc.koneksi.php";
include "../inc/library.php";
?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: FORM SYARAT PEMBIAYAAN:</title>
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
<body onload="window.print()">


     <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
<?php
  $tampil=mysql_query("SELECT * FROM upload where docid='$_GET[docid]' AND nomtrak='$_GET[nomtrak]'");
  $x=mysql_fetch_array($tampil);
  $cabang=mysql_query("SELECT * FROM f_cabang where cabangid='$x[cabangid]'");
  $m=mysql_fetch_array($cabang);
  $status=mysql_query("SELECT * FROM masterstatus where statusid='$m[statusid]'");
  $s=mysql_fetch_array($status);
  $verifikasi=mysql_query("SELECT * FROM syarat_persetujuan where nomtrak='$_GET[nomtrak]'");
  $v=mysql_fetch_array($verifikasi);?>
<div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <img src="../images/logoo.jpg" width="100%" height="150px">
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>

  <col width="22" />
  <col width="64" />
  <col width="96" />
  <col width="123" />
  <col width="23" />
  <col width="19" />
  <col width="29" />
  <col width="19" span="2" />
  <col width="29" />
  <col width="19" />
  <col width="23" span="2" />
  <col width="77" />
  <col width="64" />
  <col width="62" />
  <col width="64" span="2" />
  <col width="18" />
 <tr height="21">
    <td colspan="19" height="21" width="837" align="center"><b>SYARAT - SYARAT</b></td>
  </tr>
  <tr height="21">
    <td colspan="19" rowspan="2" height="41" align="center"><b>PEMBIAYAAN</b></td>
  </tr>
  <tr height="20"> </tr>
  <tr height="20">
    <td colspan="19" height="20">A. Proposal</td>
  </tr>
  <tr height="20">
    <td colspan="19" height="20"></td>
  </tr>
 <tr height="20">
    <td colspan="3" height="20">Nomor Registrasi    Arsip</td>
    <td colspan="5">: <?php echo "$x[notransaksi]";?></td>
    <td colspan="3" rowspan="4"></td>
    <td colspan="3">Sektor Ekonomi</td>
    <td colspan="5">: <?php echo "";?></td>
  </tr>
  <tr height="20">
    <td colspan="3" height="20">Nama Nasabah</td>
    <td colspan="5">: <?php echo "$x[namanasabah]";?></td>
    <td colspan="3">Jenis Pembiayaan</td>
    <td colspan="5">: <?php echo "$s[namastatus]";?></td>
  </tr>
  <tr height="20">
    <td colspan="3" height="20">Wilayah / Cabang</td>
    <td colspan="5">: <?php echo "$m[namacabang]";?></td>
    <td colspan="8" rowspan="2"></td>
  </tr>
  <tr height="20">
    <td colspan="3" height="20">Kota / Kabupaten</td>
    <td colspan="5">: ......................................</td>
  </tr>
  <tr height="20">
    <td colspan="19" height="20"></td>
  </tr>
  <tr height="20">
    <td colspan="19" height="20">B. Kelengkapan    Persyaratan</td>
  </tr>
  <tr height="21">
    <td colspan="19" height="21">&nbsp;</td>
  </tr>
  <tr height="27">
    <td colspan="4" height="27" align="center"><b>UKM</td>
    <td colspan="8" align="center"><b>Checklist</td>
    <td colspan="7" align="center"><b>KOLEKTIF/SERTIFIKASI</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">&nbsp;</td>
    <td colspan="4" rowspan="2" align="center"><b>LEGAL</td>
    <td colspan="4" rowspan="2" align="center"><b>ARSIP</b></td>
    <td colspan="7" rowspan="2">&nbsp;</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20" align="center"><b>Berkas Pengajuan</b></td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Persetujuan Komite Pembiayaan</td>
	<?php
	if($v[persetujuan_komite_pembiayaan_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="persetujuan_komite_pembiayaan_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="persetujuan_komite_pembiayaan_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[persetujuan_komite_pembiayaan_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="persetujuan_komite_pembiayaan_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="persetujuan_komite_pembiayaan_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">Pas Foto pemohon &amp; pasangan</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Proposal</td>
    <?php
	if($v[proposal_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="proposal_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="proposal_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[proposal_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="proposal_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="proposal_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">FC. KTP pemohon &amp; pasangan</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Taksasi Jaminan</td>
    <?php
	if($v[taksasi_jaminan_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="taksasi_jaminan_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="taksasi_jaminan_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[taksasi_jaminan_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="taksasi_jaminan_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="taksasi_jaminan_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">FC. Kartu Keluarga</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">MPP</td>
    <?php
	if($v[mpp_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="mpp_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="mpp_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[mpp_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="mpp_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="mpp_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">FC. Surat Nikah / Surat Cerai</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Peta lokasi &amp; foto usaha/kerja</td>
    <?php
	if($v[peta_lokasi_usaha_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_usaha_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_usaha_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[peta_lokasi_usaha_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_usaha_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_usaha_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">FC. ID pegawai</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Peta lokasi &amp; foto Foto jaminan</td>
    <?php
	if($v[peta_lokasi_jaminan_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_jaminan_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_jaminan_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[peta_lokasi_jaminan_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_jaminan_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_jaminan_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">FC. Taspen</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Peta lokasi &amp; foto domisili</td>
    <?php
	if($v[peta_lokasi_domisili_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_domisili_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_domisili_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[peta_lokasi_domisili_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_domisili_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="peta_lokasi_domisili_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">SK Pangkat ASLI (turunan BPD)</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">BI Checking</td>
    <?php
	if($v[bi_checking_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="bi_checking_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="bi_checking_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[bi_checking_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="bi_checking_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="bi_checking_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">SK Berkala ASLI</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">RAB</td>
    <?php
	if($v[rab_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="rab_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="rab_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[rab_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="rab_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="rab_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">FC. SK Pangkat 80%</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Bon sesuai pengajuan</td>
    <?php
	if($v[bon_pengajuan_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="bon_pengajuan_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="bon_pengajuan_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[bon_pengajuan_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="bon_pengajuan_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="bon_pengajuan_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	 <td colspan="7">FC. SK Pangkat 100%</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">&nbsp;</td>
    <td colspan="4" align="center"></td>
    <td colspan="4" align="center"></td>
    <td colspan="7" rowspan="2">&nbsp;</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20" align="center"><b>Persyaratan Umum</b></td>
    <td colspan="4" align="center"></td>
    <td colspan="4"></td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">FC. KTP pemohon &amp; pasangan</td>
    <?php
	if($v[copy_ktp_pemohon_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_ktp_pemohon_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_ktp_pemohon_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_ktp_pemohon_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_ktp_pemohon_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_ktp_pemohon_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">FC. Leger Gaji</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Pas foto pemohon &amp; pasangan</td>
    <?php
	if($v[foto_pemohon_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="foto_pemohon_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="foto_pemohon_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[foto_pemohon_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="foto_pemohon_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="foto_pemohon_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">Cessi (Potongan Gaji/Tunjungan Sertifikasi)</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">FC. Kartu Keluarga</td>
    <?php
	if($v[copy_kk_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_kk_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_kk_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_kk_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_kk_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_kk_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	 <td colspan="7">Surat Izin Suami/Istri</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">FC. ID pegawai</td>
    <?php
	if($v[copy_id_pegawai_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_id_pegawai_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_id_pegawai_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_id_pegawai_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_id_pegawai_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_id_pegawai_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">Surat Izin Kepala Sekolah</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Surat Ket. Usaha (SKU)/Slip gaji</td>
    <?php
	if($v[surat_ket_usaha_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="surat_ket_usaha_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="surat_ket_usaha_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[surat_ket_usaha_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="surat_ket_usaha_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="surat_ket_usaha_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">BI Checking</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Rek/listrik tahun berjalan</td>
    <?php
	if($v[rek_listrik_jalan_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="rek_listrik_jalan_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="rek_listrik_jalan_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[rek_listrik_jalan_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="rek_listrik_jalan_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="rek_listrik_jalan_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">Sertifikat Pendidik</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Surat Ket. Beda nama/TTL</td>
    <?php
	if($v[surat_beda_nama_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="surat_beda_nama_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="surat_beda_nama_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[surat_beda_nama_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="surat_beda_nama_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="surat_beda_nama_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">Kartu Atm &amp; Buku Tabungan</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="4"></td>
    <td colspan="7" rowspan="2">&nbsp;</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20" align="center"><b>Jaminan Kendaraan</b></td>
    <td colspan="4">&nbsp;</td>
    <td colspan="4"></td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">FC. BPKB</td>
    <?php
	if($v[copy_bpkb_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_bpkb_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_bpkb_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_bpkb_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_bpkb_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_bpkb_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">C. Daftar Kekurangan &amp; Pendingan</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">FC. STNK</td>
    <?php
	if($v[copy_stnk_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_stnk_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_stnk_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_stnk_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_stnk_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_stnk_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td colspan="7">&nbsp;</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Gesek No. Rangka</td>
    <?php
	if($v[gesek_rangka_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="gesek_rangka_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="gesek_rangka_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[gesek_rangka_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="gesek_rangka_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="gesek_rangka_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	<td rowspan="20">&nbsp;</td>
   
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Gesek No. Mesin</td>
    <?php
	if($v[gesek_mesin_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="gesek_mesin_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="gesek_mesin_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[gesek_mesin_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="gesek_mesin_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="gesek_mesin_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">Kwitansi kosong bermaterai</td>
    <?php
	if($v[kwitansi_materai_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="kwitansi_materai_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="kwitansi_materai_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[kwitansi_materai_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="kwitansi_materai_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="kwitansi_materai_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">FC. KTP pemilik &amp; BPKB &amp; STNK</td>
    <?php
	if($v[copy_ktp_milik_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_ktp_milik_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_ktp_milik_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_ktp_milik_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_ktp_milik_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_ktp_milik_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">bukti kepemilikan kendaraan</td>
    <?php
	if($v[bukti_milik_kendaraan_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="bukti_milik_kendaraan_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="bukti_milik_kendaraan_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[bukti_milik_kendaraan_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="bukti_milik_kendaraan_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="bukti_milik_kendaraan_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">&nbsp;</td>
    <td colspan="4" align="center"></td>
    <td colspan="4" align="center"></td>
    </tr>
  <tr height="20">
    <td colspan="4" height="20" align="center"><b>Jaminan Tanah &amp; Bangunan</b></td>
    <td colspan="4" align="center"></td>
    <td colspan="4" align="center"></td>
     </tr>
  <tr height="20">
    <td colspan="4" height="20">FC. SHM/SHGB/AJB</td>
    <?php
	if($v[copy_shm_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_shm_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_shm_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_shm_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_shm_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_shm_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	
  </tr>
  <tr height="20">
    <td colspan="4" height="20">FC. STTS &amp; PBB tahun pengajuan</td>
    <?php
	if($v[copy_stts_pbb_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_stts_pbb_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_stts_pbb_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_stts_pbb_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_stts_pbb_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_stts_pbb_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	
  </tr>
  <tr height="20">
    <td colspan="4" height="20">Warkah (jika jaminan AJB)</td>
    <?php
	if($v[warkah_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="warkah_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="warkah_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[warkah_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="warkah_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="warkah_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="4"></td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20" align="center"><b>Persyaratan PT/CV</b></td>
    <td colspan="4">&nbsp;</td>
    <td colspan="4"></td>
    <td colspan="5" rowspan="9">&nbsp;</td>
  </tr>
  <tr height="20">
    <td colspan="4" height="20">FC. NPWP Badan</td>
    <?php
	if($v[copy_npwp_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_npwp_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_npwp_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_npwp_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_npwp_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_npwp_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">FC. SITU</td>
    <?php
	if($v[copy_situ_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_situ_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_situ_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_situ_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_situ_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_situ_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">FC. SIUP</td>
    <?php
	if($v[copy_siup_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_siup_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_siup_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_siup_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_siup_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_siup_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">FC. TDP</td>
    <?php
	if($v[copy_tdp_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_tdp_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_tdp_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_tdp_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_tdp_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_tdp_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">FC. Akta Pendirian</td>
    <?php
	if($v[copy_akta_diri_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_akta_diri_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_akta_diri_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[copy_akta_diri_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="copy_akta_diri_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="copy_akta_diri_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">Surat Kuasa Pengurus (jika diperlukan)</td>
    <?php
	if($v[surat_kuasa_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="surat_kuasa_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="surat_kuasa_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[surat_kuasa_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="surat_kuasa_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="surat_kuasa_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="20">
    <td colspan="4" height="20">Laporan Keuangan 3 bulan terakhir</td>
    <?php
	if($v[lap_keuangan_legal]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="lap_keuangan_legal" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="lap_keuangan_legal" value="Y" disabled></td>
	<?php
	}
	?>
    <?php
	if($v[ap_keuangan_arsip]=='Y'){?>
    <td colspan="4" align="center"><input type="checkbox" name="ap_keuangan_arsip" value="Y" disabled checked></td>
	<?php
	}
	else{?>
	<td colspan="4" align="center"><input type="checkbox" name="ap_keuangan_arsip" value="Y" disabled></td>
	<?php
	}
	?>
	</tr>
  <tr height="21">
    <td colspan="4" height="21">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="4"></td>
  </tr>

</body>
</html>