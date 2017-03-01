<?php
session_start();
include_once "class/config.php";

$database = new Config();
$db = $database->getConnect();

include_once "class/logincs.php";
$in = new Logincs($db);

?>
<head>
<title>Elektronik Perpustakaan</title>
<link rel="stylesheet" type="text/css" href="css/display.css">
<link rel="stylesheet" type="text/css" href="css/form-element.css">
</head>

<body>
<div class="navbar">
		<li class="navmenu-text"><a href=#login>LOGIN</a></li>
		<li class="navmenu-text"><a href=#cari>CARI</a></li>
		<li class="navmenu-text"><a href=#berita>BERITA</a></li>
		<li class="navmenu-text"><a href=#agenda>AGENDA</a></li>
        <li class="navmenu-text dropdown"><a href=#profil>PROFIL</a>
        	<div class="dropdown-content">
        		<a href=#profil>COMPANY PROFILE</a>
       			<a href=#profil>STRUKTUR ORGANISASI</a>
       			<a href=#profil>LOKASI & KONTAK</a>
       			<a href=#profil>PERATURAN</a>
			</div>        
        </li>
		<li class="navmenu-text"><a href=index.html>HOME</a></li>
</div>
<div class="header">
</div>
<div class="content">

<form name="login" class="login" method="post" action="">
<h2 style="text-align: center; margin:0; padding:15px 0; font-family: 'Arial Black', Gadget, sans-serif;">LOGIN ANGGOTA</h2>
<input placeholder="ID ANGGOTA" type="text" id="id" name="id" class="input-textfield"><br><br>
<input placeholder="PASSWORD" type="text" name="pass" class="input-textfield"><br><br>
<input style="float:left;" type="submit" value="LOGIN">
<button style="float:right; background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;" type="button" ><a href="registrasi.php">REGISTER</button>

<?php
if ($_POST)
{

	if(empty($_POST["id"]))
	{
		?>
		<script language="javascript">
		alert("ID Anggota tidak boleh kosong!!");
		document.location="login.php";
		</script>
		<?php
	}

	else if(empty($_POST["pass"]))
	{
		?>
		<script language="javascript">
		alert("Password tidak boleh kosong!!");
		document.location="login.php";
		</script>
		<?php
	}

	else 
		{
			$cocok = $in->login($_POST["id"], $_POST["pass"], "AKTIF");
		
		if($cocok=="ADMIN")
		{
			$_SESSION['id'] = $cocok;
			$_SESSION['status'] = "AKTIF";
			header("location:administrator/cpanel-admin.php");
		}
		elseif($cocok=="ANGGOTA")
		{
			$_SESSION['id'] = $cocok;
			$_SESSION['status'] = "AKTIF";
			header("location:anggota/cpanel-anggota.php?&id=".$_POST['id']);
		}
		else 
		{
			// login gagal, beri peringatan dan kembali ke file index.php
			?>
			<script language="javascript">
			alert("Maaf, Data Belum Tersimpan!!");
			document.location="login.php";
			</script>
			<?php
		}
	}
}
?>
</form>
</div>
<div class="footer">
	<p class="foot">copyright by Pholenk Adi</p>
</div>
</body>
</html>