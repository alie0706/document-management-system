<?php
session_start();
include"inc.koneksi.php";
include"fungsi_indotgl.php";
include"library.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="menarik.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.js"></script>
<script src="../js/development-bundle/ui/jquery.ui.core.js"></script>
<script src="../js/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="../js/development-bundle/ui/jquery.ui.datepicker.js"></script>
<link href="../js/themes/sunny/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" >
 $(document).ready(function() {  
  $( "#from1" ).datepicker({
   dateFormat:'yy-mm-dd',
   defaultDate: "+0w",
   changeMonth: true,
   numberOfMonths: 1,
   onSelect: function( selectedDate ) {
    $( "#to" ).datepicker( "option", "minDate", selectedDate );
   }
  });
  $( "#to1" ).datepicker({
   dateFormat:'yy-mm-dd',
   defaultDate: "+0w",
   changeMonth: true,
   numberOfMonths: 1,
   onSelect: function( selectedDate ) {
    $( "#from" ).datepicker( "option", "maxDate", selectedDate );
   }
  });
 });
</script>
<title>Laporan Star Karyawan</title>
<style type="text/css">

input { padding: 1px; border: 1px solid #999; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 2px; }
</style>
</head>


<body><center>
  <table border="0" cellspacing="0" cellpadding="0" align="center">
   <tr>
   
    <td width="100%"><table width="100%" border="1" cellspacing="0" cellpadding="0" class="textbox" align="center">
  <tr class="ttl">
    <td height="25" align="center" valign="middle">&nbsp;&nbsp; LAPORAN STAR PER-PERIODE</td>
    </tr>
    <tr class="ttl">
    
      <tr>
    <td colspan="2"><form method="get" action=laporan_perperiode1.php target=_blank>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="textbox">
      <tr>
        <td width="100%" valign="right"><input type="hidden" name="act" value="dt" />
		<input id="from" name="from" type="text" maxlength="10" size="15" value=""/>
  &nbsp;&nbsp; s/d &nbsp;&nbsp;
  <input id="to" name="to" type="text" maxlength="10" size="15" value=""/><font color=red><i>*yyyy-mm-dd</font></i>
&nbsp;&nbsp;&nbsp;<input type="submit" name="oke" value="Cetak" class="tombol" />
        
        
       </td>
        
      </tr>
    </table> </form>   <br><br><br><br>
    <?

$oke=$_GET['oke'];
if(isset($oke))
{
	$batas=35;
	$halaman=$_GET['halaman'];
	if(empty($halaman))
	{
		$posisi=0;
		$halaman=1;
	}
	else
	{
		$posisi=($halaman-1)*$batas;
	}
	
	$jenis=$_GET['jenis'];
	$tanggal=$_GET['from'];
	$panjang_karakter1=strlen($tanggal);
	if($panjang_karakter1==1)
	{
	$tanggal1="0".$tanggal;
	}
	else
	{
		$tanggal1=$tanggal;
	}
		$bulan=$_GET['from'];
		$panjang_karakter3=strlen($bulan);
	if($panjang_karakter3==1)
	{
	$bulan1="0".$bulan;
	}
	else
	{
		$bulan1=$bulan;
	}
		$tahun=$_GET['from'];
		$tanggala=$_GET['to'];
		$panjang_karakter2=strlen($tanggala);
	if($panjang_karakter2==1)
	{
	$tanggal2="0".$tanggala;
	}
	else
	{
		$tanggal2=$tanggala;
	}
		$bulana=$_GET['to'];
		$panjang_karakter4=strlen($bulana);
	if($panjang_karakter4==1)
	{
	$bulan2="0".$bulana;
	}
	else
	{
		$bulan2=$bulana;
	}
		$tahuna=$_GET['to'];
		$tglsebelum = $_GET['from'];
		$tglsetelah = $_GET['to'];

	
		$id='$_SESSION[KODPLG]';
	
			$tampil=mysql_query("SELECT * FROM dakot_h WHERE KODPLG='$_SESSION[KODPLG]' AND RECMOD>='$tglsebelum' and RECMOD<='$tglsetelah' 
		ORDER BY NOMKOT, RECMOD ASC limit $posisi,$batas");
		
	$jumlah=mysql_num_rows($tampil);
	
	if($jumlah>0)
	{
		?>
        <center>
         <?
			
?>
<form method="get" action="laporan_perperiode1.php" target="_blank"><table width="100%" border="0" class="textbox"><tr><td align="left">

<input type="hidden" name="from" value=<?=$tglsebelum?> />
<input type="hidden" name="to" value=<?=$tglsetelah?> />
<?
echo "<font>Ditemukan <b>$jmldata</b> $_SESSION[KODPLG] dari $tglsebelum sampai $tglsetelah </font>&nbsp;&nbsp;&nbsp;&nbsp;";
?></td><tr><td align="left">
<input type="submit" value="Cetak" class="tombol" />
</td></tr></table>
</form>
      </center>
      <table width="1500" align="center" cellpadding="2" class="box">
      <tr>
	  
            <td align="center" bgcolor="#dbdedb">NO</td>
            <td width="100" align="center" bgcolor="#dbdedb">BOX NO</td>
            <td width="200" align="center" bgcolor="#dbdedb">ACCOUNT NAME</td>
            <td width="200" align="center" bgcolor="#dbdedb">RETENTION</td>
            <td width="300" align="center" bgcolor="#dbdedb">DEPARTEMEN</td>
            <td width="300" align="center"bgcolor="#dbdedb">CONTROL NO</td>
            <td width="300" align="center" bgcolor="#dbdedb">DESTRUCTION DATE</td>
			<td width="300" align="center" bgcolor="#dbdedb">RECMOD</td>
			<tr class="tts">
          </tr>
          <?


	
  $no=$posisi+1;
 while($data=mysql_fetch_array($tampil)){
		$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$data[KODPLG]'");
		$r1=mysql_fetch_array($m1);
		$idkriteria=$z[idkriteria];
		$count=$z[count(idkriteria)];
		
		//if ($count ==3){
		
  
 $tanggal=tgl_indo($data[TGLMUS]);
 
		echo"<tr bgcolor=$warna><td class=tbl align=center>$no</td><td class=tbl align=center>$data[NOMKOT]</td>
		<td class=tbl>$r1[NAMPLG]</td><td class=tbl>$data[MASRET1] $data[MASRET]</td>
		<td class=tbl>$data[KODBAG]</td><td class=tbl>$data[NOM_11]</td>
		<td class=tbl>$tanggal</td><td class=tbl>$data[RECMOD]</td></tr>";
	
 $no++;
	//} 
	
	 }
	 
	 ?>
     
     
   
	</table>
          <center>
          <?
		  $tglsebelum = $_GET['from'];
		$tglsetelah = $_GET['to'];

		  $id='$_SESSION[KODPLG]';
		$tampil2="SELECT * FROM dakot_h WHERE KODPLG='$_SESSION[KODPLG]' AND RECMOD>='$tglsebelum' and RECMOD<='$tglsetelah' 
		";	
		
		$hasil2=mysql_query($tampil2);
		$jmldata=mysql_num_rows($hasil2);
		$jmlhalaman=ceil($jmldata/$batas);
		echo"<br>Halaman : ";
		$file="laporan.php?act=dt";
		for($i=1;$i<=$jmlhalaman;$i++)
		if($i!=$halaman)
		{
			echo"<a href=$file?halaman=$i&jenis=$jenis&oke=$oke>$i</a> | ";
		}
		else
		{
			echo "<b>$i</b> | ";
		}
		
	}
	else
	{
		echo "<center><b>DATA TIDAK DITEMUKAN</b></center>";
	}
}
?>
          </center>
        </table></td>
      </tr>
      </table>
      </center>
	
</body>
</html>