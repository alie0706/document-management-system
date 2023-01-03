<?php
session_start();
error_reporting(0);
include "inc/inc.koneksi.php";
include "inc/library.php";
include "inc/fungsi_indotgl.php";
include "inc/fungsi_combobox.php";
include "inc/class_paging.php";
include "inc/fungsi_rupiah.php";
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
 // echo "<center><img src=images/tab-protect-sign.png>";
  include "index.php";
}
else{
$mod = $_GET['module'];
$thn_jam_sekarang = date("Y-m-d H:i:s");
$id_user=$_SESSION['userid'];
$namauser=$_SESSION['namauser'];
$role=mysql_query("select * from roleuser WHERE id_user='$id_user'");
$ro=mysql_fetch_array($role);
?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: DMS APPLICATION ::</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
	
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/styles.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->
<?php
if($_SESSION['leveluser']=='admin'){?>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">ADMINISTRATOR</a>
                <a class="navbar-brand hidden" href="./">ADM</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="?module=home"> <i class="menu-icon fa fa-dashboard"></i>DASHBOARD </a>
                    </li>
					
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>MASTER</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="?module=departemen">MASTER DEPARTEMEN</a></li>
                            <li> <i class="menu-icon fa fa-user"></i><a href="?module=user">USER </a>
                    </li>
                    </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="?module=menu"> <i class="menu-icon fa fa-file-text-o"></i>DOCUMENT </a>
                        
                    </li>
					<li class="">
                        <a href="?module=verifikasi"> <i class="menu-icon fa fa-external-link"></i>APPROVE DOCUMENT </a>
                    </li>
					 
					 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gear"></i>SETTING</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li> <i class="menu-icon fa fa-exclamation-triangle"></i><a href="?module=notification">NOTIFIKASI </a>
                             <li> <i class="menu-icon fa fa-pencil-square"></i><a href="?module=watermark">WATERMARK </a></li>
                            <li> <i class="menu-icon fa fa-archive"></i><a href="?module=history"> HISTORY LOG </a></li>
                             <li> <i class="menu-icon fa fa-floppy-o"></i><a href="?module=backup">BACKUP DATA </a></li>
                    </li>
                    
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
	 <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form" method="POST" action="media.php?module=menu&act=search">
                                <input class="form-control mr-sm-2" type="text" name="kata" placeholder="Full Text Search ..." aria-label="Search">
                                <input type="submit" value="cari"><button><i class="fa fa-close"></i></button>
                            </form>
                        </div>
					<?php
                    if($_SESSION['leveluser']=='admin'){
					$ceck=mysql_query("SELECT COUNT(docid) AS jml FROM dokumen_file WHERE approve='0'");
                    }
                    else{
                        $ceck=mysql_query("SELECT COUNT(docid) AS jml FROM dokumen_file WHERE approve='0' AND departemenid='$_SESSION[departemenuser]'");
                    }
					$c=mysql_fetch_array($ceck);
					$jml=$c['jml'];
					?>
                        <div class="dropdown for-message">
                          <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-email"></i>
                            <span class="count bg-primary"><?php echo "$jml";?></span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="message">
                            
                            <a class="dropdown-item media bg-flat-color-4" href="?module=verifikasi">
                                <span class="message media-body">
                                    <span class="name float-left">Silahkan klik link ini</span>
                            </a>
                            
                          </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/orang.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                                
                                <a class="nav-link" href="index.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                   
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
<?php
}

else {?>
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><?php echo "$_SESSION[namalengkap]";?></a>
                <a class="navbar-brand hidden" href="./"><?php echo "$_SESSION'";?></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="?module=home"> <i class="menu-icon fa fa-dashboard"></i>DASHBOARD </a>
                    </li>
					
                <li class="">
                        <a href="?module=menu"> <i class="menu-icon ti-email"></i>DOCUMENT </a>
                    </li>
				<?php
                if($ro['approve']=='1'){
                    ?>
                    <li class="">
                        <a href="?module=verifikasi"> <i class="menu-icon ti-email"></i>APPROVE DOCUMENT </a>
                    </li>
                    <?php
                }
                else{

                }	
				?>	
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
 <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form" method="POST" action="media.php?module=menu&act=search">
                                <input class="form-control mr-sm-2" type="text" name="kata" placeholder="Full Text Search ..." aria-label="Search">
                                <input type="submit" value="cari"><button><i class="fa fa-close"></i></button>
                            </form>
                        </div>
					<?php
					$ceck=mysql_query("SELECT COUNT(docid) AS jml FROM dokumen_file WHERE approve='0' AND departemenid='$_SESSION[departemenuser]'");
					$c=mysql_fetch_array($ceck);
					$jml=$c['jml'];
					?>
                        <div class="dropdown for-message">
                          <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-email"></i>
                            <span class="count bg-primary"><?php echo "$jml";?></span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="message">
                            
                            <a class="dropdown-item media bg-flat-color-4" href="?module=verifikasi">
                                <span class="message media-body">
                                    <span class="name float-left">Silahkan klik link ini</span>
                            </a>
                            
                          </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/orang.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                                
                                <a class="nav-link" href="index.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                   
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
<?php

}
// 
?>

   

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
            <div class="page-header float-right">
                    <div class="col-lg-12 col-md-10 col-12">
                    <form id="myform" action="media.php?module=menu&act=search_data" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <select class="form-control select2bs4" name=cari_data id="country_code" style="width: 100%">
                            <option value='namafile'>File Name</option>
                                                <option value='namaimage'>File Image</option>
                                                <option value='metadata'>Metadata</option>
                        </select>
                        </div>
                        <input type="text" name="kata" class="form-control" placeholder="Enter search file">
                        <input type="submit" value="Go" >
                    </div>

                </div>
                </form>
            </div>
        </div>
        
        </div>

        <div class="content mt-3">
	<?php
		if ($mod=='home'){
		mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Home')");
		?>
					<div class="col-sm-12">
                <div class="alert  alert-primary alert-dismissible fade show" role="alert">
                  <span class="badge badge-pill badge-danger">Success Selamat Data di Aplikasi Document Management System.</span>
				  <img class="user-avatar rounded-circle" src="images/login.png">
                    
                </div>
            </div>
			<?php
			}
			elseif ($mod=='menu'){

			mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Menu Documents')");
			   include "menu.php";
			}
			elseif ($mod=='akses'){
				include "modul/akses.php";
			}
			elseif ($mod=='backup'){
				include "backup/backup.php";
			}

			elseif ($mod=='close'){
			mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Close')");
			   include "index.php";
			}
			elseif ($mod=='history'){
				include "modul/history.php";
			}
			elseif ($mod=='verifikasi'){
				include "modul/verifikasi.php";
			}
            elseif ($mod=='watermark'){
				include "modul/watermark.php";
			}
			elseif ($mod=='historydocuments'){
				include "modul/historydocuments.php";
			}
			elseif ($mod=='import'){
            include "modul/import.php";
            }
			// Bagian permohonan
			elseif ($_GET['module']=='password'){
			  include "modul/password.php";
			}
			elseif ($mod=='user'){
				include "modul/user.php";
			}
			elseif ($mod=='departemen'){
				include "modul/departemen.php";
			}
			elseif ($mod=='type'){
				include "modul/type.php";
			}
			elseif ($mod=='notification'){
				include "modul/notification.php";
			}
			elseif ($mod=='docin'){
				include "modul/docin.php";
			}
			elseif ($mod=='verifikasidoc'){
				include "modul/verifikasidoc.php";
			}
			else{
			  echo "<b>MODUL BELUM ADA ATAU BELUM LENGKAP SILAHKAN BUAT SENDIRI</b>";
			}
			?>


          

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );

        
    </script>


<script>

$(document).ready(function(){

 $.ajax({

   url: "dokumen.php",

   method:"POST",

   dataType: "json",      

   success: function(data) 

   {

  $('#treeview').treeview({data: data});

   }  

 });

});

</script>

</body>
</html>
<?php
}
?>