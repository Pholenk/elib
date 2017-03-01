<?php
class agendacs
{
	private $conn;
	public $id_agenda;
	public $judul;
	public $isi_agenda;
	public $tanggal_agenda;
	public $status;
	
	public function __construct($db)
	{
		$this->conn=$db;
	}
	
	public function tambahagenda()
	{		
			$sql = "INSERT INTO agenda(id_agenda,judul,isi_agenda,tanggal_agenda,status) 
			VALUES (:id_agenda,:judul,isi_agenda,:tanggal_agenda,'Ada')";
			
			$result = $this->conn->prepare($sql);
			$result->bindParam(':id_agenda', $result->id_agenda);
			$result->bindParam(':judul', $result->judul);
			$result->bindParam(':isi_agenda', $result->isi_agenda);
			$result->bindParam(':tanggal_agenda', $result->tanggal_agenda);
			$result->bindParam(':status', $result->status);
			
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
	
	public function ubahagenda()
	{
			$sql = " UPDATE agenda SET 
			judul = :judul, isi_agenda = :isi_agenda, tanggal_agenda = :tanggal_agenda WHERE id_agenda = :id_agenda";
			
			$result = $this->conn->prepare($sql);
			$result->bindParam(':id_agenda', $result->id_agenda);
			$result->bindParam(':judul', $result->judul);
			$result->bindParam(':isi_agenda', $result->isi_agenda);
			$result->bindParam(':tanggal_agenda', $result->tanggal_agenda);
			$result->bindParam(':status', $result->status);
			
			
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
	.
	+
	public function tampilagenda()
	{
		$sql = "SELECT * FROM agenda WHERE id_agenda = ':id_agenda'";
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id_agenda', $this->id_agenda);		
		$num=$result->rowCount();
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
	
	
	public function hapusagenda()
	{		
			$sql = "UPDATE agenda SET status = 'TIDAK TAMPIL' WHERE id_agenda = ':id_agenda'";
			$result = $this->conn->prepare($sql);
			$result->bindParam(':id_agenda', $this->id_agenda);		
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