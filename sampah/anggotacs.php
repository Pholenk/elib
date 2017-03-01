<?php

class Anggotacs
{
	private $conn;
	public $id_anggota;
	public $pass;
	public $NoPen;
	public $NoIn;
	public $nama;
	public $alamat;
	public $TL;
	public $Tgl;
	public $Pr;
	public $NoTlp;
	public $status;
	//public $num;
	
	public function __construct($db)
	{
		$this->conn=$db;
	}

	public function tambahanggota()
	{		
			$sql = "INSERT INTO anggota VALUES ('".$this->id_anggota."','".$this->pass."')";
			
			$result = $this->conn->prepare($sql);
			//$result->bindParam($ID);
			//$result->bindParam($PASS);
			$result->execute();
			
			$num=$result->rowCount();
			if($num>0)
			{
				//$_SESSION['anggota'] = TRUE;//$_POST['id'];
				return TRUE;
			}
			else
			{
				return FALSE;
			}
	}
	
	public function tambahdetailanggota()
	{		
			$sql = "INSERT INTO det_anggota VALUES ('".$this->id_anggota."','".$this->NoPen."','".$this->NoIn."','".$this->nama."','".$this->alamat."',
			'".$this->TL."','".$this->Tgl."','".$this->Pr."','".$this->NoTlp."','".$this->status."')";
			
			$result = $this->conn->prepare($sql);
			//$result->bindParam($ID);
			//$result->bindParam($PASS);
			$result->execute();
			
			$num=$result->rowCount();
			if($num>0)
			{
				//$_SESSION['anggota'] = TRUE;//$_POST['id'];
				return TRUE;
			}
			else
			{
				return FALSE;
			}
	}
	
	public function hapusanggota()
	{
		//$sql = "DELETE FROM anggota WHERE id = '$id_anggota'";
		
		//echo "Data Anggota ID ".$id_anggota." sudah di hapus";
	}
}
?>