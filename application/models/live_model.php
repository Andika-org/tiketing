<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Live_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->load->library('bahasa');
        //$this->bhs = $this->bahasa->get_lang();
    }

/*Rajal Penjamin*/
    function get_kunjungan_debitur() {
        $data =   $this->db->query("exec procDashboardKunjunganRawatJalanCompany ?", date('Y'));
        return $data;
    }

    function get_pendapatan_debitur() {
        $data =   $this->db->query("exec procDashboardPendapatanRawatJalanCompany ?", date('Y'));
        return $data;
    }

/*Rajal Poliklinik*/
    function get_get_kunjungan_poliklinik() {
        $data =   $this->db->query("exec procDashboardKunjunganRawatJalan ?", date('Y'));
        return $data;
    }

    function get_get_pendapatan_poliklinik() {
        $data =   $this->db->query("exec procDashboardPendapatanRawatJalan ?", date('Y'));
        return $data;
    }

/*Penunjang Medis*/
    function get_kunjungan_penujang_medis() {
        $data =   $this->db->query("exec procDashboardKunjunganPenunjang ?", date('Y'));
        return $data;
    }

    function get_pendapatan_penujang_medis() {
        $data =   $this->db->query("exec procDashboardPendapatanPenunjang ?", date('Y'));
        return $data;
    }

/*Indikator RS*/
    function get_barberjohnson() {
        $data =   $this->db->query("exec procDashboardBarberJohnson ?", date('Y'));
        return $data;
    }

/*Tindakan Khusus*/
    function get_kunjungan_tinsus() {
        $data =   $this->db->query("exec procDashboardKunjunganTinSus ?", date('Y'));
        return $data;
    }

    function get_pendapatan_tinsus() {
        $data =   $this->db->query("exec procDashboardPendapatanTinSus ?", date('Y'));
        return $data;
    }

/*Ranap Penjamin*/
    function get_kunjungan_penjamin() {
        $data =   $this->db->query("exec procDashboardKunjunganRawatInapCompany ?", date('Y'));
        return $data;
    }

    function get_pendapatan_penjamin() {
        $data =   $this->db->query("exec procDashboardPendapatanRawatInapCompany ?", date('Y'));
        return $data;
    }

/*Farmasi*/
    function get_kunjungan_farmasi() {
        $data =   $this->db->query("exec procDashboardKunjunganFarmasi ?", date('Y'));
        return $data;
    }

    function get_pendapatan_farmasi() {
        $data =   $this->db->query("exec procDashboardPendapatanFarmasi ?", date('Y'));
        return $data;
    }

/*Bedah*/
    function get_kunjungan_bedah() {
        $data =   $this->db->query("exec procDashboardKunjunganBedah ?", date('Y'));
        return $data;
    }

    function get_pendapatan_bedah() {
        $data =   $this->db->query("exec procDashboardPendapatanBedah ?", date('Y'));
        return $data;
    }

/*Operasi*/
    function get_kunjungan_operasi() {
        $data =   $this->db->query("exec procDashboardKunjunganOr ?", date('Y'));
        return $data;
    }

    function get_pendapatan_operasi() {
        $data =   $this->db->query("exec procDashboardPendapatanOr ?", date('Y'));
        return $data;
    }


/*Insentive*/
    function get_kunjungan_insentive() {
        $data =   $this->db->query("exec procDashboardKunjunganIntensive ?", date('Y'));
        return $data;
    }

    function get_pendapatan_insentive() {
        $data =   $this->db->query("exec procDashboardPendapatanIntensive ?", date('Y'));
        return $data;
    }





/*-----Chart-----*/

/*Chart Rajal Penjamin*/
    function chart_get_kunjungan_debitur() {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardKunjunganRawatJalanCompanyByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_kunjungan_debitur_by_tahun($tahun) {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardKunjunganRawatJalanCompanyByMonth ?,?", array($tahun, $id));
        return $data;
    }

    function chart_get_pendapatan_debitur() {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardPendapatanRawatJalanCompanyByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_pendapatan_debitur_by_tahun($tahun) {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardPendapatanRawatJalanCompanyByMonth ?,?", array($tahun, $id));
        return $data;
    }

/*Chart Rajal Poliklinik*/
    function chart_get_kunjungan_poliklinik() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganRawatJalanByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_kunjungan_poliklinik_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganRawatJalanByMonth ?,?", array($tahun, $id));
        return $data;
    }

    function chart_get_pendapatan_poliklinik() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanRawatJalanByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_pendapatan_poliklinik_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanRawatJalanByMonth ?,?", array($tahun, $id));
        return $data;
    }

/*Chart Tindakan Khusus*/
    function chart_get_kunjungan_tinsus() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganTinSusByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_kunjungan_tinsus_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganTinSusByMonth ?,?", array($tahun, $id));
        return $data;
    }

    function chart_get_pendapatan_tinsus() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanTinSusByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_pendapatan_tinsus_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanTinSusByMonth ?,?", array($tahun, $id));
        return $data;
    }

/*Chart Penunjang Medis*/
    function chart_get_kunjungan_penujang_medis() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganPenunjangByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_kunjungan_penujang_medis_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganPenunjangByMonth ?,?", array($tahun, $id));
        return $data;
    }

    function chart_get_pendapatan_penujang_medis() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanPenunjangByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_pendapatan_penujang_medis_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanPenunjangByMonth ?,?", array($tahun, $id));
        return $data;
    }

/*Chart Ranap Company*/
    function chart_get_kunjungan_ranap_penjamin() {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardKunjunganRawatInapCompanyByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_kunjungan_ranap_penjamin_by_tahun($tahun) {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardKunjunganRawatInapCompanyByMonth ?,?", array($tahun, $id));
        return $data;
    }

    function chart_get_pendapatan_ranap_penjamin() {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardPendapatanRawatInapCompanyByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_pendapatan_ranap_penjamin_by_tahun($tahun) {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardPendapatanRawatInapCompanyByMonth ?,?", array($tahun, $id));
        return $data;
    }

/*Chart Farmasi*/
    function chart_get_kunjungan_farmasi() {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardKunjunganFarmasiByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_kunjungan_farmasi_by_tahun($tahun) {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardKunjunganFarmasiByMonth ?,?", array($tahun, $id));
        return $data;
    }

    function chart_get_pendapatan_farmasi() {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardPendapatanFarmasiByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_pendapatan_farmasi_by_tahun($tahun) {
        $id = $this->uri->segment('3');
        $data =   $this->db->query("exec procProcDashboardPendapatanFarmasiByMonth ?,?", array($tahun, $id));
        return $data;
    }

/*Chart Bedah*/
    function chart_get_kunjungan_bedah() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganBedahByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_kunjungan_bedah_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganBedahByMonth ?,?", array($tahun, $id));
        return $data;
    }

    function chart_get_pendapatan_bedah() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanBedahByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_pendapatan_bedah_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanBedahByMonth ?,?", array($tahun, $id));
        return $data;
    }

/*Chart Bedah*/
    function chart_get_kunjungan_operasi() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganOrByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_kunjungan_operasi_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganOrByMonth ?,?", array($tahun, $id));
        return $data;
    }

    function chart_get_pendapatan_operasi() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanOrByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_pendapatan_operasi_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanOrByMonth ?,?", array($tahun, $id));
        return $data;
    }

/*Chart Insentive*/
    function chart_get_kunjungan_intensive() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganIntensiveByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_kunjungan_intensive_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardKunjunganIntensiveByMonth ?,?", array($tahun, $id));
        return $data;
    }

    function chart_get_pendapatan_intensive() {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanIntensiveByMonth ?,?", array(date('Y'), $id));
        return $data;
    }

    function chart_get_pendapatan_intensive_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        $data =   $this->db->query("exec procProcDashboardPendapatanIntensiveByMonth ?,?", array($tahun, $id));
        return $data;
    }

/*Chart Indikator RS*/
    function chart_get_barberjohnson() {
        $id = urldecode($this->uri->segment('3'));
        if($id == 'Bed Occupancy Rate'){
            $data =   $this->db->query("exec procDashboardBorDetail ?", date('Y'));
        }
        else if($id == 'Average Lenght Of Stay'){
            $data =   $this->db->query("exec procDashboardAVLOSDetail ?", date('Y'));
        }
        else if($id == 'Turn Over Interval'){
            $data =   $this->db->query("exec procDashboardTOIDetail ?", date('Y'));
        }
        else if($id == 'Bed Turn Over'){
            $data =   $this->db->query("exec procDashboardBTODetail ?", date('Y'));
        }else{
            $data = 'Data Tidak DiTemukan !';
        }

        return $data;
    }

    function chart_get_barberjohnson_by_tahun($tahun) {
        $id = urldecode($this->uri->segment('3'));
        if($id == 'Bed Occupancy Rate'){
            $data =   $this->db->query("exec procDashboardBorDetail ?", $tahun);
        }
        else if($id == 'Average Lenght Of Stay'){
            $data =   $this->db->query("exec procDashboardAVLOSDetail ?", $tahun);
        }
        else if($id == 'Turn Over Interval'){
            $data =   $this->db->query("exec procDashboardTOIDetail ?", $tahun);
        }
        else if($id == 'Bed Turn Over'){
            $data =   $this->db->query("exec procDashboardBTODetail ?", $tahun);
        }else{
            $data = 'Data Tidak DiTemukan !';
        }

        return $data;
    }

    /*Nama RS*/
    function view_thamrin(){
       return $this->db->query('select NamaPerusahaan from Utama');
    }

    function nama_thamrin(){
       return $this->db->query('select NamaPerusahaan from Utama');
    }

    /*this month*/
    /*public function show_poliklinik_month() {
        $data =   $this->db->query("exec procDashboardKunjunganRawatJalan ?,?", array(date('Y-m-d'),date('Y-m-d')));
        return $data->result();
    }*/

    public function show_data_by_date_range($tanggal, $tanggal_to) {
        $data =   $this->db->query("exec SP_TEST ?,?", array(date($tanggal),date($tanggal_to)));
        return $data->result();
    }

    public function show_poliklinik_now() {
        $data =   $this->db->query("exec procDashboardKunjunganRawatJalan ?,?", array(date('Y/m/d'),date('Y/m/d')));
        return $data->result();
    }

    public function show_dokter_rajal_now() {
        $data =   $this->db->query("exec Sp_PatientListPoliPerDoctor ?,?", array(date('Y/m/d'),date('Y/m/d')));
        return $data->result();
    }

    public function show_poliklinik($tanggal, $tanggal_to) {
        $data =   $this->db->query("exec procDashboardKunjunganRawatJalan ?,?", array(date($tanggal),date($tanggal_to)));
        return $data->result();
    }

    public function show_dokter_rajal($tanggal, $tanggal_to) {
        $data =   $this->db->query("exec Sp_PatientListPoliPerDoctor ?,?", array(date($tanggal),date($tanggal_to)));
        return $data->result();
    }

    public function show_ruangan() {
        $data =   $this->db->query("exec Sp_PatientIPListOpen");
        return $data->result();
    }

    public function show_table_now() {
        $data =   $this->db->query("exec Sp_PatientListOPReffered ?,?", array(date('Y/m/d'),date('Y/m/d')));
        return $data->result();
    }

    public function show_total_ranap(){
        $data = $this->db->query("Sp_SumPatientIPListOpen");
        return $data->result();
    }

    public function show_table($tanggal, $tanggal_to) {
        $data =   $this->db->query("exec Sp_PatientListOPReffered ?,?", array(date($tanggal),date($tanggal_to)));
        return $data->result();
    }




   }
