<?php
switch($_GET[act]){
  // Tampil user
  default:
  ?>
<fieldset><legend><b>IMPORT DATA</b></legend>
	<div align="center">
	  <p><em>Please click proses to import data </em></p>
	  <p>
	    <a href="?module=import&act=importheader">Import Data Header</a> | <a href="?module=import&act=importdetail">Import Data Detail </a> | <a href="?module=import&act=importrecord">Import Data Record</a>
	  </p>
  </div>
</form></fieldset>
</p>

<?php
 break; 
case "importheader":
?>
<fieldset><legend><b>IMPORT DATA HEADER</b></legend>
<table><form method="post" enctype="multipart/form-data" action="import-dms/proses_upload.php">
<tr><td border=1 border=1>Silakan Pilih File Excel: <td><input name="userfile" type="file">
<input name="upload" type="submit" value="Import"></td></tr></form></fieldset></table>
<?php
break; 
case "importdetail":
?>
<fieldset><legend><b>IMPORT DATA DETAIL</b></legend>
<table><form method="post" enctype="multipart/form-data" action="import-dms/proses_upload_detail.php">
<tr><td border=1 border=1>Silakan Pilih File Excel: <td><input name="userfile" type="file">
<input name="upload" type="submit" value="Import"></td></tr></form></fieldset></table>
<?php
break; 
case "importrecord":
?>
<fieldset><legend><b>IMPORT DATA RECORD</b></legend>
<table><form method="post" enctype="multipart/form-data" action="import-dms/proses_upload_record.php">
<tr><td border=1 border=1>Silakan Pilih File Excel: <td><input name="userfile" type="file">
<input name="upload" type="submit" value="Import"></td></tr></form></fieldset></table>
<?php
break; 
}
?>

