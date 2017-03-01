<?php
class Bukucs
{
	private $conn;
	public $isbn;
	public $judul;
	public $penulis;
	public $tahun_terbit;
	public $tempat_terbit;
	public $penerbit;
	public $edisi;
	public $kategori;
	public $deskripsi_fisik;
	public $jumlah;
	public $status;
	
	public function __construct($db)
	{
		$this->conn=$db;
	}

	function cek_buku($isbn) // pengecekan data di table buku berdasarkan isbn
	{
		$sql = "SELECT * FROM buku where isbn = :isbn";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':isbn',$isbn);
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
	
	function tambahbuku() // menyimpan data buku ke database
	{		
		$sql = "INSERT INTO buku(isbn, judul, penulis, tahun_terbit, tempat_terbit, penerbit, edisi, kategori, deskripsi_fisik, jumlah, status) VALUES (:isbn, :judul, :penulis, :th_terbit, :tmp_terbit, :penerbit, :edisi, :kategori, :deskripsi, :jumlah, :status)";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':isbn',$this->isbn);
		$result->bindParam(':judul',$this->judul);
		$result->bindParam(':penulis',$this->penulis);
		$result->bindParam(':th_terbit',$this->tahun_terbit);
		$result->bindParam(':tmp_terbit',$this->tempat_terbit);
		$result->bindParam(':penerbit',$this->penerbit);
		$result->bindParam(':edisi',$this->edisi);
		$result->bindParam(':kategori',$this->kategori);
		$result->bindParam(':deskripsi',$this->deskripsi_fisik);
		$result->bindParam(':jumlah',$this->jumlah);
		$result->bindParam(':status',$this->status);
		
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function ubahbuku($isbn) //mengubah data buku berdasarkan isbn
	{
		$sql = " UPDATE buku SET judul = :judul, penulis = :penulis, tahun_terbit = :th_terbit, tempat_terbit = :tmp_terbit, penerbit = :penerbit, edisi = :edisi, kategori = :kategori, deskripsi_fisik = :deskripsi, 
		jumlah = :jumlah WHERE isbn = :isbn";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':isbn',$isbn);
		$result->bindParam(':judul',$this->judul);
		$result->bindParam(':penulis',$this->penulis);
		$result->bindParam(':th_terbit',$this->tahun_terbit);
		$result->bindParam(':tmp_terbit',$this->tempat_terbit);
		$result->bindParam(':penerbit',$this->penerbit);
		$result->bindParam(':edisi',$this->edisi);
		$result->bindParam(':kategori',$this->kategori);
		$result->bindParam(':deskripsi',$this->deskripsi_fisik);
		$result->bindParam(':jumlah',$this->jumlah);		
		
		if($result->execute())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	
	}
	
	function pilihbuku($isbn) // menampilkan data buku berdasarkan isbn
	{
		$sql = "SELECT * FROM buku WHERE isbn = :isbn";
		
		$result = $this->conn->prepare($sql);
		$result->bindParam(':isbn',$isbn);
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

	function tampildata() //menampilkan semua data yang ada didatabase
	{
		$sql = "SELECT isbn, judul, jumlah FROM buku where status='ADA'";
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
	
	
	function hapusbuku($isbn) //menghapus data di database berdasarkan isbn
	{		
		$sql = " UPDATE buku SET status = 'TIDAK ADA' WHERE isbn = :isbn";
		
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