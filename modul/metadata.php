<?php
switch($_GET[act]){
  // Tampil upload
  default:
 
    echo "<legend>Tambah Metadata</legend><br/>";
	 echo "<form method=POST action='./aksi.php?module=metadata&act=input' enctype='multipart/form-data'>
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <table>
          
          <tr><td>Nama File</td>     <td> : <input type=TEXT name='namajenis'></td></tr>";
		  echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
		  </table></form>";
          echo "<table>
          <tr><th>no</th><th>jenis file</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM jenisfile ORDER BY fileid");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[namajenis]</td>
             <td><a href=?module=metadata&act=detail&id=$r[fileid]><img src=images/ico_edit_16.png border=0 border=0 title='detail metadata'></a> | 
	             <a href=?module=metadata&act=edit&id=$r[fileid]><img src=images/edit.jpg border=0 border=0 title='edit'></a> | 
	             <a href='./aksi.php?module=metadata&act=hapus&id=$r[fileid]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
				   <img src=images/hapus.jpg border=0 title='hapus'></a> 
             </td></tr>";
      $no++;
    }
	echo "</table>";
     break;
    case "detail":
	$edit=mysql_query("SELECT * FROM jenisfile WHERE fileid='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	$editan=mysql_query("SELECT * FROM masterfile WHERE fileid='$r[fileid]'");
    $ra=mysql_fetch_array($editan);
	$z=mysql_num_rows($editan);
	$ketemu=$z[fileid];
	 echo "<legend>Tambah Detail Metadata</legend><br/>";
	/* if($z > 0){
	 echo "<form method=POST action='./aksi.php?module=metadata_d&act=update' enctype='multipart/form-data'>
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <input type=hidden name='fileid' value='$r[fileid]' readonly>
		  <input type=hidden name='masterid' value='$ra[masterid]' readonly>
		  <table>
          
          <tr><td>Nama Metadata</td>    	<td> : <input type=TEXT name='namametadata' value='$r[namametadata]'></td></tr>
		  <tr><td>Keterangan 1</td>     <td> : <input type=TEXT name='ket1' value='$ra[ket1]'></td></tr>
		  <tr><td>Keterangan 2</td>     <td> : <input type=TEXT name='ket2' value='$ra[ket2]'></td></tr>
		  <tr><td>Keterangan 3</td>     <td> : <input type=TEXT name='ket3' value='$ra[ket3]'></td></tr>
		  <tr><td>Keterangan 4</td>     <td> : <input type=TEXT name='ket4' value='$ra[ket4]'></td></tr>
		  <tr><td>Keterangan 5</td>     <td> : <input type=TEXT name='ket5' value='$ra[ket5]'></td></tr>";
		  echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
		  </table></form>";
		  }
	else{	  */
	 echo "<form method=POST action='./aksi.php?module=metadata_d&act=input' enctype='multipart/form-data'>
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <input type=hidden name='fileid' value='$r[fileid]' readonly>
		  <table>
          
          <tr><td>Nama Metadata</td>     <td> : <input type=TEXT name='namametadata' value='$r[namametadata]'></td></tr>
		  <tr><td>Keterangan 1</td>     <td> : <input type=TEXT name='ket1'></td></tr>
		  <tr><td>Keterangan 2</td>     <td> : <input type=TEXT name='ket2'></td></tr>
		  <tr><td>Keterangan 3</td>     <td> : <input type=TEXT name='ket3'></td></tr>
		  <tr><td>Keterangan 4</td>     <td> : <input type=TEXT name='ket4'></td></tr>
		  <tr><td>Keterangan 5</td>     <td> : <input type=TEXT name='ket5'></td></tr>";
		  echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
		  </table></form>";
	//}
	break;
  case "edit":
    $edit=mysql_query("SELECT * FROM jenisfile WHERE fileid='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<legend>Edit Metadata</legend><br />
          <form name='ganti' method=POST action='./aksi.php?module=metadata&act=update' onSubmit=\"return edit()\">
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <table>
		  <input type=hidden name='fileid' value='$r[fileid]' readonly>
		  <table>
          
          <tr><td>Jenis File</td>     <td> : <input type=TEXT name='namajenis' value='$r[namajenis]'></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
echo "<table>
          <tr><th>no</th><th>jenis file</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM jenisfile ORDER BY fileid");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[namajenis]</td>
             <td><a href=?module=metadata&act=detail&id=$r[fileid]><img src=images/ico_edit_16.png border=0 border=0 title='detail metadata'></a> | 
	             <a href=?module=metadata&act=edit&id=$r[fileid]><img src=images/edit.jpg border=0 border=0 title='edit'></a> | 
	             <a href='./aksi.php?module=metadata&act=hapus&id=$r[fileid]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
				   <img src=images/hapus.jpg border=0 title='hapus'></a> 
             </td></tr>";
      $no++;
    }
	echo "</table>";
     break;
}
?>
