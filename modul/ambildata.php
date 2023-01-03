<?php
$namaserver = "localhost";
$username = "root";
$password = "";
$database = "dbgudang";

mysql_connect( "localhost", "root", "") or die
	          (" tdk tersambung ke server".mysql_error() );
mysql_select_db("$database") or die("Tidak dapat membuka database");

$kode = $_GET['kode'];

echo "<select name='kedua'>";

$rs = mysql_query ("SELECT KODPLG,NAMPLG FROM pelanggan WHERE (NAMPLG='$kode')");
while ($r = mysql_fetch_array($rs))
    echo "<option value='$r[NAMPLG]'>$r[NAMPLG]</option>";
echo "</select>";

?>