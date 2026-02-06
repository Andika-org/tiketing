<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cs extends CI_Controller
{
	// CONSTRUCT
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('m_data');
		$this->load->helper('url');
		$this->load->helper('session_helper');
		$username = get_user_username();  // Output: 'andika'
		$dept_id = get_user_dept_id();    // Output: 17

		if (!$username) {
			redirect('welcome');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');

		$this->session->set_flashdata('message', '<div class="alert alert-info mt-5" role="alert">Anda telah keluar dari halaman user.</div>');
		redirect('welcome');
	}

	public function index()
	{
		$data = [
			'username' => get_user_username(),
			'dept_id' => get_user_dept_id(),
			'unitrs' => get_user_unitrs(),
			'id' => get_user_id()
		];
		$data['user'] = get_user_dept_id();
		$data['judul'] = "Report";
		// Data pasien hari ini yang masuk
		// $data['data_pasien'] = $this->m_data->data_pasien()->result();
		// $data['count'] = $this->m_data->count();
		$data['contdone'] = $this->m_data->contdone();
		$data['pendding'] = $this->m_data->countpendding();
		$data['proses'] = $this->m_data->countproses();
		$data['contreject'] = $this->m_data->contreject();
		// $data['count_rawat_inap'] = $this->m_data->count_rawat_inap();
		// $data['count_rawat_jalan'] = $this->m_data->count_rawat_jalan();
		$this->load->view('properti/header', $data);
		$this->load->view('properti/menu', $data);
		$this->load->view('home', $data);
		$this->load->view('properti/footer', $data);
	}

	public function showData()
	{
		$this->db->select('sDescription');
		$this->db->order_by('sDescription', 'asc');
		$data['Unit'] = $this->db->get('HRD_UNIT')->result_array();
		$data['user'] = $this->session->userdata('username');

		$data['judul'] = 'Report';
		$data['User'] = $this->db->get_where('UserHeader', ['aUserID' => $this->session->userdata('aUserID')])->row_array();
		// $data['data2'] = $this->M_Tarik->showData()->result();
		$this->load->view('properti/header', $data);
		$this->load->view('properti/menu', $data);
		$this->load->view('page/Report', $data);
		$this->load->view('properti/footer', $data);
	}

	public function showresume()
	{
		$this->db->select('sDescription');
		$this->db->order_by('sDescription', 'asc');
		$data['Unit'] = $this->db->get('HRD_UNIT')->result_array();
		$data['user'] = $this->session->userdata('username');

		$data['judul'] = 'Report';
		$data['User'] = $this->db->get_where('UserHeader', ['aUserID' => $this->session->userdata('aUserID')])->row_array();
		// $data['data2'] = $this->M_Tarik->showData()->result();
		$this->load->view('properti/header', $data);
		$this->load->view('properti/menu', $data);
		$this->load->view('page/Rpt', $data);
		$this->load->view('properti/footer', $data);
	}

	public function Report()
	{
		$data['user'] = $this->session->userdata('username');
		$data['judul'] = "Report";
		$this->db->select('sDescription');
		$this->db->order_by('sDescription', 'asc');
		$data['Unit'] = $this->db->get('HRD_UNIT')->result_array();
		$this->load->view('properti/header', $data);
		$this->load->view('properti/menu', $data);
		$this->load->view('page/Report', $data);
		$this->load->view('properti/footer', $data);
	}

	public function Resume()
	{
		$data['user'] = $this->session->userdata('username');
		$data['judul'] = "Report";
		$this->db->select('sDescription');
		$this->db->order_by('sDescription', 'asc');
		$data['Unit'] = $this->db->get('HRD_UNIT')->result_array();
		$this->load->view('properti/header', $data);
		$this->load->view('properti/menu', $data);
		$this->load->view('page/Resume', $data);
		$this->load->view('properti/footer', $data);
	}

	public function RptApotik()
	{
		$data['user'] = $this->session->userdata('username');
		$data['judul'] = "Report Apotik";
		$this->load->view('properti/header', $data);
		$this->load->view('properti/menu', $data);
		$this->load->view('page/RptApotik', $data);
		$this->load->view('properti/footer', $data);
	}

	public function Rpt()
	{
		$data['user'] = $this->session->userdata('username');
		$data['judul'] = "Report Radiology";
		$this->db->select('sDescription');
		$this->db->order_by('sDescription', 'asc');
		$data['Unit'] = $this->db->get('HRD_UNIT')->result_array();
		$this->load->view('properti/header', $data);
		$this->load->view('properti/menu', $data);
		$this->load->view('page/Rpt', $data);
		$this->load->view('properti/footer', $data);
	}

	public function ajaxdata()
	{

		$cari           = $this->input->post("cari");
		$tanggalawal    = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalawal"))));
		$tanggalakhir   = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalakhir"))));
		$kategori 		= $this->input->post("kategori");
		$penjamin 		= $this->input->post("penjamin");

		$limitperpage     = $this->input->post("limitperpage");
		$postpage         = $this->input->post("page");
		$page             = $postpage - 1;

		if ($page == "0") {
			$starpage = "0";
		} else {
			$starpage = $page * $limitperpage;
		}

		$qcekquery = $this->m_data->qdataapotik($cari, $tanggalawal, $tanggalakhir, $kategori, $penjamin, $starpage, $limitperpage);
		$sql        = $qcekquery['qdatalimit']->result_array();

		$qcountcek = $qcekquery['qdatacount']->row_array();
		$qcount    = $qcountcek["ttlcnt"];

		//-------------------- proses pagination atau logika pagination -------------------------//
		$functionjquerytosearch = "searchdata"; //-- untuk arahkan klik pagination ke function jquery yg ada di view
		$pagination = $this->Pagepagination->optioncode($qcount, $limitperpage, $postpage, $functionjquerytosearch);
		//------------------------------- proses pagination --------------------------//
		$print = '';

		if (!empty($sql)) {
			$no = 1;

			foreach ($sql as $list) {
				$print .= '
				
				<tr>
                	<td style="vertical-align:middle;text-align:center;">' . $no++ . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["nmobat"] . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["Qty"] . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["Charge"] . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["CompanyName"] . '</td>
				</tr>';
			}
		} else {
			$print .= '
				<tr>
					<td style="vertical-align:middle;text-align:center;" colspan="5"> No Data</td>
				</tr>
			';
		}


		$jsonarray = [
			"listdata"      => $print,
			"pagination"    => $pagination
		];

		echo json_encode($jsonarray);
	}

	public function ajax()
	{

		$cari           = $this->input->post("cari");
		$tanggalawal    = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalawal"))));
		$tanggalakhir   = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalakhir"))));
		$unit 			= $this->input->post("unit");

		$limitperpage     = $this->input->post("limitperpage");
		$postpage         = $this->input->post("page");
		$page             = $postpage - 1;

		//-- startpage jika angka pagination di klik, 
		//No Edit
		if ($page == "0") {
			$starpage = "0";
		} else {
			$starpage = $page * $limitperpage;
		}

		$qcekquery = $this->m_data->qdataquery($cari, $tanggalawal, $tanggalakhir, $unit, $starpage, $limitperpage);
		$sql        = $qcekquery['qdatalimit']->result_array();

		$qcountcek = $qcekquery['qdatacount']->row_array();
		$qcount    = $qcountcek["ttlcnt"];

		//-------------------- proses pagination atau logika pagination -------------------------//
		$functionjquerytosearch = "searchdata"; //-- untuk arahkan klik pagination ke function jquery yg ada di view
		$pagination = $this->Pagepagination->optioncode($qcount, $limitperpage, $postpage, $functionjquerytosearch);
		//------------------------------- proses pagination --------------------------//

		$print = '';

		if (!empty($sql)) {
			$no = 1;
			foreach ($sql as $list) {

				$print .= '

				<tr>
                <td style="vertical-align:middle;text-align:center;">' . $no++ . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["NamaPasien"] . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["TglTransaction"] . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["KodeTindakan"] . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["NamaTindakan"] . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["Category"] . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["DoctSender"] . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["DrPengirim"] . '</td>
					<td style="vertical-align:middle;text-align:center;">' . $list["DrPembaca"] . '</td>
				</tr>';
			}
		} else {
			$print .= '
				<tr>
					<td style="vertical-align:middle;text-align:center;" colspan="10"> No Data</td>
				</tr>
			';
		}


		$jsonarray = [
			"listdata"      => $print,
			"pagination"    => $pagination
		];

		echo json_encode($jsonarray);
	}

	public function excel()
	{
		date_default_timezone_set("Asia/Jakarta");
		$kondisi = $this->input->post('laporan');
		$kondisi2 = $this->input->post('kategori');
		$up = date('Y-m-d');

		// EXTRACT POST
		$data['bulan'] = $this->input->post('bulan');
		$data['tahun'] = $this->input->post('tahun');
		$data['kategori'] = $this->input->post('kategori');

		if ($kondisi2 == NULL) {
			$kateg = "";
		} else {
			$kat = $this->db->get_where('SurveyKategori', ['id_survey_kategori' => $this->input->post('kategori')])->row_array();
			$kateg = $kat['survey_kategori'];
		}

		header("Content-type: application/vnd-ms-excel");
		if ($kondisi == 'bulanan') {
			header("Content-Disposition: attachment; filename=Laporan Bulanan " . $up . " " . $kateg . ".xls");
			$this->load->view('page/excelBulan', $data);
		} else {
			header("Content-Disposition: attachment; filename=Laporan Tahunan " . $up . ".xls");
			$this->load->view('page/excelTahun', $data);
		}
	}

	public function export()
	{
		ini_set('memory_limit', '5120M'); // This also needs to be increased in some cases. Can be changed to a higher value as per need)
		ini_set('sqlsrv.ClientBufferMaxKBSize', '4718592'); // Setting to 512M
		ini_set('pdo_sqlsrv.client_buffer_max_kb_size', '4718592'); // Setting to 512M - for pdo_sqlsrv

		$this->load->library('excel');
		$fileName = 'Report Apotik' . ' ' . date('dmYHis') . '.xlsx';

		$cari           = $this->input->post("cari");
		$tanggalawal    = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalawal"))));
		$tanggalakhir   = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalakhir"))));
		$kategori 		= $this->input->post("category");
		$penjamin 		= $this->input->post("penjamin");

		$qcekquery  = $this->m_data->qdataexcel($tanggalawal, $tanggalakhir, $kategori, $penjamin);
		$sql        = $qcekquery->result_array();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama Obat');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Tanggal');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Status');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Jumlah');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Harga');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Penjamin');


		$rowCount = 2;
		foreach ($sql as $list) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'  . $rowCount, $no++);
			$objPHPExcel->getActiveSheet()->setCellValue('B'  . $rowCount, $list["nmobat"]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'  . $rowCount, $list["tgl"]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'  . $rowCount, $list["status"]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'  . $rowCount, $list["Qty"]);
			$objPHPExcel->getActiveSheet()->setCellValue('F'  . $rowCount, $list["Charge"]);
			$objPHPExcel->getActiveSheet()->setCellValue('G'  . $rowCount, $list["CompanyName"]);

			$rowCount++;
		}

		/*Rename sheet*/
		$objPHPExcel->getActiveSheet()->setTitle('Detail');

		/* Create a new worksheet, after the default sheet*/
		$objPHPExcel->createSheet();

		/* Add some data to the second sheet, resembling some different data types*/
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'ID Obat');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nama Obat');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Jumlah');

		$sqlquery        = $this->db->query("SELECT p.Description, DrugsID,sum(Qty) as jum FROM [Activity Apotik] a, Cases c, Pharmacy p, Company y, 
		ApotikHeader h WHERE a.[Case ID]=c.[Case ID] AND a.DrugsID = 
		p.PharmacyCode AND c.[Intake Date] BETWEEN '$tanggalawal' AND '$tanggalakhir' AND y.CompanyName = 'BPJS KESEHATAN'
		AND c.Category='$kategori' AND y.CompanyCode=c.CompanyCode AND h.TransactionID=a.TransactionID 
		GROUP BY DrugsID, p.Description")->result_array();

		$Count = 2;
		foreach ($sqlquery as $data) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'  . $Count, $no++);
			$objPHPExcel->getActiveSheet()->setCellValue('B'  . $Count, $data["DrugsID"]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'  . $Count, $data["Description"]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'  . $Count, $data["jum"]);
			$Count++;
		}
		$objPHPExcel->getActiveSheet()->setTitle('Resume');

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($fileName);

		header("Content-Type: application/vnd.ms-excel");
		redirect(site_url() . $fileName);
	}

	public function xls()
	{
		ini_set('memory_limit', '5120M'); // This also needs to be increased in some cases. Can be changed to a higher value as per need)
		ini_set('sqlsrv.ClientBufferMaxKBSize', '4718592'); // Setting to 512M
		ini_set('pdo_sqlsrv.client_buffer_max_kb_size', '4718592'); // Setting to 512M - for pdo_sqlsrv

		$this->load->library('excel');
		$fileName = 'Report Radiology' . ' ' . date('dmYHis') . '.xlsx';

		$cari           = $this->input->post("cari");
		$tanggalawal    = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalawal"))));
		$tanggalakhir   = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalakhir"))));
		$unit 			= $this->input->post("unit");

		$qcekquery  = $this->m_data->queryexcel($tanggalawal, $tanggalakhir, $unit);
		$sql        = $qcekquery->result_array();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Case ID');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nama Pasien');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Tanggal Transaksi');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Kode Tindakan');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Nama Tindakan');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Category');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Kode Dokter');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Dr Pengirim');
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Dr Baca');

		$rowCount = 2;
		foreach ($sql as $list) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'  . $rowCount, $no++);
			$objPHPExcel->getActiveSheet()->setCellValue('B'  . $rowCount, $list["caseid"]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'  . $rowCount, $list["NamaPasien"]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'  . $rowCount, $list["TglTransaction"]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'  . $rowCount, $list["KodeTindakan"]);
			$objPHPExcel->getActiveSheet()->setCellValue('F'  . $rowCount, $list["NamaTindakan"]);
			$objPHPExcel->getActiveSheet()->setCellValue('G'  . $rowCount, $list["Category"]);
			$objPHPExcel->getActiveSheet()->setCellValue('H'  . $rowCount, $list["DoctSender"]);
			$objPHPExcel->getActiveSheet()->setCellValue('I'  . $rowCount, $list["DrPengirim"]);
			$objPHPExcel->getActiveSheet()->setCellValue('J'  . $rowCount, $list["DokterBaca"]);
			$rowCount++;
		}

		/*Rename sheet*/
		$objPHPExcel->getActiveSheet()->setTitle('Rincian');

		/* Create a new worksheet, after the default sheet*/
		$objPHPExcel->createSheet();

		/* Add some data to the second sheet, resembling some different data types*/
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama Dokter');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Jumlah');

		$sqlquery        = $this->db->query("select a.DoctSender,x.FirstName as Doc_Sender,count(a.DoctSender) as DokterSender
		from Activity a join Cases c on c.[Case ID] = a.[Case ID] 
		join TransactionHeader t on a.TransactionID = t.TransactionID 
		join MedicalProcedure m on m.ProcedureCode =  a.Activity
		join Doctor d on d.DoctorID = a.DoctSender 
		join Doctor x on x.DoctorID = a.DoctSender
		where m.Category = '$unit' and t.Transaction_Date between '$tanggalawal' and '$tanggalakhir' AND a.DoctorID NOT IN (0)
		group by
		a.DoctSender,x.FirstName")->result_array();

		$rowCount = 2;
		foreach ($sqlquery as $data) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'  . $rowCount, $no++);
			$objPHPExcel->getActiveSheet()->setCellValue('B'  . $rowCount, $data["Doc_Sender"]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'  . $rowCount, $data["DokterSender"]);
			$rowCount++;
		}

		$objPHPExcel->getActiveSheet()->setTitle('Dokter Sender');

		//Dokter Reader ------------------------------------------
		/* Create a new worksheet, after the default sheet*/
		$objPHPExcel->createSheet();

		/* Add some data to the second sheet, resembling some different data types*/
		$objPHPExcel->setActiveSheetIndex(2);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama Dokter');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Jumlah');

		$sqldata = $this->db->query("select a.DoctReader,x.FirstName as Doc_Reader,
			count(a.DoctReader) as DokterBaca
			from Activity a join Cases c on c.[Case ID] = a.[Case ID] 
			join TransactionHeader t on a.TransactionID = t.TransactionID 
			join MedicalProcedure m on m.ProcedureCode =  a.Activity
			join Doctor d on d.DoctorID = a.DoctSender 
			join Doctor x on x.DoctorID = a.DoctReader
			where m.Category = '$unit' and t.Transaction_Date between '$tanggalawal' and '$tanggalakhir' AND a.DoctorID NOT IN (0)
			group by
			a.DoctReader,x.FirstName")->result_array();

		$rowCount = 2;
		foreach ($sqldata as $data) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'  . $rowCount, $no++);
			$objPHPExcel->getActiveSheet()->setCellValue('B'  . $rowCount, $data["Doc_Reader"]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'  . $rowCount, $data["DokterBaca"]);
			$rowCount++;
		}

		$objPHPExcel->getActiveSheet()->setTitle('Dokter Reader');
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($fileName);

		header("Content-Type: application/vnd.ms-excel");
		redirect(site_url() . $fileName);
	}

	public function ajaxresume()
	{

		$tanggalawal    = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalawal"))));
		$tanggalakhir   = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalakhir"))));
		$kategori 		= $this->input->post("kategori");


		$qdata = $this->db->query("SELECT p.Description, DrugsID,sum(Qty) as jum
		FROM [Activity Apotik] a, Cases c, Pharmacy p, Company y, ApotikHeader h 
		WHERE a.[Case ID]=c.[Case ID] AND a.DrugsID = p.PharmacyCode 
		AND c.[Intake Date] BETWEEN '$tanggalawal'  AND '$tanggalakhir' 
		AND c.Category='$kategori' AND y.CompanyCode=c.CompanyCode 
		AND h.TransactionID=a.TransactionID  GROUP BY DrugsID,  p.Description")->result_array();

		$qcount = $this->db->query("SELECT COUNT(a.DrugsID) as jum 
		FROM [Activity Apotik] a, Cases c, Pharmacy p, Company y, ApotikHeader h 
		WHERE a.[Case ID]=c.[Case ID] AND a.DrugsID = p.PharmacyCode 
		AND c.[Intake Date] BETWEEN '$tanggalawal' AND '$tanggalakhir' 
		AND c.Category='$kategori' AND y.CompanyCode=c.CompanyCode 
		AND h.TransactionID=a.TransactionID")->result_array();

		$print = '';

		$no = 1;

		foreach ($qdata as $list) {
			$print .= '
					<tr>
					<td style="text-align:center;">' . $no++ . '</td>
					<td style="text-align:center;">' . $list["Description"] . '</td>
					<td style="text-align:center;">' . $list["jum"] . '</td>

					</tr>
				';
		}


		$jsonarray = [
			"listdata"      => $print
		];

		echo json_encode($jsonarray);
	}

	public function exresume()
	{
		ini_set('memory_limit', '5120M'); // This also needs to be increased in some cases. Can be changed to a higher value as per need)
		ini_set('sqlsrv.ClientBufferMaxKBSize', '4718592'); // Setting to 512M
		ini_set('pdo_sqlsrv.client_buffer_max_kb_size', '4718592'); // Setting to 512M - for pdo_sqlsrv

		$this->load->library('excel');
		$fileName = 'Resume Apotik' . ' ' . date('dmYHis') . '.xlsx';

		$cari1          = $this->input->post("cari1");
		$tanggalawal    = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalawal"))));
		$tanggalakhir   = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalakhir"))));
		$kategori 		= $this->input->post("category");

		$qdata = $this->db->query("SELECT p.Description, DrugsID,sum(Qty) as jum
		FROM [Activity Apotik] a, Cases c, Pharmacy p, Company y, ApotikHeader h 
		WHERE a.[Case ID]=c.[Case ID] AND a.DrugsID = p.PharmacyCode 
		AND c.[Intake Date] BETWEEN '$tanggalawal' AND '$tanggalakhir' 
		AND c.Category='$kategori' AND y.CompanyCode=c.CompanyCode 
		AND h.TransactionID=a.TransactionID  GROUP BY DrugsID,  p.Description")->result_array();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama Obat');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Jumlah');

		$rowCount = 2;
		foreach ($qdata as $list) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'  . $rowCount, $no++);
			$objPHPExcel->getActiveSheet()->setCellValue('B'  . $rowCount, $list["Description"]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'  . $rowCount, $list["jum"]);

			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($fileName);

		header("Content-Type: application/vnd.ms-excel");
		redirect(site_url() . $fileName);
	}

	public function ajaxreader()
	{
		$tanggalawal    = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalawal"))));
		$tanggalakhir   = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalakhir"))));
		$unit 			= $this->input->post("unit");



		$qdata = $this->db->query("select a.DoctReader,x.FirstName as Doc_Reader,
		count(a.DoctReader) as DokterBaca
		from Activity a join Cases c on c.[Case ID] = a.[Case ID] 
		join TransactionHeader t on a.TransactionID = t.TransactionID 
		join MedicalProcedure m on m.ProcedureCode =  a.Activity
		join Doctor d on d.DoctorID = a.DoctSender 
		join Doctor x on x.DoctorID = a.DoctReader
		where m.Category = '$unit' and t.Transaction_Date between '$tanggalawal' and '$tanggalakhir' AND a.DoctorID NOT IN (0)
		group by
		a.DoctReader,x.FirstName")->result_array();

		$print = '';

		$no = 1;

		foreach ($qdata as $list) {
			$print .= '
					<tr>
					<td style="text-align:center;">' . $no++ . '</td>
					<td style="text-align:center;">' . $list["Doc_Reader"] . '</td>
					<td style="text-align:center;">' . $list["DokterBaca"] . '</td>

					</tr>
				';
		}


		$jsonarray = [
			"listdata"      => $print
		];

		echo json_encode($jsonarray);
	}

	public function ajaxsender()
	{
		$tanggalawal    = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalawal"))));
		$tanggalakhir   = date("Y-m-d", strtotime(str_replace("/", "-", $this->input->post("tanggalakhir"))));
		$unit 			= $this->input->post("unit");
		//$cari 			= $this->input->post("cari");

		$sql        = $this->db->query("select a.DoctSender,x.FirstName as Doc_Sender,count(a.DoctSender) as DokterSender
		from Activity a join Cases c on c.[Case ID] = a.[Case ID] 
		join TransactionHeader t on a.TransactionID = t.TransactionID 
		join MedicalProcedure m on m.ProcedureCode =  a.Activity
		join Doctor d on d.DoctorID = a.DoctSender 
		join Doctor x on x.DoctorID = a.DoctSender
		where m.Category = '$unit' and t.Transaction_Date between '$tanggalawal' and '$tanggalakhir' AND a.DoctorID NOT IN (0)
		group by
		a.DoctSender,x.FirstName")->result_array();


		$print = '';

		if (!empty($sql)) {
			$no = 1;
			foreach ($sql as $list) {

				$print .= '
		<tr>
		<td style="text-align:center;">' . $no++ . '</td>
		<td style="text-align:center;">' . $list["Doc_Sender"] . '</td>
		<td style="text-align:center;">' . $list["DokterSender"] . '</td>
		</tr>';
			}
		} else {
			$print .= '
		<tr>
			<td style="vertical-align:middle;text-align:center;" colspan="8"> No Data</td>
		</tr>';
		}

		$jsonarray = [
			"data"      => $print
		];


		echo json_encode($jsonarray);
	}
}