<?php
require(dirname(__DIR__) .'/fpdf/fpdf.php');
require_once dirname(__DIR__) .'/FPDI/fpdi.php';

class WatermarkPDF extends FPDI {

    public $_tplIdx;
    public $angle = 0;
    public $fullPathToFile;
    public $rotatedText = 'DOKUMEN ASLI';

    function __construct($fullPathToFile, $rotate_text) {
        $this->fullPathToFile = $fullPathToFile;
        if ($rotate_text)
            $this->rotatedText = $rotate_text;
        parent::__construct();
    }

    function Rotate($angle, $x = -1, $y = -1) {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    function _endpage() {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }
    function letak($gambar){
        //memasukkan gambar untuk header
        // $posisi="../images/";
        // $logo=$this->rotatedImg;
        // $tlogo=$posisi.$logo;
        $this->Image($gambar, 45, 110, 120, 50);
        // $this->Image($gambar,10,10,20,25);
        //menggeser posisi sekarang
        }
    function garis(){
        $this->SetLineWidth(1);
        $this->Line(10,36,138,36);
        $this->SetLineWidth(0);
        $this->Line(10,37,138,37);
        }
        function judul(){
			$this->SetFont('Arial', 'B', 50);
            // $this->SetTextColor(233,233,233);
            // $this->RotatedText(50, 190, $this->rotatedText, 35);
            
        $this->SetTextColor(255, 192, 203);
        $this->RotatedText(50, 230, $this->rotatedText, 45);
            }
			function judul2(){
				$this->SetFont('Arial', 'B', 50);
				// $this->SetTextColor(233,233,233);
				// $this->RotatedText(75, 190, $this->rotatedText, 35);
                
        $this->SetTextColor(255, 192, 203);
        $this->RotatedText(50, 230, $this->rotatedText, 45);
				}
    function Header() {
        //Put the watermark
       
        // $this->SetTitle('<watermarktext content="DRAFT" alpha="0.4" />');
        if ($this->fullPathToFile) {
            if (is_null($this->_tplIdx)) {
                // THIS IS WHERE YOU GET THE NUMBER OF PAGES
                $this->numPages = $this->setSourceFile($this->fullPathToFile);
                $this->_tplIdx = $this->importPage(1);
            }
            $this->useTemplate($this->_tplIdx, 0, 0, 200);
        }
    }

    function RotatedText($x, $y, $txt, $angle) {
        //Text rotated around its origin
        
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

}
