<?php

class pinjamcs
{
	private $conn;
	public $id_pinjam;
	public $id_anggota;
	public $isbn;
	public $tgl_pinjam;
	public $tgl_kembali;
	public $tgl_pengembalian;
	public $status;
	public $denda;
	
	public function __construct($db)
	{
		$this->conn=$db;
	}

	function kodepinjam()
	{
		$sql = "SELECT RIGHT(MAX(id_pinjam),4) as p from pinjam";
		$result = $this->conn->prepare($sql);
		
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if ($result->execute()) 
		{
			foreach ($result->fetchAll() as $row) 
			{
				extract($row);
				$a = $row["p"]+1;
			}

			if($a >= 0 && $a <= 9)
			{
				$kode = "P000".$a;
			}
			if($a >= 10 && $a <= 99)
			{
				$kode = "P00".$a;
			}
			if($a >= 100 && $a <= 999)
			{
				$kode = "P0".$a;
			}
			if($a >= 1000 && $a <= 9999)
			{
				$kode = "P".$a;
			}
			return $kode;
		}
	}

	function tambahpinjam()
	{		
		$sql = "INSERT INTO pinjam(id_pinjam,id_anggota) VALUES (:id_pinjam, :id_anggota)";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_pinjam',$this->id_pinjam);
		$result->bindParam(':id_anggota',$this->id_anggota);
		
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function tambahdetailpinjam()
	{		
		$sql = "INSERT INTO det_pinjam(id_pinjam,isbn,tgl_pinjam,tgl_kembali,status) VALUES (:id_pinjam,:isbn,:tgp,:tgk,:status)";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_pinjam',$this->id_pinjam);
		$result->bindParam(':isbn',$this->isbn);
		$result->bindParam(':tgp',$this->tgl_pinjam);
		$result->bindParam(':tgk',$this->tgl_kembali);
		$result->bindParam(':status',$this->status);
		
		if($result->execute())
		{
			//$_SESSION['pinjam'] = TRUE;//$_POST['id'];
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	function hapusdetail_pinjam($id_pinjam)
	{
		$sql = "UPDATE det_pinjam SET status = 'TIDAK AKTIF' WHERE id_pinjam = :id_pinjam";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_pinjam', $this->id_pinjam);
		
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function ubahpinjam($id_pinjam)
	{
		$sql = "UPDATE pinjam SET id_anggota = :id_anggota where id_pinjam = :id_pinjam";
		
		$result = $this->conn->prepare($sql);
		
		$result->bindParam(':id_pinjam', $this->id_pinjam);
		$result->bindParam(':id_anggota', $this->id_anggota);
		
		$num=$result->rowCount();
		if($num>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function ubahdet_pinjam($id_pinjam)
	{
		$sql = "UPDATE det_pinjam SET isbn = :isbn, tgl_pinjam = :tgl_pinjam, tgl_kembali = :tgl_kembali, status = :status, denda = :denda WHERE id_pinjam = :id_pinjam";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_buku', $this->id_buku);
		$result->bindParam(':tgl_pinjam', $this->tgl_pinjam);
		$result->bindParam(':tgl_kembali', $this->tgl_kembali);
		$result->bindParam(':status', $this->status);
		$result->bindParam(':denda', $this->denda);
		$result->bindParam(':id_pinjam', $this->id_pinjam);
		
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}	
	}

	function perpanjang($a, $b)
	{
		$sql = "UPDATE det_pinjam d SET d.tgl_kembali = :tgk WHERE d.id_pinjam = 
		(select p.id_pinjam from pinjam p where p.id_pinjam = d.id_pinjam and
			p.id_anggota= :id_anggota and d.isbn= :isbn and d.status= 'KELUAR')";

		$result = $this->conn->prepare($sql);
		$result->bindParam(':tgk', $this->tgl_kembali);
		$result->bindParam(':id_anggota', $a);
		$result->bindParam(':isbn', $b);

		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function kembali($id_anggota, $isbn)
	{
		$sql= "INSERT INTO kembali(id_pinjam, isbn, jumlah_denda, tgl_pengembalian)
		VALUES ((SELECT p.id_pinjam from pinjam p, det_pinjam d where p.id_pinjam=d.id_pinjam and
			p.id_anggota= :id_anggota and d.isbn= :isbn and d.status='KELUAR'),:isbn,:denda,:tgp)";
		
		$result=$this->conn->prepare($sql);
		$result->bindParam(':id_anggota', $id_anggota);
		$result->bindParam(':isbn', $isbn);
		$result->bindParam(':denda', $this->denda);
		$result->bindParam(':tgp', $this->tgl_pengembalian);

		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function hitung_denda($s)
	{
		$sql = "SELECT (SELECT nom_denda from denda) * :selisih as D";
		$result=$this->conn->prepare($sql);
		$result->bindParam(':selisih', $s);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		if ($result->execute()) 
		{
			foreach ($result->fetchAll() as $row) 
			{
				extract($row);
				$denda=$row['D'];
			}
			return $denda;
		}
	}

	function ambiltgk($id, $is)
	{
		$sql = "SELECT d.tgl_kembali as tgk FROM det_pinjam d where id_pinjam = (SELECT p.id_pinjam from pinjam p where p.id_pinjam=d.id_pinjam and
			p.id_anggota= :id_anggota and d.isbn= :isbn and d.status='KELUAR')";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_anggota', $id);
		$result->bindParam(':isbn', $is);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		if ($result->execute()) 
		{
			foreach ($result->fetchAll() as $row) 
			{
				extract($row);
				$denda=$row['tgk'];
			}
			return $denda;
		}
	}
	function triggermin($isbn) //mengurangi data jumlah buku
	{
		$sql = "UPDATE buku set jumlah = (select(select jumlah where isbn= :isbn)-1) where isbn= :isbn";
		$result = $this->conn->prepare($sql);
		$result->bindParam(':isbn', $isbn);
		
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}


	function triggerplus($isbn) //mengurangi data jumlah buku
	{
		$sql = "UPDATE buku set jumlah = (select(select jumlah where isbn= :isbn)+1) where isbn= :isbn";
		$result = $this->conn->prepare($sql);
		$result->bindParam(':isbn', $isbn);
		
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
}
?>