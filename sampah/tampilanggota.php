<html>
<?php
session_start();
include_once "class/config.php";

$database = new Config();
$db = $database->getConnect();

include_once "class/Anggotacs.php";
$in = new Anggotacs($db);

?>
<head>
<title>Anggota</title>
</head>
<body>
<?php
if(!empty(isset($_POST['id_anggota'])))
{
	$in->id_anggota = $_POST['id_anggota'];
	$in->pass = $_POST['pass'];
  $in->NoPen = $_POST['no_pendaftaran'];
  $in->NoIn = $_POST['no_identitas'];
  $in->nama = $_POST['nama'];
  $in->alamat = $_POST['alamat'];
  $in->TL = $_POST['Semarang'];
  $in->Tgl = $_POST['1995/08/23'];
  $in->Pr = $_POST['Mahasiswa'];
  $in->NoTlp = $_POST['0805'];
  $in->status = $_POST['Belum Aktif'];

	$cocok = $in->tambahanggota();

	if($cocok==TRUE)
	{
    $masuk=$in->tambahdetailanggota();
    if($masuk==TRUE)
    {
      header("location:tampilanggota1.php");
    }
	}
	else 
	{
	 // login gagal, beri peringatan dan kembali ke file index.php
  		?>
  		
  		<?php
  	}
}
?>
<form method="POST" name="anggota">
<table width="45%" border="0">
      <tr>
        <td width="41%">ID ANGGOTA</td>
        <td width="59%"><input type="text" name="id_anggota" id="id_anggota"></td>
      </tr>
      <tr>
        <td>PASSWORD</td>
        <td><input type="text" name="pass" id="pass"></td>
      </tr>
	  
	  <tr>
        <td>No. Pendaftaran</td>
        <td><input type="text" name="no_pendaftaran" id="no_pendaftaran"></td>
      </tr>
	  <tr>
        <td>No. Identitas</td>
        <td><input type="text" name="no_identitas" id="no_identitas"></td>
      </tr>
	  <tr>
        <td>Nama</td>
        <td><input type="text" name="nama" id="nama"></td>
      </tr>
	  <tr>
        <td>Alamat</td>
        <td><input type="text" name="alamat" id="alamat"></td>
      </tr>
</table>
<input type="submit" name="simpan" id="simpan" value="SIMPAN">
<input type="submit" name="hapus" id="hapus" value="HAPUS">
</form>
</body>
</html>