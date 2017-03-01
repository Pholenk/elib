<?php

class Logincs
{
	private $conn;
	public $ID;
	public $PASS;
	public $status;
	//public $num;
	
	public function __construct($db)
	{
		$this->conn=$db;
	}

	public function login($id, $pass, $status)
	{
		$sql = "select a.status as s from anggota a, det_anggota d where a.id_anggota=d.id_anggota and a.id_anggota= :id and a.pass= :pass and d.status= :status";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':id', $id);
		$result->bindParam(':pass', $pass);
		$result->bindParam(':status', $status);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		$num=$result->rowCount();
		if ($num == 1) 
		{
			foreach ($result->fetchAll() as $row) 
			{
				extract($row);
				$a = $row["s"];
			}
		}
		return $a;
	}
}
?>