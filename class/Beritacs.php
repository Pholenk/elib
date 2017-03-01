<?php
class Beritacs
{
	private $conn;
	public $id_berita;
	public $judul;
	public $isi_berita;
	public $tanggal_berita;
	public $status;
	
	public function __construct($db)
	{
		$this->conn=$db;
	}

	function kodeberita()
	{
		//$this->conn->beginTransaction();
		$sql = "SELECT RIGHT(MAX(id_berita),4) as j from berita";
		$result = $this->conn->prepare($sql);
		$result->execute();
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if ($result->rowCount() > 0) 
		{
			foreach ($result->fetchAll() as $row) 
			{
				extract($row);
				$a=$row["j"]+1;
			}
			if($a>=0000 && $a<=0008)
			{
				$kode="BR000".$a;
			}
			else if($a>=0009 && $a<=0098)
			{
				$kode="BR00".$a;
			}
			else if($a>=0099 && $a<=0998)
			{
				$kode="BR0".$a;
			}
			else if($a>=0999 && $a<=9998)
			{
				$kode="BR".$a;
			}
			return $kode;
		}
	}
	
	public function tambahberita()
	{		
			$sql = "INSERT INTO berita (id_berita, judul, tanggal_berita, isi_berita,status) 
			VALUES (:id_berita,:judul,:isi_berita,:tanggal_berita,'TAMPIL')";
			$result = $this->conn->prepare($sql);
			$result->bindParam(':id_berita', $this->id_berita);
			$result->bindParam(':judul', $this->judul);
			$result->bindParam(':isi_berita', $this->tanggal_berita);
			$result->bindParam(':tanggal_berita', $this->isi_berita);
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
	
	public function ubahberita($id)
	{
		$sql = "UPDATE berita SET judul = :judul, isi_berita = :isi_berita, tanggal_berita = :tanggal_berita,
		WHERE id_berita = :id_berita";
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_berita', $id);
		$result->bindParam(':judul', $this->judul);
		$result->bindParam(':isi_berita', $this->tanggal_berita);
		$result->bindParam(':tanggal_berita', $this->isi_berita);
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	
	}
	
	public function tampilberita()
	{
		$sql = "SELECT id_berita, tanggal_berita, judul, isi_berita FROM berita ";
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_berita', $this->id_berita);		
		$result->execute();
		$num=$result->rowCount();

		if($num>0)
		{
			$result->setFetchMode(PDO::FETCH_ASSOC);
			foreach ($result->fetchAll() as $num)
			{
				extract($num);
				$data[]=$num;
			}
			return $data;
		}
		else
		{
			$data=0;
			return $data;
		}
	}
	
	
	public function hapusberita()
	{		
			$sql = "UPDATE berita SET status = 'TIDAK TAMPIL' WHERE id_berita = :id_berita";
			$result = $this->conn->prepare($sql);
			$result->bindParam(':id_berita', $this->id_berita);		
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
