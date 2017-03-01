<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
include_once "../class/config.php";

$database = new Config();
$db = $database->getConnect();

include_once "../class/Bukucs.php";
$in = new Bukucs($db);

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
    <li class="cpanel-menu-text active">Buku
    	<div class="menu-kiri-content">
    		<a href=cpanel-admin-buku-tambah.php>Tambah Data Buku</a>
       		<a href=cpanel-admin-buku-ubah.php>Ubah Data Buku</a>
       		<a class="active" href=cpanel-admin-buku-hapus.php>Hapus Data Buku</a>
       		<a href=cpanel-admin-buku-tampil.php>Tampil Data Buku</a>
		</div>
	</li>
    <li class="cpanel-menu-text">Pinjam & Kembali
    	<div class="menu-kiri-content">
    		<a href=cpanel-admin-pinjam.php>Pinjam</a>
       		<a href=cpanel-admin-kembali.php>Kembali</a>
       		<a href=cpanel-admin-perpanjang.php>Perpanjang</a>
       		<a href=cpanel-admin-pinjam-cari.php>Tampil Data Peminjaman</a>
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
<h2 style="text-align: center; margin:0; padding:15px 0; font-family: 'Arial Black', Gadget, sans-serif;">Hapus Buku</h2>
	<div class="formulir">
	<form class="registrasi" name="registrasi" method="post" action="">
		<table>
        	<tr>
            	<td width="24%"><span class="formulir-text">ISBN</span></td>
            	<td class="regis"><span class="formulir-text">
                <input type="text" name="isbn" class="input-textfield" /></span></td>
	        </tr>
		</table><br><br>
		<input type="submit" value="HAPUS">
    <?php
    if($_POST)
    {
      if(empty($_POST['isbn']))
      {
        ?>
        <script language="javascript">
        alert("isbn tidak boleh kosong");
        document.location="cpanel-admin-buku-hapus.php";
        </script>
        <?php        
      }
      else
      {
        if($in->cek_buku($_POST['isbn'])==TRUE)
        {
          if($in->hapusbuku($_POST['isbn'])==TRUE)
      {
        ?>
        <script language="javascript">
        alert("data berhasil disimpan");
        document.location="cpanel-admin-buku-tampil.php";
        </script>
        <?php
      }
      else
      {
        ?>
        <script language="javascript">
        alert("data gagal disimpan");
        document.location="cpanel-admin-buku-hapus.php";
        </script>
        <?php
      }
        }
      }
    }
    ?>
	</form>
	</div>
</div>

<div class="footer">
	<p class="foot">copyright by Pholenk Adi</p>
</div>
</body>
</html>