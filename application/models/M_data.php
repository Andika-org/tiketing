<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{
	public function unit()
	{
		return $this->db->query("SELECT * FROM Department");
	}

	public function rs()
	{
		return $this->db->query("SELECT * FROM tiket_rs");
	}

	public function prioritas()
	{
		return $this->db->query("SELECT * FROM tiket_prioritas");
	}

	public function kategori()
	{
		return $this->db->query("SELECT * FROM etiket_kategori");
	}

	public function status()
	{
		return $this->db->query("SELECT * FROM etiket_status");
	}



	public function countpendding()
	{
		$s = date('Y-m-d');
		$query = "Select * From e_tiket where status ='5'";
		$contdone = $this->db->query($query);
		return $contdone->num_rows();
	}

	public function contdone()
	{
		$s = date('Y-m-d');
		$query = "Select * From e_tiket where status ='3'";
		$contdone = $this->db->query($query);
		return $contdone->num_rows();
	}

	public function contreject()
	{
		$s = date('Y-m-d');
		$query = "Select * From e_tiket where status ='4'";
		$contdone = $this->db->query($query);
		return $contdone->num_rows();
	}

	public function countproses()
	{
		$s = date('Y-m-d');
		$query = "Select * From e_tiket where status ='2'";
		$contdone = $this->db->query($query);
		return $contdone->num_rows();
	}

	public function viewtiket()
	{
		$this->db->select('*');
		$this->db->from('e_tiket');
		$this->db->join('etiket_histori', 'etiket_histori.nomortiket = e_tiket.nomortiket', 'left');
		$query = $this->db->get();
		return $query->result_array();
	}


	public function batalkirim()
	{
		return $this->db->query("SELECT * FROM etiket_histori");
	}

	public function viewcomplain($id)
	{
		$query = "SELECT * From e_tiket e left join lampiran_tiket l on e.nomortiket = l.tiket_id
		left join etiket_proses p on p.nomortiket = e.nomortiket
		 where e.id = '$id'";
		return $this->db->query($query);
	}

	public function viewnonapprove($id)
	{
		$query = "SELECT e.nomortiket,e.id,e.username,e.rs,e.unit,e.tanggal,e.waktu,e.description,l.file_name From e_tiket e left join lampiran_tiket l on e.nomortiket = l.tiket_id
		 where e.id = '$id'";
		return $this->db->query($query);
	}

	public function filelampiran($nomortiket)
	{
		$query = "SELECT * From lampiran_tiket where tiket_id = '$nomortiket'";
		return $this->db->query($query);
	}

	public function qstatus()
	{
		$query = "SELECT * From etiket_status";
		return $this->db->query($query);
	}

	public function qestimasi()
	{
		$query = "SELECT * From etiket_estimasi";
		return $this->db->query($query);
	}

	public function insertLampiran($data)
	{
		$this->db->insert('lampiran_tiket', $data);
	}

	public function insertTiket($data)
	{
		$this->db->insert('e_tiket', $data);
		return $this->db->insert_id(); // Kembalikan ID untuk relasi ke lampiran
	}

	public function insertpesan($data)
	{
		$this->db->insert('e_tiketpesan', $data);
		return $this->db->insert_id(); // Kembalikan ID untuk relasi ke lampiran
	}

	public function insertapprove($data)
	{
		$this->db->insert('etiket_proses', $data);
	}

	public function pesan($data2)
	{
		$this->db->insert('etiket_histori', $data2);
	}

	public function getAllTiket()
	{
		$this->db->select('
		e_tiket.nomortiket,
		e_tiket.unit,
		e_tiket.rs,
		e_tiket.skala_prioritas,
		e_tiket.description,
		cast (e_tiket.tanggal as date) tanggal,
		e_tiket.waktu,
		e_tiket.username,
		e_tiket.approve,
		e_tiket.id,
		e_tiket.status,
		e_tiket.kategori,
		etiket_proses.username userapprove,
	');
		$this->db->from('e_tiket');
		// $this->db->join('lampiran_tiket', 'lampiran_tiket.tiket_id = e_tiket.nomortiket', 'left');
		$this->db->join('etiket_proses', 'etiket_proses.nomortiket = e_tiket.nomortiket', 'left');
		$this->db->where_not_in('e_tiket.status', 0); // <-- Pastikan kolom status berasal dari tabel yg benar
		$this->db->order_by('e_tiket.status', 'ASC');
		$this->db->order_by('e_tiket.tanggal', 'DESC');
		$query = $this->db->get();

		return $query->result_array();
	}


	public function getAllTiketbyuser($username)
	{
		$this->db->select('e_tiket.nomortiket, e_tiket.unit, e_tiket.rs, etiket_proses.username userapprove ,e_tiket.skala_prioritas, e_tiket.description, e_tiket.tanggal, e_tiket.waktu, e_tiket.username,e_tiket.approve,e_tiket.id,e_tiket.kategori, e_tiket.status');
		$this->db->from('e_tiket');
		$this->db->join('etiket_proses', 'etiket_proses.nomortiket = e_tiket.nomortiket', 'left');
		$this->db->join('userstiket', 'userstiket.unitrs = e_tiket.rs', 'inner');  
		$this->db->where('userstiket.username', $username);
		$this->db->order_by('e_tiket.status', 'ASC');
		$this->db->order_by('e_tiket.tanggal', 'DESC');
		// $this->db->where_in('e_tiket.status', [1, 2]); //
		$query = $this->db->get();
		return $query->result_array();

		return $query->result_array();
	}
}