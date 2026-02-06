<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelrefdoc extends CI_Model
{

public function show_refpoli($cari,$tanggalawal,$tanggalakhir, $starpage, $limitperpage) {
	$arrayselect = [
		"A.Unit",
		"D.FirstName as NamaDoctor",
		"Count(distinct A.[Case ID]) as TotalKunjungan",
		"COUNT(distinct R.[Case ID]) as RujukInap",
		"c.[Case ID]",
		"c.PatientCode",
		"c.Class",
		"c.Description as NamaPasien",
		"p.Age as Usia",
		"p.Sex",
		"co.CompanyName as Penjamin",
		"C.RegStatus"
	];

	$arrayselect2 = [
		"CD.[Case ID]",
		 "AB.Unit"  
	];

	$arraygrouping = [
		"A.Unit",
		"D.FirstName",
		"c.RegStatus",
		"c.Description",
		"p.Age,p.Sex",
		"c.[Case ID]",
		"c.PatientCode",
		"c.Class",
		"co.CompanyName"
	];


	if ($cari == "") {
		$qtesdatalimit  = $this->db->select($arrayselect)
						->from('Cases C')
						->join('CaseAdmin A','(C.[Case ID]) = (A.[Case ID])','inner')
						->join('Doctor D','D.DoctorID = A.DoctorID','inner')
						->join('Company co','co.CompanyCode = c.CompanyCode','inner')
						->join('Patient p', 'c.PatientCode = p.PatientCode','left')
						->select($arrayselect2)
						->from('CaseAdmin AB')
						->join('Cases CD','(AB.[Case ID]) = (CD.[Case ID])','inner')
						->like('C.Description', $cari)
						->where('MedicalProcedure.Category', $unit) 
						->where("(TransactionHeader.Transaction_Date) between '$tanggalawal' and '$tanggalakhir' ")
						->order_by("Cases.Description ASC") // ini wajib kalau di sql server versi 2012 kebawah
						->limit($limitperpage, $starpage)
						->get();

		$qdatacount     = $this->db->select('count((Activity.[Case ID])) as ttlcnt')
						->from('Activity')
						->join('MedicalProcedure','Activity.Activity = MedicalProcedure.ProcedureCode','inner')
						->join('Doctor','Doctor.DoctorID = Activity.DoctSender','inner')
						->join('Doctor x','x.DoctorID = Activity.DoctReader','inner')
						->join('Cases', '(Cases.[Case ID]) = Activity.[Case ID]','inner')
						->join('TransactionHeader', 'TransactionHeader.TransactionID = Activity.TransactionID','inner')
						->like('Cases.Description', $cari)
						// ->or_like('f.caseid',$cari)
						->where('MedicalProcedure.Category', $unit) 
						->where("(TransactionHeader.Transaction_Date) between '$tanggalawal' and '$tanggalakhir' ")
						->get();
						
	}else{
		
		$qtesdatalimit  = $this->db->select($arrayselect)
						->from('Activity')
						->join('MedicalProcedure','Activity.Activity = MedicalProcedure.ProcedureCode','inner')
						->join('Doctor','Doctor.DoctorID = Activity.DoctSender','inner')
						->join('Doctor x','x.DoctorID = Activity.DoctReader','inner')
						->join('Cases', '(Cases.[Case ID]) = Activity.[Case ID]','inner')
						->join('TransactionHeader', 'TransactionHeader.TransactionID = Activity.TransactionID','inner')
						->like('Cases.Description', $cari)
						// ->or_like('f.caseid',$cari)
						// ->where("i.tahun = '$tahun' ") 
						// ->where("i.bln = '$bln' ") 
						->order_by("Cases.Description ASC")  // ini wajib kalau di sql server versi 2012 kebawah
						->limit($limitperpage, $starpage)
						->get();

		$qdatacount     = $this->db->select('count((Activity.[Case ID])) as ttlcnt')
						->from('Activity')
						->join('MedicalProcedure','Activity.Activity = MedicalProcedure.ProcedureCode','inner')
						->join('Doctor','Doctor.DoctorID = Activity.DoctSender','inner')
						->join('Doctor x','x.DoctorID = Activity.DoctReader','inner')
						->join('Cases', '(Cases.[Case ID]) = Activity.[Case ID]','inner')
						->join('TransactionHeader', 'TransactionHeader.TransactionID = Activity.TransactionID','inner')
						->like('Cases.Description', $cari)
						// ->or_like('f.caseid',$cari)
						->where('MedicalProcedure.Category', $unit) 
						->where("(TransactionHeader.Transaction_Date) between '$tanggalawal' and '$tanggalakhir' ")
						->get();
		
	}

	$returnarray = [
		"qdatalimit"    => $qtesdatalimit,
		"qdatacount"    => $qdatacount
	];

	return $returnarray;
    }

}

?>
 