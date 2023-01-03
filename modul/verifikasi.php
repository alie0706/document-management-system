 <?php
 session_start();

switch($_GET['act']){
  // Tampil user
  default:
  $id_user=$_SESSION['userid'];
    $namauser=$_SESSION['namauser'];
    $role=mysql_query("select * from roleuser WHERE id_user='$id_user'");
    $ro=mysql_fetch_array($role);
    ?>
	
  <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Verifikasi Document</strong>
                        </div>
                        <div class="card-body"> <div style='overflow-y:scroll;overflow-x:scroll; height:400px;scroll-color:hidden;'>
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<tr><th>NO</th><th>File Name</th><th>Metadata</th><th>Transaction Date</th><th>Retention Date</th><th>FILES</th><th>Action</th>";
	$p      = new Paging;
    $batas  = 25;
    $posisi = $p->cariPosisi($batas);
  	$rupi     = "Rp. ";
    
      if($_SESSION['leveluser']=='admin'){
        $tampil=mysql_query("SELECT * FROM dokumen_file where approve='0' ORDER BY docid_d ASC limit $posisi,$batas");
      }
      else{
          if($ro['approve']=='1'){
        $tampil=mysql_query("SELECT * FROM dokumen_file where approve='0' and departemenid='$_SESSION[departemenuser]' ORDER BY docid_d ASC limit $posisi,$batas");
          }
      }
    
    $no = $posisi+1;
//$no2=0;	
	while ($r=mysql_fetch_array($tampil)){
    echo   "<tr><td align=center>$no</td>
    <td>$r[filename]</td>
    <td>$r[metadata]</td>
    <td>$r[tgl_dokumen]</td>
    <td>$r[retentiondate]</td>
    <td align=center><iframe src='./files/$r[fileimage]' width='400' height='200' style='border: none;'></iframe><br>
        <a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$r[fileimage]'>$r[fileimage]</a></td>
        ";
				
				echo "<td align=center><a href='aksi.php?module=verifikasi&act=approve&docid_d=$r[docid_d]&docid=$r[docid]' onClick=\"return confirm('You sure will [release] data of this tables?')\">Approve</a>  </td></tr>";
		$no++;		
    }
	
    echo "</fieldset></table></div></div></div></div></div>";?>
	
	 <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Update Verifikasi Document</strong>
                        </div>
                        <div class="card-body"><div class="card-body"> <div style='overflow-y:scroll;overflow-x:scroll; height:400px;scroll-color:hidden;'>
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
           echo "<tr><th>NO</th><th>File Name</th><th>Metadata</th><th>Transaction Date</th><th>Retention Date</th><th>FILES</th>";
	$p      = new Paging;
    $batas  = 25;
    $posisi = $p->cariPosisi($batas);
	$rupi     = "Rp. ";
    if($_SESSION['leveluser']=='admin'){
        $tampil=mysql_query("SELECT * FROM dokumen_file where approve='1' ORDER BY docid_d ASC limit $posisi,$batas");
      }
      else{
          if($ro['approve']=='1'){
        $tampil=mysql_query("SELECT * FROM dokumen_file where approve='1' and departemenid='$_SESSION[departemenuser]' ORDER BY docid_d ASC limit $posisi,$batas");
          }
      }
    $no = $posisi+1;
//$no2=0;	
	while ($r=mysql_fetch_array($tampil)){
    echo   "<tr><td align=center>$no</td>
    <td>$r[filename]</td>
    <td>$r[metadata]</td>
    <td>$r[tgl_dokumen]</td>
    <td>$r[retentiondate]</td>
    <td align=center><iframe src='./files/$r[fileimage]' width='400' height='200' style='border: none;'></iframe><br>
        <a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$r[fileimage]'>$r[fileimage]</a></td></tr>";
		$no++;		
    }
	
    echo "</fieldset></table></div></div></div></div></div>";
	
    break;
	
	case "detail":
	$tampilan=mysql_query("SELECT * FROM log where username='$_GET[name]' ORDER BY logid");
	$c=mysql_fetch_array($tampilan);
	 if($_SESSION[leveluser]=='admin'){
    echo "<fieldset><legend><b>History Log $c[username]</b></legend><br>";?>
	<div style='overflow-y:scroll;overflow-x:scroll; height:300px;width:600px;scroll-color:hidden;'>
	<?php
	  echo "<table>
          <tr><th>no</th><th>username</th><th>name</th><th>Date</th><th>Description</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM log,user where log.id_user=user.id_user AND log.username='$_GET[name]' ORDER BY logid");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[username]</td>
		     <td>$r[nama_lengkap]</a></td>
			 <td>$r[tgl_log]</a></td>
			 <td>$r[keterangan]</td>
            </td></tr>";
      $no++;
    }
	}
	else{
	echo "Your Forgiveness have no rights";
	}
    echo "</fieldset></table></div>";
	
		
    break;
  case "detailfile_d":
?>
<link href="inc/default.css" rel="stylesheet"><script type="text/javascript" src="inc/artDialog.js"></script>
<link type="text/css" rel="stylesheet" href="inc/y13_html5.css">
<script type="text/javascript" src="inc/iframeTools.js"></script>
<script type="text/javascript" charset="utf-8">
	$(function () {
		var tabContainers = $('section#tabIconNav div > section');
		tabContainers.hide().filter('#fifth').show();
		
		$('section#tabIconNav ul.tabIconNavigation a').click(function () {
		//	tabContainers.hide();
		//	tabContainers.filter(this.hash).show();
			$('section#tabIconNav ul.tabIconNavigation a').removeClass('selected');
			$(this).addClass('selected');
			return true;
		}).filter('#sel').click();
	});
</script>
<?php
$tampil=mysql_query("SELECT * FROM upload where docid='$_GET[docid]' AND nomtrak='$_GET[nomtrak]'");
$x=mysql_fetch_array($tampil);
//echo "$x[fileid]";
$tampilan=mysql_query("SELECT * FROM f_tanggal a, f_bulan b, f_tahun c, f_bacthno d, f_cabang e WHERE a.bulanid=b.bulanid and a.tahunid=c.tahunid and a.batchid=d.batchid and a.cabangid=e.cabangid 
and a.tanggalid='$x[tanggalid]' and a.bulanid='$x[bulanid]' and a.tahunid='$x[tahunid]' and a.batchid='$x[batchid]' and a.cabangid='$x[cabangid]'");
$cx=mysql_fetch_array($tampilan);
 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Detail Menu $cx[namacabang]/$cx[nobatch]/$cx[tahun]/$cx[bulan]/$cx[tanggal]/$_GET[nomtrak]')");
if($_SESSION[leveluser]=='admin'){		
?>
				
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link" id="nav-profile-tab" href="?module=menu&act=tambahfileU_detail2&nomtrak=<?php echo "$x[nomtrak]";?>" role="tab" aria-controls="nav-profile" aria-selected="false">Add File</a>
                                                 </div>
<?php
/*echo "<h2><a href='?module=menu&act=detailcabang&cabangid=$cx[cabangid]'> $cx[namacabang] </a> / 
<a href='?module=menu&act=detailbatch&batchid=$cx[batchid]&cabangid=$cx[cabangid]'>$cx[nobatch] </a> 
/ <a href='?module=menu&act=detailtahun&tahunid=$cx[tahunid]&batchid=$cx[batchid]&cabangid=$cx[cabangid]'>$cx[tahun]</a> 
/ <a href='?module=menu&act=detailbulan&bulanid=$cx[bulanid]&tahunid=$cx[tahunid]&batchid=$cx[batchid]&cabangid=$cx[cabangid]'> $cx[bulan]</a> / 
<a href='?module=menu&act=detailfile&tanggalid=$cx[tanggalid]&bulanid=$cx[bulanid]&tahunid=$cx[tahunid]&batchid=$cx[batchid]&cabangid=$cx[cabangid]'> $cx[tanggal] </a> / $_GET[nomtrak] </b></h2><hr>";*/
echo "<div style='overflow-y:scroll;overflow-x:scroll; height:500px;scroll-color:hidden;'>";
echo "<table id='bootstrap-data-table' class='table table-striped table-bordered'>
                    <thead><tr><th>NO</th><th>File Name</th><th>Metadata</th><th>Transaction Date</th><th>Retention Date</th><th>FILES</th><th>Action</th>";
	$p      = new Paging12;
    $batas  = 100;
    $posisi = $p->cariPosisi($batas);
	$rupi     = "Rp. ";
    $tampil=mysql_query("SELECT * FROM upload_d where nomtrak='$_GET[nomtrak]' ORDER BY nomtrak ASC limit $posisi,$batas");

    $no = $posisi+1;
//$no2=0;	
	while ($r=mysql_fetch_array($tampil)){
	 echo   "<tr><td align=center>$no</td>
				<td>$r[filename]</td>
				<td>$r[metadata]</td>
				<td>$r[inputtgl]</td>
				<td>$r[retentiondate]</td>
				<td align=center><iframe src='./files/$r[fileimage]' width='400' height='200' style='border: none;'></iframe><br>
						<a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$r[fileimage]'>$r[fileimage]</a></td>
						";
				
				echo "<td align=center><a href='?module=menu&act=editfileU_detail2&docid_d=$r[docid_d]&docid=$x[docid]&nomtrak=$x[nomtrak]'><i class='menu-icon fa fa-pencil'></i></a> 
				| <a href='./aksi.php?module=menu&act=hapusfileU_detail&docid_d=$r[docid_d]&docid=$x[docid]&nomtrak=$x[nomtrak]&fileimage=$r[fileimage]' onClick=\"return confirm('You sure will [release] data of this tables?')\">
				<i class='menu-icon fa fa-trash-o'></i></a> 
				</tr>";
		$no++;		
     }
	 
echo "</table></div>";
}
else{
/*echo "<h2><a href='?module=menu&act=detailcabang&cabangid=$cx[cabangid]'> $cx[namacabang] </a> / 
<a href='?module=menu&act=detailbatch&batchid=$cx[batchid]&cabangid=$cx[cabangid]'>$cx[nobatch] </a> 
/ <a href='?module=menu&act=detailtahun&tahunid=$cx[tahunid]&batchid=$cx[batchid]&cabangid=$cx[cabangid]'>$cx[tahun]</a> 
/ <a href='?module=menu&act=detailbulan&bulanid=$cx[bulanid]&tahunid=$cx[tahunid]&batchid=$cx[batchid]&cabangid=$cx[cabangid]'> $cx[bulan]</a> / 
<a href='?module=menu&act=detailfile&tanggalid=$cx[tanggalid]&bulanid=$cx[bulanid]&tahunid=$cx[tahunid]&batchid=$cx[batchid]&cabangid=$cx[cabangid]'> $cx[tanggal] </a> / $_GET[nomtrak] </b></h2><hr>";*/

 echo "<div style='overflow-y:scroll;overflow-x:scroll; height:300px;scroll-color:hidden;'>";
echo "<table><thead><tr><th>NO</th><th>File Name</th><th>Metadata</th><th>Transaction Date</th><th>Retention Date</th><th>FILES</th><th>Action</th>";
	$p      = new Paging12;
    $batas  = 100;
    $posisi = $p->cariPosisi($batas);
	$rupi     = "Rp. ";
    $tampil=mysql_query("SELECT * FROM upload_d where nomtrak='$_GET[nomtrak]' ORDER BY nomtrak ASC limit $posisi,$batas");

    $no = $posisi+1;
//$no2=0;	
	while ($r=mysql_fetch_array($tampil)){
	 echo   "<tr><td align=center>$no</td>
				<td>$r[filename]</td>
				<td>$r[metadata]</td>
				<td>$r[inputtgl]</td>
				<td>$r[retentiondate]</td>
				<td align=center><iframe src='./files/$r[fileimage]' width='400' height='200' style='border: none;'></iframe><br>
						<a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$r[fileimage]'>$r[fileimage]</a></td>
						
				
				</tr>";
		$no++;		
     }
	 
echo "</table></div>";

}
    
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM upload_detail where docid_d='$x[docid_d]' AND nomkot='$x[nomkot]' AND status='Open'"));

 
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<p>$linkHalaman</p>";
break;
 }
?>
