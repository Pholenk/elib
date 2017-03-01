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

$id=$_GET['id'];
if(!empty($id))
{
  $pilih = $in->pilihdata($id);
  foreach ($pilih as $data) 
  {
    $no = $data["id_anggota"];
    $nama = $data["nama"];
    $noin = $data["no_identitas"];
    $jenis = $data["jenis_identitas"];
    $alamat = $data["alamat"];
    $tempat = $data["tempat_lahir"];
    $tgl = $data["tanggal_lahir"];
    $kerja = $data["pekerjaan"];
    $telpon = $data["no_telpon"];
  }
}
else
{
  header("location:cpanel-admin-anggota-tampil.php");
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
<h2 style="text-align: center; margin:0; padding:15px 0; font-family: 'Arial Black', Gadget, sans-serif;">Ubah Anggota</h2>
	<div class="formulir">
		<form class="registrasi" name="registrasi" method="post" action="">
            <table>
            	<tr>
                    <td width="24%"><span class="formulir-text">ID Anggota</span></td>
                    <td class="regis"><span class="formulir-text">
                    <?php echo $no; ?>
                    </span></td>
                </tr>
                <tr>
                    <td><span class="formulir-text">Password </span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="pass" class="input-textfield"/>
                    </span></td>
                </tr>
                <tr>
                    <td width="24%"><span class="formulir-text">No Identitas</span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="no_identitas" class="input-textfield"  value="<?php echo $noin; ?>" />
                    </span></td>
                </tr>
                <tr>
                    <td><span class="formulir-text">Jenis Identitas </span></td>
                    <td class="regis"><span class="formulir-text">
                      <select name="jns_identitas" class="input-textfield"/>
                      <?php if($jenis == "KTP")
                      {?>
                        <option selected>KTP</option>
                        <option>SIM</option>
                        <option>Kartu Pelajar</option>
                      <?php ;}
                      elseif($jenis == "SIM")
                      {?>
                        <option>KTP</option>
                        <option selected>SIM</option>
                        <option>Kartu Pelajar</option>
                      <?php ;}
                      elseif($jenis=="Kartu Pelajar")
                      {?>
                        <option>KTP</option>
                        <option>SIM</option>
                        <option selected>Kartu Pelajar</option>
                      <?php ;}
                      else
                      {?>
                        
                        
                      <?php ;}
                      ?>
                      
                      </select>              
                    </span></td>
                </tr>
                <tr>
                    <td><span class="formulir-text">Nama Lengkap</span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="nama" class="input-textfield"  value="<?php echo $nama ?>" />
                    </span></td>
                </tr>
                <tr>
                    <td><span class="formulir-text">Alamat</span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="alamat" class="input-textfield"  value="<?php echo $alamat ?>" />
                    </span></td>
                </tr>
                <tr>
                    <td><span class="formulir-text">Tempat Lahir</span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="tmp_lahir" class="input-textfield"  value="<?php echo $tempat ?>" />
                    </span></td>
                </tr>
                <tr>
                    <td><span class="formulir-text">Tanggal Lahir </span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="tgl_lahir" class="input-textfield"  value="<?php echo $tgl ?>" />
                    </span></td>
                </tr>
                <tr>
                    <td><span class="formulir-text">Pekerjaan </span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="kerja" class="input-textfield"  value="<?php echo $kerja ?>" />
                    </span></td>
                </tr>
                <tr>
                    <td><span class="formulir-text">No Telepon </span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="telp" class="input-textfield"  value="<?php echo $telpon ?>" />
                    </span></td>
                </tr>
                
            </table><br><br>
			<input type="submit" class="register" value="UBAH">
      <?php
        if($_POST)
        {
          if(empty($_POST["jns_identitas"]))
          {
            ?>
            <script language="javascript">
            alert("jenis identitas tidak boleh kosong");
            document.location="cpanel-admin-anggota-ubah.php";
            </script>
            <?php
          }
          else if(empty($_POST["nama"]))
          {
            ?>
            <script language="javascript">
            alert("nama tidak boleh kosong");
            document.location="cpanel-admin-anggota-ubah.php";
            </script>
            <?php
          }
          else if(empty($_POST["alamat"]))
          {
            ?>
            <script language="javascript">
            alert("alamat tidak boleh kosong");
            document.location="cpanel-admin-anggota-ubah.php";
            </script>
            <?php
          }
          else if(empty($_POST["tmp_lahir"]))
          {
            ?>
            <script language="javascript">
            alert("tempat lahir tidak boleh kosong");
            document.location="cpanel-admin-anggota-ubah.php";
            </script>
            <?php
          }
          else if(empty($_POST["tgl_lahir"]))
          {
            ?>
            <script language="javascript">
            alert("tanggal lahir tidak boleh kosong");
            document.location="cpanel-admin-anggota-ubah.php";
            </script>
            <?php
          }
          else if(empty($_POST["kerja"]))
          {
            ?>
            <script language="javascript">
            alert("pekerjaan tidak boleh kosong");
            document.location="cpanel-admin-anggota-ubah.php";
            </script>
            <?php
          }
          else if(empty($_POST["telp"]))
          {
            ?>
            <script language="javascript">
            alert("no. telepon tidak boleh kosong");
            document.location="cpanel-admin-anggota-ubah.php";
            </script>
            <?php
          }
          else if(empty($_POST["pass"]))
          {
            ?>
            <script language="javascript">
            alert("password tidak boleh kosong");
            document.location="cpanel-admin-anggota-ubah.php";
            </script>
            <?php
          }

          else
          {
            $in->pass = $_POST["pass"];
            $in->jenis = $_POST["jns_identitas"];
            $in->NoIn = $_POST["no_identitas"];
            $in->nama = $_POST["nama"];
            $in->alamat = $_POST["alamat"];
            $in->TL = $_POST["tmp_lahir"];
            $in->Tgl = $_POST["tgl_lahir"];
            $in->Pr = $_POST["kerja"];
            $in->NoTlp = $_POST["telp"];
            
            if($in->cek_anggota($no)==TRUE)
            {
              if($in->ubahanggota($no)==TRUE)
              {
                if($in->ubahdetailanggota($no)==TRUE)
                {
                  ?>
                  <script language="javascript">
                  alert("data berhasil disimpan");
                  document.location="cpanel-admin-anggota-ubah.php";
                  </script>
                  <?php
                }
                else
                {
                  ?>
                  <script language="javascript">
                  alert("maaf, data gagal disimpan");
                  document.location="cpanel-admin-anggota-ubah.php";
                  </script>
                  <?php
                }
              }
              else
              {
                ?>
                <script language="javascript">
                alert("maaf, data gagal disimpan");
                document.location="cpanel-admin-anggota-ubah.php";
                </script>
                <?php
              }
            }
            else
            {
              ?>
              <script language="javascript">
              alert("maaf, data gagal disimpan");
              document.location="cpanel-admin-anggota-ubah.php";
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