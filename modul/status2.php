 <link rel="stylesheet" href="style.css" /> 
 <?php
 session_start();

switch($_GET[act]){
  // Tampil status
  default:
  if($_SESSION[leveluser]=='admin'){?>
  <div class="card-body">
    <a class="btn btn-primary" href="?module=status2&act=tambahstatus" role="button">Tambah Data</a></div>
	<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Master Status 2</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<tr><th>No</th><th>Nama Status 2</th><th>Jenis Status</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM masterstatus2 a, masterstatus b WHERE a.statusid=b.statusid ORDER BY a.statusid2 ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[namastatus2]</td>
             <td>$r[namastatus]</td>
             <td><a href=?module=status2&act=editstatus&id=$r[statusid2]><i class='menu-icon fa fa-edit' border=0 border=0 title='edit'></i></a> | 
	             <a href='./aksi.php?module=status2&act=hapus&id=$r[statusid2]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
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
  
  case "tambahstatus":
    echo "<form name='tambah' method=POST action='./aksi.php?module=status2&act=input' onSubmit=\"return validasi()\">";?>
		  <div class="card-header">
                            <strong class="card-title">Tambah status</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
          <tr><td>Nama Status 2</td>     <td> : <input type=text name='namastatus2' onBlur='validate(this)'></td></tr>
          <tr><td> Status </td>     <td> <select name="statusid" id="select" class="form-control">
		  <?php
		  echo "<option value='0' selected>:: Silahkan Pilih ::</option>";
		  $status=mysql_query("SELECT * FROM masterstatus ORDER BY statusid");
		  while ($s=mysql_fetch_array($status)){
			echo "<option value='$s[statusid]'>$s[namastatus]</option>";
			}
			echo "</select>";
                            				
			echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form></div>";
     break;
    
  case "editstatus":
    $edit=mysql_query("SELECT * FROM masterstatus2 WHERE statusid2='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form name='ganti' method=POST action='./aksi.php?module=status2&act=update' onSubmit=\"return edit()\">";?>
		  <div class="card-header">
                            <strong class="card-title">Edit status</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
		<?php		  
		  echo "<input type=hidden name='statusid2' value='$r[statusid2]'>
		  <tr><td>Nama Status2</td>     <td> : <input type=text name='namastatus2' value='$r[namastatus2]' onBlur='validate(this)'></td></tr>";?>
          <tr><td> Status </td>     <td> <select name="statusid" id="select" class="form-control">
		  <?php
		  $status=mysql_query("SELECT * FROM masterstatus ORDER BY statusid");
		  while ($s=mysql_fetch_array($status)){
		  if($r[statusid]==$s[statusid]){
			echo "<option value='$s[statusid]' selected>$s[namastatus]</option>";
			}
			else{
			echo "<option value='$s[statusid]'>$s[namastatus]</option>";
			}
			}
			echo "</select>";
                            				
			echo "</td></tr><tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form></div>";
    break;  
}
?>
