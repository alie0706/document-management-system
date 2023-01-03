<?php
session_start();
include "../inc/inc.koneksi.php";
include "../inc/library.php";
//This page contains edit the existing file by using fpdi.
require(dirname(__DIR__ ) . '/vendor/WatermarkPDF/WatermarkPDF.php');

$docid_d=$_GET['docid_d'];
$docid=$_GET['docid'];
$file = $_GET['file'];
$id_user=$_SESSION['userid'];
$namauser=$_SESSION['namauser'];
# ==========================
$pdfFile = dirname(__DIR__ ) . "/files/$file";
$watermark=mysql_query("SELECT * FROM watermark");
$w=mysql_fetch_array($watermark);
$watermarkText = $w['nama'];
$pdf = new WatermarkPDF($pdfFile, $watermarkText);
//$pdf = new FPDI();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);


/*$txt = "FPDF is a PHP class which allows to generate PDF files with pure PHP, that is to say " .
        "without using the PDFlib library. F from FPDF stands for Free: you may use it for any " .
        "kind of usage and modify it to suit your needs.\n\n";
for ($i = 0; $i < 25; $i++) {
    $pdf->MultiCell(0, 5, $txt, 0, 'J');
}*/
// $ifile = dirname(__DIR__ ) . "/files/$file"; // this is the actual path to the file you want to delete.
// unlink($pdfFile); // use server document root

unlink("../files/$file");
if($pdf->numPages>1) {
    for($i=2;$i<=$pdf->numPages;$i++) {
        //$pdf->endPage();
        $pdf->_tplIdx = $pdf->importPage($i);
        $pdf->AddPage();
    }
}
        $tampil=mysql_query("select * from dokumen_file where docid_d='$docid_d' AND docid='$docid'");
		$r=mysql_fetch_array($tampil); 
		
		//insert file lama ke table refisi
		// mysql_query("INSERT INTO dokumen_file_watermark(docid_d,
		// 						fileimage,
		// 						recmod,
		// 						id_user) 
		// 					VALUES('$r[docid_d]',
		// 						'$r[fileimage]',
		// 						'$recmod',
		// 						'$id_user')");	

		//update dokumen file refisi ke table file
        function UploadImage($fupload_name){
            //direktori gambar
            $vdir_upload = "../files/";
            $vfile_upload = $vdir_upload . $fupload_name;
          
           
              //Simpan gambar dalam ukuran sebenarnya
            
              
              
           }	
        //    $pdf->Output($vfile_upload);
		    // $lokasi_file = "file/";
			$nama_file   = "watermark_".$r['fileimage'];
			// Apabila ada gambar yang diupload
			UploadImage($pdf->Output("../files/".$r['fileimage']));
			mysql_query("UPDATE dokumen_file SET fileimage = '$nama_file',
										recmod ='$recmod',
                                        watermark='1'
								  where docid_d = '$docid_d' AND docid='$docid'");
			//mysql_query("UPDATE jenisfile SET status2='1' where fileid='$_POST[fileid]'");		
		 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$recmod','Refisi Upload file=$nama_file')");
		 	  
		echo "<script Language=\"JavaScript\">
		  window.alert (\"Watermark files success ..!\");
		  window.location = \"../media.php?module=menu&act=listdokumen&docid=$docid\";
		  </script>";
			

// $pdf->Output(); //If you Leave blank then it should take default "I" i.e. Browser
//$pdf->Output("sampleUpdated.pdf", 'D'); //Download the file. open dialogue window in browser to save, not open with PDF browser viewer
//$pdf->Output("save_to_directory_path.pdf", 'F'); //save to a local file with the name given by filename (may include a path)
//$pdf->Output("sampleUpdated.pdf", 'I'); //I for "inline" to send the PDF to the browser
//$pdf->Output("", 'S'); //return the document as a string. filename is ignored.
?>
