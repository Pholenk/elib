<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
include_once "../class/config.php";

$database = new Config();
$db = $database->getConnect();

include_once "../class/Anggotacs.php";
$in = new Anggotacs($db);
$id=$_GET["id"];
$anggota=$in->cari($id);

if((!($_SESSION['id']=="ANGGOTA")) and (!($_SESSION['status']=="AKTIF")))
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
	<li class="cpanel-menu-text active">PROFIL
    	<div class="menu-kiri-content">
    	<a href=cpanel-admin-anggota-ubah.php>Ubah Data Anggota</a>
      <a class="active" href=cpanel-anggota-tampil.php>Tampil Data Anggota</a>
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