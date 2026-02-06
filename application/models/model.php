<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model extends CI_Model
{

	public function filter()
    {
        extract($_GET);
        $c = $caseid;
        $query = "SELECT [Case ID] AS [caseid], [Description] as nama, [Case Status] as status, [NoSEP] as nosep FROM [dbo].[Cases] WHERE [Case ID] = '".$c."'";
        return $this->db->query($query);
    }

	public function filterubahjaminan()
    {
        extract($_GET);
        $c = $caseid;
		$a = $case1;
		$b = $case2;
		$c1 = $case3; 
		$d = $case4;
		$e = $case5;
		$f = $case6;
		$g = $case7;
		$a1 = $case8;
		$a2 = $case9;
		$b3 = $case10;
		$b4 = $case11;
        $query = "SELECT [Case ID] AS [caseid], [Description],CompanyCode as nama FROM [dbo].[Cases] 
		WHERE [Case ID] = '".$c."' OR [Case ID] = '".$a."' OR [Case ID] = '".$b."' OR [Case ID] = '".$c1."'
		OR [Case ID] = '".$d."' OR [Case ID] = '".$e."' OR [Case ID] = '".$f."' OR [Case ID] = '".$g."' 
		OR [Case ID] = '".$a1."' OR [Case ID] = '".$a2."' OR [Case ID] = '".$b3."'
		Or [Case ID] = ".$b4;
        return $this->db->query($query);
    }

	public function qdata($cari, $tahun, $bln, $starpage, $limitperpage)
    {

       

        $arrayselect = 
        [
			'f.id',
			'f.caseid',
			'f.mr',
			'f.nama',
			'f.ruangrawat',
			'i.tgl1',
			'i.tgl2' 
        ];

        if ($cari == "") {
           
            $qtesdatalimit  = $this->db->select($arrayselect)
                            ->from('Forminput f')
							->join('inputbulan i','f.caseid = i.caseid','inner')
							->like('f.nama',$cari) 
							->where("i.tahun = '$tahun' ") 
							->where("i.bln = '$bln' ")
                            ->order_by("f.nama ASC") // ini wajib kalau di sql server versi 2012 kebawah
                            ->limit($limitperpage, $starpage)
                            ->get();
 
            $qdatacount     = $this->db->select('count((f.caseid)) as ttlcnt')
							->from('Forminput f')
							->join('inputbulan i','f.caseid = i.caseid','inner')
							->like('f.nama',$cari)
							// ->or_like('f.caseid',$cari)
							->where("i.tahun = '$tahun' ") 
							->where("i.bln = '$bln' ") 
                            ->get();
                            
        }else{
            
            $qtesdatalimit  = $this->db->select($arrayselect)
							->from('Forminput f')
							->join('inputbulan i','f.caseid = i.caseid','inner')
							->like('f.nama',$cari)
							->or_like('f.caseid',$cari)
							// ->where("i.tahun = '$tahun' ") 
							// ->where("i.bln = '$bln' ") 
							->order_by("f.nama ASC") // ini wajib kalau di sql server versi 2012 kebawah
                            ->limit($limitperpage, $starpage)
                            ->get();

            $qdatacount     = $this->db->select('count(f.caseid) as ttlcnt')
							->from('Forminput f')
							->join('inputbulan i','f.caseid = i.caseid','inner')
							->like('f.nama',$cari)
							// ->or_like('f.caseid',$cari)
							->where("i.tahun = '$tahun' ") 
							->where("i.bln = '$bln' ") 
                            ->get();
            
        }

        $returnarray = [
            "qdatalimit"    => $qtesdatalimit,
            "qdatacount"    => $qdatacount
        ];

        return $returnarray;
    }

	public function queryexcel($tahun, $bln){
		$arrayselect = [
			'f.id',
			'f.caseid',
			'f.mr',
			'f.nama',
			'f.nosep',
			'f.tglmasuk',
			'f.jammasuk',
			'f.tglpulang',
			'f.jampulang',
			'f.kelas',
			'f.ruangrawat',
			'f.ruangmutasi',
			'f.jammutasi',
			'f.carapulang'
		];

		$qdata = $this->db->select('*')
		->from('Forminput f')
		->join('inputbulan i','f.caseid = i.caseid','inner')
		->where("i.tahun = '$tahun' ") 
		->where("i.bln = '$bln' ")
		->get();
		return $qdata;
	}

	public function save_batch($data2){
		return $this->db->insert_batch('inputbulan', $data2);
	}

	public function show($id){
	$arrayselect = [
    	"(Cases.[Case ID])",
		"Cases.Description",
		"(Cases.[Intake Date])", 
		"Cases.PatientCode",
    	"ApotikHeader.Transaction_Date",
    	"Company.CompanyName",
    	"Activity_Apotik.Charge", 
		"Activity_Apotik.Qty", 
		"Activity_Apotik.UnitPrice",
    	"Pharmacy.Description as namaobat"
	];

	$querydb  = $this->db->select($arrayselect)
				->from('Cases')
				->join('ApotikHeader','(Cases.[Case ID]) = (ApotikHeader.[Case ID])','inner')
				->join('Company','Cases.CompanyCode = Company.CompanyCode','inner')
				->join('Activity Apotik Activity_Apotik','Activity_Apotik.TransactionID = ApotikHeader.TransactionID','inner')
				->join('Pharmacy','Activity_Apotik.DrugsID = Pharmacy.PharmacyCode','inner')
				->where("(Cases.[Case ID]) = '$id' ") 
				->get()
				->result_array();
				
				return $querydb;

	}

	public function filterubahbed()
    {
        extract($_GET);
        $c = $caseid;
        $query = "SELECT [Case ID] AS [caseid], [Description],[Case Status] as casestatus,Room,PatientCode,Class FROM [dbo].[Cases] 
		WHERE [Case ID] = '".$c."' and [Case Status] = 'CLOSED' ";
        return $this->db->query($query);
    }

	public function filterubahbedlab()
    {
        extract($_GET);
        $c = $No_Pasien;
		$d1 = $modified_date;
		$d2 = $modified_date1;
        $query = "SELECT DISTINCT No_Pasien, modified_date,Kode_Kunjungan,Nama,Ruang FROM [dbo].[KirimLIS] 
		WHERE modified_date between '".$d1."' and '".$d2."' and No_Pasien = '".$c."'";
        return $this->db->query($query);
    }

}
