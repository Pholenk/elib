<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
include_once "class/config.php";//memanggil kelas

$database = new Config();//pembuatan objek baru
$db = $database->getConnect();//menjalankan koneksi

include_once "class/Anggotacs.php";
$in = new Anggotacs($db);
$ka = $in->kodeanggota();
$kp = $in->kodedaftar();

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>registrasi</title>
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
    		<a href=#comprof>COMPANY PROFILE</a>
       		<a href=#struktur>STRUKTUR ORGANISASI</a>
       		<a href=#lokasi>LOKASI & KONTAK</a>
       		<a href=#peraturan>PERATURAN</a>
		</div>
	</li>
  <li class="navmenu-text"><a href=index.html>HOME</a></li>
</div>
<div class="header">
</div>

<div class="content">
	<h2 style="text-align: center; margin:0; padding:15px 0; font-family: 'Arial Black', Gadget, sans-serif;">Registrasi Anggota</h2>
	<div class="formulir">
		<form class="registrasi" name="registrasi" method="post" action="">
            <table>
                <tr>
                    <td width="24%"><span class="formulir-text">No Identitas</span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="no_identitas" class="input-textfield" />
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Jenis Identitas </span></td>
                    <td class="regis"><span class="formulir-text">
                      <select name="jns_identitas" class="input-textfield"/>
                      <option>KTP</option>
                      <option>SIM</option>
                      <option>Kartu Pelajar</option>
                      </select>              
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Nama Lengkap</span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="nama" class="input-textfield" />
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Alamat</span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="alamat" class="input-textfield" />
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Tempat Lahir</span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="tmp_lahir" class="input-textfield" />
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Tanggal Lahir </span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="tgl_lahir" class="input-textfield" />
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Pekerjaan </span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="kerja" class="input-textfield" />
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">No Telepon </span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="telp" class="input-textfield" />
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="formulir-text">Password </span></td>
                    <td class="regis"><span class="formulir-text">
                      <input type="text" name="pass" class="input-textfield" />
                    </span></td>
                  </tr>
                </table><br><br>
				<input type="submit" class="register" value="REGISTER">
        <?php
        if($_POST)
        {
          if(empty($_POST["no_identitas"]))
          {
            ?>
            <script language="javascript">
            alert("no. identitas tidak boleh kosong");
            document.location="registrasi.php";
            </script>
            <?php
          }
          else if(empty($_POST["jns_identitas"]))
          {
            ?>
            <script language="javascript">
            alert("jenis identitas tidak boleh kosong");
            document.location="registrasi.php";
            </script>
            <?php
          }
          else if(empty($_POST["nama"]))
          {
            ?>
            <script language="javascript">
            alert("nama tidak boleh kosong");
            document.location="registrasi.php";
            </script>
            <?php
          }
          else if(empty($_POST["alamat"]))
          {
            ?>
            <script language="javascript">
            alert("alamat tidak boleh kosong");
            document.location="registrasi.php";
            </script>
            <?php
          }
          else if(empty($_POST["tmp_lahir"]))
          {
            ?>
            <script language="javascript">
            alert("tempat lahir tidak boleh kosong");
            document.location="registrasi.php";
            </script>
            <?php
          }
          else if(empty($_POST["tgl_lahir"]))
          {
            ?>
            <script language="javascript">
            alert("tanggal lahir tidak boleh kosong");
            document.location="registrasi.php";
            </script>
            <?php
          }
          else if(empty($_POST["kerja"]))
          {
            ?>
            <script language="javascript">
            alert("pekerjaan tidak boleh kosong");
            document.location="registrasi.php";
            </script>
            <?php
          }
          else if(empty($_POST["telp"]))
          {
            ?>
            <script language="javascript">
            alert("no. telepon tidak boleh kosong");
            document.location="registrasi.php";
            </script>
            <?php
          }
          else if(empty($_POST["pass"]))
          {
            ?>
            <script language="javascript">
            alert("password tidak boleh kosong");
            document.location="registrasi.php";
            </script>
            <?php
          }

          else
          {
            if($in->cek_daftar($_POST['no_identitas'])==FALSE)
            {
              $in->id_anggota = $ka;
              $in->pass = $_POST["pass"];
              $in->NoPen = $kp;
              $in->jenis = $_POST["jns_identitas"];
              $in->NoIn = $_POST["no_identitas"];
              $in->nama = $_POST["nama"];
              $in->alamat = $_POST["alamat"];
              $in->TL = $_POST["tmp_lahir"];
              $in->Tgl = $_POST["tgl_lahir"];
              $in->Pr = $_POST["kerja"];
              $in->NoTlp = $_POST["telp"];
              $in->status = "TIDAK AKTIF";
              $in->stat = "ANGGOTA";

              if($in->tambahanggota()==TRUE)
              {
                if($in->tambahdetailanggota()==TRUE)
                {
                  ?>
                  <script language="javascript">
                  alert("data berhasil disimpan");
                  document.location="cetak.php?&id=<?php echo $kp ?>";
                  </script>
                  <?php
                }
                else
                {
                  ?>
                  <script language="javascript">
                  alert("maaf, data gagal disimpan");
                  document.location="registrasi.php";
                  </script>
                  <?php
                }
              }
              else
              {
                ?>
                <script language="javascript">
                alert("maaf, data gagal masuk");
                document.location="registrasi.php";
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