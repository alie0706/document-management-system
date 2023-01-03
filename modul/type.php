 <link rel="stylesheet" href="style.css" /> 
 <?php
 session_start();

switch($_GET[act]){
  // Tampil type
  default:
  if($_SESSION[leveluser]=='admin'){
  ?>
  <div class="card-body">
    <a class="btn btn-primary" href="?module=type&act=tambahtype" role="button">Tambah Data</a></div>
	<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Master Type</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<tr><th>No</th><th>Nama Type</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM mastertype ORDER BY typeid ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[namatype]</td>
             <td><a href=?module=type&act=edittype&id=$r[typeid]><i class='menu-icon fa fa-edit' border=0 border=0 title='edit'></i></a> | 
	             <a href='./aksi.php?module=type&act=hapus&id=$r[typeid]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
			     <i class='menu-icon fa fa-trash-o' border=0 title='hapus'></i></a> 
             </td></tr>";
      $no++;
    }
	}
	else{
	echo "Maaf Anda tidak punya hak";
	}
    echo "</fieldset>";
    ?>
	</tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
			<?php
	
		
    break;
  
  case "tambahtype":
    echo "<form name='tambah' method=POST action='./aksi.php?module=type&act=input' onSubmit=\"return validasi()\">";?>
		 <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Tambah Type</strong>
                        </div>
                        <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <tr><td>Nama Type</td>     <td> : <input type=text name='namatype' onBlur='validate(this)'></td></tr>
         
		<?php									
			echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form></div>
          </div>
          </div>
      </div>";
     break;
    
  case "edittype":
    $edit=mysql_query("SELECT * FROM mastertype WHERE typeid='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form name='ganti' method=POST action='./aksi.php?module=type&act=update' onSubmit=\"return edit()\">";?>
		  <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Edit Type</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
		<?php		  
		  echo "<input type=hidden name='typeid' value='$r[typeid]'>
		  <tr><td>Nama Type</td>     <td> : <input type=text name='namatype' value='$r[namatype]' onBlur='validate(this)'></td></tr>
          <tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form></div></div>
          </div>
          </div>
          </div></div>";
    break;  
}
?>
