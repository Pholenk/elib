<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
session_start();
include_once "../class/config.php";

$database = new Config();
$db = $database->getConnect();

include_once "../class/Anggotacs.php";
$in = new Anggotacs($db);
$id=$_GET['id'];

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
    <li class="cpanel-menu-text active"><a class="active" href=cpanel-anggota.php>Anggota</a></li>
        <li class="cpanel-menu-text">PROFIL
            <div class="menu-kiri-content">
                <a href=cpanel-anggota-ubah.php?&id=<?php echo $id ?>>Ubah Data Anggota</a>
                <a href=cpanel-anggota-tampil.php?&id=<?php echo $id ?>>Tampil Data Anggota</a>
            </div>
        </li>
</div>
<div class="content">
</div>

<div class="footer">
	<p class="foot">copyright by Pholenk Adi</p>
</div>
</body>
</html>