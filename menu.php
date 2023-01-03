<script language="JavaScript">
function bukajendela(url) {
 window.open(url, "window_baru", "width=1000,height=700,left=120,top=10,resizable=1,scrollbars=1");
}

function yesnoCheck() {

if (document.getElementById('adminCheck').checked) {

    document.getElementById('ifNo').style.display = 'none';

}
else {
document.getElementById('ifNo').style.display = 'block';
}
}

function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>
<?php
session_start();
$thn_jam_sekarang = date("Y-m-d H:i:s");
$id_user=$_SESSION['userid'];
$namauser=$_SESSION['namauser'];
$role=mysql_query("select * from roleuser WHERE id_user='$id_user'");
$ro=mysql_fetch_array($role);

switch($_GET['act']){
  // Tampil Agenda
  default:
  ?>
  	
	<link rel="stylesheet" href="jquery.treeview.css" />
	<script type="text/javascript" src="jquery.min.js"></script>
	<script src="inc/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview.js" type="text/javascript"></script>
	<link href="inc/default.css" rel="stylesheet"><script type="text/javascript" src="inc/artDialog.js"></script>
	<link type="text/css" rel="stylesheet" href="inc/y13_html5.css">
	<!-- <link type="text/css" rel="stylesheet" href="style.css"> -->

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
<style>
.highlight
{
background: #00FFFF;
}

.highlight_important
{
background: #00FFFF;
}
</style>
	<script type="text/javascript" src="demo.js"></script>

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
if($_SESSION['leveluser']=='admin'){			
				?>
				 <div class="nav nav-tabs" id="nav-tab" role="tablist">
         <a class="nav-item nav-link" id="nav-home-tab" href="?module=menu&act=tambahdokumen" role="tab" aria-controls="nav-home" aria-selected="true">Add Folder</a>
         <a class="nav-item nav-link" id="nav-home-tab" href="?module=menu&act=tambahfile" role="tab" aria-controls="nav-home" aria-selected="true">Add File</a>
                                                </div>
				
				<?php
			
			}	
		else{
			}		
      ?>
	  <div class="content mt-3">
            <div class="animated fadeIn">

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h4>Document</h4>
                            </div>
                            <div class="card-body">
                              
                            <ul id="browser" class="filetree">
                            <?php
                            
                              include_once("dokumen.php");
                              $sql = "SELECT * FROM dokumen ORDER BY docid";
                              $result = mysql_query($sql);
                              // Create an array to conatin a list of items and parents
                              $menus = array(
                                'items' => array(),
                                'parents' => array()
                              );
                              // Builds the array lists with data from the SQL result
                              while ($items = mysql_fetch_assoc($result)) {
                                // Create current menus item id into array
                                $menus['items'][$items['docid']] = $items;
                                // Creates list of all items with children
                                $menus['parents'][$items['id_parent']][] = $items['docid'];
                              }
                              // Print all tree view menus 
                              echo createTreeView(0, $menus);
                              ?>		
                              </ul>
                        </div>
                    </div>
                    </div>
                    </div>
<?php                    
break;


case "search":
  
$kata = trim($_POST['kata']);

if($kata !=''){
 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Search kata=$kata')");

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = $kata;
  // echo $pisah_kata;
  // $jml_katakan = (integer)count($pisah_kata);
  // $jml_kata = $jml_katakan-1;
//echo "$pisah_kata";
  if($_SESSION['leveluser']=='admin'){
    // $cari = "SELECT * FROM dokumen_file WHERE approve='1' and filename LIKE '%$pisah_kata%' or metadata LIKE '%$pisah_kata%' 
	  // or fileimage LIKE '%$pisah_kata%' or keterangan LIKE '%$pisah_kata%' ORDER BY docid_d DESC";
    $cari = "SELECT * FROM dokumen_file WHERE approve='1' AND MATCH(`filename`, `metadata`, `fileimage`, `keterangan`) AGAINST ('$pisah_kata' IN BOOLEAN MODE) ORDER BY docid_d DESC";
      
  }
  else{
    $cari = "SELECT * FROM dokumen_file WHERE approve='1' and departemenid='$_SESSION[departemenuser]' AND MATCH(`filename`, `metadata`, `fileimage`, `keterangan`) AGAINST ('$pisah_kata' IN BOOLEAN MODE) ORDER BY docid_d DESC";
     
    
  }
    
  // $cari .= " ORDER BY docid_d DESC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
    echo "<p>Found <b>$ketemu</b> keywords with words <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>"; 
    while($t=mysql_fetch_array($hasil)){
    $filename = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['filename']);
    $metadata = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['metadata']);
    $fileimage = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['fileimage']);
    $keterangan = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['keterangan']);
	
  		echo "<h1 bgcolor=red><a href='?module=menu&act=listdokumen&docid=$t[docid]'>$filename</a> </h1>
				<iframe src='./files/$t[fileimage]' width='400' height='200' style='border: none;'></iframe>";
        if($_SESSION['leveluser']=='admin'){
          echo "<br><a href='#' onclick=\"bukajendela('files/$fileimage')\">Preview </a> | <a href='downlot.php?file=$fileimage'>$fileimage</a><br>$tglinput<br>$retentiondate </a>";
        }
        else{
        if($ro['preview']=='1'){
				echo "<br><a href='#' onclick=\"bukajendela('files/$fileimage')\">Preview </a> | ";
        }
        else{
        }
        if($ro['download']=='1'){
          echo "<a href='downlot.php?file=$fileimage'>$fileimage</a><br>$tglinput<br>$retentiondate </a>";
        }
        else{
        }
      }
				echo "<hr color=#e0cb91 noshade=noshade />";
    }      
  }
  else{
    echo "Not found keyword with the word <b>$kata</b>";
  }
}
else{
echo "<script Language=\"JavaScript\">
  window.alert (\"Please enter the word ..\");
  window.location = \"media.php?module=menu\";
  </script>')";
}
break;

//search
case "search_data":
$cari=$_POST['cari_data'];
$kata = trim($_POST['kata']);
// echo $kata;
if($kata !=''){
      if($cari=='namafile'){
        mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Search kata=$kata')");

        // pisahkan kata per kalimat lalu hitung jumlah kata
        $pisah_kata = $kata;
        // echo $pisah_kata;
        // $jml_katakan = (integer)count($pisah_kata);
        // $jml_kata = $jml_katakan-1;
      //echo "$pisah_kata";
        if($_SESSION['leveluser']=='admin'){
          // $cari = "SELECT * FROM dokumen_file WHERE approve='1' and filename LIKE '%$pisah_kata%' or metadata LIKE '%$pisah_kata%' 
          // or fileimage LIKE '%$pisah_kata%' or keterangan LIKE '%$pisah_kata%' ORDER BY docid_d DESC";
          $cari = "SELECT * FROM dokumen_file WHERE approve='1' AND MATCH(`filename`) AGAINST ('$pisah_kata' IN BOOLEAN MODE) ORDER BY docid_d DESC";
            
        }
        else{
          $cari = "SELECT * FROM dokumen_file WHERE approve='1' and departemenid='$_SESSION[departemenuser]' AND MATCH(`filename`) AGAINST ('$pisah_kata' IN BOOLEAN MODE) ORDER BY docid_d DESC";
           
          
        }
          
        // $cari .= " ORDER BY docid_d DESC";
        $hasil  = mysql_query($cari);
        $ketemu = mysql_num_rows($hasil);
      
        if ($ketemu > 0){
          echo "<p>Found <b>$ketemu</b> keywords with words <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>"; 
          while($t=mysql_fetch_array($hasil)){
          $filename = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['filename']);
          $metadata = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['metadata']);
          $fileimage = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['fileimage']);
          $keterangan = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['keterangan']);
        
            echo "<h1 bgcolor=red><a href='?module=menu&act=listdokumen&docid=$t[docid]'>$filename</a> </h1>
              <iframe src='./files/$t[fileimage]' width='400' height='200' style='border: none;'></iframe>";
              if($_SESSION['leveluser']=='admin'){
                echo "<br><a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$fileimage'>$fileimage</a><br>$tglinput<br>$retentiondate </a>";
              }
              else{
              if($ro['preview']=='1'){
              echo "<br><a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | ";
              }
              else{
              }
              if($ro['download']=='1'){
                echo "<a href='downlot.php?file=$fileimage'>$fileimage</a><br>$tglinput<br>$retentiondate </a>";
              }
              else{
              }
            }
              echo "<hr color=#e0cb91 noshade=noshade />";
          }      
        }
        
        else{
          echo "Not found keyword with the word <b>$kata</b>";
        }
      }
      elseif($cari=='namaimage'){
        mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Search kata=$kata')");

        // pisahkan kata per kalimat lalu hitung jumlah kata
        $pisah_kata = $kata;
        // echo $pisah_kata;
        // $jml_katakan = (integer)count($pisah_kata);
        // $jml_kata = $jml_katakan-1;
      //echo "$pisah_kata";
        if($_SESSION['leveluser']=='admin'){
          // $cari = "SELECT * FROM dokumen_file WHERE approve='1' and filename LIKE '%$pisah_kata%' or metadata LIKE '%$pisah_kata%' 
          // or fileimage LIKE '%$pisah_kata%' or keterangan LIKE '%$pisah_kata%' ORDER BY docid_d DESC";
          $cari = "SELECT * FROM dokumen_file WHERE approve='1' AND MATCH(`filename`, `metadata`, `fileimage`, `keterangan`) AGAINST ('$pisah_kata' IN BOOLEAN MODE) ORDER BY docid_d DESC";
            
        }
        else{
          $cari = "SELECT * FROM dokumen_file WHERE approve='1' and departemenid='$_SESSION[departemenuser]' AND MATCH(`filename`, `metadata`, `fileimage`, `keterangan`) AGAINST ('$pisah_kata' IN BOOLEAN MODE) ORDER BY docid_d DESC";
           
          
        }
          
        // $cari .= " ORDER BY docid_d DESC";
        $hasil  = mysql_query($cari);
        $ketemu = mysql_num_rows($hasil);
      
        if ($ketemu > 0){
          echo "<p>Found <b>$ketemu</b> keywords with words <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>"; 
          while($t=mysql_fetch_array($hasil)){
          $filename = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['filename']);
          $metadata = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['metadata']);
          $fileimage = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['fileimage']);
          $keterangan = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['keterangan']);
        
            echo "<h1 bgcolor=red><a href='?module=menu&act=listdokumen&docid=$t[docid]'>$filename</a> </h1>
              <iframe src='./files/$t[fileimage]' width='400' height='200' style='border: none;'></iframe>";
              if($_SESSION['leveluser']=='admin'){
                echo "<br><a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$fileimage'>$fileimage</a><br>$tglinput<br>$retentiondate </a>";
              }
              else{
              if($ro['preview']=='1'){
              echo "<br><a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | ";
              }
              else{
              }
              if($ro['download']=='1'){
                echo "<a href='downlot.php?file=$fileimage'>$fileimage</a><br>$tglinput<br>$retentiondate </a>";
              }
              else{
              }
            }
              echo "<hr color=#e0cb91 noshade=noshade />";
          }      
        }
        
        else{
          echo "Not found keyword with the word <b>$kata</b>";
        }
      }

      elseif($cari=='metadata'){
        mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Search kata=$kata')");

        // pisahkan kata per kalimat lalu hitung jumlah kata
        $pisah_kata = $kata;
        // echo $pisah_kata;
        // $jml_katakan = (integer)count($pisah_kata);
        // $jml_kata = $jml_katakan-1;
      //echo "$pisah_kata";
        if($_SESSION['leveluser']=='admin'){
          // $cari = "SELECT * FROM dokumen_file WHERE approve='1' and filename LIKE '%$pisah_kata%' or metadata LIKE '%$pisah_kata%' 
          // or fileimage LIKE '%$pisah_kata%' or keterangan LIKE '%$pisah_kata%' ORDER BY docid_d DESC";
          $cari = "SELECT * FROM dokumen_file WHERE approve='1' AND MATCH(`filename`, `metadata`, `fileimage`, `keterangan`) AGAINST ('$pisah_kata' IN BOOLEAN MODE) ORDER BY docid_d DESC";
            
        }
        else{
          $cari = "SELECT * FROM dokumen_file WHERE approve='1' and departemenid='$_SESSION[departemenuser]' AND MATCH(`filename`, `metadata`, `fileimage`, `keterangan`) AGAINST ('$pisah_kata' IN BOOLEAN MODE) ORDER BY docid_d DESC";
           
          
        }
          
        // $cari .= " ORDER BY docid_d DESC";
        $hasil  = mysql_query($cari);
        $ketemu = mysql_num_rows($hasil);
      
        if ($ketemu > 0){
          echo "<p>Found <b>$ketemu</b> keywords with words <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>"; 
          while($t=mysql_fetch_array($hasil)){
          $filename = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['filename']);
          $metadata = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['metadata']);
          $fileimage = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['fileimage']);
          $keterangan = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['keterangan']);
        
            echo "<h1 bgcolor=red><a href='?module=menu&act=listdokumen&docid=$t[docid]'>$filename</a> </h1>
              <iframe src='./files/$t[fileimage]' width='400' height='200' style='border: none;'></iframe>";
              if($_SESSION['leveluser']=='admin'){
                echo "<br><a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$fileimage'>$fileimage</a><br>$tglinput<br>$retentiondate </a>";
              }
              else{
              if($ro['preview']=='1'){
              echo "<br><a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | ";
              }
              else{
              }
              if($ro['download']=='1'){
                echo "<a href='downlot.php?file=$fileimage'>$fileimage</a><br>$tglinput<br>$retentiondate </a>";
              }
              else{
              }
            }
              echo "<hr color=#e0cb91 noshade=noshade />";
          }      
        }
            
        mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Search kata=$kata')");

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = $kata;
  // echo $pisah_kata;
  // $jml_katakan = (integer)count($pisah_kata);
  // $jml_kata = $jml_katakan-1;
//echo "$pisah_kata";
  if($_SESSION['leveluser']=='admin'){
    // $cari = "SELECT * FROM dokumen_file WHERE approve='1' and filename LIKE '%$pisah_kata%' or metadata LIKE '%$pisah_kata%' 
	  // or fileimage LIKE '%$pisah_kata%' or keterangan LIKE '%$pisah_kata%' ORDER BY docid_d DESC";
    $cari = "SELECT * FROM dokumen_file WHERE approve='1' AND MATCH(`filename`, `metadata`, `fileimage`, `keterangan`) AGAINST ('$pisah_kata' IN BOOLEAN MODE) ORDER BY docid_d DESC";
      
  }
  else{
    $cari = "SELECT * FROM dokumen_file WHERE approve='1' and departemenid='$_SESSION[departemenuser]' AND MATCH(`filename`, `metadata`, `fileimage`, `keterangan`) AGAINST ('$pisah_kata' IN BOOLEAN MODE) ORDER BY docid_d DESC";
     
    
  }
    
  // $cari .= " ORDER BY docid_d DESC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
    echo "<p>Found <b>$ketemu</b> keywords with words <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>"; 
    while($t=mysql_fetch_array($hasil)){
    $filename = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['filename']);
    $metadata = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['metadata']);
    $fileimage = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['fileimage']);
    $keterangan = str_replace($kata, "<span class=\"highlight\">$kata</span>", $t['keterangan']);
	
  		echo "<h1 bgcolor=red><a href='?module=menu&act=listdokumen&docid=$t[docid]'>$filename</a> </h1>
				<iframe src='./files/$t[fileimage]' width='400' height='200' style='border: none;'></iframe>";
        if($_SESSION['leveluser']=='admin'){
          echo "<br><a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$fileimage'>$fileimage</a><br>$tglinput<br>$retentiondate </a>";
        }
        else{
        if($ro['preview']=='1'){
				echo "<br><a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | ";
        }
        else{
        }
        if($ro['download']=='1'){
          echo "<a href='downlot.php?file=$fileimage'>$fileimage</a><br>$tglinput<br>$retentiondate </a>";
        }
        else{
        }
      }
				echo "<hr color=#e0cb91 noshade=noshade />";
    }      
  }
 
          else{
            echo "Not found keyword with the word <b>$kata</b>";
          }
        } 
}
else{
echo "<script Language=\"JavaScript\">
  window.alert (\"Please enter the word ..\");
  window.location = \"media.php?module=menu\";
  </script>')";
} 
break;

//filter data
case "filterdata":
$folder=$_POST[folderid];
$tahuun=$_POST[tahun];
$bulan=$_POST[bulan];
$tanggal=$_POST[tanggal];
$namaplg=$_POST[namaplg];


if($tahuun !='' AND $bulan !='' AND $tanggal !='' AND $namaplg !='' ){
 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Filter='$tahuun-$bulan-$tanggal-$namaplg')");

$tampil=mysql_query("SELECT * FROM jenisfile a,masterfile b, mastertanggal c where a.fileid=b.fileid and b.masterid=c.masterid and a.folderid='$tahuun' AND c.tanggalid='$namaplg' and c.fileid='$bulan' AND c.masterid='$tanggal'");
$x=mysql_fetch_array($tampil);
$ketemu=mysql_num_rows($tampil);
if($ketemu >='1'){
 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Detail Menu $x[namajenis]/$x[namafile]/$x[tanggal]')");
if($_SESSION['leveluser']=='admin'){		

echo "<br><h2><a href='?module=menu&act=detail&id=$x[fileid]'> $x[namajenis] </a> / <a href='?module=menu&act=detailP&id=$x[fileid]&masterid=$x[masterid]'>$x[namafile] </a>/ <b>$x[tanggal]</b></h2><hr>";
 $folderan=mysql_query("SELECT * FROM upload where tanggalid='$namaplg' and fileid='$bulan' and masterid='$tanggal' order by docid ASC");
?>
 <div style='overflow-y:scroll;overflow-x:scroll; height:300px;width:100%;scroll-color:hidden;'>
 <?php
 while($f=mysql_fetch_array($folderan)){
 $cek=mysql_query("SELECT COUNT(nomkot) AS count FROM upload_d where docid='$f[docid]' AND nomkot='$f[nomkot]'");
$ff=mysql_fetch_array($cek);
$count=$ff[count];
	 echo "<table>";
				echo "<a href='?module=menu&act=detailfile_d&id=$f[docid]&nomkot=$f[nomkot]&id_p=$x[tanggalid]'><img src='images/folder.png' width=20 height=20></a> $f[nomkot]</a> ($count) ||
				<a href='?module=menu&act=detailfileU&id=$f[docid]&nomkot=$f[nomkot]'><img src=images/detail.gif></a> || <a href='?module=menu&act=editfileU&&id=$f[docid]&nomkot=$f[nomkot]'><img src=images/edit.jpg></a>
				|| <a href='aksi.php?module=menu&act=hapusfileU&id=$f[docid]&nomkot=$f[nomkot]'><img src=images/hapus.jpg></a>";
				}
				echo "</table></div>";
}
else{

echo "<br><h2><a href='?module=menu&act=detail&id=$x[fileid]'> $x[namajenis] </a> / <b>$x[namafile]</b></h2><hr>";
 $folderan=mysql_query("SELECT * FROM upload where tanggalid='$namaplg' and fileid='$bulan' and masterid='$tanggal' order by docid ASC");
?>
 <div style='overflow-y:scroll;overflow-x:scroll; height:300px;width:100%;scroll-color:hidden;'>
 <?php
 while($f=mysql_fetch_array($folderan)){
 $cek=mysql_query("SELECT COUNT(nomkot) AS count FROM upload_d where docid='$f[docid]' AND nomkot='$f[nomkot]'");
$ff=mysql_fetch_array($cek);
$count=$ff[count];
	 echo "<table>";
				echo "<a href='?module=menu&act=detailfile_d&id=$f[docid]&nomkot=$f[nomkot]&id_p=$x[tanggalid]'><img src='images/folder.png' width=20 height=20></a> $f[nomkot]</a> ($count) ||
				<a href='?module=menu&act=detailfileU&id=$f[docid]&nomkot=$f[nomkot]'><img src=images/detail.gif></a> ";
				}
				echo "</table></div>";
	}
}
else{
echo "<script Language=\"JavaScript\">
  window.alert (\"Data tidak ditemukan ..\");
  window.location = \"media.php?module=menu\";
  </script>')";
  } 
}
else{
echo "<script Language=\"JavaScript\">
  window.alert (\"Silahkan isi data tersebut ..\");
  window.location = \"media.php?module=menu\";
  </script>')";
} 
break;

case "tambahdokumen":
      echo "<form name='tambah' method=POST action='./aksi.php?module=menu&act=tambahdokumen' onSubmit=\"return validasi()\">";
      
  include_once("dokumen2.php");?>
      
	<link type="text/css" rel="stylesheet" href="inc/y13_html5.css">
	<!-- <link type="text/css" rel="stylesheet" href="style.css"> -->
         <div class="animated fadeIn">
                  <div class="row">
  
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title">Add Folder</strong>
                          </div>
                          <div class="card-body">
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                      <thead>
                <tr><td class='left'>Pilih Dokumen </td><td>
                              <div class="card-body">
                            <ul id="browser" class="filetree">
                            <?php
                            
                              $sql = "SELECT * FROM dokumen ORDER BY docid";
                              $result = mysql_query($sql);
                              // Create an array to conatin a list of items and parents
                              $menus = array(
                                'items' => array(),
                                'parents' => array()
                              );
                              // Builds the array lists with data from the SQL result
                              while ($items = mysql_fetch_assoc($result)) {
                                // Create current menus item id into array
                                $menus['items'][$items['docid']] = $items;
                                // Creates list of all items with children
                                $menus['parents'][$items['id_parent']][] = $items['docid'];
                              }
                              // Print all tree view menus 
                              echo createTreeView(0, $menus);
                              ?>		
                              </ul>
                            </div>
    </td></tr>
    <tr><td>Nama Dokumen</td>     <td> : <input type=TEXT name='nama_dokumen'></td></tr>
            <tr><td colspan=2><input type=submit value=Save>
                              <input type=button Value=Cancel onclick=self.history.back()></td></tr>
            </table></form></div></div></div></div></div>
        <?php
       break;

       case "tambahfile":?>
        <script src="./js/jquery.js"></script>
      <script src="./js/development-bundle/ui/jquery.ui.core.js"></script>
      <script src="./js/development-bundle/ui/jquery.ui.widget.js"></script>
      <script src="./js/development-bundle/ui/jquery.ui.datepicker.js"></script>
      <link href="./js/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
      <script type="text/javascript"> 
                $(document).ready(function(){
                  $("#tgldokumen").datepicker({
                    dateFormat : "yy-mm-dd",  
                    defaultDate: "+0w",
                     changeYear  : true,
                changeMonth : true
                  });
              
                });
                $(document).ready(function(){
                  $("#tglexpired").datepicker({
                    dateFormat : "yy-mm-dd",  
                    defaultDate: "+0w",
                     changeYear  : true,
                changeMonth : true
                  });
              
                });
              </script> 
      <?php
        echo "<form name='tambah' method=POST action='./aksi.php?module=menu&act=tambahfile' enctype='multipart/form-data' id='form1'>";
        
   
  mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Page=Halaman Add Nomkot')");
  echo "<input type=hidden name='iduser' value='$id_user' readonly class='form-control'>";
        ?>
    <!-- <link type="text/css" rel="stylesheet" href="inc/y13_html5.css"> -->
    <!-- <link type="text/css" rel="stylesheet" href="style.css"> -->
           <div class="animated fadeIn">
                    <div class="row">
    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Add File</strong>
                            </div>
                            <div class="card-body" style="height: 300px; overflow-y: scroll;">
              
                              <?php
                              
                              include_once("pilihdokumen.php");
                                ?>	
   
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<input type=hidden name='id_user' value='$_SESSION[userid]'>
          <tr><td>Nama File</td>     <td>  <input type=text name='filename' class='form-control'></td></tr>
		      <tr><td>Metadata</td>     <td>  <input type='text' name='metadata' class='form-control'></td></tr>
          <tr><td>Upload File</td>     <td>  <input name='fupload' type='file' size='32' class='form-control'></td></tr>
          <tr><td>Tanggal Dokumen</td>     <td>  <input type=text name='tgl_dokumen' id='tgldokumen' class='form-control'></td></tr>
          <tr><td>Tanggal Expired</td>     <td>  <input type=text name='tgl_expired' id='tglexpired' class='form-control'></td></tr>
          <tr><td>Keterangan</td>     <td>  <input type=text name='keterangan' class='form-control'></td></tr>
          <tr><td>Komentar</td>     <td>  <textarea name='komentar' rows='3' class='form-control'></textarea></td></tr>";
          echo "<tr><td> Departemen <td>  <select name='departemenid' class='form-control'>";
					echo "<option value='0'> Silahkan Pilih Departemen  </option>";
					$prov = mysql_query("SELECT * FROM masterdepartemen order by departemenid asc");
					while($hasil = mysql_fetch_array($prov)){
					echo "<option value='$hasil[departemenid]'>$hasil[namadepartemen]</option>";
					}
					
					echo "</select></td>";
            echo "<tr><td>PIC Documents <td>  <input type=text name='pic' class='form-control'>";	
            echo "<tr><td>Username <td>  <input type=text name='username' value='$_SESSION[namauser]' readonly class='form-control'>
      
            <tr><td colspan=2 align='center'><button type='submit' class='btn btn-primary btn-sm'>
                  <i class='fa fa-dot-circle-o'></i> Submit
                  </button>
                  <button type='reset' class='btn btn-danger btn-sm'>
                  <i class='fa fa-ban'></i> Reset
                  </button>
                  <button type='button' onclick=self.history.back() class='btn btn-warning btn-sm'>
                  <i class='fa fa-ban'></i> Back
                  </button></td></tr>
				
          </table></form>";
     break;	
     
     
     case "listdokumen":
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
     
       mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','List Dokumen')");
      if($_SESSION['leveluser']=='admin'){		
      ?>
              
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link" id="nav-profile-tab" href="?module=menu&act=tambahfiledetail&docid=<?php echo $_GET['docid'];?>" role="tab" aria-controls="nav-profile" aria-selected="false">Add File</a>
                                                       </div>
      <?php
      echo "<div style='overflow-y:scroll;overflow-x:scroll; height:500px;scroll-color:hidden;'>";
      echo "<table id='bootstrap-data-table' class='table table-striped table-bordered'>
                          <thead><tr><th>NO</th><th>File Name</th><th>Metadata</th><th>Transaction Date</th><th>Retention Date</th><th>FILES</th><th>Action</th>";
        $p      = new Paging12;
        $batas  = 100;
        $posisi = $p->cariPosisi($batas);
        $rupi     = "Rp. ";
        $tampil=mysql_query("SELECT * FROM dokumen_file where docid='$_GET[docid]' AND approve='1' ORDER BY docid_d ASC limit $posisi,$batas");
      
          $no = $posisi+1;
      //$no2=0;	
        while ($r=mysql_fetch_array($tampil)){
         echo   "<tr><td align=center>$no</td>
              <td>$r[filename]</td>
              <td>$r[metadata]</td>
              <td>$r[tgl_dokumen]</td>
              <td>$r[retentiondate]</td>
              <td align=center><iframe src='./files/$r[fileimage]' width='400' height='200' style='border: none;'></iframe><br>
                  <a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$r[fileimage]'>$r[fileimage]</a>
                  | ";
                  if($r['watermark']=='1'){
                   echo "<a href='./aksi.php?module=menu&act=deletewatermark&docid_d=$r[docid_d]&docid=$r[docid]&fileimage=$r[fileimage]' onClick=\"return confirm('You sure will watermark files data of this tables?')\">Delete Watermark</a></td>";
                    
                  }
                  else{
                    echo "<a href='inc/watermark-edit-existing-pdf.php?docid_d=$r[docid_d]&docid=$r[docid]&file=$r[fileimage]' onClick=\"return confirm('You sure will watermark files data of this tables?')\">Watermark</a></td>";
                  }
              
              echo "<td align=center><a href='?module=menu&act=editdokfile&docid_d=$r[docid_d]&docid=$r[docid]' title='edit'><i class='menu-icon fa fa-pencil'></i></a> |
              <a href='?module=menu&act=refisidokfile&docid_d=$r[docid_d]&docid=$r[docid]' title='refisi'><i class='menu-icon fa fa-history'></i></a> 
              | <a href='?module=menu&act=linkdokfile&docid_d=$r[docid_d]&docid=$r[docid]' title='link'><i class='menu-icon fa fa-link'></i></a> 
              | <a href='./aksi.php?module=menu&act=deletedokfile&docid_d=$r[docid_d]&docid=$r[docid]&fileimage=$r[fileimage]' title='delete' onClick=\"return confirm('You sure will [release] data of this tables?')\">
              <i class='menu-icon fa fa-trash-o'></i></a> 
              </tr>";
          $no++;		
           }
         
      echo "</table></div>";
      }
      else{
        if($ro['create']=='1'){
        ?>
              
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link" id="nav-profile-tab" href="?module=menu&act=tambahfiledetail&docid=<?php echo $_GET['docid'];?>" role="tab" aria-controls="nav-profile" aria-selected="false">Add File</a>
                                                 </div>
      <?php
        }
        else{

        }
        // echo $_SESSION['departemenuser'];
       echo "<div style='overflow-y:scroll;overflow-x:scroll; height:500px;scroll-color:hidden;'>";
       echo "<table id='bootstrap-data-table' class='table table-striped table-bordered'>
       <thead><tr><th>NO</th><th>File Name</th><th>Metadata</th><th>Transaction Date</th><th>Retention Date</th><th>FILES</th><th>Action</th>";
        $p      = new Paging12;
        $batas  = 100;
        $posisi = $p->cariPosisi($batas);
        $rupi     = "Rp. ";
        $tampil=mysql_query("SELECT * FROM dokumen_file where docid='$_GET[docid]'  AND approve='1' AND departemenid='$_SESSION[departemenuser]' ORDER BY docid_d ASC limit $posisi,$batas");
      
          $no = $posisi+1;
      //$no2=0;	
        while ($r=mysql_fetch_array($tampil)){
          //permission
          // $permission=mysql_query("SELECT * FROM levelpermission where docid_d='$r[docid_d]' AND level='user'");
          // $p=mysql_fetch_array($permission);
          
          // echo $r['level'];
          if($ro['read']=='1'){ 
          echo   "<tr><td align=center>$no</td>
          <td>$r[filename]</td>
          <td>$r[metadata]</td>
          <td>$r[tgl_dokumen]</td>
          <td>$r[retentiondate]</td>";?>
          <td align=center><iframe src="<?php echo "./files/$r[fileimage]";?>#toolbar=0&navpanes=0&statusbar=0&view=Fit;readonly=true; disableprint=true;" width='400' height='200' style='border: none;'></iframe><br>
           <?php
             if($ro['preview']=='1'){ 
              echo "<a href='#' onclick=\"bukajendela('files/$r[fileimage]')\">Preview </a> | ";
             }
             else{
             }
             if($ro['download']=='1'){ 
              echo "<a href='downlot.php?file=$r[fileimage]'>$r[fileimage]</a></td>";
             }
             else{

             }
             if($ro['watermark']=='1'){ 
               if($r['watermark']=='1'){
                echo "<a href='#'>Watermark</a></td>";
              }
              else{
                echo "<a href='inc/watermark-edit-existing-pdf.php?docid_d=$r[docid_d]&docid=$r[docid]&file=$r[fileimage]' onClick=\"return confirm('You sure will watermark files data of this tables?')\">Watermark</a></td>";
              }
            }
             else{

             }
          
          echo "<td align=center>";
          if($ro['edit']=='1'){ 
          echo "<a href='?module=menu&act=editdokfile&docid_d=$r[docid_d]&docid=$r[docid]' title='edit'><i class='menu-icon fa fa-pencil'></i></a> |";
          }
          else{

          }
          if($ro['refisi']=='1'){ 
            echo "<a href='?module=menu&act=refisidokfile&docid_d=$r[docid_d]&docid=$r[docid]' title='refisi'><i class='menu-icon fa fa-history'></i></a> 
          | ";
          }
          else{
          }
          if($ro['link']=='1'){ 
            echo "<a href='?module=menu&act=linkdokfile&docid_d=$r[docid_d]&docid=$r[docid]' title='link'><i class='menu-icon fa fa-link'></i></a> 
          | ";
          }
          else{
          }
          if($ro['delete']=='1'){ 
            echo "<a href='./aksi.php?module=menu&act=deletedokfile&docid_d=$r[docid_d]&docid=$r[docid]&fileimage=$r[fileimage]' title='delete' onClick=\"return confirm('You sure will [release] data of this tables?')\">
          <i class='menu-icon fa fa-trash-o'></i></a> ";
          }
          else{

          }
          echo "</tr>";
            }
            else{

            }
          $no++;		
           }
         
      echo "</table></div>";
      
      }
          
        $jmldata = mysql_num_rows(mysql_query("SELECT * FROM dokumen_file where docid='$_GET[docid]' AND approve='1'"));
      
       
          $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
          $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
      
          echo "<p>$linkHalaman</p>";
      break;

      case "tambahfiledetail":?>
        <script src="./js/jquery.js"></script>
      <script src="./js/development-bundle/ui/jquery.ui.core.js"></script>
      <script src="./js/development-bundle/ui/jquery.ui.widget.js"></script>
      <script src="./js/development-bundle/ui/jquery.ui.datepicker.js"></script>
      <link href="./js/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
      <script type="text/javascript"> 
                $(document).ready(function(){
                  $("#tgldokumen").datepicker({
                    dateFormat : "yy-mm-dd",  
                    defaultDate: "+0w",
                     changeYear  : true,
                changeMonth : true
                  });
              
                });
                $(document).ready(function(){
                  $("#tglexpired").datepicker({
                    dateFormat : "yy-mm-dd",  
                    defaultDate: "+0w",
                     changeYear  : true,
                changeMonth : true
                  });
              
                });
              </script> 
      <?php
        echo "<form name='tambah' method=POST action='./aksi.php?module=menu&act=\' enctype='multipart/form-data' id='form1'>";
        
   
  mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Page=Halaman Add File')");
  echo "<input type=hidden name='iduser' value='$id_user' readonly class='form-control'>
  
  <input type=hidden name='docid' value='$_GET[docid]'>";
        ?>
    <!-- <link type="text/css" rel="stylesheet" href="inc/y13_html5.css"> -->
    <!-- <link type="text/css" rel="stylesheet" href="style.css"> -->
           <div class="animated fadeIn">
                    <div class="row">
    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Add File</strong>
                            </div>
                            
   
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<input type=hidden name='id_user' value='$_SESSION[userid]'>
          <tr><td>Nama File</td>     <td>  <input type=text name='filename' class='form-control'></td></tr>
		      <tr><td>Metadata</td>     <td>  <input type='text' name='metadata' class='form-control'></td></tr>
          <tr><td>Upload File</td>     <td>  <input name='fupload' type='file' size='32' class='form-control'></td></tr>
          <tr><td>Tanggal Dokumen</td>     <td>  <input type=text name='tgl_dokumen' id='tgldokumen' class='form-control'></td></tr>
          <tr><td>Tanggal Expired</td>     <td>  <input type=text name='tgl_expired' id='tglexpired' class='form-control'></td></tr>
          <tr><td>Keterangan</td>     <td>  <input type=text name='keterangan' class='form-control'></td></tr>
          <tr><td>Komentar</td>     <td>  <textarea name='komentar' rows='3' class='form-control'></textarea></td></tr>";
           echo "<tr><td> Departemen <td>  <select name='departemenid' class='form-control'>";
				
          if($_SESSION['leveluser']=='admin'){
            echo "<option value='0'> Silahkan Pilih Departemen </option>";
					$prov = mysql_query("SELECT * FROM masterdepartemen order by departemenid asc");
          }
          else{
            
					$prov = mysql_query("SELECT * FROM masterdepartemen WHERE departemenid='$_SESSION[departemenuser]' order by departemenid asc");
          }
					while($hasil = mysql_fetch_array($prov)){
					echo "<option value='$hasil[departemenid]'>$hasil[namadepartemen]</option>";
					}
					
					echo "</select></td>";
		  	echo "<tr><td>PIC Documents <td>  <input type=text name='pic' class='form-control'>";	
				echo "<tr><td>Username <td>  <input type=text name='username' value='$_SESSION[namauser]' readonly class='form-control'>";
         
            
          echo "<tr><td colspan=2 align='center'><button type='submit' class='btn btn-primary btn-sm'>
                  <i class='fa fa-dot-circle-o'></i> Submit
                  </button>
                  <button type='reset' class='btn btn-danger btn-sm'>
                  <i class='fa fa-ban'></i> Reset
                  </button>
                  <button type='button' onclick=self.history.back() class='btn btn-warning btn-sm'>
                  <i class='fa fa-ban'></i> Back
                  </button></td></tr>
				
          </table></form>";
     break;	
       
     case "editdokfile":?>
      <script src="./js/jquery.js"></script>
      <script src="./js/development-bundle/ui/jquery.ui.core.js"></script>
      <script src="./js/development-bundle/ui/jquery.ui.widget.js"></script>
      <script src="./js/development-bundle/ui/jquery.ui.datepicker.js"></script>
      <link href="./js/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
      <?php
      
      $tampil=mysql_query("SELECT * FROM dokumen_file where docid_d='$_GET[docid_d]' AND docid='$_GET[docid]' AND approve='1'");
      $x=mysql_fetch_array($tampil);
        mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Page=Halaman Edit Edit File')");
      ?>
        <script type="text/javascript"> 
        $(document).ready(function(){
          $("#tgldokumen").datepicker({
            dateFormat : "yy-mm-dd",  
            defaultDate: "+0w",
             changeYear  : true,
        changeMonth : true
          });
      
        });
        $(document).ready(function(){
          $("#tglexpired").datepicker({
            dateFormat : "yy-mm-dd",  
            defaultDate: "+0w",
             changeYear  : true,
        changeMonth : true
          });
      
        });
      </script> 
<?php
echo "<form name='tambah' method=POST action='./aksi.php?module=menu&act=editfiledetail' enctype='multipart/form-data' id='form1'>";


mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Page=Halaman Add File')");
echo "<input type=hidden name='iduser' value='$id_user' readonly class='form-control'>

<input type=hidden name='docid' value='$_GET[docid]'>
<input type=hidden name='docid_d' value='$_GET[docid_d]'>";
?>
<!-- <link type="text/css" rel="stylesheet" href="inc/y13_html5.css"> -->
<!-- <link type="text/css" rel="stylesheet" href="style.css"> -->
   <div class="animated fadeIn">
            <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Edit File</strong>
                    </div>
                    

  <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
  <?php
  echo "<input type=hidden name='id_user' value='$_SESSION[userid]'>
  <tr><td>Nama File</td>     <td>  <input type=text name='filename' value='$x[filename]' class='form-control'></td></tr>
  <tr><td>Metadata</td>     <td>  <input type='text' name='metadata' value='$x[metadata]' class='form-control'></td></tr>
  <tr><td colspan=2 align=center><a href='files/$x[fileimage]'><img src=images/pdf.png><br>$x[fileimage]</a></td></tr>	    
  <tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>
  <tr><td>Tanggal Dokumen</td>     <td>  <input type=text name='tgl_dokumen' id='tgldokumen' value='$x[tgl_dokumen]' class='form-control'></td></tr>
  <tr><td>Tanggal Expired</td>     <td>  <input type=text name='tgl_expired' id='tglexpired' value='$x[retentiondate]' class='form-control'></td></tr>
  <tr><td>Keterangan</td>     <td>  <input type=text name='keterangan' value='$x[keterangan]' class='form-control'></td></tr>
  <tr><td>Komentar</td>     <td>  <textarea name='komentar' rows='3' class='form-control'>$x[komentar]</textarea></td></tr>";
  echo "<tr><td>PIC Documents <td>  <input type=text name='pic' value='$x[pic]' class='form-control'>";	
  echo "<tr><td>Username <td>  <input type=text name='username' value='$_SESSION[namauser]' readonly class='form-control'>";?>
         
              <tr><td colspan='2' align='center'><a href="#" onclick="javascript:yesnoCheck();" id='adminCheck'><b>Departemen Permission</b> </a></td></tr>
              <?php			
					echo "<div id='ifNo' style='display:none'><table id='bootstrap-data-table' class='table table-striped table-bordered'>
          <tr><td>No</td><td>Level User</td><td>Read</td><td>Update</td><td>Delete</td>
          <td>Print</td><td>Preview</td><td>Download</td><td><input type='checkbox' onclick='toggle(this);' />Check all?</tr>";
          $no=1;
          $tampil=mysql_query("select * from masterdepartemen");
          while($r=mysql_fetch_array($tampil)){
          $permission=mysql_query("select * from departemenpermission where docid_d ='$x[docid_d]' AND departemenid='$r[departemenid]'");
          $p=mysql_fetch_array($permission);
            echo "<tr><td align='center'>$no </td>
                  <td>$r[namadepartemen] <input type='hidden' name='iddepartemen[]' value='$r[departemenid]'> </td>";
                  if($p['read']=='1'){
                    echo "<td align='center'><input type='checkbox' name='read[]' value='$p[read]' checked> </td>";
                  }
                  else{
                    echo "<td align='center'><input type='checkbox' name='read[]' value='1'> </td>";
                  }
                  if($p['edit']=='1'){
                    echo "<td align='center'><input type='checkbox' name='edit[]' value='$p[edit]' checked> </td>";
                  }
                  else{
                    echo "<td align='center'><input type='checkbox' name='edit[]' value='1'> </td>";
                  }
                  if($p['delete']=='1'){
                    echo "<td align='center'><input type='checkbox' name='delete[]' value='$p[delete]' checked> </td>";
                  }
                  else{
                    echo "<td align='center'><input type='checkbox' name='delete[]' value='1'> </td>";
                  }
                  if($p['print']=='1'){
                    echo "<td align='center'><input type='checkbox' name='print[]' value='$p[print]' checked> </td>";
                  }
                  else{
                    echo "<td align='center'><input type='checkbox' name='print[]' value='1'> </td>";
                  }
                  if($p['preview']=='1'){
                    echo "<td align='center'><input type='checkbox' name='preview[]' value='$p[preview]' checked> </td>";
                  }
                  else{
                    echo "<td align='center'><input type='checkbox' name='preview[]' value='1'> </td>";
                  }
                  if($p['download']=='1'){
                    echo "<td align='center'><input type='checkbox' name='download[]' value='$p[download]' checked> </td>";
                  }
                  else{
                    echo "<td align='center'><input type='checkbox' name='download[]' value='1'> </td>";
                  }
                  // if($p['link']=='1'){
                  //   echo "<td align='center'><input type='checkbox' name='link' value='$p[link]' checked> </td>";
                  // }
                  // else{
                  //   echo "<td align='center'><input type='checkbox' name='link' value='1'> </td>";
                  // }
                  // if($p['refisi']=='1'){
                  //   echo "<td align='center'><input type='checkbox' name='refisi' value='$p[refisi]' checked> </td>";
                  // }
                  // else{
                  //   echo "<td align='center'><input type='checkbox' name='refisi' value='1'> </td>";
                  // }

                 
                  $no++;
          }
          echo "</tr></table></div>";
							
			echo "<table>";
  echo "<tr><td colspan=2 align='center'><button type='submit' class='btn btn-primary btn-sm'>
            <i class='fa fa-dot-circle-o'></i> Submit
            </button>
            <button type='reset' class='btn btn-danger btn-sm'>
            <i class='fa fa-ban'></i> Reset
            </button>
            <button type='button' onclick=self.history.back() class='btn btn-warning btn-sm'>
            <i class='fa fa-ban'></i> Back
            </button></td></tr>

    </table></form>";     
     
           break;	

           case "refisidokfile":?>
            <script src="./js/jquery.js"></script>
            <script src="./js/development-bundle/ui/jquery.ui.core.js"></script>
            <script src="./js/development-bundle/ui/jquery.ui.widget.js"></script>
            <script src="./js/development-bundle/ui/jquery.ui.datepicker.js"></script>
            <link href="./js/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
            <?php
            
            $tampil=mysql_query("SELECT * FROM dokumen_file where docid_d='$_GET[docid_d]' AND docid='$_GET[docid]' AND approve='1'");
            $x=mysql_fetch_array($tampil);
              mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Page=Halaman Edit Edit File')");
            ?>
              <script type="text/javascript"> 
              $(document).ready(function(){
                $("#tgldokumen").datepicker({
                  dateFormat : "yy-mm-dd",  
                  defaultDate: "+0w",
                   changeYear  : true,
              changeMonth : true
                });
            
              });
              $(document).ready(function(){
                $("#tglexpired").datepicker({
                  dateFormat : "yy-mm-dd",  
                  defaultDate: "+0w",
                   changeYear  : true,
              changeMonth : true
                });
            
              });
            </script> 
      <?php
      echo "<form name='tambah' method=POST action='./aksi.php?module=menu&act=refisifiledetail' enctype='multipart/form-data' id='form1'>";
      
      
      mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Page=Halaman Add File')");
      echo "<input type=hidden name='iduser' value='$id_user' readonly class='form-control'>
      
      <input type=hidden name='docid' value='$_GET[docid]'>
      <input type=hidden name='docid_d' value='$_GET[docid_d]'>";
      ?>
      <!-- <link type="text/css" rel="stylesheet" href="inc/y13_html5.css"> -->
      <!-- <link type="text/css" rel="stylesheet" href="style.css"> -->
         <div class="animated fadeIn">
                  <div class="row">
      
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title">Refisi File</strong>
                          </div>
                          
      
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                  <thead>
        <?php
        echo "<input type=hidden name='id_user' value='$_SESSION[userid]'>
        <tr><td>Nama File</td>     <td>  <input type=text name='filename' value='$x[filename]' class='form-control'></td></tr>
        <tr><td>Metadata</td>     <td>  <input type='text' name='metadata' value='$x[metadata]' class='form-control'></td></tr>
        <tr><td colspan=2 align=center><a href='files/$x[fileimage]'><img src=images/pdf.png><br>$x[fileimage]</a></td></tr>	    
        <tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>
        <tr><td>Tanggal Dokumen</td>     <td>  <input type=text name='tgl_dokumen' readonly value='$x[tgl_dokumen]' class='form-control'></td></tr>
        <tr><td>Tanggal Expired</td>     <td>  <input type=text name='tgl_expired' readonly value='$x[retentiondate]' class='form-control'></td></tr>
        <tr><td>Keterangan</td>     <td>  <input type=text name='keterangan' value='$x[keterangan]' readonly class='form-control'></td></tr>
        <tr><td>Komentar</td>     <td>  <textarea name='komentar' rows='3' class='form-control' readonly >$x[komentar]</textarea></td></tr>";
        echo "<tr><td>PIC Documents <td>  <input type=text name='pic' value='$x[pic]' readonly  class='form-control'>";	
        echo "<tr><td>Username <td>  <input type=text name='username' value='$_SESSION[namauser]' readonly class='form-control'>
        <tr><td colspan=2 align='center'><button type='submit' class='btn btn-primary btn-sm'>
                  <i class='fa fa-dot-circle-o'></i> Submit
                  </button>
                  <button type='reset' class='btn btn-danger btn-sm'>
                  <i class='fa fa-ban'></i> Reset
                  </button>
                  <button type='button' onclick=self.history.back() class='btn btn-warning btn-sm'>
                  <i class='fa fa-ban'></i> Back
                  </button></td></tr>
      
          </table></form>";     
           
                 break;	

                 case "linkdokfile":
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
                  $cek=mysql_query("SELECT * FROM dokumen_file where docid_d='$_GET[docid_d]' and docid='$_GET[docid]' AND approve='1'  ORDER BY docid_d ASC limit $posisi,$batas");
                   mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','List Link Dokumen')");
                  if($_SESSION['leveluser']=='admin'){		
                  ?>
                          
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link" id="nav-profile-tab" href="?module=menu&act=addlinkdokfile&docid_d=<?php echo $_GET['docid_d'];?>&docid=<?php echo $_GET['docid'];?>" role="tab" aria-controls="nav-profile" aria-selected="false">Add Link File</a>
                                                                   </div>
                  <?php
                  echo "<div style='overflow-y:scroll;overflow-x:scroll; height:500px;scroll-color:hidden;'>";
                  echo "<table id='bootstrap-data-table' class='table table-striped table-bordered'>
                                      <thead><tr><th>NO</th><th>File Name</th><th>Metadata</th><th>Transaction Date</th><th>Retention Date</th><th>FILES</th><th>Action</th>";
                    $p      = new Paging12;
                    $batas  = 100;
                    $posisi = $p->cariPosisi($batas);
                    $rupi     = "Rp. ";
                    $tampil=mysql_query("SELECT * FROM dokumen_file_link where docid_d='$_GET[docid_d]' and  docid='$_GET[docid]' ORDER BY docid_link ASC limit $posisi,$batas");
                  
                      $no = $posisi+1;
                  //$no2=0;	
                    while ($r=mysql_fetch_array($tampil)){
                     echo   "<tr><td align=center>$no</td>
                          <td>$r[filename]</td>
                          <td>$r[metadata]</td>
                          <td>$r[tgl_dokumen]</td>
                          <td>$r[retentiondate]</td>
                          <td align=center><iframe src='./files/link/$r[fileimage]' width='400' height='200' style='border: none;'></iframe><br>
                              <a href='#' onclick=\"bukajendela('files/link/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$r[fileimage]'>$r[fileimage]</a></td>
                              ";
                          
                          echo "<td align=center><a href='?module=menu&act=editlinkdokfile&docid_link=$r[docid_link]&docid_d=$r[docid_d]&docid=$r[docid]' title='edit'><i class='menu-icon fa fa-pencil'></i></a> 
                          | <a href='./aksi.php?module=menu&act=deletelinkdokfile&docid_link=$r[docid_link]&docid_d=$r[docid_d]&docid=$r[docid]&fileimage=$r[fileimage]' title='delete' onClick=\"return confirm('You sure will [release] data of this tables?')\">
                          <i class='menu-icon fa fa-trash-o'></i></a> 
                          </tr>";
                      $no++;		
                       }
                     
                  echo "</table></div>";
                  }
                  else{
                  
                   echo "<div style='overflow-y:scroll;overflow-x:scroll; height:300px;scroll-color:hidden;'>";
                  echo "<table><thead><tr><th>NO</th><th>File Name</th><th>Metadata</th><th>Transaction Date</th><th>Retention Date</th><th>FILES</th><th>Action</th>";
                    $p      = new Paging12;
                    $batas  = 100;
                    $posisi = $p->cariPosisi($batas);
                    $rupi     = "Rp. ";
                    $tampil=mysql_query("SELECT * FROM dokumen_file_link where docid_d='$_GET[docid_d]' and docid='$_GET[docid]' ORDER BY docid_d ASC limit $posisi,$batas");
                  
                      $no = $posisi+1;
                  //$no2=0;	
                    while ($r=mysql_fetch_array($tampil)){
                     echo   "<tr><td align=center>$no</td>
                          <td>$r[filename]</td>
                          <td>$r[metadata]</td>
                          <td>$r[inputtgl]</td>
                          <td>$r[retentiondate]</td>
                          <td align=center><iframe src='./files/link/$r[fileimage]' width='400' height='200' style='border: none;'></iframe><br>
                              <a href='#' onclick=\"bukajendela('files/link/$r[fileimage]')\">Preview </a> | <a href='downlot.php?file=$r[fileimage]'>$r[fileimage]</a></td>
                              
                          
                          </tr>";
                      $no++;		
                       }
                     
                  echo "</table></div>";
                  
                  }
                      
                    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM dokumen_file where docid='$_GET[docid]' AND approve='1'"));
                  
                   
                      $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                      $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                  
                      echo "<p>$linkHalaman</p>";
                  break;
                  
                 case "addlinkdokfile":?>
                  <script src="./js/jquery.js"></script>
                  <script src="./js/development-bundle/ui/jquery.ui.core.js"></script>
                  <script src="./js/development-bundle/ui/jquery.ui.widget.js"></script>
                  <script src="./js/development-bundle/ui/jquery.ui.datepicker.js"></script>
                  <link href="./js/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
                  <?php
                  
                  $tampil=mysql_query("SELECT * FROM dokumen_file where docid_d='$_GET[docid_d]' AND docid='$_GET[docid]' AND approve='1'");
                  $x=mysql_fetch_array($tampil);
                    mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Page=Halaman Edit Edit File')");
                  ?>
                    <script type="text/javascript"> 
                    $(document).ready(function(){
                      $("#tgldokumen").datepicker({
                        dateFormat : "yy-mm-dd",  
                        defaultDate: "+0w",
                         changeYear  : true,
                    changeMonth : true
                      });
                  
                    });
                    $(document).ready(function(){
                      $("#tglexpired").datepicker({
                        dateFormat : "yy-mm-dd",  
                        defaultDate: "+0w",
                         changeYear  : true,
                    changeMonth : true
                      });
                  
                    });
                  </script> 
            <?php
            echo "<form name='tambah' method=POST action='./aksi.php?module=menu&act=linkfiledetail' enctype='multipart/form-data' id='form1'>";
            
            
            mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Page=Halaman Add File')");
            echo "<input type=hidden name='iduser' value='$id_user' readonly class='form-control'>
            
            <input type=hidden name='docid' value='$_GET[docid]'>
            <input type=hidden name='docid_d' value='$_GET[docid_d]'>";
            ?>
            <!-- <link type="text/css" rel="stylesheet" href="inc/y13_html5.css"> -->
            <!-- <link type="text/css" rel="stylesheet" href="style.css"> -->
               <div class="animated fadeIn">
                        <div class="row">
            
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Link Dokumen File | <?php echo $x['filename'];?></strong>
                                </div>
                                
            
              <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
              <?php
              echo "<input type=hidden name='id_user' value='$_SESSION[userid]'>
              <tr><td>Nama File</td>     <td>  <input type=text name='filename' class='form-control'></td></tr>
              <tr><td>Metadata</td>     <td>  <input type='text' name='metadata' class='form-control'></td></tr>
              <tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>
              <tr><td>Tanggal Dokumen</td>     <td>  <input type=text name='tgl_dokumen' id='tgldokumen' class='form-control'></td></tr>
              <tr><td>Tanggal Expired</td>     <td>  <input type=text name='tgl_expired' id='tglexpired' class='form-control'></td></tr>
              <tr><td>Keterangan</td>     <td>  <input type=text name='keterangan' class='form-control'></td></tr>";
              echo "<tr><td>PIC Documents <td>  <input type=text name='pic' value='$x[pic]' class='form-control'>";	
              echo "<tr><td>Username <td>  <input type=text name='username' value='$_SESSION[namauser]' readonly class='form-control'>
              <tr><td colspan=2 align='center'><button type='submit' class='btn btn-primary btn-sm'>
                        <i class='fa fa-dot-circle-o'></i> Submit
                        </button>
                        <button type='reset' class='btn btn-danger btn-sm'>
                        <i class='fa fa-ban'></i> Reset
                        </button>
                        <button type='button' onclick=self.history.back() class='btn btn-warning btn-sm'>
                        <i class='fa fa-ban'></i> Back
                        </button></td></tr>
            
                </table></form>";     
                 
                       break;	

            case "editlinkdokfile":?>
                        <script src="./js/jquery.js"></script>
                        <script src="./js/development-bundle/ui/jquery.ui.core.js"></script>
                        <script src="./js/development-bundle/ui/jquery.ui.widget.js"></script>
                        <script src="./js/development-bundle/ui/jquery.ui.datepicker.js"></script>
                        <link href="./js/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
                        <?php
                        
                        $tampil=mysql_query("SELECT * FROM dokumen_file_link where docid_link='$_GET[docid_link]' AND docid_d='$_GET[docid_d]' and docid='$_GET[docid]'");
                        $x=mysql_fetch_array($tampil);
                          mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Page=Halaman Edit Link File')");
                        ?>
                          <script type="text/javascript"> 
                          $(document).ready(function(){
                            $("#tgldokumen").datepicker({
                              dateFormat : "yy-mm-dd",  
                              defaultDate: "+0w",
                               changeYear  : true,
                          changeMonth : true
                            });
                        
                          });
                          $(document).ready(function(){
                            $("#tglexpired").datepicker({
                              dateFormat : "yy-mm-dd",  
                              defaultDate: "+0w",
                               changeYear  : true,
                          changeMonth : true
                            });
                        
                          });
                        </script> 
                  <?php
                  echo "<form name='tambah' method=POST action='./aksi.php?module=menu&act=editlinkfiledetail' enctype='multipart/form-data' id='form1'>";
                  
                  
                  echo "<input type=hidden name='iduser' value='$id_user' readonly class='form-control'>
                  
                  <input type=hidden name='docid' value='$_GET[docid]'>
                  <input type=hidden name='docid_d' value='$_GET[docid_d]'>
                  <input type=hidden name='docid_link' value='$_GET[docid_link]'>";
                  ?>
                  <!-- <link type="text/css" rel="stylesheet" href="inc/y13_html5.css"> -->
                  <!-- <link type="text/css" rel="stylesheet" href="style.css"> -->
                     <div class="animated fadeIn">
                              <div class="row">
                  
                              <div class="col-md-12">
                                  <div class="card">
                                      <div class="card-header">
                                          <strong class="card-title">Edit Link File</strong>
                                      </div>
                                      
                  
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                              <thead>
                    <?php
                    echo "<input type=hidden name='id_user' value='$_SESSION[userid]'>
                    <tr><td>Nama File</td>     <td>  <input type=text name='filename' value='$x[filename]' class='form-control'></td></tr>
                    <tr><td>Metadata</td>     <td>  <input type='text' name='metadata' value='$x[metadata]' class='form-control'></td></tr>
                    <tr><td colspan=2 align=center><a href='files/link/$x[fileimage]'><img src=images/pdf.png><br>$x[fileimage]</a></td></tr>	    
                    <tr><td>Upload File</td>     <td> : <input name='fupload' type='file' size='32'></td></tr>
                    <tr><td>Tanggal Dokumen</td>     <td>  <input type=text name='tgl_dokumen' id='tgldokumen' value='$x[tgl_dokumen]' class='form-control'></td></tr>
                    <tr><td>Tanggal Expired</td>     <td>  <input type=text name='tgl_expired' id='tglexpired' value='$x[retentiondate]' class='form-control'></td></tr>
                    <tr><td>Keterangan</td>     <td>  <input type=text name='keterangan' value='$x[keterangan]' class='form-control'></td></tr>";
                    echo "<tr><td>PIC Documents <td>  <input type=text name='pic' value='$x[pic]' class='form-control'>";	
                    echo "<tr><td>Username <td>  <input type=text name='username' value='$_SESSION[namauser]' readonly class='form-control'>
                    <tr><td colspan=2 align='center'><button type='submit' class='btn btn-primary btn-sm'>
                              <i class='fa fa-dot-circle-o'></i> Submit
                              </button>
                              <button type='reset' class='btn btn-danger btn-sm'>
                              <i class='fa fa-ban'></i> Reset
                              </button>
                              <button type='button' onclick=self.history.back() class='btn btn-warning btn-sm'>
                              <i class='fa fa-ban'></i> Back
                              </button></td></tr>
                  
                      </table></form>";     
                       
                             break;	
}
?>
</div>
</table>