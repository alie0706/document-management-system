 <link rel="stylesheet" href="style.css" /> 
 <?php
 session_start();

switch($_GET['act']){
  // Tampil departemen
  default:
  if($_SESSION['leveluser']=='admin'){?>
  <div class="card-body">
    <a class="btn btn-primary" href="?module=departemen&act=tambahdepartemen" role="button">Tambah Data</a></div>
	<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Master Departemen</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<tr><th>No</th><th>Nama Departemen</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM masterdepartemen ORDER BY departemenid ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[namadepartemen]</td>
             <td><a href=?module=departemen&act=editdepartemen&id=$r[departemenid]><i class='menu-icon fa fa-edit' border=0 border=0 title='edit'></i></a> | 
	             <a href='./aksi.php?module=departemen&act=hapus&id=$r[departemenid]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
			     <i class='menu-icon fa fa-trash-o' border=0 title='hapus'></i></a> 
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
  
  case "tambahdepartemen":
    echo "<form name='tambah' method=POST action='./aksi.php?module=departemen&act=input' onSubmit=\"return validasi()\">";?>
		  <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Tambah departemen</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
          <tr><td>Nama departemen</td>     <td>  <input type=text name='namadepartemen' onBlur='validate(this)'></td></tr>
          <tr><td colspan=2><input type=submit value=Save>
                                <input type=button value=Cancel onclick=self.history.back()></td></tr>
              </table></form></div></div>
              </div>
              </div>
              </div></div>
    <?php
     break;
    
  case "editdepartemen":
    $edit=mysql_query("SELECT * FROM masterdepartemen WHERE departemenid='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form name='ganti' method=POST action='./aksi.php?module=departemen&act=update' onSubmit=\"return edit()\">";?>
		   <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Tambah departemen</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
		<?php		  
		  echo "<input type=hidden name='departemenid' value='$r[departemenid]'>
		  <tr><td>Nama departemen</td>     <td> <input type=text name='namadepartemen' value='$r[namadepartemen]' onBlur='validate(this)'></td></tr>
          <tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form></div></div>
          </div>
          </div>
          </div></div>";
    break;  
}
?>
