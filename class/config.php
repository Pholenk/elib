<?php
	
class Config
{
	private $db_user = "root";
	private $db_pass = "";
	private $db = "mysql:host=localhost;dbname=project_perpus";
	public $koneksi;
	
	public function getConnect()
	{
		$this->koneksi=null;
		try
		{
			$this->koneksi = new PDO ($this->db,$this->db_user,$this->db_pass);
			//echo"sukses";
		}
		catch(PDOException $e)
		{
			echo "gagal ".$e->getMessage();
		}
		return $this->koneksi;
	}
}
?>