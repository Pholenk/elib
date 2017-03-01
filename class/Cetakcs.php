<?php
// pendefinisian folder font pada FPDF
define('FPDF_FONTPATH', '../lib/fpdf/font/');
require('../lib/fpdf/fpdf.php');

// seperti sebelunya, kita membuat class anakan dari class FPDF
 class Cetakcs extends FPDF{

  function Header(){
   $this->Image('logo.png',1,1,2.25); // logo
   $this->SetTextColor(128,0,0); // warna tulisan
   $this->SetFont('Arial','B','12'); // font yang digunakan

   // membuat cell dg panjang 19 dan align center 'C'
   $this->Cell(19,1,'LAPORAN SISWA',0,0,'C');
   $this->Ln();
   $this->Cell(19,1,'Sekolah Sementara',0,0,'C');
   $this->Ln();
   $this->SetFont('Arial','B','9');
   $this->SetFillColor(192,192,192); // warna isi
   $this->SetTextColor(0,0,0); // warna teks untuk th
   $this->Cell(6);
   $this->Cell(1,1,'No','TB',0,'L',1); // cell dengan panjang 1
   $this->Cell(1,1,'Kode','TB',0,'L',1); // cell dengan panjang 1
   $this->Cell(2,1,'Nama','TB',0,'L',1); // cell dengan panjang 2
   $this->Cell(3,1,'Alamat','TB',0,'L',1); // cell dengan panjang 3
   // panjang cell bisa disesuaikan
   $this->Ln();
  }

  function Footer(){
   $this->SetY(-2,5);
   $this->Cell(0,1,$this->PageNo(),0,0,'C');
  } 
 }
 ?>