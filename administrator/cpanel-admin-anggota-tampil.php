<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
include_once "../class/config.php";

$database = new Config();
$db = $database->getConnect();

include_once "../class/Anggotacs.php";
$in = new Anggotacs($db);

$anggota=$in->tampildata();

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
  <li class="cpanel-menu-text active">Anggota
      <div class="menu-kiri-content">
        <a href=cpanel-admin-anggota-registrasi.php>Registrasi Anggota</a>
        <a href=cpanel-admin-anggota-verifikasi.php>Verifikasi Anggota</a>
          <a class="active" href=cpanel-admin-anggota-ubah.php>Ubah Data Anggota</a>
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
    <li class="cpanel-menu-text">Pinjam & Kembali
      <div class="menu-kiri-content">
        <a href=cpanel-admin-pinjam.php>Pinjam</a>
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
	<h2 style="text-align: center; margin:0; padding:15px 0; font-family: 'Arial Black', Gadget, sans-serif;">Tampil Anggota</h2>
    <br></br>
    <table >
	<th>ID Anggota</th>
	<th>Nama Angota</th>
	<th>Status Anggota</th>
  <th>Aksi</th>
	<tr class="tampil">
   <?php
        foreach ($anggota as $data) 
        {
          ?>
          <tr class="tampil">
          <td class="tampil"><?php echo $data["id_anggota"] ?></td>
          <td class="tampil"><?php echo $data["nama"] ?></td>
          <td class="tampil"><?php echo $data["status"] ?></td>
          <td class="tampil"><a class = "tabel" href="cpanel-anggota-ubah.php?&id=<?php echo $data["id_anggota"]; ?>"</a>Ubah </td>
          <?php
        }
      ?>
	</tr>
  </table>
</div>

<div class="footer">
	<p class="foot">copyright by Pholenk Adi</p>
</div>
</body>
</html>