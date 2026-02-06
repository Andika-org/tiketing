<style>
    #example1 th,
    #example1 td {
        font-size: 10px;
        /* Atur sesuai kebutuhan */
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">

            <div class="card-header">
                <i class="fa fa-id-card"></i> <strong>Tiket Approve</strong><br>
                <div class="row">
                    <div class="col-md-3">
                        <select name="rs" id="filter-rs" class="form-control">
                            <option value="">Pilih RS</option>
                            <?php foreach ($rs as $d) : ?>
                                <option value="<?= $d['Namars']; ?>"><?= $d['Namars']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="prioritas" id="filter-prioritas" class="form-control">
                            <option value="">Pilih Prioritas</option>
                            <?php foreach ($prioritas as $d) : ?>
                                <option value="<?= $d['prioritas']; ?>"><?= $d['prioritas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="status" id="filter-status" class="form-control">
                            <option value="">Pilih Status</option>
                            <?php foreach ($status as $d) : ?>
                                <option value="<?= $d['statusname']; ?>"><?= $d['statusname']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="kategori" id="filter-kategori" class="form-control">
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $d) : ?>
                                <option value="<?= $d['Kategori']; ?>"><?= $d['Kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6" align="right">
                    </div><br>
                </div>
                <!-- DataTables CSS -->
                <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
                <style>
                    #tabel-approve th,
                    #tabel-approve td {
                        vertical-align: top;
                        border: 1px solid #ddd; /* Warna soft gray */
                        padding: 8px;
                    }


                    #tabel-approve {
                        border-collapse: collapse;
                    }

                    #tabel-approve td:nth-child(1) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 3%;
                        width: 3%;
                    }
                    #tabel-approve td:nth-child(6) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 40%;
                        width: 40%;
                    }
                    #tabel-approve td:nth-child(3) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 5%;
                        width: 5%;
                    }
                    #tabel-approve td:nth-child(4) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 3%;
                        width: 3%;
                    }
                    #tabel-approve td:nth-child(5) {
                        white-space: nowrap;
                        overflow: hidden;
                        max-width: 5%;
                        width: 5%;
                    }
                    #tabel-approve td:nth-child(9) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 5%;
                        width: 5%;
                    }
                    #tabel-approve td:nth-child(7) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 5%;
                        width: 5%;
                    }
                    #tabel-approve td:nth-child(11) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 5%;
                        width: 5%;
                    }
                </style>


                <table id="tabel-approve" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Tiket</th>
                            <th>Tanggal</th>
                            <th>Unit</th>
                            <th>RS</th>
                            <th>Desc</th>
                            <th>Prioritas</th>
                            <th>Kategori</th>
                            <th>Approve</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-approve" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="form-approve" method="post" action="<?= base_url('tiket/savepesan'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><b>History <span id="notiket"></span></b></h4> &nbsp;&nbsp;&nbsp;
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="dataheader" class="table table-striped dataTable dtr-inline" style="font-size: 12px;">
                        <small>
                            <thead>
                                <tr>
                                    <td><b>Unit / Kategori</b></td>
                                    <td>:</td>
                                    <td><span id="unit"></span> / <span id="kategori"></span></td>

                                    <!-- <td><b>Kategori</b></td>
                                    <td>:</td>
                                    <td id="kategori"></td> -->

                                    <!-- <td><b>Rs</b></td>
                                    <td>:</td>
                                    <td id="rs"></td> -->

                                    <!-- <td><b>Prioritas</b></td>
                                    <td>:</td>
                                    <td id="prioritas"></td> -->
                                </tr>
                                <tr>
                                    <td><b>Description</b></td>
                                    <td>:</td>
                                    <td id="description"></td>

                                    
                                    
                                </tr>
                                <tr>
                                    <td><b>Download Lampiran</b></td>
                                    <td>:</td>
                                    <td> <a href="#" id="btn-download" class="btn btn-sm btn-success">
                                            <i class="fa fa-download"> semua</i>
                                        </a> 
                                    <a href="#" id="btn-downloadx" class="btn btn-sm btn-primary">
                                            <i class="fa fa-download"> satu</i>
                                        </a></td>
                                </tr>
                            </thead>
                    </table>
                    </small>

                    <br>
                    <table id="example1" class="table table-striped dataTable dtr-inline table-tiket" aria-describedby="example1_info">
                        <thead>
                            <small>
                                <tr>
                                    <th>User</th>
                                    <th>Tgl</th>
                                    <th>Status</th>
                                    <th>Estimasi</th>
                                    <th>Progres</th>
                                    <th>Keterangan</th>
                                </tr>
                            </small>

                        </thead>
                        <tbody id="modal-tbody">
                            <small>
                                <!-- Isi data dari AJAX -->
                            </small>
                        </tbody>
                    </table><br><br>
                    <input type="hidden" name="idcomplain" id="approve-idcomplain">
                    <div class="form-group">
                        <div id="approve-pesan"></div>
                        <input class="form-control message" name="pesan" type="text" placeholder="Type a Message">
                    </div>
                    <br>
                    <div class="form-group">
                        <small>
                            <label for="">Progresbar</label>
                        </small>
                        <div class="progress progress-sm active">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" id="progressBar" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                <span class="sr-only">20% Complete</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- Hidden input untuk ID Tiket -->
                    <input type="hidden" id="done-id-tiket" value="">
                    <!-- <button type="submit" class="btn btn-success" onclick="done()" title="Done (Closed)"><i class="fa fa-check"></i></button> -->
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        const base_url = "<?= base_url(); ?>";

        // Inisialisasi DataTable dan simpan ke variabel 'table'
        var table = $('#tabel-approve').DataTable({
            ajax: {
                url: base_url + "tiket/getTiketJson", // Ganti URL JSON-mu
                dataSrc: 'data'
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'nomortiket',
                    render: function(data, type, row, meta) {
                        return data ? data.substring(9) : '';
                    }
                },
                {
                    data: 'tanggal'
                },
                {
                    data: 'unit'
                },
                {
                    data: 'rs', // data asli lengkap
                    render: function(data, type, row, meta) {
                        if(type === 'display') {
                            // Tampilkan yang sudah dipotong 10 karakter awal
                            return data.substring(16);
                        }
                        // Untuk filter/search/sorting gunakan data asli lengkap
                        return data;
                    }
                },
                {
                
                    data: 'description',
                    className: 'wrap-desc',
                    render: function(data, type, row, meta) {
                        return data ? data.replace(/\n/g, '<br>') : '';
                    }
                },
                {
                    data: 'skala_prioritas',
                    render: function(data, type, row, meta) {
                        let badgeClass = '';
                        let value = data.toLowerCase();
                        if (value === 'urgent') {
                            badgeClass = 'bg-danger text-light';
                        } else if (value === 'normal') {
                            badgeClass = 'bg-warning text-dark';
                        } else if (value === 'low') {
                            badgeClass = 'bg-primary text-light';
                        } else {
                            badgeClass = 'bg-secondary text-light';
                        }
                        return `<span class="badge ${badgeClass}">${data}</span>`;
                    }
                },
                {
                    data: 'kategori'
                },
                {
                    data: 'userapprove'
                },
                {
                    data: 'status',
                    render: function(data, type, row, meta) {
                        if (data == 0) {
                            return `<button class="btn btn-sm btn-info unapprove-tiket" data-id="${row.nomortiket}">Draft</button>`;
                        } else if (data == 1) {
                            //return `<button class="btn btn-sm btn-primary">Terkirim</button>`;
                            return `<button class="btn btn-sm btn-primary approve-tiket" data-id="${row.nomortiket}">Terkirim</button>`;
                        } else if (data == 2) {
                            return `<button class="btn btn-sm btn-success approve-tiket" data-id="${row.nomortiket}">Process</button>`;
                        } else if (data == 3) {
                            return `<button class="btn btn-sm btn-danger approve-tiket" data-id="${row.nomortiket}">Closed</button>`;
                        } else if (data == 4) {
                            return `<button class="btn btn-sm btn-default approve-tiket" data-id="${row.nomortiket}">Reject</button>`;
                        } else {
                            return `<button class="btn btn-sm btn-warning approve-tiket" data-id="${row.nomortiket}">Pending</button>`;
                        }
                    }
                },
                {
                    data: 'approve',
                    render: function(data, type, row, meta) {
                        let tombol = '';
                        if (data == 1) {
                            if (row.status == 3) {
                                tombol = `<a href="#" class="btn btn-sm btn-success disabled">
                                <i class="fa fa-eye" title="Closed"></i>
                            </a>`;
                            } else {
                                tombol = `<a href="${base_url}tiket/editcomplain/${row.id}" class="btn btn-sm btn-primary">
                                <i class="fa fa-eye" title="Process"></i>
                            </a>`;
                            }
                        } else {
                            tombol = `<a href="${base_url}tiket/complain/${row.id}" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye" title="Approve"></i>
                        </a>`;
                        }
                        return tombol;
                    }
                }
            ]
        });

        // Fungsi umum filter
        function filterTabel() {
            var rs = $('#filter-rs').val();
            var prioritas = $('#filter-prioritas').val();
            var status = $('#filter-status').val();
            var kategori = $('#filter-kategori').val();

            table.column(4).search(rs) // RS di kolom ke-3
                .column(6).search(prioritas) // Prioritas di kolom ke-4
                .column(7).search(kategori) // Kategori di kolom ke-5
                .column(9).search(status) // Status di kolom ke-6 (harus cek posisi)
                .draw();
        }

        // Event ketika select berubah
        $('#filter-rs, #filter-prioritas, #filter-status, #filter-kategori').on('change', function() {
            filterTabel();
        });

    });
</script>




<script>
    $(document).on('click', '.approve-tiket', function() {
        var id = $(this).data('id'); // Ambil ID tiket dari elemen yang diklik

        $.ajax({
            url: "<?= base_url('tiket/getApproveDetail') ?>", // Endpoint untuk mengambil detail tiket
            method: "POST",
            data: {
                id: id
            }, // Kirim ID tiket ke server
            dataType: "json", // Tentukan format data yang diharapkan (JSON)
            success: function(response) {
                if (response.status === 'success') {
                    const tiketList = response.data; // Ambil array data tiket

                    let html = '';
                    // Loop untuk setiap tiket dalam array response.data
                    tiketList.forEach(function(tiket, index) {
                        html += `
                            <tr>
                                <td>${tiket.username}</td>
                    
                                <td>${tiket.waktu}</td>
                                <td>
                                    ${
                                        tiket.status == 0
                                            ? `<a href="#" class="btn btn-sm btn-info unapprove-tiket" data-id="${tiket.nomortiket}">Draft</a>`
                                            : tiket.status == 1
                                            ? `<a href="#" class="btn btn-sm btn-primary">Terkirim</a>`
                                            : tiket.status == 2
                                            ? `<a href="#"  class="btn btn-sm btn-success approve-tiket" data-id="${tiket.nomortiket}">Process</a>`
                                            : tiket.status == 3
                                            ? `<a class="btn btn-sm btn-danger" onclick="done()" data-id="${tiket.nomortiket}">Closed</a>`
                                            : tiket.status == 4
                                            ? `<a href="#" class="btn btn-sm btn-secondary approve-tiket" data-id="${tiket.nomortiket}">Reject</a>`
                                            : `<a href="#" class="btn btn-sm btn-warning approve-tiket" data-id="${tiket.nomortiket}">Pending</a>`
                                    }
                                </td>
                                <td>${tiket.estimasi}</td>
                                <td>${tiket.progresbar !== null && tiket.progresbar !== '' ? tiket.progresbar : '-'}</td>
                                <td>${tiket.alasan}</td>
                            </tr>
                        `;
                    });

                    // Tampilkan detail tiket ke dalam modal/tabel
                    $('#modal-tbody').html(html);

                    // Set ID untuk form (misalnya jika ingin digunakan untuk keperluan lain)
                    $('#approve-idcomplain').val(tiketList[0].id); // Gunakan id tiket pertama
                    $('#done-id-tiket').val(tiketList[0].nomortiket); // Gunakan id tiket pertama
                    $('#notiket').text(tiketList[0].nomortiket);

                    $('#btn-download').off('click').on('click', function() {
                        var nomortiket = $('#done-id-tiket').val();
                        var url = "<?= base_url('tiket/cetakberkas/'); ?>" + nomortiket;
                        window.open(url, '_blank');
                    });

                    $('#btn-downloadx').off('click').on('click', function() {
                        var nomortiket = $('#done-id-tiket').val();
                        var url = "http://117.102.83.162:8082/tiketing/uploads/" + nomortiket;
                        window.open(url, '_blank');
                    });

                    // Tampilkan modal untuk melihat detail tiket
                    let modal = new bootstrap.Modal(document.getElementById('modal-approve'));
                    modal.show();
                    // <<<<< Panggil loadProgressBar setelah modal ditampilkan
                    loadProgressBar(id);
                    loadPesan(tiketList[0].id);
                } else {
                    // Jika status bukan 'success', tampilkan pesan error
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Tangani error AJAX (misalnya koneksi gagal)
                console.error('AJAX Error:', error);
            }
        });

        $.ajax({
            url: "<?= base_url('tiket/getApproveHeader') ?>",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    var header = response.data;

                    $('#unit').text(header.unit || '-');
                    $('#rs').text(header.rs || '-');
                    if (header.skala_prioritas) {
                        var badgeClass = '';

                        if (header.skala_prioritas.toLowerCase() === 'urgent') {
                            badgeClass = 'bg-danger'; // merah
                        } else if (header.skala_prioritas.toLowerCase() === 'normal') {
                            badgeClass = 'bg-warning text-dark'; // kuning (tulisan hitam)
                        } else if (header.skala_prioritas.toLowerCase() === 'low') {
                            badgeClass = 'bg-success'; // hijau
                        } else {
                            badgeClass = 'bg-secondary'; // abu-abu untuk prioritas lain
                        }

                        $('#prioritas').html(`<span class="badge ${badgeClass}">${header.skala_prioritas}</span>`);
                    } else {
                        $('#prioritas').html('-');
                    }

                    // $('#description').text(header.description || '-');
                    $('#description').html((header.description || '-').replace(/\n/g, '<br>'));

                    $('#kategori').text(header.kategori || '-');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });



        function loadProgressBar() {
            $.ajax({
                url: '<?= base_url('tiket/getProgresbar') ?>', // sesuaikan dengan URL kamu
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        var progress = response.progresbar; // misal hasil 70
                          // Jika progres tidak valid, set ke 0
                        if (!progress || isNaN(progress)) {
                            progress = 0;
                        }// misal hasil 70
                        $('#progressBar').css('width', progress + '%');
                        $('#progressBar').text(progress + '%');
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Gagal mengambil data progresbar.');
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#form-approve').on('submit', function(e) {
            e.preventDefault(); // Mencegah form submit default

            const idcomplain = $('#approve-idcomplain').val(); // ambil ID dari input

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(), // Ambil semua data dari input form
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Pesan berhasil disimpan!');
                        loadPesan(idcomplain); // panggil ulang pesan berdasarkan ID
                        $('.message').val('');
                        $('#form-approve')[0].reset();
                        $('#modal-approve').modal('hide'); // tutup modal
                    } else {
                        alert('Gagal menyimpan pesan: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        });
    });
</script>

<script>
    function loadPesan(idComplain) {
        const base_url = "<?= base_url(); ?>";
        const userDeptId = <?= get_user_dept_id(); ?>;
        $.ajax({
            url: "<?= base_url('tiket/getPesan') ?>",
            method: "POST",
            data: {
                idcomplain: idComplain
            },
            dataType: "json",
            success: function(response) {
                let html = '';
                let tombolHapus = '';

                if (userDeptId !== 45) {
                    tombolHapus = `
                         <a href="#" class="float-right btn-tool btn-hapus-pesan" 
                            data-id="${item.id}" 
                            data-idcomplain="${item.idcomplain}" 
                            data-pesan="${item.pesan}" 
                            data-date="${item.date}">
                            <i class="fa fa-times"></i>
                        </a>
                    `;
                }

                if (response.length > 0) {
                    response.forEach(item => {
                        html += `
                    <div class="post">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="${base_url}assets/img/logo.png" alt="user image">
                            <span class="username">${item.username}</span>
                            <span class="description">${item.date}</span>
                        </div>
                        ${tombolHapus}
                        <p>${item.pesan}</p>
                    </div>
                    `;
                    });
                } else {
                    html = '<p class="text-muted">Belum ada pesan.</p>';
                }

                $('#approve-pesan').html(html);
            },
            error: function(xhr, status, error) {
                console.error('Gagal memuat pesan:', error);
            }
        });
    }
</script>

<script>
    $(document).on('click', '.btn-hapus-pesan', function(e) {
        e.preventDefault();
        const button = $(this);

        const id = button.data('id');
        const idcomplain = button.data('idcomplain');
        const pesan = button.data('pesan');
        const date = button.data('date');

        if (confirm('Yakin ingin menghapus pesan ini?')) {
            $.ajax({
                url: '<?= base_url("tiket/hapusPesan"); ?>',
                method: 'POST',
                data: {
                    id: id,
                    idcomplain: idcomplain,
                    pesan: pesan,
                    date: date
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        // Reload ulang daftar pesan
                        loadPesan(idcomplain);
                    } else {
                        alert('Gagal menghapus pesan: ' + res.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        }
    });
</script>

<script>
    function done() {
        const idTiket = $('#done-id-tiket').val(); // Ambil ID dari input hidden

        if (!idTiket) {
            alert('ID tiket tidak tersedia!');
            return;
        }

        $.ajax({
            url: "<?= base_url('tiket/doneTiket') ?>",
            method: "POST",
            data: {
                id: idTiket
            },
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    alert('Tiket berhasil di-Open!');
                    // Bisa reload tabel atau modal
                    location.reload();
                } else {
                    alert(response.message || 'Gagal mengubah status tiket.');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                alert('Terjadi kesalahan saat menghubungi server.');
            }
        });
    }
</script>