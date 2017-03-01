<?php
class Aturancs
{
	private $conn;
	public $id_aturan;
	public $isi_aturan;
	public $nom_denda;
	
	public function __construct($db)
	{
		$this->conn=$db;
	}

	function kodeaturan()
	{
		//$this->conn->beginTransaction();
		$sql = "SELECT RIGHT(MAX(id_aturan),4) as j from aturan";
		$result = $this->conn->prepare($sql);
		$result->execute();
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if ($result->rowCount() > 0) 
		{
			foreach ($result->fetchAll() as $row) 
			{
				extract($row);
				$a=$row["j"]+1;
				$kode="AR000".$a;
			}
			return $kode;
		}
	}
	
	public function tambahaturan()
	{		
			$sql = "INSERT INTO aturan (id_aturan, isi_aturan) VALUES (:id,:isi)";
			$result = $this->conn->prepare($sql);
			$result->bindParam(':id', $this->id_aturan);
			$result->bindParam(':isi', $this->isi_aturan);
			
			if($result->execute())
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
	}
	
	public function ubahdenda()
	{
		$id="DND00";
			$sql = "UPDATE denda SET nom_denda = :isi WHERE id_denda = :id";
			$result = $this->conn->prepare($sql);
			$result->bindParam(':id', $id);
			$result->bindParam(':isi', $this->nom_denda);
			
			if($result->execute())
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
	
	}
	
	public function ubahaturan($id)
	{
			$sql = "UPDATE aturan SET isi_berita = ':isi' WHERE id_berita = ':id'";
			$result = $this->conn->prepare($sql);
			$result->bindParam(':id', $id);
			$result->bindParam(':isi', $this->isi_berita);
			
			if($result->execute())
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
	
	}
	
	public function tampilaturan()
	{
		$sql = "SELECT * FROM aturan";
		$result = $this->conn->prepare($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		if($result->rowCount() > 0)
		{
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
}