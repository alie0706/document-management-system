 <link rel="stylesheet" href="style.css" /> 
 
<script src="./js/jquery.js"></script>
<script src="./js/development-bundle/ui/jquery.ui.core.js"></script>
<script src="./js/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="./js/development-bundle/ui/jquery.ui.datepicker.js"></script>
<link href="./js/themes/sunny/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
 <?php
 session_start();

switch($_GET[act]){
  // Tampil verifikasidoc
  default:
  
    echo "<form name='tambah' method=POST action='?module=verifikasidoc&act=cari' onSubmit=\"return validasi()\">";?>
		  <div class="card-header">
                            <strong class="card-title">Report Verifikasi Document</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
		  <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgl1").datepicker({
					dateFormat : "yy-mm-dd",  
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true
        });
		
      });
	  $(document).ready(function(){
        $("#tgl2").datepicker({
					dateFormat : "yy-mm-dd",  
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true
        });
		
      });
    </script> 
          <tr><td> Status Ceck </td>     <td> <select name="cecksts" id="select" class="form-control">
		  <?php
		  echo "<option value='Ya'>Yes</option>";
		 echo "<option value='No'>No</option>";
			echo "</select>";								
			echo "</td></tr><tr><td>Date </td>     <td> : <input type=text name='tgl1' id='tgl1' onBlur='validate(this)'> from <input type=text name='tgl2' id='tgl2' onBlur='validate(this)'> </td></tr>
           <tr><td colspan=2><input type=submit value=Cari>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form></div>";
     break;
    
  case "cari":
  $tgl1=$_POST[tgl1];
  $tgl2=$_POST[tgl2];
  $cecksts=$_POST[cecksts];
  $ceck=mysql_query("SELECT * FROM upload a, upload_d b where a.nomtrak=b.nomtrak AND a.inputtgl BETWEEN '$tgl1' AND '$tgl2' AND a.status='$cecksts'");
  $c=mysql_fetch_array($ceck);?>
  <div class="card-body">
    <a class="btn btn-primary" href="./inc/verifikasidoc.php?tgl1=<?php echo $tgl1;?>&tgl2=<?php echo $tgl2;?>&cecksts=<?php echo $cecksts;?>" target="_blank" role="button">Print</a></div>
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
    echo "<tr><th>NO</th><th>Nomtrak</th><th>Nama Nasabah</th><th>No Transaksi</th><th>File Name</th><th>FILE</th><th>Transaction Date</th><th>Retention Date</th><th>PIC Documents</th><th>Action</th>";
	$p      = new Paging;
    $batas  = 25;
    $posisi = $p->cariPosisi($batas);
	$rupi     = "Rp. ";
    $tampil=mysql_query("SELECT * FROM upload a, upload_d b where a.nomtrak=b.nomtrak AND a.inputtgl BETWEEN '$tgl1' AND '$tgl2' AND a.status='$cecksts' ORDER BY a.docid ASC limit $posisi,$batas");

    $no = $posisi+1;
//$no2=0;	
	while ($r=mysql_fetch_array($tampil)){
	 echo   "<tr><td align=center>$no</td>
				<td>$r[nomtrak] </td>
				<td>$r[namanasabah] </td>
				<td>$r[notransaksi] </td>
				<td>$r[filename] </td>
				<td align=center><a href='files/$r[fileimage]'><img alt='Report page 1' src='images/pdf.png' style='float: center; width: 30px; height; 30px; border: 0px solid #666;'></a>
				<br>$r[fileimage]</a></td><td>$r[inputtgl]</td>
				<td>$r[retentiondate]</td>
				<td>$r[pic]</td>";
				
				echo "<td align=center><a href='?module=verifikasidoc&act=detailfile_d&docid_d=$r[docid_d]&nomtrak=$r[nomtrak]'><img src=images/detail.gif border=0></a> </tr>";
		$no++;		
    }
	
    echo "</fieldset></table></div></div></div></div></div>";
	
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
$tampil=mysql_query("SELECT * FROM upload where docid_d='$_GET[docid_d]&nomtrak='$_GET[nomtrak]'");
$x=mysql_fetch_array($tampil);
//echo "$x[fileid]";
$tampilan=mysql_query("SELECT * FROM jenisfile a,masterfile b, mastertanggal c where a.fileid=b.fileid and b.masterid=c.masterid and a.fileid='$x[fileid]' AND b.masterid='$x[masterid]' AND c.tanggalid='$x[tanggalid]'");
$cx=mysql_fetch_array($tampilan);
 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Detail Menu $cx[namajenis]/$cx[namafile]/$_GET[nomkot]/$_GET[filename]')");

echo "<div style='overflow-y:scroll;overflow-x:scroll; height:500px;scroll-color:hidden;'>";
echo "<table id='bootstrap-data-table' class='table table-striped table-bordered'>
                    <thead><tr><th>NO</th><th>File Name</th><th>Metadata</th><th>Transaction Date</th><th>Retention Date</th><th>FILES</th>";
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
						<a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$r[fileimage]'>$r[fileimage]</a></td></tr>";
		$no++;		
     }
	 
echo "</table></div>";
    
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM upload_detail where docid_d='$x[docid_d]' AND nomkot='$x[nomkot]' AND status='Open'"));

 
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<p>$linkHalaman</p>";
break;	
}
?>
