<?php
switch($_GET[act]){
  // Tampil upload
  default:
  if($_SESSION[leveluser]=='admin'){
  
    echo "<fieldset><legend><b>Data Retensi</b></legend><br/>
	<table>
          <tr><th>no</th><th>nama file</th><th>gambar</th><th>tgl upload</th><th>tgl retensi</th><th>jenis file</th><th>nama user</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM upload,user,jenisfile where upload.userid=user.userid AND upload.fileid=jenisfile.fileid ORDER BY docid");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	$x=mysql_query("SELECT * FROM upload_d WHERE upload_d.docid='$r[docid]'");
    $z=mysql_fetch_array($x);
       echo "<tr><td>$no</td>
             <td>$r[filename]</td>
             <td><a href=downlot.php?file=$r[fileimage]>$r[fileimage]</a></td>
		         <td>$r[inputtgl]</td>
				 <td>$r[retentiondate]</td>
				 <td>$r[namajenis]</td>
				 <td>$r[nama]</td>
             <td><a href=?module=retensi&act=detaila&id=$r[docid]><img src=images/detail.gif border=0 border=0 title='detail'></a> | 
	             <a href=?module=upload&act=edit&id=$r[docid]><img src=images/edit.jpg border=0 border=0 title='edit'></a> | 
	             <a href='./aksi.php?module=upload&act=hapus&id=$r[docid]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
				   <img src=images/hapus.jpg border=0 title='hapus'></a> 
             </td></tr>";
      $no++;
    }
	}
else {
	 echo "<fieldset><legend>Data Retensi</b></h2>
	<table>
          <tr><th>no</th><th>nama file</th><th>gambar</th><th>tgl upload</th><th>nama user</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM upload,user where upload.userid=user.userid ORDER BY docid");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[filename]</td>
             <td>$r[fileimage]</td>
		         <td>$r[inputtgl]</td>
				 <td>$r[nama]</td>
             <td> <a href=?module=upload&act=edit&id=$r[docid]><img src=images/edit.jpg border=0 border=0 title='edit'></a> | 
	             <a href='./aksi.php?module=upload&act=hapus&id=$r[docid]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
				   <img src=images/hapus.jpg border=0 title='hapus'></a> 
             </td></tr>";
      $no++;
    }
	}
    echo "</fieldset></table>";
	
		
    break;
  
  case "tambahupload":
    echo "<fieldset><legend>Tambah upload</legend><br/>";
	if($_SESSION[leveluser]=='admin'){
	
          echo "<form method=POST action='./aksi.php?module=upload&act=input' enctype='multipart/form-data'>
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <input type=hidden name='userid' value='$_SESSION[iduser]' readonly>
		  <table>
          
          <tr><td>Nama File</td>     <td> : <input type=TEXT name='filename'></td></tr>
		  <tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>";?>
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

echo "<tr><td>Tanggal Retensi <td><input type=text name='retentiondate' id='tgla' value='' readonly>";
	        
		 }
		 else {
		  echo "<form method=POST action='./aksi.php?module=upload&act=input' enctype='multipart/form-data'>
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <input type=hidden name='userid' value='$_SESSION[iduser]' readonly>
		  <table>
          
          <tr><td>Nama File</td>     <td> : <input type=TEXT name='filename'></td></tr>
		  <tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>";?>
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

echo "<tr><td>Tanggal Retensi <td><input type=text name='retentiondate' id='tgla' value='' readonly>";
		 }
            //}
			echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </fieldset></table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM upload WHERE docid='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<legend>Edit upload</legend><br />
          <form name='ganti' method=POST action='./aksi.php?module=upload&act=update' onSubmit=\"return edit()\">
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <table>
		  <input type=hidden name='userid' value='$r[userid]' readonly>
		  <table>
          
          <tr><td>Nama File</td>     <td> : <input type=TEXT name='filename' value='$r[filename]'></td></tr>
		  <tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>";?>
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

echo "<tr><td>Tanggal Retensi <td><input type=text name='retentiondate' id='tgla' value='' readonly>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";


    break;  

//detaila
	
	case "detaila":
    $edit=mysql_query("SELECT * FROM upload WHERE docid='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<fieldset><legend> Silahkan Kli Untuk Download </legend>
		  <table>
		            
          <tr><td>Image File</td>     <td> : <a href=downlot.php?file=$r[fileimage]>$r[fileimage]</a></td></tr>";
		  $x=1;
		  $edit1=mysql_query("SELECT * FROM upload_d WHERE docid='$r[docid]' order by upl_d");
		  while($rr=mysql_fetch_array($edit1)){

		  echo "<tr><td align=center> $x </td>     <td>    : <a href=downlot.php?file=$rr[image_d]>$rr[image_d]</a></td></tr>";
		  $x++;
		  }
           echo "<tr><td colspan=2 align=center><input type=button value=Batal onclick=self.history.back()></td></tr>
          </table>";


    break;  
	
	//upload
case "detail":
    $edit=mysql_query("SELECT * FROM upload WHERE docid='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<legend>Tambah Upload</legend><br />
          <form name='ganti' method=POST action='./aksi.php?module=upload&act=input_d' onSubmit=\"return edit()\">
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <table>
		  <input type=hidden name='docid' value='$r[docid]' readonly>
		  <table>
          
          <tr><td>Nama File</td>     <td> : <input type=TEXT name='filename' value='$r[filename]' readonly></td></tr>";
		  /*
		  <tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>";?>*/
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

echo "<tr><td>Tanggal Retensi <td>: <input type=text name='retentiondate' id='tgla' value='$r[inputtgl]' readonly>";
 echo "<tr><td colspan=2>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>
		  <a href=?module=retensi&act=detailE&id=$r[docid]>Tambah Upload</a>
<table>
          <tr><th>no</th><th>nama file</th><th>gambar</th><th>tgl upload</th><th>keterangan</th><th>nama user</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM upload_d,upload,user where upload_d.docid=upload.docid AND upload.userid=user.userid AND upload_d.docid='$_GET[id]'");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[namafile]</td>
             <td><a href=downlot.php?file=$r[image_d]>$r[image_d]</a></td>
		         <td>$r[tglupload]</td>
				 <td>$r[keterangan]</td>
				 <td>$r[nama]</td>
                 <td><a href=?module=retensi&act=editan&id=$r[upl_d]><img src=images/edit.jpg border=0 border=0 title='edit'></a> | 
	             <a href='./aksi.php?module=retensi_d&act=hapus&id=$r[upl_d]&image_d=$r[image_d]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
				   <img src=images/hapus.jpg border=0 title='hapus'></a> 
             </td></tr>";
      $no++;
   }
echo "</table>";

    break;  
	
case "detailE":
	
    $edit=mysql_query("SELECT * FROM upload WHERE docid='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<legend>Tambah Upload Detail</legend><br />
          <form name='ganti' method=POST action='./aksi.php?module=upload&act=input_desc' enctype='multipart/form-data'>
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <table>
		  <input type=hidden name='docid' value='$r[docid]' readonly>
		  <input type=hidden name='filename' value='$r[filename]' readonly>
		  <input type=hidden name='retentiondate' id='tgla' value='$r[inputtgl]' readonly>";
echo "<table>
<tr><td>Nama File</td>     <td> : <input type=TEXT name='namafile'></td></tr>
<tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>";
?>
		  <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgl").datepicker({
					dateFormat : "yy-mm-dd",  
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true
        });
		
      });
    </script> 
<?php
echo "<tr><td>Tgl Retensi</td>     <td> : <input type=TEXT name='tglretensi' id='tgl' value='' readonly></td></tr>
<tr><td>Keterangan  </td>	<td> : <textarea name='keterangan' rows='5' cols='60'></textarea>";

          echo "<tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";


    break; 
//editan
case "editan":
	
    $edit=mysql_query("SELECT * FROM upload_d,upload WHERE upload_d.docid=upload.docid AND upl_d='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<legend>Edit Upload Detail</legend><br />
          <form name='ganti' method=POST action='./aksi.php?module=upload&act=update_desc' enctype='multipart/form-data'>
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <table>
		  <input type=hidden name='upl_d' value='$r[upl_d]' readonly>
		  <input type=hidden name='docid' value='$r[docid]' readonly>
		  
		  ";
echo "<table>
<tr><td>Nama File</td>     <td> : <input type=TEXT name='namafile' value='$r[namafile]'></td></tr>
<tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'><font color=red>$r[image_d]</font></td></tr>";
?>
		  <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgl").datepicker({
					dateFormat : "yy-mm-dd",  
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true
        });
		
      });
    </script> 
<?php
echo "<tr><td>Tgl Retensi</td>     <td> : <input type=TEXT name='tglretensi' id='tgl' value='$r[tglretensi]'' readonly></td></tr>
<tr><td>Keterangan  </td>	<td> : <textarea name='keterangan' rows='5' cols='60'>$r[keterangan]</textarea>";

          echo "<tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";


    break;  	
	
}
?>
