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
$id=$_GET["id"];
if($id != 0)
{
  $buku = $in->pilihbuku($id);
  foreach ($buku as $data)
  {
    $isbn=$data['isbn'];
    $judul=$data['judul'];
    $penulis=$data['penulis'];
    $penerbit=$data['penerbit'];
    $tahun=$data['tahun_terbit'];
    $tempat=$data['tempat_terbit'];
    $edisi=$data['edisi'];
    $kategori=$data['kategori'];
    $deskripsi=$data['deskripsi_fisik'];
    $jumlah = $data['jumlah'];
  }
}
else
{
  header("location:cpanel-admin-buku-tampil.php");
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
    		<a href=cpanel-admin-anggota-registrasi.php>Registrasi Anggota</a>
       		<a href=cpanel-admin-anggota-ubah.php>Ubah Data Anggota</a>
       		<a href=cpanel-admin-anggota-hapus.php>Hapus Data Anggota</a>
       		<a href=cpanel-admin-anggota-tampil.php>Tampil Data Anggota</a>
		</div>
	</li>
    <li class="cpanel-menu-text active">Buku
    	<div class="menu-kiri-content">
    		<a href=cpanel-admin-buku-tambah.php>Tambah Data Buku</a>
       		<a class="active" href=cpanel-admin-buku-ubah.php>Ubah Data Buku</a>
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
<h2 style="text-align: center; margin:0; padding:15px 0; font-family: 'Arial Black', Gadget, sans-serif;">Ubah Buku</h2>
	<div class="formulir">
		<form class="registrasi" name="registrasi" method="post" action="">
            <table>
                <tr>
                    <td width="24%"><span class="formulir-text">ISBN</span></td>
                    <td class="regis"><span class="formulir-text">
                    <input type="text" name="isbn" class="input-textfield" value="<?php echo $isbn; ?>" />
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Judul</span></td>
                    <td class="regis">
                    <span class="formulir-text">
                    <input type="text" name="judul" class="input-textfield" value="<?php echo $judul; ?>"/>
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Penulis</span></td>
                    <td class="regis">
                    <span class="formulir-text"><input type="text" name="penulis" class="input-textfield" value="<?php echo $penulis; ?>" />
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Tahun Terbit</span></td>
                    <td class="regis">
                    <span class="formulir-text"><input type="text" name="th_terbit" class="input-textfield" value="<?php echo $tahun; ?>" /><br />
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Tempat Terbit</span></td>
                    <td class="regis">
                    <span class="formulir-text"><input type="text" name="tmpt_terbit" class="input-textfield" value="<?php echo $tempat; ?>"/>
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Penerbit</span></td>
                    <td class="regis">
                    <span class="formulir-text"><input type="text" name="penerbit" class="input-textfield" value="<?php echo $penerbit; ?>" /></span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Edisi</span></td>
                    <td class="regis">
                    <span class="formulir-text"><input type="text" name="edisi" class="input-textfield" value="<?php echo $edisi; ?>"/></span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Kategori</span></td>
                    <td class="regis">
                    <span class="formulir-text"><input type="text" name="kategori" class="input-textfield" value="<?php echo $kategori; ?>"/></span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Jumlah</span></td>
                    <td class="regis">
                    <span class="formulir-text"><input type="text" name="jumlah" class="input-textfield" value="<?php echo $jumlah; ?>"/></span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Deskripsi Fisik</span></td>
                    <td class="regis">
                    <span class="formulir-text"><textarea name="textarea" id="textarea" cols="45" rows="5"><?php echo $deskripsi; ?></textarea></span>
                    </td>
                  </tr>
                </table><br><br>
				<input type="submit" class="register" value="UBAH">
         <?php
          if($_POST)
          {
            if(empty($_POST["isbn"]))
            {
              ?>
              <script language="javascript">
              alert("ISBN tidak boleh kosong");
              document.location="cpanel-admin-buku-tambah.php";
              </script>
              <?php
            }
            else if(empty($_POST["judul"]))
            {
              ?>
              <script language="javascript">
              alert("Judul tidak boleh kosong");
              document.location="cpanel-admin-buku-tambah.php";
              </script>
              <?php
            }
            else if(empty($_POST["penulis"]))
            {
              ?>
              <script language="javascript">
              alert("Penulis tidak boleh kosong");
              document.location="cpanel-admin-buku-tambah.php";
              </script>
              <?php
            }
            else if(empty($_POST["th_terbit"]))
            {
              ?>
              <script language="javascript">
              alert("Tahun Terbit tidak boleh kosong");
              document.location="cpanel-admin-buku-tambah.php";
              </script>
              <?php
            }
            else if(empty($_POST["tmpt_terbit"]))
            {
              ?>
              <script language="javascript">
              alert("Tempat Terbit tidak boleh kosong");
              document.location="cpanel-admin-buku-tambah.php";
              </script>
              <?php
            }
            else if(empty($_POST["penerbit"]))
            {
              ?>
              <script language="javascript">
              alert("Penerbit tidak boleh kosong");
              document.location="cpanel-admin-buku-tambah.php";
              </script>
              <?php
            }
            else if(empty($_POST["edisi"]))
            {
              ?>
              <script language="javascript">
              alert("Edisi tidak boleh kosong");
              document.location="cpanel-admin-buku-tambah.php";
              </script>
              <?php
            }
            else if(empty($_POST["kategori"]))
            {
              ?>
              <script language="javascript">
              alert("Kategori tidak boleh kosong");
              document.location="cpanel-admin-buku-tambah.php";
              </script>
              <?php
            }
            elseif(empty($_POST["jumlah"]))
            {
              ?>
              <script language="javascript">
              alert("Jumlah tidak boleh kosong");
              document.location="cpanel-admin-buku-tambah.php";
              </script>
              <?php
            }
            elseif(empty($_POST["deskripsi"]))
            {
              ?>
              <script language="javascript">
              alert("Deskripsi tidak boleh kosong");
              document.location="cpanel-admin-buku-tambah.php";
              </script>
              <?php
            }
            else
            {
              if($in->cek_buku($_POST['isbn'])==TRUE)
              {
                $in->judul = $_POST['judul'];
                $in->penulis = $_POST['penulis'];
                $in->tahun_terbit = $_POST['th_terbit'];
                $in->tempat_terbit = $_POST['tmpt_terbit'];
                $in->penerbit = $_POST['penerbit'];
                $in->edisi = $_POST['edisi'];
                $in->kategori = $_POST['kategori'];
                $in->deskripsi_fisik = $_POST['deskripsi'];
                $in->jumlah = $_POST['jumlah'];

                if($in->ubahbuku($_POST['isbn'])==TRUE)
                {
                  ?>
                  <script language="javascript">
                  alert("data berhasil disimpan");
                  document.location="cpanel-admin-buku-tambah.php";
                  </script>
                  <?php
                }
                else
                {
                  ?>
                  <script language="javascript">
                  alert("data gagal disimpan");
                  document.location="cpanel-admin-buku-tambah.php";
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