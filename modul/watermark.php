 <link rel="stylesheet" href="style.css" /> 
 <?php
 session_start();

switch($_GET['act']){
  // Tampil watermark
  default:
  if($_SESSION[leveluser]=='admin'){
    ?>
  <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Watermark</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<tr><th>No</th><th>nama</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM watermark ORDER BY id ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[nama]</td>
             <td align=center><a href=?module=watermark&act=editwatermark&id=$r[id]><img src=images/icon_edit.gif border=0 border=0 title='edit'></a>
             </td></tr>";
      $no++;
    }
	}
	else{
	echo "Maaf Anda tidak punya hak";
	}
    echo "</fieldset>";?>
	</tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
			<?php
    break;
  
  case "tambahwatermark":
    echo "<h2>Tambah watermark</h2>
          <form name='tambah' method=POST action='./aksi.php?module=watermark&act=input' onSubmit=\"return validasi()\">
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <table>
          <tr><td>Nama</td>     <td> : <input type=text name='nama' onBlur='validate(this)'></td></tr>
          ";
			echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editwatermark":
    $edit=mysql_query("SELECT * FROM watermark WHERE id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form name='ganti' method=POST action='?module=watermark&act=update' onSubmit=\"return edit()\">";?>
    <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Edit Watermark</strong>
                        </div>
                        <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
		 echo "<input type=hidden name='id' value='$r[id]'>
		 <tr><td>Nama</td>     <td> : <input type=text name='nama' value='$r[nama]' onBlur='validate(this)'></td></tr>
          ";
			echo "</td></tr>
			<tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form></div></div>
          </div>
          </div>
          </div></div>";
    break;  
	
	case "update":
	$nama=$_POST['nama'];
	mysql_query("UPDATE watermark SET nama='$nama' where id='$_POST[id]'");	
	echo "<script Language=\"JavaScript\">
  window.location = \"media.php?module=watermark\";
  </script>')";
	break;
}
?>
