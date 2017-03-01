<html>
<?php
session_start();
include_once "class/config.php";

$database = new Config();
$db = $database->getConnect();

include_once "class/logincs.php";
$in = new Logincs($db);

?>
<head>
<title>login</title>
</head>
<body>
<?php
if(isset($_POST['id']) and isset($_POST['pass']))
{
	$in->ID = $_POST['id'];
	$in->PASS = $_POST['pass'];
	$cocok = $in->tambah();

	if($cocok==TRUE)
	{
		header("location:tampillogin.php");
	}
	else 
	{
	 // login gagal, beri peringatan dan kembali ke file index.php
  		?>
  		<script language="javascript">
		alert("Maaf, Data Belum Tersimpan!!");
		document.location="tampillogin1.php";
		</script>
  		<?php
  	}
}
?>
<form method="POST" name="login">
<table width="45%" border="0">
      <tr>
        <td width="41%">ID ANGGOTA</td>
        <td width="59%"><input type="text" name="id" id="id"></td>
      </tr>
      <tr>
        <td>PASSWORD</td>
        <td><input type="text" name="pass" id="pass"></td>
      </tr>
</table>
<input type="submit" name="login" id="login" value="LOG IN">
</form>
</body>
</html>