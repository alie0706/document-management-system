<?php
switch($_GET[act]){
  // Tampil upload
  default:
  /*if($_SESSION[leveluser]=='admin'){
  
    echo "<legend><b>Upload Data</b></legend><br/>
 <a href='?module=upload&act=tambahupload'>Tambah Master upload</a>
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
             <td><a href=?module=upload&act=edit&id=$r[docid]><img src=images/edit.jpg border=0 border=0 title='edit'></a> | 
	               <a href='./aksi.php?module=upload&act=hapus&id=$r[docid]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
				   <img src=images/hapus.jpg border=0 title='hapus'></a> 
             </td></tr>";
      $no++;
    }
	}
else {
	 echo "<h2><b>Upload Data</b></h2>
 <a href='?module=upload&act=tambahupload'>Tambah Master upload</a>
		  <table>
          <tr><th>no</th><th>nama file</th><th>gambar</th><th>tgl upload</th><th>nama user</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM upload,user where upload.userid=user.userid ORDER BY docid");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[filename]</td>
             <td>$r[fileimage]</td>
		         <td>inputtgl</td>
				 <td>$r[nama]</td>
             <td><a href=?module=upload&act=edit&id=$r[docid]><img src=images/edit.jpg border=0 border=0 title='edit'></a> | 
	               <a href='./aksi.php?module=upload&act=hapus&id=$r[docid]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
				   <img src=images/hapus.jpg border=0 title='hapus'></a> 
             </td></tr>";
      $no++;
    }
	}
    echo "</table>";
	
		
    break;
  
  case "tambahupload":
  */
    echo "<legend>Tambah upload</legend><br/>";
	if($_SESSION[leveluser]=='admin'){
	
          echo "<form method=POST action='./aksi.php?module=upload&act=input' enctype='multipart/form-data'>
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <input type=hidden name='userid' value='$_SESSION[iduser]' readonly>
		  <table>
          
          <tr><td>Nama File</td>     <td> : <input type=TEXT name='filename'></td></tr>";?>
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

echo "<tr><td>Tanggal Retensi <td> : <input type=text name='retentiondate' id='tgla' value='' readonly>
	    
<tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>
<tr><td class='left'>Departemen</td>  <td class='left'> : 
          <select name='fileid'>";
            $tampil=mysql_query("SELECT * FROM jenisfile ORDER BY fileid");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[fileid]>$r[namajenis]</option>";
            }
    echo "</select></td></tr>";
 
		 }
		 else {
		  echo "<form method=POST action='./aksi.php?module=upload&act=input' enctype='multipart/form-data'>
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <input type=hidden name='userid' value='$_SESSION[iduser]' readonly>
		  <table>
          
          <tr><td>Nama File</td>     <td> : <input type=TEXT name='filename'></td></tr>";
		  

echo "<tr><td>Tanggal Retensi <td><input type=text name='retentiondate' id='tgla' value='' readonly><tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>";?>
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
echo "<tr><td class='left'>Kategori File</td>  <td class='left'> :"; 
           $tampil=mysql_query("SELECT * FROM jenisfile ORDER BY fileid");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[fileid]>$r[namajenis]</option>";
            }
    echo "</select></td></tr>";
		 }
            //}
			echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Pilih>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
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
		  <tr><td>Upload File</td>    <td> : <input name='fupload' type='file' size='32'><font color=red>$r[fileimage]</red></td></tr>";?>
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

echo "<tr><td>Tanggal Retensi <td><input type=text name='retentiondate' id='tgla' value='$r[retentiondate]' readonly>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";


    break;  
	
	// detail_upload
	 case "detail_upload":
    $edit=mysql_query("SELECT * FROM temp_upload WHERE docid='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<br />
          <form name='ganti' method=POST action='./aksi.php?module=upload&act=update' onSubmit=\"return edit()\">
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <table>
		  <input type=hidden name='userid' value='$r[userid]' readonly>
		  <table>
          
          <tr><td>Nama File</td>     <td> : <input type=TEXT name='filename' value='$r[filename]'></td></tr>
		  <tr><td>Upload File</td>    <td> : <input name='fupload' type='file' size='32'><font color=red>$r[fileimage]</red></td></tr>";?>
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

echo "<tr><td>Tanggal Retensi <td><input type=text name='retentiondate' id='tgla' value='$r[retentiondate]' readonly>
<tr><td class='left'>Nama Metadata</td>  <td class='left'> : 
          <select name='fileid'>";
            $tampilan=mysql_query("SELECT * FROM jenisfile,masterfile where jenisfile.fileid=masterfile.fileid AND jenisfile.fileid='$r[fileid]' ORDER BY fileid");
            while($r1=mysql_fetch_array($tampilan)){
              echo "<option value=$r1[fileid]>$r[namametadata]</option>";
            }
    echo "</select></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";


    break;  
}
?>
