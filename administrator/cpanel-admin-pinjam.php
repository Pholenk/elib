<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
include_once "../class/config.php";

$database = new Config();
$db = $database->getConnect();

include_once "../class/Pinjamcs.php";
$in = new Pinjamcs($db);

$d=strtotime("+7 Days");

$kp = $in->kodepinjam();

if((!($_SESSION['id']=="ADMIN")) and (!($_SESSION['status']=="AKTIF")))
{
  header("location:../login.php");
}

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>cpanel</title>
<link rel="stylesheet" type="text/css" href="../css/display.css">
<link rel="stylesheet" type="text/css" href="../css/form-element.css">
</head>

<body>
<div class="header">
</div>
<div class="cpanel-menu">
	<li class="cpanel-menu-text"><a href=cpanel-admin.php>Administrator</a></li>
	<li class="cpanel-menu-text">Anggota
    	<div class="menu-kiri-content">
    		<a href=cpanel-admin-anggota-registrasi.php>Registasi Anggota</a>
       		<a href=cpanel-admin-anggota-ubah.php>Ubah Data Anggota</a>
       		<a href=cpanel-admin-anggota-hapus.php>Hapus Data Anggota</a>
       		<a href=cpanel-admin-anggota-tampil.php>Tampil Data Anggota</a>
		</div>
	</li>
    <li class="cpanel-menu-text">Buku
    	<div class="menu-kiri-content">
    		<a href=cpanel-admin-buku-tambah.php>Tambah Data Buku</a>
       		<a href=cpanel-admin-buku-ubah.php>Ubah Data Buku</a>
       		<a href=cpanel-admin-buku-hapus.php>Hapus Data Buku</a>
       		<a href=cpanel-admin-buku-tampil.php>Tampil Data Buku</a>
		</div>
	</li>
    <li class="cpanel-menu-text active">Pinjam & Kembali
    	<div class="menu-kiri-content">
    		<a class="active" href=cpanel-admin-pinjam.php>Pinjam</a>
       		<a href=cpanel-admin-kembali.php>Kembali</a>
       		<a href=cpanel-admin-perpanjang.php>Perpanjang</a>
       		
		</div>
	</li>
    <li class="cpanel-menu-text">Berita Terkini
    	<div class="menu-kiri-content">
    		<a href=cpanel-admin-berita-baru.php>Berita Baru</a>
       		<a href=cpanel-admin-berita-tampil.php>Tampil Berita</a>
		</div>
	</li>
    <li class="cpanel-menu-text">Peraturan
    	<div class="menu-kiri-content">
    		<a href=cpanel-admin-aturan-tambah.php>Tambah Aturan</a>
       		<a href=cpanel-admin-aturan-tampil.php>Tampil Aturan</a>
            <a href=cpanel-admin-aturan-denda.php>Ubah Denda</a>
		</div>
	</li>
</div>
<div class="content">
<h2 style="text-align: center; margin:0; padding:15px 0; font-family: 'Arial Black', Gadget, sans-serif;">Peminjaman</h2>
	<div class="formulir">
	<form class="registrasi" name="registrasi" method="post" action="">
		<table>
        	<tr>
          	<td width="30%"><span class="formulir-text">ID Anggota</span></td>
          	<td class="regis"><span class="formulir-text">
            <input type="text" name="id_anggota" class="input-textfield" /></span></td>
	        </tr>
          <tr>
          	<td><span class="formulir-text">ISBN</span></td>
          	<td class="regis"><span class="formulir-text">
            <input type="text" name="isbn" class="input-textfield" /></span></td>
	        </tr>
          <tr><td></td></tr>
          <tr>
            <td><span class="formulir-text">Tanggal Kembali</span></td>
            <td class="regis"><span class="formulir-text"><?php echo date("Y/m/d", $d); ?></span></td>
          </tr>
           <?php
            if($_POST)
            {
              if(empty($_POST["id_anggota"]))
              {
                ?>
                <script language="javascript">
                alert("Id Anggota tidak boleh kosong");
                document.location="cpanel-admin-pinjam.php";
                </script>
                <?php
              }
              else if(empty($_POST["isbn"]))
              {
                ?>
                <script language="javascript">
                alert("ISBN tidak boleh kosong");
                document.location="cpanel-admin-pinjam.php";
                </script>
                <?php
              }
              else
              {
                $in->id_pinjam = $kp;
                $in->id_anggota = $_POST["id_anggota"];
                $in->isbn = $_POST["isbn"];
                $in->tgl_pinjam = date("Y/m/d");
                $in->tgl_kembali = date("Y/m/d", $d);
                $in->status= 'KELUAR';

                if($in->tambahpinjam()==TRUE)
                {
                  if($in->tambahdetailpinjam()==TRUE)
                  {
                    if($in->triggermin($_POST['isbn']))
                    {
                      
                    }
                  }
                }
                else
                {
                  ?>
                  <script language="javascript">
                  alert("data gagal disimpan");
                  document.location="cpanel-admin-pinjam.php";
                  </script>
                  <?php
                }
              }
            }
          ?>
		</table><br><br>
		<input type="submit" value="PINJAM">
	</form>
	</div>
</div>

<div class="footer">
	<p class="foot">copyright by Pholenk Adi</p>
</div>
</body>
</html>