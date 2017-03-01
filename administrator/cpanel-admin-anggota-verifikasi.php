<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
include_once "../class/config.php";

$database = new Config();
$db = $database->getConnect();

include_once "../class/Anggotacs.php";
$in = new Anggotacs($db);

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
            <a class ="active" href=cpanel-admin-anggota-verifikasi.php>Verifikasi Anggota</a>
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
	<div class="formulir">
		<h2 style="text-align: center; margin:0; padding:15px 0; font-family: 'Arial Black', Gadget, sans-serif;">Verifikasi Anggota</h2>
    		<form class="registrasi" name="verifikasi" method="post" action="">
				<table>
					<tr>
						<td width="30%"><span class="formulir-text">No Pendaftaran</span>
						</td>
						<td class="regis">
							<span class="formulir-text">
        	    		    	<input type="text" name="no_pendaftaran" class="input-textfield" />
			                </span>
			            </td>
					</tr>
				</table><br><br>
                <input type="submit" value="Verify">
                <?php
                  if($_POST)
                  {
                    if(empty($_POST["no_pendaftaran"]))
                    {
                      ?>
                      <script language="javascript">
                      alert("no. pendaftaran tidak boleh kosong");
                      document.location="cpanel-admin-anggota-verifikasi.php";
                      </script>
                      <?php
                    }
                    else
                    {
                      $cocok = $in->verifikasi($_POST["no_pendaftaran"]);
                      if($cocok==TRUE)
                      {
                        ?>
                        <script language="javascript">
                        alert("data berhasil disimpan");
                        document.location="cetak_anggota.php?&id=<?php echo $_POST["no_pendaftaran"]?>";
                        </script>
                        <?php
                      }
                      else
                      {
                        ?>
                        <script language="javascript">
                        alert("maaf, data gagal disimpan");
                        document.location="cpanel-admin-anggota-verifikasi.php";
                        </script>
                        <?php
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