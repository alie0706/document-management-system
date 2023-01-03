<?php
session_start();

if(empty($_SESSION['lp'])){
	$lp=1;
}else{
	$lp=$_SESSION['lp'];
}
?>
 <script src="./js/jquery.js"></script>
<script src="./js/development-bundle/ui/jquery.ui.core.js"></script>
<script src="./js/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="./js/development-bundle/ui/jquery.ui.datepicker.js"></script>
<link href="./js/themes/sunny/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
<!--
	function calc_laporan()
	{
		document.tambah.TGLMUS.value = 
			parseInt(document.tambah.TGL_11.value) +
			parseInt(document.tambah.MASRET.value) ;
	}
	
	
-->
</script>
  <script type="text/javascript" src="./js/jquery.validate.js"></script>
  <script type="text/javascript">
		$(document).ready(function() {
			$("#form1").validate({
				rules: {
				  NOMKOT: {
				required: true,
				},
				  
					 MASRET: {
          	 required: true,
					   number: true
          },	
			
		  
					website: {
        	  required: true,
						url: true
					}
				},
			
      	messages: { 
			   NOMKOT: {
				required: "Harus di isi",
				minlength: "Harus lebih dari 3 Karakter"
			},
		      
				  MASRET: {
				    required: 'Harus di isi',
				    number  : 'Hanya boleh di isi Angka'
			    },
			    
			    website: {
				    required: 'Website harus di isi',
				    url     : 'Alamat website harus valid'
			    }
			   },
         
         success: function(label) {
            label.text('OK!').addClass('valid');
         }
			});
		});
	</script>
	<style type="text/css">
#form1 label.error {
	color:red;
padding: 5px 5px 5px 0.1em;
font-size: 9pt;
margin-left: 5px;
font-weight:bold;
 }
td { padding: 5px; }

#form1 label.valid {
	color:green;
padding: 5px 5px 5px 0.1em;
font-size: 9pt;
margin-left: 5px;
font-weight:bold;
 }
td { padding: 5px; }
</style>

 <?php
switch($_GET[act]){
  // Tampil user
  default:
  if($_SESSION[KODPLG]=='S012'){?>
   <script language="JavaScript">
<!--
	
		function calc_laporan1()
	{
		document.tambah.TGLMUS.value = 
			parseInt(document.tambah.PRD_TX.value) +
			parseInt(document.tambah.MASRET.value) ;
	}

-->
</script>

<?php
    echo "
	<form name='tambah' method=POST action='./aksi.php?module=transaksi&act=inputan' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>";

		echo "<input type=hidden name=KODGUD value='KRW'>
		 <input type=hidden name=KODPLG value='$_SESSION[KODPLG]'>
		 <input type=hidden name=KODWIL value='01'>
		 <input type=hidden name=KODKCU value='PDBS'>
		 <input type=hidden name=KODKCP value=''>";
		 //<input type=hidden name=KODKOT value='K144'>
		 echo"<input type=hidden name=RECSTS value='1'>
		 <input type=hidden name=KODMUT value='11'>
		 <input type=hidden name=KOTSTS value='1'>
		 <input type=hidden name=KONKOT value='1'>
		 <input type=hidden name=KONLEB value='1'>
		 <input type=hidden name=KONDAT value='1'>
		 <input type=hidden name=KONSEG value='1'>
		 <input type=hidden name=JMLDOK value='$lp'>
		 <input type=hidden name=STATUS value='Aktive'>
		 <input type=hidden name=ACTION value='B'>
		 <input type=hidden name=IDUSER value='$_SESSION[namalengkap]'>
		 
	<tr><td>Nomor Kotak <td><input type=text name=NOMKOT class='required' title='*Harus Diisi'>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true	
			
        });
      });
    </script>
<?php	echo "<td> Tanggal <td><input type=text name='RECMOD' id='tanggal1' value='$tgl_sekarang1'  readonly>";

//NOMCON
$result = mysql_query("select * from control");    
$jsArray = "var NOMCON1 = new Array();\n";    
echo '<TR><TD>Control No <td><select name="NOMCON" onchange="changeValue(this.value)">';    
echo '<option>- SILAHKAN PILIH -</option>';    
while ($row = mysql_fetch_array($result)) {    
    echo '<option value="' . $row['NOMCON'] . '">' . $row['NOMCON'] . '</option>';    
    $jsArray .= "NOMCON1['" . $row['NOMCON'] . "'] = {name:'" . addslashes($row['MASRET']) . "',desc:'".addslashes($row['MASA'])."'};\n";    
}    
echo '</select>';    
?>    
  
  
<td>Masa Retensi <td><input type="text" name="MASRET1" size=10  id="MASRET1" class='required' title='*Harus Diisi' />  
<input type="text" name="MASRET" id="MASRET" size=5 title='*Harus Diisi'><font color=red size=1><i> * Jika tidak ada retensi harap diisi angka 9999</i></font>  
<script type="text/javascript">    
<?php echo $jsArray; ?>  
function changeValue(id){  
document.getElementById('MASRET1').value = NOMCON1[id].name;  
document.getElementById('MASRET').value = NOMCON1[id].desc;  
};  
</script>  
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

echo "<tr><td>Tanggal Musnah <td><input type=text name='TGLMUS' value='' readonly><font color=red><i>*Kosongkan saja</i></font> <td>Keterangan Kotak <td><input type=text name=KETKOT>
 	
<tr><td>Kode Bagian <td><select name='KODBAG'> 
			 <option value=0 selected>- Silahkan Pilih -</option>";
            $tampil=mysql_query("SELECT * FROM bagian where KODPLG='S012' ORDER BY KODPLG,KODBAG ASC");
             while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODBAG]'>$r[KODBAG]</option>";
            }
			echo "<td>Jenis Kotak <td><select name='KODKOT'> ";
			  $tampil=mysql_query("SELECT * FROM kotak,tblkot where kotak.KODKOT=tblkot.KODKOT and KODPLG='$_SESSION[KODPLG]' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODKOT]'>$r[NAMKOT]</option>";
            }
	echo "</table></center></form><form action='modul/lp.php' method='post'><td align=center colspan='4'><input type=text name='lp' size=2 value='$lp'>
		  <font color=red><b> <blink>Masukkan jumlah baris yang diinginkan</font></b><input name='' type='hidden' value='Update' /></td></form>";
			
		  echo "<table>
          <tr><th>no urut</th><th>Namdok</th><th>Prd Tx</th><th>Ketdk1</th><th>Ketdk2</th><th>Ketdk3</th></tr>"; 
		     ///$no=1;
			 
			   for($x=1;$x<=$lp;$x++){
    //$tampil=mysql_query("SELECT * FROM user ORDER BY id_user");
 
    //while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td align=center>";?><input type=text readonly name=<? echo 'URTDOK'.$x;?> size=5 value=<?=$x;?>></td>
             <td><input type=text  size=40 name=<? echo 'NAMDOK'.$x;?> class='required' title='*Harus Diisi'></td>
		
	<td><input type=text size=20 name=<? echo 'PRD_TX'.$x;?> value="yy-mm-dd" class='required' onfocus="this.value=''" class='required' onfocus="this.value=''"></td>
	 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgl").datepicker({
					dateFormat : "yy-mm-dd",        
          showOn          : "button",
          buttonImage     : "./js/development-bundle/demos/datepicker/images/calendar.gif",
          buttonImageOnly : true				
        });
		
      });
	  </script>
		      <td><input type=text size=41 name=<? echo 'KETDK1'.$x;?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK2'.$x;?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK3'.$x;?>></td><?
             echo "</td></tr>";
			 
      //$no++;
    //}
	};
	 echo "<tr><td colspan=6 align=center><input type=submit value=Simpan>
                            <input type=reset value=Batal>  | <a href=media.php?module=transaksi&act=listtransaksi>List Transaksi</a></td></tr>";
         }
		 
// C012
elseif($_SESSION[KODPLG]=='C026'){?>
   <script language="JavaScript">
<!--
	
		function calc_laporan1()
	{
		document.tambah.TGLMUS.value = 
			parseInt(document.tambah.PRD_TX.value) +
			parseInt(document.tambah.MASRET.value) ;
	}

-->
</script>

<?php
    echo "
	<form name='tambah' method=POST action='./aksi.php?module=transaksi&act=inputan' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>";

		echo "<input type=hidden name=KODGUD value='KRW'>
		 <input type=hidden name=KODPLG value='$_SESSION[KODPLG]'>
		 <input type=hidden name=KODWIL value='01'>
		 <input type=hidden name=KODKCU value='PDBS'>
		 <input type=hidden name=KODKCP value=''>";
		 //<input type=hidden name=KODKOT value='K144'>
		 echo"<input type=hidden name=RECSTS value='1'>
		 <input type=hidden name=KODMUT value='11'>
		 <input type=hidden name=KOTSTS value='1'>
		 <input type=hidden name=KONKOT value='1'>
		 <input type=hidden name=KONLEB value='1'>
		 <input type=hidden name=KONDAT value='1'>
		 <input type=hidden name=KONSEG value='1'>
		 <input type=hidden name=JMLDOK value='$lp'>
		 <input type=hidden name=STATUS value='Aktive'>
		 <input type=hidden name=ACTION value='B'>
		 <input type=hidden name=IDUSER value='$_SESSION[namalengkap]'>
		 
	<tr><td>Nomor Kotak <td><input type=text name=NOMKOT class='required' title='*Harus Diisi'>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true	
			
        });
      });
    </script>
<?php	echo "<td> Tanggal <td><input type=text name='RECMOD' id='tanggal1' value='$tgl_sekarang1'  readonly>";

//NOMCON
$result = mysql_query("select * from control");    
$jsArray = "var NOMCON1 = new Array();\n";    
echo '<TR><TD>Control No <td><select name="NOMCON" onchange="changeValue(this.value)">';    
echo '<option>- SILAHKAN PILIH -</option>';    
while ($row = mysql_fetch_array($result)) {    
    echo '<option value="' . $row['NOMCON'] . '">' . $row['NOMCON'] . '</option>';    
    $jsArray .= "NOMCON1['" . $row['NOMCON'] . "'] = {name:'" . addslashes($row['MASRET']) . "',desc:'".addslashes($row['MASA'])."'};\n";    
}    
echo '</select>';    
?>    
  
  
<td>Masa Retensi <td><input type="text" name="MASRET1" size=10  id="MASRET1" class='required' title='*Harus Diisi' />  
<input type="text" name="MASRET" id="MASRET" size=5 title='*Harus Diisi'><font color=red size=1><i> * Jika tidak ada retensi harap diisi angka 9999</i></font>  
<script type="text/javascript">    
<?php echo $jsArray; ?>  
function changeValue(id){  
document.getElementById('MASRET1').value = NOMCON1[id].name;  
document.getElementById('MASRET').value = NOMCON1[id].desc;  
};  
</script>  
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

echo "<tr><td>Tanggal Musnah <td><input type=text name='TGLMUS' value='' readonly><font color=red><i>*Kosongkan saja</i></font> <td>Keterangan Kotak <td><input type=text name=KETKOT>
 	
<tr><td>Kode Bagian <td><select name='KODBAG'> 
			 <option value=0 selected>- Silahkan Pilih -</option>";
            $tampil=mysql_query("SELECT * FROM bagian where KODPLG='C026' ORDER BY KODPLG,KODBAG ASC");
             while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODBAG]'>$r[KODBAG]</option>";
            }
			echo "<td>Jenis Kotak <td><select name='KODKOT'> ";
			  $tampil=mysql_query("SELECT * FROM kotak,tblkot where kotak.KODKOT=tblkot.KODKOT and KODPLG='$_SESSION[KODPLG]' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODKOT]'>$r[NAMKOT]</option>";
            }
	echo "</table></center></form><form action='modul/lp.php' method='post'><td align=center colspan='4'><input type=text name='lp' size=2 value='$lp'>
		  <font color=red><b> <blink>Masukkan jumlah baris yang diinginkan</font></b><input name='' type='hidden' value='Update' /></td></form>";
			
		  echo "<table>
          <tr><th>no urut</th><th>Namdok</th><th>Prd Tx</th><th>Ketdk1</th><th>Ketdk2</th><th>Ketdk3</th></tr>"; 
		     ///$no=1;
			 
			   for($x=1;$x<=$lp;$x++){
    //$tampil=mysql_query("SELECT * FROM user ORDER BY id_user");
 
    //while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td align=center>";?><input type=text readonly name=<? echo 'URTDOK'.$x;?> size=5 value=<?=$x;?>></td>
             <td><input type=text  size=40 name=<? echo 'NAMDOK'.$x;?> class='required' title='*Harus Diisi'></td>
		
	<td><input type=text size=20 name=<? echo 'PRD_TX'.$x;?> value="yy-mm-dd" class='required' onfocus="this.value=''" class='required' onfocus="this.value=''"></td>
	 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgl").datepicker({
					dateFormat : "yy-mm-dd",        
          showOn          : "button",
          buttonImage     : "./js/development-bundle/demos/datepicker/images/calendar.gif",
          buttonImageOnly : true				
        });
		
      });
	  </script>
		      <td><input type=text size=41 name=<? echo 'KETDK1'.$x;?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK2'.$x;?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK3'.$x;?>></td><?
             echo "</td></tr>";
			 
      //$no++;
    //}
	};
	 echo "<tr><td colspan=6 align=center><input type=submit value=Simpan>
                            <input type=reset value=Batal>  | <a href=media.php?module=transaksi&act=listtransaksi>List Transaksi</a></td></tr>";
         }
 //ELECTRONI SOLUTION

elseif($_SESSION[KODPLG]=='E024'){?>
  <script language="JavaScript">
<!--
	
		function calc_laporan1()
	{
		document.tambah.TGLMUS.value = 
			parseInt(document.tambah.PRD_TX.value) +
			parseInt(document.tambah.MASRET.value) ;
	}

-->
</script>
<?php
    echo "
	<form name=tambah method=POST action='./aksi.php?module=transaksi&act=inputan_elec' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>";

		echo "<input type=hidden name=KODGUD value='$_SESSION[KODGUD]'>
		 <input type=hidden name=KODPLG value='$_SESSION[KODPLG]'>
		 <input type=hidden name=KODWIL value='01'>
		 <input type=hidden name=KODKCU value='PDBS'>
		 <input type=hidden name=KODKCP value=''>";
		 //<input type=hidden name=KODKOT value='K144'>
		 echo"<input type=hidden name=RECSTS value='1'>
		 <input type=hidden name=KODMUT value='11'>
		 <input type=hidden name=KOTSTS value='1'>
		 <input type=hidden name=KONKOT value='1'>
		 <input type=hidden name=KONLEB value='1'>
		 <input type=hidden name=KONDAT value='1'>
		 <input type=hidden name=KONSEG value='1'>
		 <input type=hidden name=JMLDOK value='$lp'>
		 <input type=hidden name=STATUS value='Aktive'>
		 <input type=hidden name=ACTION value='B'>
		 <input type=hidden name=IDUSER value='$_SESSION[namalengkap]'>
		 
	<tr><td>Nomor Kotak/BOX <td><input type=text name=NOMKOT class='required' title='*Harus Diisi'>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true	
			
        });
      });
    </script>
<?php	echo "<td> Tanggal / Periode <td><input type=text name='RECMOD' id='tanggal1' value='$tgl_sekarang1'  readonly>";

echo "<tr><td>Control No <td><input type=text name='NOMCON'>";
?>    
  
  
<td>Masa Retensi <td><input type="text" name="MASRET" id="MASRET" size=5 ><font color=red size=1><i> * Jika tidak ada retensi harap diisi angka 9999</i></font>  
<script type="text/javascript">    
<?php echo $jsArray; ?>  
function changeValue(id){  
document.getElementById('MASRET1').value = NOMCON1[id].name;  
document.getElementById('MASRET').value = NOMCON1[id].desc;  
};  
</script>  
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

echo "<tr><td>Tanggal Musnah <td><input type=text name='TGLMUS' value='' id='tgla'> <td>Keterangan Kotak <td><input type=text name=KETKOT>
 	<tr><td>Kode Bagian <td><select name='KODBAG'> 
			 <option value=0 selected>- Silahkan Pilih -</option>";
            $tampil=mysql_query("SELECT * FROM bagian where KODPLG='E024' ORDER BY KODPLG ASC");
             while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODBAG]'>$r[KODBAG] ($r[NAMBAG])</option>";
            }
			echo "<td>Jenis Kotak <td><select name='KODKOT'> ";
			  $tampil=mysql_query("SELECT * FROM kotak,tblkot where kotak.KODKOT=tblkot.KODKOT and KODPLG='$_SESSION[KODPLG]' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODKOT]'>$r[NAMKOT]</option>";
            }
			echo "<tr><td>PIC <td colspan=3><input type=text name='pic' ></tr></td>";
	echo "</table></center></form><form action='modul/lp.php' method='post'><td align=center colspan='4'><input type=text name='lp' size=2 value='$lp'>
		  <font color=red><b> <blink>Masukkan jumlah baris yang diinginkan</font></b><input name='' type='hidden' value='Update' /></td></form>";
			
		  echo "<table>
          <tr><th>NO</th><th>JN</th><th>No. Voucher/invoice</th><th>Date/Month</th><th>Payment Date</th><th>Store</th><th>Vendor/Customer</th></tr>"; 
		     ///$no=1;
			 
			   for($x=1;$x<=$lp;$x++){
    //$tampil=mysql_query("SELECT * FROM user ORDER BY id_user");
 
    //while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td align=center>";?><input type=text readonly name=<? echo 'URTDOK'.$x;?> size=1 value=<?=$x;?>></td>
             <td><input type=text  size=20 name=<? echo 'KETDK4'.$x;?> class='required' title='*Harus Diisi'></td>
		     <td><input type=text  size=35 name=<? echo 'NAMDOK'.$x;?> class='required' title='*Harus Diisi'></td>
			 
	<td><input type=text size=10 name=<? echo 'PRD_TX'.$x;?> value="yy-mm-dd" class='required' onfocus="this.value=''" onChange='calc_laporan1()' title='*Harus Diisi'></td>
	 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgl").datepicker({
					dateFormat : "yy-mm-dd",        
          showOn          : "button",
          buttonImage     : "./js/development-bundle/demos/datepicker/images/calendar.gif",
          buttonImageOnly : true				
        });
		
      });
	  </script>
		      <td><input type=text size=38 name=<? echo 'KETDK1'.$x;?>></td>
		      <td><input type=text size=38 name=<? echo 'KETDK2'.$x;?>></td>
		      <td><input type=text size=38 name=<? echo 'KETDK3'.$x;?>></td><?
             echo "</td></tr>";
			 
      //$no++;
    //}
	};
	 echo "<tr><td colspan=7 align=center><input type=submit value=Simpan>
                            <input type=reset value=Batal>  | <a href=media.php?module=transaksi&act=listtransaksiE>List Transaksi</a></td></tr>";
         }	

// ELOK SURYA

elseif($_SESSION[KODPLG]=='E026'){?>
  <script language="JavaScript">
<!--
	
		function calc_laporan1()
	{
		document.tambah.TGLMUS.value = 
			parseInt(document.tambah.PRD_TX.value) +
			parseInt(document.tambah.MASRET.value) ;
	}

-->
</script>
<?php
    echo "
	<form name=tambah method=POST action='./aksi.php?module=transaksi&act=inputan_elec' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>";

		echo "<input type=hidden name=KODGUD value='$_SESSION[KODGUD]'>
		 <input type=hidden name=KODPLG value='$_SESSION[KODPLG]'>
		 <input type=hidden name=KODWIL value='01'>
		 <input type=hidden name=KODKCU value='PDBS'>
		 <input type=hidden name=KODKCP value=''>";
		 //<input type=hidden name=KODKOT value='K144'>
		 echo"<input type=hidden name=RECSTS value='1'>
		 <input type=hidden name=KODMUT value='11'>
		 <input type=hidden name=KOTSTS value='1'>
		 <input type=hidden name=KONKOT value='1'>
		 <input type=hidden name=KONLEB value='1'>
		 <input type=hidden name=KONDAT value='1'>
		 <input type=hidden name=KONSEG value='1'>
		 <input type=hidden name=JMLDOK value='$lp'>
		 <input type=hidden name=STATUS value='Aktive'>
		 <input type=hidden name=ACTION value='B'>
		 <input type=hidden name=IDUSER value='$_SESSION[namalengkap]'>
		 
	<tr><td>Nomor Kotak/BOX <td><input type=text name=NOMKOT class='required' title='*Harus Diisi'>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true	
			
        });
      });
    </script>
<?php	echo "<td> Tanggal / Periode <td><input type=text name='RECMOD' id='tanggal1' value='$tgl_sekarang1'  readonly>";

echo "<tr><td>Control No <td><input type=text name='NOMCON'>";
?>    
  
  
<td>Masa Retensi <td><input type="text" name="MASRET" id="MASRET" size=5 ><font color=red size=1><i> * Jika tidak ada retensi harap diisi angka 9999</i></font>  
<script type="text/javascript">    
<?php echo $jsArray; ?>  
function changeValue(id){  
document.getElementById('MASRET1').value = NOMCON1[id].name;  
document.getElementById('MASRET').value = NOMCON1[id].desc;  
};  
</script>  
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

echo "<tr><td>Tanggal Musnah <td><input type=text name='TGLMUS' value='' id='tgla'> <td>Keterangan Kotak <td><input type=text name=KETKOT>
 	<tr><td>Kode Bagian <td><select name='KODBAG'> 
			 <option value=0 selected>- Silahkan Pilih -</option>";
            $tampil=mysql_query("SELECT * FROM bagian where KODPLG='E026' ORDER BY KODPLG ASC");
             while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODBAG]'>$r[KODBAG] ($r[NAMBAG])</option>";
            }
			echo "<td>Jenis Kotak <td><select name='KODKOT'> ";
			  $tampil=mysql_query("SELECT * FROM kotak,tblkot where kotak.KODKOT=tblkot.KODKOT and KODPLG='$_SESSION[KODPLG]' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODKOT]'>$r[NAMKOT]</option>";
            }
			echo "<tr><td>PIC <td colspan=3><input type=text name='pic' ></tr></td>";
	echo "</table></center></form><form action='modul/lp.php' method='post'><td align=center colspan='4'><input type=text name='lp' size=2 value='$lp'>
		  <font color=red><b> <blink>Masukkan jumlah baris yang diinginkan</font></b><input name='' type='hidden' value='Update' /></td></form>";
			
		  echo "<table>
          <tr><th>NO</th><th>JN</th><th>No. Voucher/invoice</th><th>Date/Month</th><th>Payment Date</th><th>Store</th><th>Vendor/Customer</th></tr>"; 
		     ///$no=1;
			 
			   for($x=1;$x<=$lp;$x++){
    //$tampil=mysql_query("SELECT * FROM user ORDER BY id_user");
 
    //while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td align=center>";?><input type=text readonly name=<? echo 'URTDOK'.$x;?> size=1 value=<?=$x;?>></td>
             <td><input type=text  size=20 name=<? echo 'KETDK4'.$x;?> class='required' title='*Harus Diisi'></td>
		     <td><input type=text  size=35 name=<? echo 'NAMDOK'.$x;?> class='required' title='*Harus Diisi'></td>
			 
	<td><input type=text size=10 name=<? echo 'PRD_TX'.$x;?> value="yy-mm-dd" class='required' onfocus="this.value=''" onChange='calc_laporan1()' title='*Harus Diisi'></td>
	 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgl").datepicker({
					dateFormat : "yy-mm-dd",        
          showOn          : "button",
          buttonImage     : "./js/development-bundle/demos/datepicker/images/calendar.gif",
          buttonImageOnly : true				
        });
		
      });
	  </script>
		      <td><input type=text size=38 name=<? echo 'KETDK1'.$x;?>></td>
		      <td><input type=text size=38 name=<? echo 'KETDK2'.$x;?>></td>
		      <td><input type=text size=38 name=<? echo 'KETDK3'.$x;?>></td><?
             echo "</td></tr>";
			 
      //$no++;
    //}
	};
	 echo "<tr><td colspan=7 align=center><input type=submit value=Simpan>
                            <input type=reset value=Batal>  | <a href=media.php?module=transaksi&act=listtransaksiE>List Transaksi</a></td></tr>";
         }	

// SUKSES ELECTRONIK		

elseif($_SESSION[KODPLG]=='E025'){?>
  <script language="JavaScript">
<!--
	
		function calc_laporan1()
	{
		document.tambah.TGLMUS.value = 
			parseInt(document.tambah.PRD_TX.value) +
			parseInt(document.tambah.MASRET.value) ;
	}

-->
</script>
<?php
    echo "
	<form name=tambah method=POST action='./aksi.php?module=transaksi&act=inputan_elec' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>";

		echo "<input type=hidden name=KODGUD value='$_SESSION[KODGUD]'>
		 <input type=hidden name=KODPLG value='$_SESSION[KODPLG]'>
		 <input type=hidden name=KODWIL value='01'>
		 <input type=hidden name=KODKCU value='PDBS'>
		 <input type=hidden name=KODKCP value=''>";
		 //<input type=hidden name=KODKOT value='K144'>
		 echo"<input type=hidden name=RECSTS value='1'>
		 <input type=hidden name=KODMUT value='11'>
		 <input type=hidden name=KOTSTS value='1'>
		 <input type=hidden name=KONKOT value='1'>
		 <input type=hidden name=KONLEB value='1'>
		 <input type=hidden name=KONDAT value='1'>
		 <input type=hidden name=KONSEG value='1'>
		 <input type=hidden name=JMLDOK value='$lp'>
		 <input type=hidden name=STATUS value='Aktive'>
		 <input type=hidden name=ACTION value='B'>
		 <input type=hidden name=IDUSER value='$_SESSION[namalengkap]'>
		 
	<tr><td>Nomor Kotak/BOX <td><input type=text name=NOMKOT class='required' title='*Harus Diisi'>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true	
			
        });
      });
    </script>
<?php	echo "<td> Tanggal / Periode <td><input type=text name='RECMOD' id='tanggal1' value='$tgl_sekarang1'  readonly>";

echo "<tr><td>Control No <td><input type=text name='NOMCON'>";
?>    
  
  
<td>Masa Retensi <td><input type="text" name="MASRET" id="MASRET" size=5 ><font color=red size=1><i> * Jika tidak ada retensi harap diisi angka 9999</i></font>  
<script type="text/javascript">    
<?php echo $jsArray; ?>  
function changeValue(id){  
document.getElementById('MASRET1').value = NOMCON1[id].name;  
document.getElementById('MASRET').value = NOMCON1[id].desc;  
};  
</script>  
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

echo "<tr><td>Tanggal Musnah <td><input type=text name='TGLMUS' value='' id='tgla'> <td>Keterangan Kotak <td><input type=text name=KETKOT>
 	<tr><td>Kode Bagian <td><select name='KODBAG'> 
			 <option value=0 selected>- Silahkan Pilih -</option>";
            $tampil=mysql_query("SELECT * FROM bagian where KODPLG='E025' ORDER BY KODPLG ASC");
             while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODBAG]'>$r[KODBAG] ($r[NAMBAG])</option>";
            }
			echo "<td>Jenis Kotak <td><select name='KODKOT'> ";
			  $tampil=mysql_query("SELECT * FROM kotak,tblkot where kotak.KODKOT=tblkot.KODKOT and KODPLG='$_SESSION[KODPLG]' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODKOT]'>$r[NAMKOT]</option>";
            }
			echo "<tr><td>PIC <td colspan=3><input type=text name='pic' ></tr></td>";
	echo "</table></center></form><form action='modul/lp.php' method='post'><td align=center colspan='4'><input type=text name='lp' size=2 value='$lp'>
		  <font color=red><b> <blink>Masukkan jumlah baris yang diinginkan</font></b><input name='' type='hidden' value='Update' /></td></form>";
			
		  echo "<table>
          <tr><th>NO</th><th>JN</th><th>No. Voucher/invoice</th><th>Date/Month</th><th>Payment Date</th><th>Store</th><th>Vendor/Customer</th></tr>"; 
		     ///$no=1;
			 
			   for($x=1;$x<=$lp;$x++){
    //$tampil=mysql_query("SELECT * FROM user ORDER BY id_user");
 
    //while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td align=center>";?><input type=text readonly name=<? echo 'URTDOK'.$x;?> size=1 value=<?=$x;?>></td>
             <td><input type=text  size=20 name=<? echo 'KETDK4'.$x;?> class='required' title='*Harus Diisi'></td>
		     <td><input type=text  size=35 name=<? echo 'NAMDOK'.$x;?> class='required' title='*Harus Diisi'></td>
			 
	<td><input type=text size=10 name=<? echo 'PRD_TX'.$x;?> value="yy-mm-dd" class='required' onfocus="this.value=''" onChange='calc_laporan1()' title='*Harus Diisi'></td>
	 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgl").datepicker({
					dateFormat : "yy-mm-dd",        
          showOn          : "button",
          buttonImage     : "./js/development-bundle/demos/datepicker/images/calendar.gif",
          buttonImageOnly : true				
        });
		
      });
	  </script>
		      <td><input type=text size=38 name=<? echo 'KETDK1'.$x;?>></td>
		      <td><input type=text size=38 name=<? echo 'KETDK2'.$x;?>></td>
		      <td><input type=text size=38 name=<? echo 'KETDK3'.$x;?>></td><?
             echo "</td></tr>";
			 
      //$no++;
    //}
	};
	 echo "<tr><td colspan=7 align=center><input type=submit value=Simpan>
                            <input type=reset value=Batal>  | <a href=media.php?module=transaksi&act=listtransaksiE>List Transaksi</a></td></tr>";
         }	

//rekayasa 
else{
	if($_SESSION[leveluser]=='sub_user'){
	echo "
	<form name='tambah' method=POST action='./aksi.php?module=transaksi&act=input' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>";	 
		echo "<input type=hidden name=KODGUD value='$_SESSION[KODGUD]'>
		 <input type=hidden name=KODPLG value='$_SESSION[KODPLG]'>
		 <input type=hidden name=KODWIL value='01'>
		 <input type=hidden name=KODKCU value='PDBS'>
		 <input type=hidden name=KODKCP value=''>";
		 //<input type=hidden name=KODKOT value='K144'>
		 echo"<input type=hidden name=RECSTS value='1'>
		 <input type=hidden name=KODMUT value='11'>
		 <input type=hidden name=KOTSTS value='1'>
		 <input type=hidden name=KONKOT value='1'>
		 <input type=hidden name=KONLEB value='1'>
		 <input type=hidden name=KONDAT value='1'>
		 <input type=hidden name=KONSEG value='1'>
		 <input type=hidden name=JMLDOK value='$lp'>
		 <input type=hidden name=STATUS value='Aktive'>
		 <input type=hidden name=ACTION value='B'>
		 <input type=hidden name=IDUSER value='$_SESSION[namalengkap]'>
		 
	<tr><td>Nomor Kotak <td><input type=text name=NOMKOT class='required' title='*Harus Diisi'>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	echo "<td> Tanggal <td><input type=text name='RECMOD' id='tanggal1' value='$tgl_sekarang1' onChange='calc_laporan()' readonly>
	<tr><td>Control No <td><input type=text name='NOMCON'> <td>Masa Retensi <td><input type=text name=MASRET size=5 onChange='calc_laporan()' class='required' title='*Harus Diisi'><font color=red size=1><i> * Jika tidak ada retensi harap diisi angka 9999</i></font>";
	?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	

echo "<tr><td>Tanggal Musnah <td><input type=text name=TGLMUS id=tanggal value='' readonly> <td>Keterangan Kotak <td><input type=text name=KETKOT>
 	<tr><td>Kode Bagian <td><select name='KODBAG'> 
			 <option value=0 selected>- Silahkan Pilih -</option>";
            $tampil=mysql_query("SELECT * FROM bagian where KODPLG='$_SESSION[KODPLG]' ORDER BY KODPLG ASC");
             while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODBAG]'>$r[KODBAG]</option>";
            }
			echo "<td>Jenis Kotak <td><select name='KODKOT'> ";
			  $tampil=mysql_query("SELECT * FROM kotak,tblkot where kotak.KODKOT=tblkot.KODKOT and KODPLG='$_SESSION[KODPLG]' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODKOT]'>$r[NAMKOT]</option>";
            }
	echo "</table></center></form><form action='modul/lp.php' method='post'><td align=center colspan='4'><input type=text name='lp' size=2 value='$lp'>
		  <font color=red><b> <blink>Masukkan jumlah baris yang diinginkan</font></b><input name='' type='hidden' value='Update' /></td></form>";
			
		  echo "<table>
          <tr><th>no urut</th><th>Namdok</th><th>Prd Tx</th><th>Ketdk1</th><th>Ketdk2</th><th>Ketdk3</th></tr>"; 
		     ///$no=1;
		  for($x=1;$x<=$lp;$x++){
    //$tampil=mysql_query("SELECT * FROM user ORDER BY id_user");
 
    //while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td align=center>";?><input type=text readonly name=<? echo 'URTDOK'.$x;?> size=5 value=<?=$x;?>></td>
             <td><input type=text  size=40 name=<? echo 'NAMDOK'.$x;?> class='required' title='*Harus Diisi'></td>
             <td><input type=text size=20 name=<? echo 'PRD_TX'.$x;?> class='required' title='*Harus Diisi'></td>
		      <td><input type=text size=41 name=<? echo 'KETDK1'.$x;?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK2'.$x;?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK3'.$x;?>></td><?
             echo "</td></tr>";
			 
      //$no++;
    //}
	};
	}
	else{
	if($_SESSION[leveluser]=='user' AND $_SESSION[KODPLG]=='R004'){
	echo "
	<form name='tambah' method=POST action='./aksi.php?module=transaksi&act=input' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>";	 
		echo "<input type=hidden name=KODGUD value='$_SESSION[KODGUD]'>
		 <input type=hidden name=KODPLG value='$_SESSION[KODPLG]'>
		 <input type=hidden name=KODWIL value='01'>
		 <input type=hidden name=KODKCU value='PDBS'>
		 <input type=hidden name=KODKCP value=''>";
		 //<input type=hidden name=KODKOT value='K144'>
		 echo"<input type=hidden name=RECSTS value='1'>
		 <input type=hidden name=KODMUT value='11'>
		 <input type=hidden name=KOTSTS value='1'>
		 <input type=hidden name=KONKOT value='1'>
		 <input type=hidden name=KONLEB value='1'>
		 <input type=hidden name=KONDAT value='1'>
		 <input type=hidden name=KONSEG value='1'>
		 <input type=hidden name=JMLDOK value='$lp'>
		 <input type=hidden name=STATUS value='NO'>
		 <input type=hidden name=ACTION value='B'>
		 <input type=hidden name=IDUSER value='$_SESSION[namalengkap]'>
		 
	<tr><td>Nomor Kotak <td><input type=text name=NOMKOT class='required' title='*Harus Diisi'>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	echo "<td> Tanggal <td><input type=text name='RECMOD' id='tanggal1' value='$tgl_sekarang1' onChange='calc_laporan()' readonly>
	<tr><td>Control No <td><input type=text name='NOMCON'> <td>Masa Retensi <td><input type=text name=MASRET size=5 onChange='calc_laporan()' class='required' title='*Harus Diisi'><font color=red size=1><i> * Jika tidak ada retensi harap diisi angka 9999</i></font>";
	?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	

echo "<tr><td>Tanggal Musnah <td><input type=text name=TGLMUS id=tanggal value='' readonly> <td>Keterangan Kotak <td><input type=text name=KETKOT>
 	<tr><td>Kode Bagian <td><select name='KODBAG'> 
			 <option value=0 selected>- Silahkan Pilih -</option>";
            $tampil=mysql_query("SELECT * FROM bagian where KODPLG='$_SESSION[KODPLG]' ORDER BY KODPLG ASC");
             while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODBAG]'>$r[KODBAG]</option>";
            }
			echo "<td>Jenis Kotak <td><select name='KODKOT'> ";
			  $tampil=mysql_query("SELECT * FROM kotak,tblkot where kotak.KODKOT=tblkot.KODKOT and KODPLG='$_SESSION[KODPLG]' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODKOT]'>$r[NAMKOT]</option>";
            }
	echo "</table></center></form><form action='modul/lp.php' method='post'><td align=center colspan='4'><input type=text name='lp' size=2 value='$lp'>
		  <font color=red><b> <blink>Masukkan jumlah baris yang diinginkan</font></b><input name='' type='hidden' value='Update' /></td></form>";
			
		  echo "<table>
          <tr><th>no urut</th><th>Namdok</th><th>Prd Tx</th><th>Ketdk1</th><th>Ketdk2</th><th>Ketdk3</th></tr>"; 
		     ///$no=1;
		  for($x=1;$x<=$lp;$x++){
    //$tampil=mysql_query("SELECT * FROM user ORDER BY id_user");
 
    //while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td align=center>";?><input type=text readonly name=<? echo 'URTDOK'.$x;?> size=5 value=<?=$x;?>></td>
             <td><input type=text  size=40 name=<? echo 'NAMDOK'.$x;?> class='required' title='*Harus Diisi'></td>
             <td><input type=text size=20 name=<? echo 'PRD_TX'.$x;?> class='required' title='*Harus Diisi'></td>
		      <td><input type=text size=41 name=<? echo 'KETDK1'.$x;?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK2'.$x;?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK3'.$x;?>></td><?
             echo "</td></tr>";
			 
      //$no++;
    //}
	};
	}
	else {
	echo "
	<form name='tambah' method=POST action='./aksi.php?module=transaksi&act=input' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>";	 
		echo "<input type=hidden name=KODGUD value='$_SESSION[KODGUD]'>
		 <input type=hidden name=KODPLG value='$_SESSION[KODPLG]'>
		 <input type=hidden name=KODWIL value='01'>
		 <input type=hidden name=KODKCU value='PDBS'>
		 <input type=hidden name=KODKCP value=''>";
		 //<input type=hidden name=KODKOT value='K144'>
		 echo"<input type=hidden name=RECSTS value='1'>
		 <input type=hidden name=KODMUT value='11'>
		 <input type=hidden name=KOTSTS value='1'>
		 <input type=hidden name=KONKOT value='1'>
		 <input type=hidden name=KONLEB value='1'>
		 <input type=hidden name=KONDAT value='1'>
		 <input type=hidden name=KONSEG value='1'>
		 <input type=hidden name=JMLDOK value='$lp'>
		 <input type=hidden name=STATUS value='Aktive'>
		 <input type=hidden name=ACTION value='B'>
		 <input type=hidden name=IDUSER value='$_SESSION[namalengkap]'>
		 
	<tr><td>Nomor Kotak <td><input type=text name=NOMKOT class='required' title='*Harus Diisi'>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	echo "<td> Tanggal <td><input type=text name='RECMOD' id='tanggal1' value='$tgl_sekarang1' onChange='calc_laporan()' readonly>
	<tr><td>Control No <td><input type=text name='NOMCON'> <td>Masa Retensi <td><input type=text name=MASRET size=5 onChange='calc_laporan()' class='required' title='*Harus Diisi'><font color=red size=1><i> * Jika tidak ada retensi harap diisi angka 9999</i></font>";
	?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	

echo "<tr><td>Tanggal Musnah <td><input type=text name=TGLMUS id=tanggal value='' readonly> <td>Keterangan Kotak <td><input type=text name=KETKOT>
 	<tr><td>Kode Bagian <td><select name='KODBAG'> 
			 <option value=0 selected>- Silahkan Pilih -</option>";
            $tampil=mysql_query("SELECT * FROM bagian ORDER BY KODPLG ASC");
             while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODBAG]'>$r[KODBAG]</option>";
            }
			echo "<td>Jenis Kotak <td><select name='KODKOT'> ";
			  $tampil=mysql_query("SELECT * FROM kotak,tblkot where kotak.KODKOT=tblkot.KODKOT and KODPLG='$_SESSION[KODPLG]' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODKOT]'>$r[NAMKOT]</option>";
            }
	echo "</table></center></form><form action='modul/lp.php' method='post'><td align=center colspan='4'><input type=text name='lp' size=2 value='$lp'>
		  <font color=red><b> <blink>Masukkan jumlah baris yang diinginkan</font></b><input name='' type='hidden' value='Update' /></td></form>";
			
		  echo "<table>
          <tr><th>no urut</th><th>Namdok</th><th>Prd Tx</th><th>Ketdk1</th><th>Ketdk2</th><th>Ketdk3</th></tr>"; 
		     ///$no=1;
		  for($x=1;$x<=$lp;$x++){
    //$tampil=mysql_query("SELECT * FROM user ORDER BY id_user");
 
    //while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td align=center>";?><input type=text readonly name=<? echo 'URTDOK'.$x;?> size=5 value=<?=$x;?>></td>
             <td><input type=text  size=40 name=<? echo 'NAMDOK'.$x;?> class='required' title='*Harus Diisi'></td>
             <td><input type=text size=20 name=<? echo 'PRD_TX'.$x;?> class='required' title='*Harus Diisi'></td>
		      <td><input type=text size=41 name=<? echo 'KETDK1'.$x;?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK2'.$x;?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK3'.$x;?>></td><?
             echo "</td></tr>";
			 
      //$no++;
    //}
	};
	}
}
	 echo "<tr><td colspan=6 align=center><input type=submit value=Simpan>
                            <input type=reset value=Batal>  | <a href=media.php?module=transaksi&act=listtransaksi>List Transaksi</a></td></tr>";
         }
					echo " </table>";
		  
		  echo "<table><tr><td><i><blink><font color=red>NB : Jika ingin menambah kolom rubah angka 1 menjadi angka yang diinginkan, kemudian tekan tombol ENTER</font></td></tr></i></blink></table>";		
    echo "</table>";
	
		
    break;
  
   case"listtransaksi":
  if($_SESSION[leveluser]=='admin'){
     echo "<br><fieldset><legend>LIST DATA BOX STATUS AKTIVE</legend>";
	 
//$m=@mysql_query("SELECT * FROM dakot_h,dakot_d where dakot_h.KODPLG=dakot_d.KODPLG order by dakot_d.KODPLG");
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>ACCOUNT NAME</th><th>RETENTION</th><th>DEPARTEMENT</th><th>CONTROL NO</th><th>DESTRUCTION DATE</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_h where STATUS='Aktive' ORDER BY KODPLG");
    $no = $posisi+1;
    
    while ($r=mysql_fetch_array($tampil)){
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td><a href=media.php?module=transaksi&act=detailtransaksi&id=$r[NOMKOT]>$r[NOMKOT]</a></td>
                <td>$r1[NAMPLG]</td>
                <td>$r[MASRET]</td>
                <td>$r[KODBAG]</td>
				<td>$r[NOMCON]</td>
				<td>$tglmus</td>
				<td><a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				$no++;
      }
	  echo "</table>";
	  //<a href=./dump.php>Back-Up database</a> | 
	  //echo "<a href=eksport.php>Eksport Dakot_h</a> | <a href=eksport_d.php>Eksport Dakot_d</a>";
	  echo "<a href=?module=transaksi&act=eksport_h>Eksport Dakot_h</a> | <a href=?module=transaksi&act=eksport_d>Eksport Dakot_d</a>
	  <br><hr color=#FCEDC7 noshade=noshade /> ";
echo "<br><fieldset><legend>LIST DATA BOX STATUS RECEIPT</legend>";
	 
//$m=@mysql_query("SELECT * FROM dakot_h,dakot_d where dakot_h.KODPLG=dakot_d.KODPLG order by dakot_d.KODPLG");
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>ACCOUNT NAME</th><th>RETENTION</th><th>DEPARTEMENT</th><th>CONTROL NO</th><th>DESTRUCTION DATE</th><th>NO TANDA TERIMA</th><th>TGL RECEIPT</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_h where STATUS='Receipt' ORDER BY KODPLG");
    $no = $posisi+1;
    
    while ($r=mysql_fetch_array($tampil)){
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td><a href=media.php?module=transaksi&act=detailtransaksi&id=$r[NOMKOT]>$r[NOMKOT]</a></td>
                <td>$r1[NAMPLG]</td>
                <td>$r[MASRET]</td>
                <td>$r[KODBAG]</td>
				<td>$r[NOMCON]</td>
				<td>$tglmus</td>
				<td>$r[NOM_11]</td>
				<td>$r[TGL_11]</td>
				<td><a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				$no++;
      }
}
elseif($_SESSION[leveluser]=='sub_user'){
     echo "<br><fieldset><legend>LIST DATA BOX </legend>";
	 
//$m=@mysql_query("SELECT * FROM dakot_h,dakot_d where dakot_h.KODPLG=dakot_d.KODPLG order by dakot_d.KODPLG");
echo "<a href=inc/report.php?id=$_SESSION[KODPLG] target=_blank><img src='images/pdf.png' border=0 width=40 height=40 title='cetak laporan'></a> ";
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>ACCOUNT NAME</th><th>RETENTION</th><th>DEPARTEMENT</th><th>CONTROL NO</th><th>DESTRUCTION DATE</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_h where KODPLG='$_SESSION[KODPLG]' AND STATUS='Aktive' ORDER BY KODPLG");
    $no = $posisi+1;
    
    while ($r=mysql_fetch_array($tampil)){
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td><a href=media.php?module=transaksi&act=detailtransaksiSUB&id=$r[NOMKOT]>$r[NOMKOT]</a></td>
                <td>$r1[NAMPLG]</td>
                <td>$r[MASRET]</td>
                <td>$r[KODBAG]</td>
				<td>$r[NOM_11]</td>
				<td>$tglmus</td>
				<td><a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				$no++;
      }
	  echo "</fieldset></legend></table><br><hr color=#FCEDC7 noshade=noshade /> ";
	  
echo "<br><fieldset><legend>LIST DATA BOX YANG BELUM DIVERIFIKASI</legend>";
	 
//$m=@mysql_query("SELECT * FROM dakot_h,dakot_d where dakot_h.KODPLG=dakot_d.KODPLG order by dakot_d.KODPLG");
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>ACCOUNT NAME</th><th>RETENTION</th><th>DEPARTEMENT</th><th>CONTROL NO</th><th>DESTRUCTION DATE</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_h where KODPLG='$_SESSION[KODPLG]' AND STATUS='NO' ORDER BY KODPLG");
    $no = $posisi+1;
    
    while ($r=mysql_fetch_array($tampil)){
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td><a href=media.php?module=transaksi&act=detailtransaksiSUB&id=$r[NOMKOT]>$r[NOMKOT]</a></td>
                <td>$r1[NAMPLG]</td>
                <td>$r[MASRET]</td>
                <td>$r[KODBAG]</td>
				<td>$r[NOM_11]</td>
				<td>$tglmus</td>
				<td><a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				$no++;
      }
}
else {
echo "<br><fieldset><legend>LIST DATA BOX</legend>";
	echo "<form method=POST action='?module=transaksi&act=hasilcariSUNL'>    
			<input name=kata type=text size=25 />
			<input type=submit value=Cari />
			</form>
      <hr color=#FCEDC7 noshade=noshade /> "; 
//$m=@mysql_query("SELECT * FROM dakot_h,dakot_d where dakot_h.KODPLG=dakot_d.KODPLG order by dakot_d.KODPLG");
echo "<a href=inc/report.php?id=$_SESSION[KODPLG] target=_blank><img src='images/pdf.png' border=0 width=40 height=40 title='cetak laporan'></a> ";
          
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>ACCOUNT NAME</th><th>RETENTION</th><th>DEPARTEMENT</th><th>CONTROL NO</th><th>DESTRUCTION DATE</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_h where KODPLG='$_SESSION[KODPLG]' AND STATUS='Aktive' ORDER BY KODPLG");
    $no = $posisi+1;
    
    while ($r=mysql_fetch_array($tampil)){
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td>$r[NOMKOT]</a></td>
                <td>$r1[NAMPLG]</td>
                <td>$r[MASRET1] $r[MASRET]</td>
                <td>$r[KODBAG]</td>
				<td>$r[NOM_11]</td>
				<td>$tglmus</td>
				<td align=center><a href=inc/printout_sunlife.php?kd=$r[KODPLG]&id=$r[NOMKOT] target=_blank><img src=images/print.png border=0 border=0 title='verifikasi'></a>
				|<a href=?module=transaksi&act=editSUN&id=$r[NOMKOT]><img src=images/edit.jpg border=0 border=0 title='edit'></a>
				|<a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				$no++;
      }

}
echo "</table>";
  break;
 // hasil cari sunlife

case "hasilcariSUNL":
  echo "<feildset><legend>Hasil Pencarian</legend>";
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM dakot_h WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "KODPLG='$_SESSION[KODPLG]' AND NOMKOT LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY KODPLG DESC LIMIT 7";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
    $p      = new Paging;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysql_query("SELECT * FROM dakot_h  ORDER BY KODPLG DESC LIMIT $posisi_,$batas_");
    
	$no = $posisi_+1;
	$rupi='Rp.';
while ($r=mysql_fetch_array($hasil)){

    echo "<p>Ditemukan <b>$ketemu</b> Nomor Box/Kotak dengan No. <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>"; 
 echo "<table>
      
	<tr><th>no</th><th>BOX  NO</th><th>ACCOUNT NAME</th><th>RETENTION</th><th>DEPARTEMENT</th><th>CONTROL NO</th><th>DESTRUCTION DATE</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_h WHERE KODPLG='$_SESSION[KODPLG]' AND STATUS='Aktive' ORDER BY KODPLG");
    $no = $posisi+1;
    
    //while ($r=mysql_fetch_array($tampil)){
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td>$r[NOMKOT]</a></td>
                <td>$r1[NAMPLG]</td>
                <td>$r[MASRET]</td>
                <td>$r[KODBAG]</td>
				<td>$r[NOMCON]</td>
				<td>$tglmus</td>
				<td><a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        ";
				$no++;
	
	}
	echo " </table>";
  }
  else{
    echo "Tidak ditemukan No Kotak/BOX yang anda cari dengan No <b>$kata</b>";
  }  
  echo "<input type=button value=Back onclick=self.history.back()>";
    break;	
 
 //list electronik
case"listtransaksiE":
  if($_SESSION[KODPLG]=='E024'){
echo "<br><fieldset><legend>LIST DATA BOX</legend>
	<form method=POST action='?module=transaksi&act=hasilcariE'>    
			<input name=kata type=text size=25 />
			<input type=submit value=Cari />
			</form>
      <hr color=#FCEDC7 noshade=noshade /> ";
//$m=@mysql_query("SELECT * FROM dakot_h,dakot_d where dakot_h.KODPLG=dakot_d.KODPLG order by dakot_d.KODPLG");
echo "<a href=inc/reportE.php?id=$_SESSION[KODPLG] target=_blank><img src='images/pdf.png' border=0 width=40 height=40 title='cetak laporan'></a> ";
          
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_h WHERE KODPLG='E024' AND STATUS='Aktive' ORDER BY KODPLG");
    $no = $posisi+1;
    
    while ($r=mysql_fetch_array($tampil)){
$m1=@mysql_query("SELECT * FROM dakot_d where KODPLG='$r[KODPLG]' order by NOMKOT");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td>$r[NOMKOT]</a></td>
                <td align=center><a href=?module=transaksi&act=detaillisttransaksiE&id=$r[NOMKOT]><img src=images/detail.gif border=0 border=0 title='detail'></a> | 
				<a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				$no++;
      }


echo "</table>";
}
elseif($_SESSION[KODPLG]=='E025'){
echo "<br><fieldset><legend>LIST DATA BOX</legend>
	<form method=POST action='?module=transaksi&act=hasilcariE'>    
			<input name=kata type=text size=25 />
			<input type=submit value=Cari />
			</form>
      <hr color=#FCEDC7 noshade=noshade /> ";
//$m=@mysql_query("SELECT * FROM dakot_h,dakot_d where dakot_h.KODPLG=dakot_d.KODPLG order by dakot_d.KODPLG");
echo "<a href=inc/reportE.php?id=$_SESSION[KODPLG] target=_blank><img src='images/pdf.png' border=0 width=40 height=40 title='cetak laporan'></a> ";
          
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_h WHERE KODPLG='E025' AND STATUS='Aktive' ORDER BY KODPLG");
    $no = $posisi+1;
    
    while ($r=mysql_fetch_array($tampil)){
$m1=@mysql_query("SELECT * FROM dakot_d where KODPLG='$r[KODPLG]' order by NOMKOT");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td>$r[NOMKOT]</a></td>
                <td align=center><a href=?module=transaksi&act=detaillisttransaksiE&id=$r[NOMKOT]><img src=images/detail.gif border=0 border=0 title='detail'></a> | 
				<a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				$no++;
      }


echo "</table>";
}
elseif($_SESSION[KODPLG]=='E026'){
echo "<br><fieldset><legend>LIST DATA BOX</legend>
	<form method=POST action='?module=transaksi&act=hasilcariE'>    
			<input name=kata type=text size=25 />
			<input type=submit value=Cari />
			</form>
      <hr color=#FCEDC7 noshade=noshade /> ";
//$m=@mysql_query("SELECT * FROM dakot_h,dakot_d where dakot_h.KODPLG=dakot_d.KODPLG order by dakot_d.KODPLG");
echo "<a href=inc/reportE.php?id=$_SESSION[KODPLG] target=_blank><img src='images/pdf.png' border=0 width=40 height=40 title='cetak laporan'></a> ";
          
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_h WHERE KODPLG='E026' AND STATUS='Aktive' ORDER BY KODPLG");
    $no = $posisi+1;
    
    while ($r=mysql_fetch_array($tampil)){
$m1=@mysql_query("SELECT * FROM dakot_d where KODPLG='$r[KODPLG]' order by NOMKOT");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td>$r[NOMKOT]</a></td>
                <td align=center><a href=?module=transaksi&act=detaillisttransaksiE&id=$r[NOMKOT]><img src=images/detail.gif border=0 border=0 title='detail'></a> | 
				<a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				$no++;
      }


echo "</table>";
}
else{}
  break; 
  
 case"detaillisttransaksiE":
  
echo "<br><fieldset><legend>LIST DATA BOX</legend>
	 <form method=POST action='?module=transaksi&act=hasilcariELEC'>";    
			/*echo "<TR><td><select name='NOMKOT'> ";
			echo "<option value='0'>PILIH No. Kotak/BOX</option>";
			  $tampil=mysql_query("SELECT * FROM dakot_h where KODPLG='E024' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[NOMKOT]'>$r[NOMKOT]</option>";
            }
			echo "<td><select name='NAMDOK'> ";
			echo "<option value='0'>PILIH No. Voucher/invoice</option>";
			  $tampil=mysql_query("SELECT * FROM dakot_d where KODPLG='E024' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[NAMDOK]'>$r[NAMDOK]</option>";
            }
			
			echo "<td><select name='PRD_TX'> ";
			echo "<option value='0'>PILIH Date/Month</option>";
			  $tampil=mysql_query("SELECT * FROM dakot_d where KODPLG='E024' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[PRD_TX]'>$r[PRD_TX]</option>";
            }
			echo "<td><select name='KETDK1'> ";
			echo "<option value='0'>PILIH Payment Date</option>";
			  $tampil=mysql_query("SELECT * FROM dakot_d where KODPLG='E024' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KETDK1]'>$r[KETDK1]</option>";
            }
			echo "<td><select name='KETDK2'> ";
			echo "<option value='0'>PILIH Store</option>";
			  $tampil=mysql_query("SELECT * FROM dakot_d where KODPLG='E024' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KETDK2]'>$r[KETDK2]</option>";
            }
			echo "<td><select name='KETDK3'> ";
			echo "<option value='0'>PILIH Vendor/Customer</option>";
			  $tampil=mysql_query("SELECT * FROM dakot_d where KODPLG='E024' ORDER BY KODPLG ASC");
            while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KETDK3]'>$r[KETDK3]</option>";
            }*/
			ECHO "<input name=NOMKOT type=text>&nbsp;&nbsp;<input name=NAMDOK type=text size=30>&nbsp;&nbsp;<input name=PRD_TX type=text>&nbsp;&nbsp;<input name=KETDK1 type=text>&nbsp;&nbsp;<input name=KETDK2 type=text>
			&nbsp;<input name=KETDK3 type=text>";
			echo "&nbsp;<input type=submit value=Cari />
			</form>
      <hr color=#FCEDC7 noshade=noshade /> ";
//$m=@mysql_query("SELECT * FROM dakot_h,dakot_d where dakot_h.KODPLG=dakot_d.KODPLG order by dakot_d.KODPLG");
echo "<a href=inc/reportE.php?id=$_SESSION[KODPLG] target=_blank><img src='images/pdf.png' border=0 width=40 height=40 title='cetak laporan'></a> ";
    $id=$_GET[id];      
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>No. Voucher/invoice</th><th>Date/Month</th><th>Payment Date</th><th>Store</th><th>Vendor/Customer</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_d WHERE NOMKOT='$id' ORDER BY KODPLG");
    $no = $posisi+1;
    
    while ($r=mysql_fetch_array($tampil)){
//$m1=@mysql_query("SELECT * FROM dakot_d where KODPLG='$r[KODPLG]' order by NOMKOT");
//$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td>$r[NOMKOT]</a></td>
                <td>$r[NAMDOK]</td>
                <td>$r[PRD_TX]</td>
                <td>$r[KETDK1]</td>
				<td>$r[KETDK2]</td>
				<td>$r[KETDK3]</td>
				<td align=center>";//<a href=?module=transaksi&act=edit&id=$r[NOMKOT]><img src=images/edit.jpg border=0 border=0 title='verifikasi'></a> | 
				echo "<a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				$no++;
      }


echo "</table>";
  break; 
 
  //BACK_UP
  case"eksport_h":
 echo "";
 ?>
 <script type="text/javascript" >
 $(document).ready(function() {  
  $( "#from" ).datepicker({
   dateFormat:'yy-mm-dd',
   defaultDate: "+0w",
   changeMonth: true,
   numberOfMonths: 1,
   onSelect: function( selectedDate ) {
    $( "#to" ).datepicker( "option", "minDate", selectedDate );
   }
  });
  $( "#to" ).datepicker({
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

  <table border="0" cellspacing="0" cellpadding="0" align="center">
   <tr class="ttl">
    <td height="25" align="center" valign="middle">&nbsp;&nbsp; EKSPORT DAKOT HEADER</td>
    </tr>
    <tr class="ttl">
      <tr>
    <td colspan="2"><form method="POST" action=eksport.php>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="textbox">
	<?php
		echo "<tr><td>Kode Bagian <td><select name='KODPLG'> 
			 <option value=0 selected>- Silahkan Pilih -</option>";
            $tampil=mysql_query("SELECT * FROM pelanggan ORDER BY KODPLG ASC");
             while($r=mysql_fetch_array($tampil)){
			
              echo "<option value='$r[KODPLG]'>$r[KODPLG]</option>";
            }
			?>
		<input id="from" name="from" type="text" maxlength="10" size="15" readonly value=""/>
  &nbsp;&nbsp; s/d &nbsp;&nbsp;
  <input id="to" name="to" type="text" maxlength="10" size="15" readonly value=""/>
&nbsp;&nbsp;&nbsp;<input type="submit" value="Cari" class="tombol" />
        
        
       </td>
        
      </tr></table></form>
      
    <?php
	
 break;
 
 case"eksport_d":
 echo "";
 ?>
 <script type="text/javascript" >
 $(document).ready(function() {  
  $( "#from" ).datepicker({
   dateFormat:'yy-mm-dd',
   defaultDate: "+0w",
   changeMonth: true,
   numberOfMonths: 1,
   onSelect: function( selectedDate ) {
    $( "#to" ).datepicker( "option", "minDate", selectedDate );
   }
  });
  $( "#to" ).datepicker({
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

  <table border="0" cellspacing="0" cellpadding="0" align="center">
   <tr class="ttl">
    <td height="25" align="center" valign="middle">&nbsp;&nbsp; EKSPORT DAKOT DETAIL</td>
    </tr>
    <tr class="ttl">
      <tr>
    <td colspan="2"><form method="POST" action=eksport_d.php>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="textbox">
      <tr>
        <td width="100%" valign="right"><input type=text name=KODPLG value='<?=$_SESSION[KODPLG]?>'>
      <input id="from" name="from" type="text" maxlength="10" size="15" readonly value=""/>
  &nbsp;&nbsp; s/d &nbsp;&nbsp;
  <input id="to" name="to" type="text" maxlength="10" size="15" readonly value=""/>
&nbsp;&nbsp;&nbsp;<input type="submit" value="Cari" class="tombol" />
        
        
       </td>
        
      </tr></table></form>
      
    <?php
	
 break;
  
 case"detailtransaksi":
 $m=@mysql_query("SELECT * FROM dakot_h where NOMKOT='$_GET[id]'");
$r=mysql_fetch_array($m);
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

   echo "<form name='tambah' method=POST action='./aksi.php?module=transaksi&act=update' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>
		 <input type=hidden name=KODGUD value='$r[KODGUD]'>
		 <input type=hidden name=KODPLG value='$r[KODPLG]'>
		 <input type=hidden name=NOMKOT value='$r[NOMKOT]'>
		 
		 <input type=hidden name=STATUS value='Receipt'>
<tr><td>Nomor Tanda Terima </td><td><input type=text name=NOM_11></td></tr>";
echo "<td> Tanggal Receipt<td><input type=text name='TGL_11' id='tanggalan' value='' readonly>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggalan").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	

echo "<tr><td colspan=2 align=center><input type=submit value=Simpan>
                            <input type=reset value=Batal>";
	
echo "</table></legend>";
$m=@mysql_query("SELECT * FROM dakot_h where dakot_h.NOMKOT='$_GET[id]'");
$r=mysql_fetch_array($m);
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

?>

<table cellspacing="0" cellpadding="0">
  <col width="29" />
  <col width="93" />
  <col width="125" />
  <col width="64" span="2" />
  <col width="104" />
  <col width="167" />
  <tr height="20">
    <td colspan="2" rowspan="3" height="60" width="122"><img src=./images/logoindoarsip.JPG width=120 heigth=100></td>
    <td colspan="5" rowspan="3" width="524" align=center><font size=+2><b> BOX DATA </b></font></td>
  </tr>
  <tr height="20"> </tr>
  <tr height="20"> </tr>
  <tr height="20">
  
    <td colspan="2" rowspan="4" height="80" width="122" align=center><b> BOX  NO. <br><br></b> <?=$r[NOMKOT]?> </td>
    <td><b>ACCOUNT NAME</b></td>
    <td colspan="3"><?=$r1[NAMPLG]?></td>
    <td rowspan="2" width="167"><b>RETENTION </b><br><br> <?=$r[MASRET]?> THN</td>
  </tr>
  <tr height="20">
    <td height="20"><b>DEPARTEMENT</b></td>
    <td colspan="3"><?=$r[KODBAG]?></td>
  </tr>
  <tr height="20">
    <td height="20"><b>CONTROL NO</b></td>
    <td colspan="3"><?=$r[NOMCON]?></td>
    <td rowspan="2" width="167"><b>DESTRUCTION DATE</b> <br><br> <?=$tglmus?></td>
  </tr>
  <tr height="20">
    <td height="20">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr height="20">
    <td height="20" align=center><b>NO</td>
    <td colspan="4" align=center><b>DESCRIPTION OF CONTENT</td>
    <td align=center><b>PERIODE</td>
    <td align=center><b>DESCRIPTION</b></td>
  </tr>
  <?
    $p      = new Paging;
    $batas  = 30;
    $posisi = $p->cariPosisi($batas); 
$m2=@mysql_query("SELECT * FROM dakot_d where dakot_d.NOMKOT='$r[NOMKOT]' ORDER BY URTDOK");
while($x=mysql_fetch_array($m2)){
//$no=$posisi+1;
  echo "<tr height='20'>
    <td height='20' align='center'>$x[URTDOK]</td>
    <td colspan='4'>$x[NAMDOK]</td>
    <td>$x[PRD_TX]</td>
    <td>$x[KETDK1]</td>
  </tr>";
  //$no++;
  }
 
  ?>
  
  
</table>
<? 
 break;
 
 case"detailtransaksiSUB":
 $m=@mysql_query("SELECT * FROM dakot_h where NOMKOT='$_GET[id]'");
$r=mysql_fetch_array($m);
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

   echo "<form name='tambah' method=POST action='./aksi.php?module=transaksi&act=updateSUB' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>
		 <input type=hidden name=KODGUD value='$r[KODGUD]'>
		 <input type=hidden name=KODPLG value='$r[KODPLG]'>
		 <input type=hidden name=NOMKOT value='$r[NOMKOT]'>";
		 
echo "<tr><td>Verifikasi Data </td>       <td> : <select name='STATUS'>";
			 if($r[STATUS]=='Aktive'){
              echo "<option value='Aktive' checked>Aktif</option>";
			  echo "<option value='NO'>Tidak Aktif</option>";
            //}
			}
			else{
			  echo "<option value='Aktive'>Aktif</option>";
			  echo "<option value='NO' checked>Tidak Aktif</option>";
			}
			echo "</td></tr>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggalan").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	

echo "<tr><td colspan=2 align=center><input type=submit value=Simpan>
                            <input type=reset value=Batal>";
	
echo "</table></legend>";
$m=@mysql_query("SELECT * FROM dakot_h where dakot_h.NOMKOT='$_GET[id]'");
$r=mysql_fetch_array($m);
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

?>

<table cellspacing="0" cellpadding="0">
  <col width="29" />
  <col width="93" />
  <col width="125" />
  <col width="64" span="2" />
  <col width="104" />
  <col width="167" />
  <tr height="20">
    <td colspan="2" rowspan="3" height="60" width="122"><img src=./images/logoindoarsip.JPG width=120 heigth=100></td>
    <td colspan="5" rowspan="3" width="524" align=center><font size=+2><b> BOX DATA </b></font></td>
  </tr>
  <tr height="20"> </tr>
  <tr height="20"> </tr>
  <tr height="20">
  
    <td colspan="2" rowspan="4" height="80" width="122" align=center><b> BOX  NO. <br><br></b> <?=$r[NOMKOT]?> </td>
    <td><b>ACCOUNT NAME</b></td>
    <td colspan="3"><?=$r1[NAMPLG]?></td>
    <td rowspan="2" width="167"><b>RETENTION </b><br><br> <?=$r[MASRET]?> THN</td>
  </tr>
  <tr height="20">
    <td height="20"><b>DEPARTEMENT</b></td>
    <td colspan="3"><?=$r[KODBAG]?></td>
  </tr>
  <tr height="20">
    <td height="20"><b>CONTROL NO</b></td>
    <td colspan="3"><?=$r[NOMCON]?></td>
    <td rowspan="2" width="167"><b>DESTRUCTION DATE</b> <br><br> <?=$tglmus?></td>
  </tr>
  <tr height="20">
    <td height="20">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr height="20">
    <td height="20" align=center><b>NO</td>
    <td colspan="4" align=center><b>DESCRIPTION OF CONTENT</td>
    <td align=center><b>PERIODE</td>
    <td align=center><b>DESCRIPTION</b></td>
  </tr>
  <?
    $p      = new Paging;
    $batas  = 30;
    $posisi = $p->cariPosisi($batas); 
$m2=@mysql_query("SELECT * FROM dakot_d where dakot_d.NOMKOT='$r[NOMKOT]' ORDER BY URTDOK");
while($x=mysql_fetch_array($m2)){
//$no=$posisi+1;
  echo "<tr height='20'>
    <td height='20' align='center'>$x[URTDOK]</td>
    <td colspan='4'>$x[NAMDOK]</td>
    <td>$x[PRD_TX]</td>
    <td>$x[KETDK1]</td>
  </tr>";
  //$no++;
  }
 
  ?>
  
  
</table>
<? 
 break;
 case"edit":
$m=@mysql_query("SELECT * FROM dakot_h,dakot_d where dakot_h.KODGUD=dakot_d.KODGUD AND dakot_h.KODPLG=dakot_d.KODPLG AND dakot_h.NOMKOT='$_GET[id]'");
$r=mysql_fetch_array($m);
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);
 echo "
	<form name='tambah' method=POST action='./aksi.php?module=transaksi&act=input' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>
		 <input type=TEXT name=KODGUD value='$r[KODGUD]'>
		 <input type=TEXT name=KODPLG value='$r[KODPLG]'>
		 <input type=TEXT name=KODWIL value='01'>
		 <input type=TEXT name=KODKCU value='PDBS'>
		 <input type=TEXT name=KODKCP value='$r[KODKCP]'>";
		 //<input type=hidden name=KODKOT value='K144'>
		 echo"<input type=hidden name=RECSTS value='1'>
		 <input type=hidden name=KODMUT value='11'>
		 <input type=hidden name=KOTSTS value='1'>
		 <input type=hidden name=KONKOT value='1'>
		 <input type=hidden name=KONLEB value='1'>
		 <input type=hidden name=KONDAT value='1'>
		 <input type=hidden name=KONSEG value='1'>
		 <input type=text name=JMLDOK value='$r[JMLDOK]'>
		 <input type=hidden name=STATUS value='Aktive'>
		 <input type=text name=IDUSER value='$r[IDUSER]'>
		 
	<tr><td>Nomor Kotak <td><input type=text name=NOMKOT value=$r[NOMKOT] class='required' title='*Harus Diisi'>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	echo "<td> Tanggal <td><input type=text name='TGL_11' id='tanggal1' value=$r[TGL_11] onChange='calc_laporan()' readonly>
	<tr><td>Control No <td><input type=text name='NOMCON' value=$r[NOMCON] > <td>Masa Retensi <td><input type=text name=MASRET  value=$r[MASRET]  size=5 onChange='calc_laporan()' class='required' title='*Harus Diisi'>";
	?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	

echo "<tr><td>Tanggal Musnah <td><input type=text name=TGLMUS id=tanggal value='$r[TGLMUS]' readonly> <td>Keterangan Kotak <td><input type=text name=KETKOT  value=$r[KETKOT]>
 	<tr><td>Kode Bagian <td><select name='KODBAG'> ";
	 $tampil=mysql_query("SELECT * FROM bagian ORDER BY KODPLG ASC");
           while($w=mysql_fetch_array($tampil)){
                if ($r[KODBAG]==$w[KODBAG]){
                    echo "<option value=$w[KODBAG] selected>$w[KODBAG]</option>";
                }
                    else{
                         echo "<option value=$w[KODBAG]>$w[KODBAG]</option>";
                    }
                    }  
	
	
			 
			echo "<td>Jenis Kotak <td><select name='KODKOT'> ";
			  $tampil=mysql_query("SELECT * FROM kotak ORDER BY KODPLG ASC");
            while($w=mysql_fetch_array($tampil)){
			if ($r[KODKOT]==$w[KODKOT]){
                    echo "<option value=$w[KODKOT] selected>$w[KODKOT]</option>";
                }
                    else{
                         echo "<option value=$w[KODKOT]>$w[KODKOT]</option>";
                    }
                    }  
              
	echo "</table></center></form><form action='modul/lp.php' method='post'><td align=center colspan='4'><input type=text name='lp' size=2 value='$r[JMLDOK]'>
		  <font color=red><b> <blink>Masukkan jumlah baris yang diinginkan</font></b><input name='' type='hidden' value='Update' /></td></form>";
			
		  echo "<table>
          <tr><th>no urut</th><th>Namdok</th><th>Prd Tx</th><th>Ketdk1</th><th>Ketdk2</th><th>Ketdk3</th></tr>"; 
		     ///$no=1;
			 $JMLDOK=$r[JMLDOK];
		  for($x=1;$x<=$JMLDOK;$x++){
    //$tampil=mysql_query("SELECT * FROM user ORDER BY id_user");
 
    //while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td align=center>";?><input type=text readonly name=<? echo 'URTDOK'.$x;?> size=5 value=<?=$x;?>></td>
             <td><input type=text  size=40 name=<? echo 'NAMDOK'.$x;?> value=<?=$r[NAMDOK]?> class='required' title='*Harus Diisi'></td>
             <td><input type=text size=20 name=<? echo 'PRD_TX'.$x;?> value=<?=$r[PRD_TX]?> class='required' title='*Harus Diisi'></td>
		      <td><input type=text size=41 name=<? echo 'KETDK1'.$x;?> value=<?=$r[KETDK1]?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK2'.$x;?> value=<?=$r[KETDK2]?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK3'.$x;?> value=<?=$r[KETDK3]?>></td><?
             echo "</td></tr>";
      //$no++;
    //}
	};
					 echo "<tr><td colspan=6 align=center><input type=submit value=Simpan>
                            <input type=reset value=Batal>  | <a href=media.php?module=transaksi&act=listtransaksi>List Transaksi</a></td></tr>
          </table>";
		  
		  echo "<table><tr><td><i><blink><font color=red>NB : Jika ingin menambah kolom rubah angka 1 menjadi angka yang diinginkan, kemudian tekan tombol ENTER</font></td></tr></i></blink></table>";		
    echo "</table>";
	
		
    break;
	
	//EDIT SUNLIFE
case"editSUN":
$m=@mysql_query("SELECT * FROM dakot_h where dakot_h.NOMKOT='$_GET[id]'");
$r=mysql_fetch_array($m);
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);
//$tampil = mysql_query("SELECT * FROM dakot_d where dakot_d.NOMKOT='$r[NOMKOT]'");
//$r1=mysql_fetch_array($tampil);

 echo "
	<form name='tambah' method=POST action='./aksi.php?module=transaksi&act=input' id='form1'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>
		 <input type=TEXT name=KODGUD value='$r[KODGUD]'>
		 <input type=TEXT name=KODPLG value='$r[KODPLG]'>
		 <input type=TEXT name=KODWIL value='01'>
		 <input type=TEXT name=KODKCU value='PDBS'>
		 <input type=TEXT name=KODKCP value='$r[KODKCP]'>";
		 //<input type=hidden name=KODKOT value='K144'>
		 echo"<input type=hidden name=RECSTS value='1'>
		 <input type=hidden name=KODMUT value='11'>
		 <input type=hidden name=KOTSTS value='1'>
		 <input type=hidden name=KONKOT value='1'>
		 <input type=hidden name=KONLEB value='1'>
		 <input type=hidden name=KONDAT value='1'>
		 <input type=hidden name=KONSEG value='1'>
		 <input type=text name=JMLDOK value='$r[JMLDOK]'>
		 <input type=hidden name=STATUS value='Aktive'>
		 <input type=text name=IDUSER value='$r[IDUSER]'>
		 
	<tr><td>Nomor Kotak <td><input type=text name=NOMKOT value=$r[NOMKOT] class='required' title='*Harus Diisi'>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	echo "<td> Tanggal <td><input type=text name='TGL_11' id='tanggal1' value=$r[RECMOD] onChange='calc_laporan()' readonly>
	<tr><td>Control No <td><input type=text name='NOMCON' value=$r[NOMCON] > <td>Masa Retensi <td><input type=text name=MASRET1 value=$r[MASRET1]  size=5 onChange='calc_laporan()' class='required' title='*Harus Diisi'><input type=text name=MASRET  value=$r[MASRET]  size=5 onChange='calc_laporan()' class='required' title='*Harus Diisi'>";
	?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true					
        });
      });
    </script>
<?php	

echo "<tr><td>Tanggal Musnah <td><input type=text name=TGLMUS id=tanggal value='$r[TGLMUS]' readonly> <td>Keterangan Kotak <td><input type=text name=KETKOT  value=$r[KETKOT]>
 	<tr><td>Kode Bagian <td><select name='KODBAG'> ";
	 $tampil=mysql_query("SELECT * FROM bagian ORDER BY KODPLG ASC");
           while($w=mysql_fetch_array($tampil)){
                if ($r[KODBAG]==$w[KODBAG]){
                    echo "<option value=$w[KODBAG] selected>$w[KODBAG]</option>";
                }
                    else{
                         echo "<option value=$w[KODBAG]>$w[KODBAG]</option>";
                    }
                    }  
	
	
			 
			echo "<td>Jenis Kotak <td><select name='KODKOT'> ";
			  $tampil=mysql_query("SELECT * FROM kotak ORDER BY KODPLG ASC");
            while($w=mysql_fetch_array($tampil)){
			if ($r[KODKOT]==$w[KODKOT]){
                    echo "<option value=$w[KODKOT] selected>$w[KODKOT]</option>";
                }
                    else{
                         echo "<option value=$w[KODKOT]>$w[KODKOT]</option>";
                    }
                    }  
              
	echo "</table></center></form><form action='modul/lp.php' method='post'><td align=center colspan='4'><input type=text name='lp' size=2 value='$r[JMLDOK]'>
		  <font color=red><b> <blink>Masukkan jumlah baris yang diinginkan</font></b><input name='' type='hidden' value='Update' /></td></form>";
			
		  echo "<table>
          <tr><th>no urut</th><th>Namdok</th><th>Prd Tx</th><th>Ketdk1</th><th>Ketdk2</th><th>Ketdk3</th></tr>"; 
		     ///$no=1;
			 $JMLDOK=$r[JMLDOK];

		  
    
	$tampil = mysql_query("SELECT * FROM dakot_d where dakot_d.NOMKOT='$r[NOMKOT]' ORDER BY NOMKOT");
	$r1=mysql_fetch_array($tampil);
	for($x=1;$x<=$JMLDOK;$x++){
       echo "<tr><td align=center>";?><input type=text readonly name=<? echo 'URTDOK'.$x;?> size=5 value=<?=$x;?>></td>
             <td><input type=text  size=40 name=<? echo 'NAMDOK'.$x;?> value=<?=$r1['NAMDOK'].$x?> class='required' title='*Harus Diisi'></td>
             <td><input type=text size=20 name=<? echo 'PRD_TX'.$x;?> value=<?=$r1['PRD_TX'].$x?> class='required' title='*Harus Diisi'></td>
		      <td><input type=text size=41 name=<? echo 'KETDK1'.$x;?> value=<?=$r1['KETDK1'].$x?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK2'.$x;?> value=<?=$r1['KETDK2'].$x?>></td>
		      <td><input type=text size=41 name=<? echo 'KETDK3'.$x;?> value=<?=$r1['KETDK3'].$x?>></td><?
             echo "</td></tr>";
      
	};
					 echo "<tr><td colspan=6 align=center><input type=submit value=Simpan>
                            <input type=reset value=Batal>  | <a href=media.php?module=transaksi&act=listtransaksi>List Transaksi</a></td></tr>
          </table>";
		  
		  echo "<table><tr><td><i><blink><font color=red>NB : Jika ingin menambah kolom rubah angka 1 menjadi angka yang diinginkan, kemudian tekan tombol ENTER</font></td></tr></i></blink></table>";		
    echo "</table>";
	
		
    break;	
	
  //hasil cari Electronik
case "hasilcariE":
  echo "<feildset><legend>Hasil Pencarian</legend>";
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM dakot_h WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "NOMKOT LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY KODPLG DESC LIMIT 7";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
    $p      = new Paging;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysql_query("SELECT * FROM dakot_h ORDER BY KODPLG DESC LIMIT $posisi_,$batas_");
    
	$no = $posisi_+1;
	$rupi='Rp.';
while ($r=mysql_fetch_array($hasil)){

    echo "<p>Ditemukan <b>$ketemu</b> Nomor Box/Kotak dengan No. <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>"; 
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>aksi</th></tr>";
	$tampil=mysql_query("SELECT * FROM dakot_h WHERE KODPLG='E024' AND STATUS='Aktive' ORDER BY KODPLG");
    $no = $posisi+1;
    
    
//$m1=@mysql_query("SELECT * FROM dakot_d where KODPLG='$r[KODPLG]' order by NOMKOT");
//$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td>$r[NOMKOT]</a></td>
                <td align=center><a href=?module=transaksi&act=detaillisttransaksiE&id=$r[NOMKOT]><img src=images/detail.gif border=0 border=0 title='detail'></a> | 
				<a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				
	$no++;
	}
	echo " </table>";
  }
  else{
    echo "Tidak ditemukan No Kotak/BOX yang anda cari dengan No <b>$kata</b>";
  }  
  echo "<input type=button value=Back onclick=self.history.back()>";
    break;	
	
//hasil cari Electronik
case "hasilcariELEC":
  echo "<feildset><legend>Hasil Pencarian</legend>";
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST[kata]);
  $NOMKOT = $_POST[NOMKOT];
  $NAMDOK = $_POST[NAMDOK];
  $PRD_TX = $_POST[PRD_TX];
  $KETDK1 = $_POST[KETKD1];
  $KETDK2 = $_POST[KETDK2];
  $KETDK3 = $_POST[KETDK3];
  
/*
  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM dakot_h WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "NOMKOT LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY KODPLG DESC LIMIT 7";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);
*/
$hasil=mysql_query("select * from dakot_d where NOMKOT LIKE '%$NOMKOT%' AND NAMDOK LIKE '%$NAMDOK%' AND PRD_TX LIKE '%$PRD_TX%'
					AND KETDK1 LIKE '%$KETDK1%' AND KETDK2 LIKE '%$KETDK2%' AND KETDK3 LIKE '%$KETDK3%'");
$ketemu = mysql_num_rows($hasil);					
  if ($ketemu > 0){
    $p      = new Paging;
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);

    
    echo "<p>Ditemukan <font style='background-color:#00FFFF'><b>$ketemu</b> yang anda cari </font></p>"; 
 echo "<table>
          <tr><th>no</th><th>BOX  NO</th><th>No. Voucher/invoice</th><th>PIC</th><th>Date/Month</th><th>Payment Date</th><th>Store</th><th>Vendor/Customer</th><th>aksi</th></tr>";
	//$tampil=mysql_query("SELECT * FROM dakot_d WHERE NOMKOT='$id' ORDER BY KODPLG");
    //$no = $posisi+1;
    
   // while ($r=mysql_fetch_array($tampil)){
//$m1=@mysql_query("SELECT * FROM dakot_d where KODPLG='$r[KODPLG]' order by NOMKOT");
//$r1=mysql_fetch_array($m1);
$tampil=mysql_query("SELECT * FROM dakot_d ORDER BY KODPLG DESC LIMIT $posisi_,$batas_");
    
	$no = $posisi_+1;
	$rupi='Rp.';
while ($r=mysql_fetch_array($hasil)){

$tglmus=tgl_indo($r[TGLMUS]);

	echo "<tr><td>$no</td>
                <td>$r[NOMKOT]</a></td>
                <td>$r[NAMDOK]</td>
                <td>$r[pic]</td>
                <td>$r[PRD_TX]</td>
                <td>$r[KETDK1]</td>
				<td>$r[KETDK2]</td>
				<td>$r[KETDK3]</td>
				<td align=center>";//<a href=?module=transaksi&act=edit&id=$r[NOMKOT]><img src=images/edit.jpg border=0 border=0 title='verifikasi'></a> | 
				echo "<a href=./aksi.php?module=transaksi&act=hapus&id=$r[NOMKOT]&kd=$r[KODPLG] onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\"><img src=images/hapus.jpg border=0 border=0 title='hapus'></a> 
		        </tr>";
				$no++;
	}
	echo " </table>";
  }
  else{
    echo "Maaf data yang anda cari tidak ditemukan ";
  }  
  echo "<input type=button value=Back onclick=self.history.back()>";
    break;	
    
    case"sunlife":
$m=@mysql_query("SELECT * FROM dakot_h where dakot_h.KODPLG='$_GET[kd]' AND dakot_h.NOMKOT='$_GET[id]'");
$r=mysql_fetch_array($m);
?>
<script type="text/javascript">                   

var theForm1 = document.forms['form_new_label'];

if (!theForm1)

{  theForm1 = document.form_new_label; }

 

function __doPostBacks_1()

{

                if (!theForm1.onsubmit || (theForm1.onsubmit() != false))

                {   theForm1.submit(); }

}

 

function __doPostBacks_2()

{

                if (!theForm1.onsubmit || (theForm1.onsubmit() != false))

                {   theForm1.submit(); }

}

</script>

<?php
    echo "
	<form name='form_new_label' method=POST action='./aksi.php?module=transaksi&act=update_SUNL' id='form1' enctype='multipart/form-data'>";
		  echo "<fieldset><legend> Silahkan isi dengan benar </legend>
		 <center><table>";

		echo "<tr><td>Nomor Kotak <td><input type=text name=NOMKOT class='required' value='$r[NOMKOT]' title='*Harus Diisi' readonly>";
?>
	 
   
 <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal1").datepicker({
					dateFormat:'yy-mm-dd', 
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true	
			
        });
      });
    </script>
<?php	echo "<td> Tanggal <td><input type=text name='RECMOD' id='tanggal1' value='$r[RECMOD]'  readonly>";

//NOMCON
echo "<TR><TD>Control No <td><input type=text name=NOMCON value=$r[NOMCON] readonly>  

  
<td>Masa Retensi <td><input type='text' name='MASRET1' size=10  value='$r[MASRET1]' class='required' title='*Harus Diisi' readonly/>  
<input type='text' name='MASRET' size=5 title='*Harus Diisi' value=$r[MASRET] onchange='javascript:__doPostBacks_1();' readonly><font color=red size=1><i> * Jika tidak ada retensi harap diisi angka 9999</i></font>  
";?>
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
$tgl = date("Y-m-d", $tanggal4);

echo "<tr><td>Keterangan Kotak <td><input type=text name=KETKOT value='$r[KETKOT]' readonly>
 	
<td>Kode Bagian <td><select name='KODBAG'>";
            $tampil=mysql_query("SELECT * FROM bagian ORDER BY KODPLG ASC");
             while($f=mysql_fetch_array($tampil)){
			if($f[KODBAG]==$r[KODBAG]){
              echo "<option value='$f[KODBAG]' selected>$f[KODBAG]</option>";
            }
			else{
			 echo "<option value='$f[KODBAG]'>$f[KODBAG]</option>";
			 }
			 }
						
			echo "<tr><td>Jenis Kotak <td colspan=3><select name='KODKOT'> ";
			 $tampil=mysql_query("SELECT * FROM kotak,tblkot where kotak.KODKOT=tblkot.KODKOT ORDER BY KODPLG ASC");
             while($x=mysql_fetch_array($tampil)){
			if($x[KODKOT]==$r[KODKOT]){
              echo "<option value='$x[KODKOT]' selected>$x[NAMKOT]</option>";
            }
			else{
			 echo "<option value='$x[KODKOT]'>$x[NOMKOT]</option>";
			 }
			 }
	 echo "</table>";
	echo "<table width=1150>
          <tr><th>no urut</th><th>Namdok</th><th>Prd Tx</th><th>Ketdk1</th><th>Ketdk2</th><th>Ketdk3</th></tr>"; 
		     ///$no=1;
$m=@mysql_query("SELECT * FROM dakot_h where dakot_h.KODPLG='$_GET[kd]' AND dakot_h.NOMKOT='$_GET[id]'");
$r=mysql_fetch_array($m);		 
			 $tampil = mysql_query("SELECT * FROM dakot_d where dakot_d.KODGUD='$r[KODGUD]' AND dakot_d.NOMKOT='$r[NOMKOT]' ORDER BY KODGUD");

$retention = $r['MASRET'];

    $no = 0;
	$tanggal_pilih = mktime(0,0,0,"01","01","1970");
    while($f=mysql_fetch_array($tampil))
	{		
		$tanggal = mktime(0,0,0,substr($f['PRD_TX'],5,2),substr($f['PRD_TX'],8,2),substr($f['PRD_TX'],0,4)+$retention);
		
		//echo date("Y-m-d",$tanggal);
		
		if($tanggal_pilih <= $tanggal)
			$tanggal_pilih = $tanggal;
		
		$no++;

    	echo   "<tr><td align=center width=10>$f[URTDOK]</td>
				<td>$f[NAMDOK]</td>
				<td width=100><input type=text name=PRD_TX value='$f[PRD_TX]' readonly></td>
				<td>$f[KETDK1]</td>
                <td>$f[KETDK2]</td>
				<td>$f[KETDK3]</td>";
			 
     	};
	
 
//echo "<table><tr><td colspan=4 align=center><input type=submit name=simpan value=UPDATE></form>
echo "<table><input type=hidden name=KODGUD value='$r[KODGUD]'><input type=hidden name=KODPLG value='$r[KODPLG]'>
<input type=hidden name=NOMKOT value='$r[NOMKOT]'>
<input type=hidden name=MASRET1 value='$r[MASRET1]'><input type=hidden name=MASRET value='$r[MASRET]' >
<input type=hidden name=KETKOT value='$r[KETKOT]'><input type=hidden name=KODBAG value='$r[KODBAG]' ><input type=hidden name=KODKOT value='$r[KODKOT]' >
<tr><td>Tanggal Musnah <td><input type=text name='TGLMUS' value='".date("Y-m-d",$tanggal_pilih)."'><font color=red><i>*0000-00-00</i></font> 
<tr><td colspan=2 align=center><input type=submit name=simpan value=UPDATE><input type=reset value=Batal>  | <a href=media.php?module=transaksi&act=listtransaksi>List Transaksi</a></td></tr></table></center></form>";
                            
	echo "</table>";
break;	
}
?>
