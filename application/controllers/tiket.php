<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tiket extends CI_Controller
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
        $this->load->helper(array('url', 'file'));
        require_once APPPATH . 'libraries/PDFMerger/vendor/clegginabox/pdf-merger/src/PDFMerger/PDFMerger.php';
        require_once APPPATH . 'libraries/PDFMerger/vendor/setasign/fpdi/src/autoload.php';
        require_once APPPATH . 'libraries/PDFMerger/vendor/setasign/fpdf/fpdf.php';
        require_once APPPATH . 'libraries/PDFMerger/vendor/setasign/fpdi/src/FpdfTpl.php';
        require_once APPPATH . 'libraries/PDFMerger/vendor/setasign/fpdi/src/Fpdi.php';

        $username = get_user_username();  // Output: 'andika'
        $dept_id = get_user_dept_id();    // Output: 17

        if (!$username) {
            redirect('welcome');
        }
    }

    public function index()
    {
       $data = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id(),
            'unitrs' => get_user_unitrs(),
            'id' => get_user_id()
        ];
        $data['user']   = get_user_dept_id();
        $data['unitrs'] = get_user_unitrs();
        $data['abdulradjak'] = $this->db->query("SELECT TOP 1 * FROM Utama")->row_array();
        $data['judul'] = "tiketing";
        $data['viewtiket']  = $this->m_data->viewtiket();
        $data['rs']   = $this->m_data->rs()->result_array();
        $data['prioritas'] = $this->m_data->prioritas()->result_array();
        $data['kategori'] = $this->m_data->kategori()->result_array();
        $data['status'] = $this->m_data->status()->result_array();

        $this->load->view('properti/header', $data);
        $this->load->view('properti/menu', $data);
        $this->load->view('page/viewtiket', $data);
        $this->load->view('properti/footer', $data);
    }

    public function formviewtiket()
    {
        $data = [
                'username' => get_user_username(),
                'dept_id' => get_user_dept_id(),
                'unitrs' => get_user_unitrs(),
                'id' => get_user_id()
                ];

        $data['user'] = $user = get_user_dept_id();
        $data['unitrs'] = get_user_unitrs();
        $data['abdulradjak'] = $this->db->query("SELECT TOP 1 * FROM Utama")->row_array();
        $data['judul'] = "Report";
        $data['unit'] = $this->m_data->unit()->result_array();
        $data['rs']   = $this->m_data->rs()->result_array();
        $data['prioritas'] = $this->m_data->prioritas()->result_array();
        $data['kategori'] = $this->m_data->kategori()->result_array();

        $this->load->view('properti/header', $data);
        $this->load->view('properti/menu', $data);
        $this->load->view('page/formtiket', $data);
        $this->load->view('properti/footer', $data);
    }

    public function simpan()
    {
        $username = $this->session->userdata(AUTHORIZATION::HTTP_SESSION_LOGIN_CONSTANT());
        $data['User'] = $user = $this->db->get_where('UserHeader', ['aUserID' => $this->session->userdata('aUserID')])->row_array();
        $data['abdulradjak'] = $this->db->query("SELECT TOP 1 * FROM Utama")->row_array();
        $data['judul'] = "Report";

        // Ambil input dari form
        $nomortiket       = $this->input->post('nomortiket');
        $unit             = $this->input->post('unit');
        $rs               = $this->input->post('rs');
        $tanggal          = date('Y-m-d');
        $waktu            = date('H:i');
        $usernamex         = $user['UserName'];
        $sekalaprioritas  = $this->input->post('sekalaprioritas');
        $description      = $this->input->post('description');

        $fileName = $nomortiket . '-' . $tanggal . '-' . $waktu;
        $path = $_SERVER['DOCUMENT_ROOT'] . '/tiketing' . '/uploads/';
        $config['upload_path'] = $path;
        $config['file_name'] = $fileName;
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // var_dump($_FILES);

        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
        }

        $nama_file = null;

        if ($this->upload->do_upload('file')) {
            $upload_data = $this->upload->data();

            // Ekstensi file
            $ext = $upload_data['file_ext'];

            // Buat nama baru
            $nama_file_baru = $fileName . $ext;

            // Full path lama dan baru
            $old_path = $upload_data['full_path'];
            $new_path = $upload_data['file_path'] . $nama_file_baru;

            // Rename
            if (rename($old_path, $new_path)) {
                $nama_file = $nama_file_baru;
            } else {
                $nama_file = $upload_data['file_name']; // fallback
            }
        } else {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            exit();
        }

        // Buat array data untuk simpan
        $data_simpan = array(
            'nomor_tiket'      => $nomortiket,
            'unit'             => $unit,
            'rs'               => $rs,
            'tanggal'          => $tanggal,
            'waktu'            => $waktu,
            'username'         => $usernamex,
            'skala_prioritas'  => $sekalaprioritas,
            'description'        => $description,
            'file'             => $nama_file
        );

        $this->db->insert('e_tiket', $data_simpan);

        $this->session->set_flashdata('message', 'Data berhasil disimpan!');
        redirect('tiket/index');
    }

    // Upload file (via Dropzone)
    public function uploadLampiran()
    {
        $nomortiket = $this->input->post('nomortiket');
        $queue  = $this->input->post('queue');
        $countUpload  = $this->input->post('countUpload');

        $fileName = $nomortiket . '-' . $queue;
        $path = $_SERVER['DOCUMENT_ROOT'] . '/tiketing' . '/uploads/' . $nomortiket;
        $config['upload_path']          = $path;
        $config['remove_spaces'] = FALSE;
        $config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
        $config['file_name']        = $fileName; // issue variable ini (bisa coba check lagi dari kodingan sebelumnya) // solved ditambahin .pdf
        $config['max_size']             = 20096;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // var_dump($_FILES);

        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
        }

        if (!$this->upload->do_upload('userfile')) {
            echo  $fileName;
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            exit();
        }

        $fileNameUpload = $nomortiket . '-' . $queue;
        $filedb = $nomortiket . '-' . $queue . '.pdf';
        $time = date('Y-m-d H:i:s');

        $data = [
            'tiket_id' => $nomortiket, // jika kolom DB tetap pakai nama tiket_id
            'file_name' => $filedb,
            'file_path' => $path,
            'uploaded_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('lampiran_tiket', $data);

        if ($countUpload == $queue) {

            $this->load->helper('directory');
            $pdf = new \Clegginabox\PDFMerger\PDFMerger;

            $data = directory_map($path);
            if (empty($data)) {
                echo 'Opps..Data Tidak Ditemukan..';
                exit();
            }

            for ($i = 0; $i < count($data); $i++) {

                if (strpos($data[$i], $nomortiket) !== false) {
                    $pdf->addPDF($path . '/' . $data[$i], 'all');
                }
            }
            file_put_contents($path . '/' . $fileNameUpload . '.pdf', $pdf->merge('string', $fileNameUpload . '.pdf'));
            for ($a = 1; $a < $countUpload + 3; $a++) {
                $fileNameUpload = str_replace(".", "_", $fileNameUpload); // ditambahin ini karna jadi duplikat soalnya filenamenya ada symbol titik jadinya pas upload berubah jadi _  underscore
                if (file_exists($path . '/' . $fileNameUpload . ' - ' . $a . '.pdf')) {
                    unlink($path . '/' . $fileNameUpload . ' - ' . $a . '.pdf');
                }
            }
        }
    }


    public function simpanjquery()
    {
        date_default_timezone_set("Asia/Jakarta");
       $data = [
    'username' => get_user_username(),
    'dept_id' => get_user_dept_id(),
    'unitrs' => get_user_unitrs(),
    'id' => get_user_id()
];
        $user_info = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id()
        ];

        $user =  $user_info;
        $data = [
            'nomortiket'      => $this->input->post('nomortiket'),
            'unit'            => $this->input->post('unit'),
            'rs'              => $this->input->post('rs'),
            'tanggal'          => date('Y-m-d'),
            'waktu'            => date('H:i:s'),
            'username'         => $user['username'],
            'skala_prioritas' => $this->input->post('sekalaprioritas'),
            'description'     => $this->input->post('description'),
            'status'          => 1,
            'kategori'        => $this->input->post('kategori')
        ];

        $data2 = [
            'nomortiket'      => $this->input->post('nomortiket'),
            'alasan'          => "",
            'username'        => $user['username'],
            'waktu_tarik'     => date('Y-m-d H:i:s'),
            'status'          => 1
        ];

        // Simpan ke database
        $insert_id = $this->m_data->insertTiket($data);
        $this->m_data->pesan($data2);
        log_message('debug', 'Data2 yang dikirim: ' . json_encode($data2));
        // Kirim response ke frontend (pakai JSON supaya mudah)
        $response = [
            'status' => 'success',
            'tiket_id' => $insert_id,
            'data2' => $data2, // Tambahkan ini untuk cek apakah data2 dikirim
        ];
        echo json_encode($response);
    }

    public function getTiketJson()
    {
        $data = $this->m_data->getAllTiket(); // asumsi fungsi ambil semua data tiket
        echo json_encode(['data' => $data]);
    }

    public function getTiketJsonbyuser()
    {
       $data = [
    'username' => get_user_username(),
    'dept_id' => get_user_dept_id(),
    'unitrs' => get_user_unitrs(),
    'id' => get_user_id()
];
        $user_info = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id()
        ];

        $user =  $user_info;
        $username = $user['username'];
        $data = $this->m_data->getAllTiketbyuser($username); // asumsi fungsi ambil semua data tiket
        echo json_encode(['data' => $data]);
    }


    public function delete()
    {
        $id = $this->input->post('id');

        // Hapus tiket dari tabel utama
        $this->db->where('nomortiket', $id);
        $this->db->delete('e_tiket');

        // Ambil semua lampiran yang terkait
        $lampiran = $this->db->get_where('lampiran_tiket', ['tiket_id' => $id])->result();

        // Hapus file secara fisik
        foreach ($lampiran as $file) {
            $fullpath = FCPATH . 'uploads/' . $id . '/' . $file->file_name;

            if (file_exists($fullpath)) {
                unlink($fullpath);
            } else {
                log_message('error', 'File tidak ditemukan: ' . $fullpath);
            }
        }

        // Hapus data dari tabel lampiran
        $this->db->where('tiket_id', $id);
        $this->db->delete('lampiran_tiket');

        echo json_encode(['status' => 'success']);
    }

    // controller Tiket.php

    public function getTiketById()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('e_tiket', ['nomortiket' => $id])->row();
        echo json_encode($data);
    }

    public function updateTiket()
    {
        $id = $this->input->post('nomortiket');
        $update = [
            'unit' => $this->input->post('unit'),
            'rs' => $this->input->post('rs'),
            'sekalaprioritas' => $this->input->post('sekalaprioritas'),
            'description' => $this->input->post('description')
        ];

        $this->db->where('nomortiket', $id);
        $this->db->update('e_tiket', $update);

        echo json_encode(['status' => 'success']);
    }

    public function complain($id)
    {
       $data = [
    'username' => get_user_username(),
    'dept_id' => get_user_dept_id(),
    'unitrs' => get_user_unitrs(),
    'id' => get_user_id()
];

        $user_info = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id()
        ];

        $data['user'] =   get_user_dept_id();
        $data['abdulradjak'] = $this->db->query("SELECT TOP 1 * FROM Utama")->row_array();
        $data['judul'] = "Report";
        $data['qdata']  = $qdata = $this->m_data->viewnonapprove($id)->row_array();
        $data['qstatus'] = $this->m_data->qstatus()->result_array();
        $data['qestimasi'] = $this->m_data->qestimasi()->result_array();
        $data['file'] = $this->m_data->filelampiran($qdata['nomortiket'])->result_array();

        $this->load->view('properti/header', $data);
        $this->load->view('properti/menu', $data);
        $this->load->view('page/viewcomplain', $data);
        $this->load->view('properti/footer', $data);
    }

    public function editcomplain($id)
    {
       $data = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id(),
            'unitrs' => get_user_unitrs(),
            'id' => get_user_id()
        ];
        $data['user'] = $user = get_user_dept_id();
        $data['abdulradjak'] = $this->db->query("SELECT TOP 1 * FROM Utama")->row_array();
        $data['judul'] = "Tiketing";
        $data['qdata']  = $this->m_data->viewcomplain($id)->row_array();
        $data['qstatus'] = $this->m_data->qstatus()->result_array();
        $data['qestimasi'] = $this->m_data->qestimasi()->result_array();

        $this->load->view('properti/header', $data);
        $this->load->view('properti/menu', $data);
        $this->load->view('page/vieweditcomplain', $data);
        $this->load->view('properti/footer', $data);
    }

    public function approve($id)
    {
        date_default_timezone_set("Asia/Jakarta");
       $data = [
    'username' => get_user_username(),
    'dept_id' => get_user_dept_id(),
    'unitrs' => get_user_unitrs(),
    'id' => get_user_id()
];

        $user_info = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id()
        ];

        $user =  $user_info;

        $data = [
            'id'              => $id,
            'nomortiket'      => $this->input->post('nomortiket'),
            'username'        => $user['username'],
            'date'            => date('Y-m-d H:i:s'),
            'status'          => $this->input->post('proses'),
            'estimasi'     => $this->input->post('estimasi'),
        ];

        $data2 = [
            'nomortiket'      => $this->input->post('nomortiket'),
            'alasan'          => $this->input->post('keterangan'),
            'username'        => $user['username'],
            'waktu_tarik'     => date('Y-m-d H:i:s'),
            'status'          => $this->input->post('proses'),
        ];

        $nomortiket = $this->input->post('nomortiket');

        // Simpan ke database
        $insert_id = $this->m_data->insertapprove($data);
        $insertpesan = $this->m_data->pesan($data2);
        $this->db->query("UPDATE e_tiket SET status= 2, approve = 1 WHERE nomortiket ='$nomortiket'");

        redirect('tiket/viewapprove');
    }

    public function getApproveDetail()
    {
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $result = $this->db->select("
            e.nomortiket,
            e.id,
            h.username,
            e.unit,
            e.rs,
            e.skala_prioritas,
            e.description,
            h.waktu_tarik waktu,
            h.status,
            e.kategori,
            p.estimasi,
            h.progresbar,
            h.alasan
        ")
            ->from("e_tiket e")
            ->join("etiket_histori h", "e.nomortiket = h.nomortiket", "left")
            ->join("etiket_proses p", "p.nomortiket = h.nomortiket", "left")
            ->where("e.nomortiket", $id)
            ->where("e.status IS NOT NULL")
            ->where("e.status !=", 0)
            ->order_by("h.waktu_tarik", "ASC")
            ->get()
            ->result_array();

        if (!$result) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
            return;
        }

        echo json_encode([
            'status' => 'success',
            'data' => $result
        ]);
    }


    public function getApproveHeader()
    {
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $result = $this->db->select("
            e.nomortiket,
            e.id,
            h.username,
            e.unit,
            e.rs,
            e.skala_prioritas,
            e.description,
            RIGHT('0' + CAST(DATEPART(HOUR, h.waktu_tarik) AS VARCHAR), 2) + ':' +
            RIGHT('0' + CAST(DATEPART(MINUTE, h.waktu_tarik) AS VARCHAR), 2) + ' ' +
            CONVERT(VARCHAR, h.waktu_tarik, 105) AS waktu,
            h.status,
            e.kategori,
            p.estimasi,
            h.progresbar,
            h.alasan
        ")
            ->from("e_tiket e")
            ->join("etiket_histori h", "e.nomortiket = h.nomortiket", "left")
            ->join("etiket_proses p", "p.nomortiket = h.nomortiket", "left")
            ->where("e.nomortiket", $id)
            // ->where("h.status !=", 0)
            ->order_by("h.waktu_tarik", "ASC")
            ->get()
            ->row_array();

        if (!$result) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
            return;
        }

        echo json_encode([
            'status' => 'success',
            'data' => $result
        ]);
    }



    public function savepesan()
    {
        date_default_timezone_set("Asia/Jakarta");
       $data = [
    'username' => get_user_username(),
    'dept_id' => get_user_dept_id(),
    'unitrs' => get_user_unitrs(),
    'id' => get_user_id()
];

        $user_info = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id()
        ];

        $user =  $user_info;
        $data = [
            'idcomplain' => $this->input->post('idcomplain'),
            'pesan'      => $this->input->post('pesan'),
            'date'          => date('Y-m-d H:i:s'),
            'username'         => $user['username']
        ];

        // Simpan ke database
        $insert_id = $this->m_data->insertpesan($data);

        // Kirim response ke frontend (pakai JSON supaya mudah)
        echo json_encode(['status' => 'success', 'idcomplain' => $insert_id]);
    }

    public function getPesan()
    {
        $id = $this->input->post('idcomplain');
        $this->db->where('idcomplain', $id);
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get('e_tiketpesan');

        $result = $query->result_array();
        echo json_encode($result);
    }

    public function hapusPesan()
    {
        $id = $this->input->post('id');
        $pesan = $this->input->post('pesan');
        $date = $this->input->post('date');

        $this->db->where('id', $id);
        $this->db->where('pesan', $pesan);
        $this->db->where('date', $date);
        $hapus = $this->db->delete('e_tiketpesan');

        if ($hapus) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus pesan']);
        }
    }

    public function viewapprove()
    {
       $data = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id(),
            'unitrs' => get_user_unitrs(),
            'id' => get_user_id()
        ];
        $data['user'] = $user = get_user_dept_id();
        $data['abdulradjak'] = $this->db->query("SELECT TOP 1 * FROM Utama")->row_array();
        $data['judul'] = "Tiket";
        $data['viewtiket']  = $this->m_data->viewtiket();
        $data['rs']   = $this->m_data->rs()->result_array();
        $data['prioritas'] = $this->m_data->prioritas()->result_array();
        $data['kategori'] = $this->m_data->kategori()->result_array();
        $data['status'] = $this->m_data->status()->result_array();

        $this->load->view('properti/header', $data);
        $this->load->view('properti/menu', $data);
        $this->load->view('page/viewapprove', $data);
        $this->load->view('properti/footer', $data);
    }

    public function getDetail()
    {
        $nomortiket = $this->input->post('nomortiket');

        // Ambil data tiket
        $tiket = $this->db->get_where('e_tiket', ['nomortiket' => $nomortiket])->row_array();

        // Ambil data dropdown
        $unit = $this->db->get('Department')->result_array();
        $prioritas = $this->db->get('tiket_prioritas')->result_array();
        $kategori = $this->db->get('etiket_kategori')->result_array();
        $rs = $this->db->get('tiket_rs')->result_array();

        // Format dropdown
        $rs_options = array_map(function ($r) {
            return ['id' => $r['Namars'], 'nama' => $r['Namars']];
        }, $rs);

        $unit_options = array_map(function ($u) {
            return ['id' => $u['DeptName'], 'nama' => $u['DeptName']];
        }, $unit);

        $prioritas_options = array_map(function ($p) {
            return ['id' => $p['prioritas'], 'nama' => $p['prioritas']];
        }, $prioritas);

        $kategori_options = array_map(function ($k) {
            return ['id' => $k['Kategori'], 'nama' => $k['Kategori']];
        }, $kategori);

        // Kirim response
        echo json_encode([
            'tiket' => $tiket,
            'unit_options' => $unit_options,
            'prioritas_options' => $prioritas_options,
            'kategori_options' => $kategori_options,
            'rs_options' => $rs_options
        ]);
    }

    public function update()
    {
        $nomortiket = $this->input->post('nomortiket');
        $unit = $this->input->post('unit');
        $rs = $this->input->post('rs');
        $prioritas = $this->input->post('skala_prioritas');
        $kategori = $this->input->post('kategori');
        $description = $this->input->post('description');

        $data_update = [
            'unit' => $unit,
            'rs' => $rs,
            'skala_prioritas' => $prioritas,
            'kategori' => $kategori,
            'description' => $description,
        ];

        $this->db->where('nomortiket', $nomortiket);
        $update = $this->db->update('e_tiket', $data_update);

        if ($update) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function updatecomplain()
    {
        date_default_timezone_set("Asia/Jakarta");
       $data = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id(),
            'unitrs' => get_user_unitrs(),
            'id' => get_user_id()
        ];
        $user_info = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id()
        ];

        $data['judul'] = "Tiket";
        $data['user'] = $user = get_user_dept_id();
        $nomortiket = $this->input->post('nomortiket');
        $status = $this->input->post('status');
        $estimasi = $this->input->post('estimasi');
        $keterangan = $this->input->post('keterangan');
        $progresbar = $this->input->post('progresbar');

        $data_update = [
            'username' => $user_info['username'],
            'status' => $status,
            'estimasi' => $estimasi
        ];

        $data2 = [
            'nomortiket'      => $this->input->post('nomortiket'),
            'alasan'          => $this->input->post('keterangan'),
            'username'        => $user_info['username'],
            'waktu_tarik'     => date('Y-m-d H:i:s'),
            'status' => $status,
            'progresbar' => $progresbar
        ];

        $datatiket = [
            'status' => $status
        ];

        $this->db->where('nomortiket', $nomortiket);
        $update = $this->db->update('e_tiket', $datatiket);

        $this->db->where('nomortiket', $nomortiket);
        $update = $this->db->update('etiket_proses', $data_update);
        $insertpesan = $this->m_data->pesan($data2);

        $this->session->set_flashdata('message', '<div class="alert alert-info mt-5" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Berhasil Update.</div>');
        redirect('tiket/viewapprove');
    }

    public function tarik()
    {
       $data = [
    'username' => get_user_username(),
    'dept_id' => get_user_dept_id(),
    'unitrs' => get_user_unitrs(),
    'id' => get_user_id()
];
        date_default_timezone_set("Asia/Jakarta");
        $user_info = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id()
        ];

        $user =  $user_info;

        $nomortiket = $this->input->post('nomortiket');
        $alasan = $this->input->post('alasan');

        // Simpan ke kolom misalnya: status & alasan_tarik
        $data_simpan = [
            'nomortiket' =>  $nomortiket,
            'alasan' => $alasan,
            'username' => $user['username'],
            'waktu_tarik' => date('Y-m-d H:i:s'), // opsional
            'status' => 0
        ];

        $datax = [
            'status' => 0
        ];

        $this->db->insert('etiket_histori', $data_simpan);

        $this->db->where('nomortiket', $nomortiket);
        $update = $this->db->update('e_tiket', $datax);

        if ($update) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function getTiketTarik()
    {
        $nomortiket = $this->input->post('nomortiket');

        $this->db->select('etiket_histori.*, e_tiket.unit, e_tiket.rs, e_tiket.skala_prioritas, e_tiket.kategori, e_tiket.description');
        $this->db->from('etiket_histori');
        $this->db->join('e_tiket', 'e_tiket.nomortiket = etiket_histori.nomortiket', 'left');
        $this->db->where('etiket_histori.nomortiket', $nomortiket);
        $this->db->where('e_tiket.status', 0); // Selain 1 dan 3
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            echo json_encode([
                'status' => 'success',
                'data' => $query->result_array()
            ]);
        } else {
            echo json_encode(['status' => 'not_found']);
        }
    }


    public function kembalikanTiket()
    {
        $nomortiket = $this->input->post('nomortiket');

        // Misalnya, update status di e_tiket jadi aktif (1), atau apapun logikamu
        $this->db->where('nomortiket', $nomortiket);
        $update = $this->db->update('e_tiket', ['status' => 1]); // atau status sesuai kebutuhan

        if ($update) {

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengembalikan tiket']);
        }
    }

    public function batalkirim()
    {
       $data = [
    'username' => get_user_username(),
    'dept_id' => get_user_dept_id(),
    'unitrs' => get_user_unitrs(),
    'id' => get_user_id()
];
        $data['user'] = get_user_dept_id();
        $data['abdulradjak'] = $this->db->query("SELECT TOP 1 * FROM Utama")->row_array();
        $data['viewtiket']  = $this->m_data->batalkirim();
        $data['judul'] = "Batal";

        $this->load->view('properti/header', $data);
        $this->load->view('properti/menu', $data);
        $this->load->view('page/viewbatal', $data);
        $this->load->view('properti/footer', $data);
    }


    public function getbatal()
    {
        // Ambil data dari tabel etiket_histori dan join dengan e_tiket untuk info tambahan
        $this->db->select('etiket_histori.nomortiket, etiket_histori.alasan, etiket_histori.username, etiket_histori.waktu_tarik');
        $this->db->from('etiket_histori');
        $this->db->join('e_tiket', 'e_tiket.nomortiket = etiket_histori.nomortiket', 'left');
        // Jika ingin filter status tertentu, bisa ditambahkan:
        $this->db->where('etiket_histori.status', 0); // Contoh filter

        $query = $this->db->get();
        $result = $query->result_array();

        // Return dalam format DataTables
        echo json_encode(['data' => $result]);
    }

    public function doneTiket()
    {
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        if (!$id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID tiket tidak valid.'
            ]);
            return;
        }

        // Update status tiket ke 3 (Closed)
        $this->db->where('nomortiket', $id);
        $update = $this->db->update('e_tiket', ['status' => 2]);

        if ($update) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Tiket berhasil di-close.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal update status tiket.'
            ]);
        }
    }

    public function cetakberkas($nomortiket)
    {
        $user_data = get_user_dept_id();
        $this->load->helper('directory');
        $pdf = new \Clegginabox\PDFMerger\PDFMerger;
    
        $upload_path = 'uploads/' . $nomortiket;
    
        if (!preg_match('/^[a-zA-Z0-9-]+$/', $nomortiket)) {
            echo 'Nomor tiket tidak valid.';
            exit();
        }
    
        if (!is_dir($upload_path)) {
            echo 'Opps..Direktori tidak ditemukan.';
            exit();
        }
    
        $files = directory_map($upload_path);
        if (empty($files)) {
            echo 'Opps..Tidak ada berkas ditemukan di direktori ini.';
            exit();
        }
    
        $pdf_added = false;
    
        foreach ($files as $file) {
            $file_path = $upload_path . '/' . $file;
    
            if (strtolower(pathinfo($file_path, PATHINFO_EXTENSION)) === 'pdf') {
                try {
                    // Coba tambah PDF asli
                    $pdf->addPDF($file_path, 'all');
                    $pdf_added = true;
                } catch (Exception $e) {
                    // Jika gagal, coba konversi dengan Ghostscript
                    $converted_file = $upload_path . '/converted_' . $file;
                    $cmd = "gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen -dNOPAUSE -dBATCH -sOutputFile=\"" . $converted_file . "\" \"" . $file_path . "\"";
                    exec($cmd, $output, $return_var);
    
                    // Tambahkan file hasil konversi jika berhasil
                    if ($return_var === 0 && file_exists($converted_file)) {
                        try {
                            $pdf->addPDF($converted_file, 'all');
                            $pdf_added = true;
                        } catch (Exception $e2) {
                            log_message('error', 'Gagal menambahkan PDF setelah konversi: ' . $converted_file);
                        }
                    } else {
                        log_message('error', 'Konversi PDF gagal: ' . $file_path);
                    }
                }
            }
        }
    
        if ($pdf_added) {
            $pdf->merge('browser', $nomortiket . '.pdf');
        } else {
            echo 'Opps..Tidak ada berkas PDF yang valid untuk digabungkan.';
            exit();
        }
    }
    

    public function getProgresbar()
    {
        $id = $this->input->post('id');
        $this->db->select('progresbar');
        $this->db->from('etiket_histori');
        $this->db->where('nomortiket', $id);
        $this->db->order_by('waktu_tarik', 'desc');
        $this->db->limit(1); // ambil yang paling baru
        $query = $this->db->get();
        $data = $query->row();

        if ($data) {
            echo json_encode(['status' => 'success', 'progresbar' => $data->progresbar]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    public function uploadtambahan()
    {
       $data = [
    'username' => get_user_username(),
    'dept_id' => get_user_dept_id(),
    'unitrs' => get_user_unitrs(),
    'id' => get_user_id()
];
        $user_info = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id()
        ];

        $data['user'] =  $user_info;
        $data['abdulradjak'] = $this->db->query("SELECT TOP 1 * FROM Utama")->row_array();
        $data['judul'] = "UploadTambahan";

        $this->load->view('properti/header', $data);
        $this->load->view('properti/menu', $data);
        $this->load->view('page/Uploadtambah', $data);
        $this->load->view('properti/footer', $data);
    }
}