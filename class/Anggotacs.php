<?php

class Anggotacs //nama class
{
	//property
	private $conn;
	public $id_anggota;
	public $pass;
	public $NoPen;
	public $jenis;
	public $NoIn;
	public $nama;
	public $alamat;
	public $TL;
	public $Tgl;
	public $Pr;
	public $NoTlp;
	public $status;
	public $stat;
	
	public function __construct($db)
	{
		$this->conn=$db;
	}

	function cek_anggota($id)//cek anggota berdasar id_anggota
	{
		$sql = "SELECT * FROM anggota where id_anggota = :id";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id',$id);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		
		$num = $result->rowCount();
		if($num > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function cek_daftar($ni) //pengecekan berdasar no_identitas
	{
		$sql = "SELECT * FROM det_anggota where no_identitas = :ni";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':ni',$ni);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		
		$num = $result->rowCount();
		if($num > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function kodeanggota()//kode otomatis id_anggota
	{
		$sql = "SELECT RIGHT(MAX(id_anggota),4) as a from anggota";
		$result = $this->conn->prepare($sql);
		
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if ($result->execute()) 
		{
			foreach ($result->fetchAll() as $row)
			{
				extract($row);
				$a = $row["a"]+1;
			}

			if($a >= 0 && $a <= 9)
			{
				$kode = "A000".$a;
			}
			if($a >= 10 && $a <= 99)
			{
				$kode = "A00".$a;
			}
			if($a >= 100 && $a <= 999)
			{
				$kode = "A0".$a;
			}
			if($a >= 1000 && $a <= 9999)
			{
				$kode = "A".$a;
			}
			return $kode;
		}
	}

	function kodedaftar()//kode otomatis no_pendaftaran
	{
		$sql = "SELECT RIGHT(MAX(no_pendaftaran),4) as d from det_anggota";
		$result = $this->conn->prepare($sql);
		
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if ($result->execute())
		{
			foreach ($result->fetchAll() as $row) 
			{
				extract($row);
				$a=$row["d"]+1;
			}

			if($a >= 0 && $a <= 9)
			{
				$kode = "DT000".$a;
			}
			if($a >= 10 && $a <= 99)
			{
				$kode = "DT00".$a;
			}
			if($a >= 100 && $a <= 999)
			{
				$kode = "DT0".$a;
			}
			if($a >= 1000 && $a <= 9999)
			{
				$kode = "DT".$a;
			}
			return $kode;
		}
	}

	function tambahanggota()//menyimpan data di anggota
	{		
		$sql = "INSERT INTO anggota  VALUES (:id_anggota, :pass, :status)";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_anggota', $this->id_anggota);
		$result->bindParam(':pass', $this->pass);
		$result->bindParam(':status', $this->stat);

		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function tambahdetailanggota()//menyimpan data di det_anggota
	{		
		$sql = "INSERT INTO det_anggota (id_anggota,
			no_pendaftaran,
			jenis_identitas,
			no_identitas,
			nama,
			alamat,
			tempat_lahir,
			tanggal_lahir,
			pekerjaan,
			no_telpon,
			status)
			VALUES (:id_anggota, :NoPen, :jenis, :NoIn, :nama, :alamat, :TL, :Tgl, :Pr, :NoTlp, :status)";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_anggota', $this->id_anggota);
		$result->bindParam(':NoPen', $this->NoPen);
		$result->bindParam(':jenis', $this->jenis);
		$result->bindParam(':NoIn', $this->NoIn);
		$result->bindParam(':nama', $this->nama);
		$result->bindParam(':alamat', $this->alamat);
		$result->bindParam(':TL', $this->TL);
		$result->bindParam(':Tgl', $this->Tgl);
		$result->bindParam(':Pr', $this->Pr);
		$result->bindParam(':NoTlp', $this->NoTlp);
		$result->bindParam(':status', $this->status);
		
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function hapusdetail_anggota($id) //hapus berdasarkan id_anggota
	{
		$sql = "UPDATE det_anggota SET status = 'TIDAK AKTIF' WHERE id_anggota = :id_anggota";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_anggota', $id);
				
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function ubahanggota($id) //ubah data di tabel anggota berdasarkan id_anggota
	{
			$sql = "UPDATE anggota SET pass = :pass where id_anggota = :id_anggota";
			
			$result = $this->conn->prepare($sql);
			$result->bindParam(':id_anggota', $id);
			$result->bindParam(':pass', $this->pass);
			
			
			$num=$result->rowCount();
			if($result->execute())
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
	
	}
	
	function ubahdetailanggota($id) //ubah data di tabel det_anggota berdasarkan id_anggota
	{
			$sql = "UPDATE det_anggota SET jenis_identitas = :jenis, no_identitas = :noin, nama= :nama, alamat = :alamat, tempat_lahir= :tl, tanggal_lahir = :tgl, pekerjaan = :pr, no_telpon = :notlp WHERE id_anggota = :id";
			
			$result = $this->conn->prepare($sql);
			$result->bindParam(':jenis', $this->jenis);
			$result->bindParam(':noin', $this->NoIn);
			$result->bindParam(':nama', $this->nama);
			$result->bindParam(':alamat', $this->alamat);
			$result->bindParam(':tl', $this->TL);
			$result->bindParam(':tgl', $this->Tgl);
			$result->bindParam(':pr', $this->Pr);
			$result->bindParam(':notlp', $this->NoTlp);
			$result->bindParam(':id', $id);
			
			if($result->execute())
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
	
	}

	function verifikasi($np) //verifikasi anggota
	{
		$sql="UPDATE det_anggota SET status='AKTIF' where no_pendaftaran= :Nopen";
		$result = $this->conn->prepare($sql);
		$result->bindParam(':Nopen', $np);
		
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function pilihdata($id) //nampil data berdasarkan id_anggota
	{
		$sql="SELECT a.id_anggota, d.nama, d.no_identitas, d.jenis_identitas, d.alamat, d.tempat_lahir, d.tanggal_lahir, d.pekerjaan, d.no_telpon FROM anggota a, det_anggota d where a.id_anggota=d.id_anggota and a.id_anggota= :id";
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id', $id);
		
		if($result->execute())
			{
				$result->setFetchMode(PDO::FETCH_ASSOC);
				foreach ($result->fetchAll() as $num)
				{
					extract($num);
					$data[]=$num;
				}
				return $data;		
			}
	}

	function cari($id) //nampil data berdasarkan id_anggota
	{
		$sql="SELECT a.id_anggota, d.nama, d.status FROM anggota a, det_anggota d where a.id_anggota=d.id_anggota and a.id_anggota =:id";
		$result = $this->conn->prepare($sql);
		// d.no_identitas, d.jenis_identitas, d.alamat, d.tempat_lahir, d.tanggal_lahir, d.pekerjaan, d.no_telpon
		$result->bindParam(':id', $id);
		
		if($result->execute())
			{
				$result->setFetchMode(PDO::FETCH_ASSOC);
				foreach ($result->fetchAll() as $num)
				{
					extract($num);
					$data[]=$num;
				}
				return $data;		
			}
	}

	function tampildata()//nampil semua data
	{
		$sql="SELECT a.id_anggota, d.nama, d.status FROM anggota a, det_anggota d where a.id_anggota=d.id_anggota";
		$result = $this->conn->prepare($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		if($result->execute())
		{
			foreach ($result->fetchAll() as $num)
			{
				extract($num);
				$data[]=$num;
			}
			return $data;		
		}
	}

	function cetak_verivikasi($np)
	{
		$sql="SELECT d.no_pendaftaran, d.nama, d.tempat_lahir, d.tanggal_lahir, d.alamat, d.no_telpon FROM det_anggota d where d.no_pendaftaran=:np";
		$result = $this->conn->prepare($sql);
		$result->bindParam(':np',$np);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();

		if($result->rowCount == 1)
		{
			foreach ($result->fetchAll() as $num)
			{
				extract($num);
				$data[]=$num;
			}
			return $data;		
		}
	}

	function cetak_kartu($id)
	{
		$sql="SELECT d.id_anggota, d.nama, d.pekerjaan, d.alamat, d.no_telpon FROM det_anggota d where d.no_pendaftaran=:np";
		$result = $this->conn->prepare($sql);
		$result->bindParam(':np',$id);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();

		if($result->rowCount() == 1)
		{
			foreach ($result->fetchAll() as $num)
			{
				extract($num);
				$data[]=$num;
			}
			return $data;		
		}
	}	
}
?>