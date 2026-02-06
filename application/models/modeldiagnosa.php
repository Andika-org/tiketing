<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modeldiagnosa extends CI_Model
{

public function qdatadiagnosa($cari,$tanggalawal,$tanggalakhir,$kategori, $starpage, $limitperpage){
		$arrayselect = [
			"(c.[Case ID]) as caseid",
			"c.Description as NamaPasien",
			"c.PatientCode",
			"co.CompanyName as Jaminan",
			"d.FirstName as DokterPenanggungJawab",
			"(c.[Presenting Problem]) AS DiagnosaAwal",
			"(c.[Intake Date]) as TglKedatangan",
			"(c.[Closed Date]) as TglPulang",
			"c.category"
		];

		if ($cari == "") {
            $qtesdatalimit  = $this->db->select($arrayselect)
							->from('Cases c')
							->join('Company co','c.CompanyCode = co.CompanyCode','inner')
							->join('Doctor d','c.DoctIncharge = d.DoctorID','inner')
							->like('c.Description', $cari)
							->where('c.Category', $kategori) 
							->where("(c.[Closed Date]) between '$tanggalawal' and '$tanggalakhir' ")
                            ->order_by("c.Description ASC") // ini wajib kalau di sql server versi 2012 kebawah
                            ->limit($limitperpage, $starpage)
                            ->get();

            $qdatacount     = $this->db->select('count((c.[Case ID])) as ttlcnt')
							->from('Cases c')
							->join('Company co','c.CompanyCode = co.CompanyCode','inner')
							->join('Doctor d','c.DoctIncharge = d.DoctorID','inner')
							->like('c.Description', $cari)
							->where('c.Category', $kategori)  
							->where("(c.[Closed Date]) between '$tanggalawal' and '$tanggalakhir' ")
                            ->get();
                            
        }else{
            
            $qtesdatalimit  = $this->db->select($arrayselect)
							->from('Cases c')
							->join('Company co','c.CompanyCode = co.CompanyCode','inner')
							->join('Doctor d','c.DoctIncharge = d.DoctorID','inner')
							->like('c.Description', $cari)
							// ->or_like('f.caseid',$cari)
							// ->where("i.tahun = '$tahun' ") 
							// ->where("i.bln = '$bln' ") 
							->order_by("c.Description ASC")  // ini wajib kalau di sql server versi 2012 kebawah
                            ->limit($limitperpage, $starpage)
                            ->get();

            $qdatacount     = $this->db->select('count((c.[Case ID])) as ttlcnt')
							->from('Cases c')
							->join('Company co','c.CompanyCode = co.CompanyCode','inner')
							->join('Doctor d','c.DoctIncharge = d.DoctorID','inner')
							->like('c.Description', $cari)
							// ->or_like('f.caseid',$cari)
							->where('c.Category', $kategori) 
							->where("(c.[Closed Date]) between '$tanggalawal' and '$tanggalakhir' ")
                            ->get();
            
        }

		$returnarray = [
            "qdatalimit"    => $qtesdatalimit,
            "qdatacount"    => $qdatacount
        ];

        return $returnarray;
	}


public function qdataexcel($tanggalawal, $tanggalakhir, $kategori){
		$arrayselect = [
			"(c.[Case ID]) as caseid",
            "c.Description as NamaPasien",
			"c.PatientCode",
			"co.CompanyName as Jaminan",
			"d.FirstName as DokterPenanggungJawab",
			"(c.[Presenting Problem]) AS DiagnosaAwal",
			"(c.[Intake Date]) as TglKedatangan",
			"(c.[Closed Date]) as TglPulang",
			"c.category"
        ];

		$qdata  = $this->db->select($arrayselect)
		->from('Cases c')
		->join('Company co','c.CompanyCode = co.CompanyCode','inner')
		->join('Doctor d','c.DoctIncharge = d.DoctorID','inner')
		->where('c.Category', $kategori)  
		->where("(c.[Closed Date]) between '$tanggalawal' and '$tanggalakhir' ")
		->get();
		return $qdata;
	}
}
