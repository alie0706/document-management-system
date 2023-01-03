 <?php
 session_start();

switch($_GET[act]){
  // Tampil user
  default:
  if($_SESSION[leveluser]=='admin'){?>
	 <div style='overflow-y:scroll;overflow-x:scroll; height:400px;scroll-color:hidden;'>
  <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">History Dosument</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
$todayDate = date("Y-m-d");// current date
$notif=mysql_query("SELECT day FROM notification");
$rr=mysql_fetch_array($notif);
//echo "$rr[day]";

//echo "Today: ".$todayDate."<br>";
$now = strtotime(date("Y-m-d"));
$month=$rr[day];
//Add one day to today
$date = date('Y-m-j', strtotime($month. 'month', $now));
//echo "".$date."<br>";		
          echo "<tr><th>NO</th><th>File Name</th><th>FILE</th><th>Transaction Date</th><th>Retention Date</th><th>PIC Documents</th><th>Action</th>";
	$p      = new Paging;
    $batas  = 25;
    $posisi = $p->cariPosisi($batas);
	$rupi     = "Rp. ";
    $tampil=mysql_query("SELECT * FROM upload a, upload_d b where a.nomtrak=b.nomtrak AND left(b.retentiondate,7)<='$date' ORDER BY a.docid ASC limit $posisi,$batas");

    $no = $posisi+1;
//$no2=0;	
	while ($r=mysql_fetch_array($tampil)){
	 echo   "<tr><td align=center>$no</td>
				<td>$r[filename] </td>
				<td align=center><a href='files/$r[fileimage]'><img alt='Report page 1' src='images/pdf.png' style='float: center; width: 50px; height; 50px; border: 0px solid #666;'></a>
				<br>$r[fileimage]</a></td><td>$r[inputtgl]</td>
				<td>$r[retentiondate]</td>
				<td>$r[pic]</td>";
				
				echo "<td align=center><a href='?module=historydocuments&act=editfile&docid_d=$r[docid_d]&nomtrak=$r[nomtrak]'><img src=images/icon_edit.gif border=0></a> 
				| <a href='./aksi.php?module=menu&act=hapusfile_h&docid_d=$r[docid_d]&nomtrak=$r[nomtrak]&fileimage=$r[fileimage]' onClick=\"return confirm('Apakah yakin ingin menghapus data ini ?')\"><img src=images/hapus.jpg border=0 border=0 title='Close'></a> 
				</tr>";
		$no++;		
    }
	
    echo "</fieldset></table></div></div></div></div></div>";
	}
	else{
	echo "Your Forgiveness have no rights";
	}
		
    break;
	case "editfile":?>
<script src="./js/jquery.js"></script>
<script src="./js/development-bundle/ui/jquery.ui.core.js"></script>
<script src="./js/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="./js/development-bundle/ui/jquery.ui.datepicker.js"></script>
<link href="./js/themes/sunny/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
<?php
 $tampil=mysql_query("SELECT * FROM upload_d where docid_d='$_GET[docid_d]' AND nomtrak='$_GET[nomtrak]'");
$x=mysql_fetch_array($tampil);
  mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Page=Halaman Edit Edit File $x[namefile]')");

     echo "<form method=POST action='./aksi.php?module=menu&act=editfileU_detail_2_r' enctype='multipart/form-data'>
           <input type=text name='nomtrak' value='$x[nomtrak]'>
		   <input type=text name='docid_d' value='$x[docid_d]'>";?>
		    <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Edit File Detail</strong>
                        </div>
                        <div class="card-body">
		   
		 <table id='bootstrap-data-table' class='table table-striped table-bordered'>
                    <thead>
          <?php
          echo "<tr><td>Nama File</td>     <td> : <input type=TEXT name='namefile' value='$x[filename]'></td></tr>
		  <tr><td>Metadata File</td>     <td> : <input type=TEXT name='metadata_file' value='$x[metadata]' size=50px></td></tr>";
		 ?>
		  <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgla").datepicker({
					dateFormat : "yy-mm-dd",  
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true
        });
		
      });
    </script> 
<?php

echo "<tr><td>Expired Date <td> : <input type=text name='retentiondate' id='tgla' value='$x[retentiondate]'>
<tr><td colspan=2 align=center><a href='./files/$x[fileimage]'><img src=images/pdf.png><br>$x[fileimage]</a></td></tr>	    
<tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>";
	echo "<tr><td colspan=2><input type=submit Value=Save>
                            <input type=button Value=Cancel onclick=self.history.back()></td></tr>
				
          </table></form>";
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
  
 }
?>
