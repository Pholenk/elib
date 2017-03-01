<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
$id=$_GET['id'];
include_once "class/config.php";//memanggil kelas

$database = new Config();//pembuatan objek baru
$db = $database->getConnect();//menjalankan koneksi

include_once "class/Anggotacs.php";
$in = new Anggotacs($db);

if(!empty($id))
{
  $cetak = $in->cetak_verifikasi($id);
  foreach ($cetak as $data) 
  {
    $nama = $data["nama"];
    $tempat = $data["tempat_lahir"];
    $tgl = $data["tanggal_lahir"];
    $alamat = $data["alamat"];
    $telpon = $data["no_telpon"];
    $no = $data["no_pendaftaran"];
  }
}
else
{
  header("location:registrasi.php");
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KARTU VERIFIKASI</title>
</head>

<body>
<div align="center">
  <table width="75%" border="0">
    <tr>
      <td height="57" colspan="6"><div align="center">
        <h2>FORMULIR VERIFIKASI ANGGOTA</h2>
      </div></td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td width="6%">&nbsp;</td>
      <td width="18%" rowspan="6"><div align="center">FOTO</div></td>
      <td width="2%">&nbsp;</td>
      <td width="16%">NAMA</td>
      <td width="1%">:</td>
      <td width="57%"><?php echo $nama ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>TEMPAT LAHIR</td>
      <td>:</td>
      <td><?php echo $tempat ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>TANGGAL LAHIR</td>
      <td>:</td>
      <td><?php echo $tgl ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>ALAMAT</td>
      <td>:</td>
      <td><?php echo $alamat ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>TELEPON</td>
      <td>:</td>
      <td><?php echo $telpon ?></td>
    </tr>
    <tr>
      <td height="47">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td height="37" colspan="6"><div align="center">
        <h4><?php echo $no ?></h4>
      </div></td>
    </tr>
    <tr>
      <td height="47" colspan="6"><div align="center">
        <h3>e - LIBRARY POLITEKNIK CILACAP</h3>
      </div></td>
    </tr>
    <tr>
      <td height="21" colspan="6">*silahkan simpan / cetak halaman ini</td>
    </tr>
  </table>
</div>
</body>
</html>