<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="content-wrapper">
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-id-card"></i> <strong>Tiket</strong><br>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6" align="right">
                        <a href="<?= base_url('tiket/formviewtiket'); ?>"
                            class="btn btn-sm btn-info bg-gradient-info"><i class="fa fa-edit"></i> Tambah</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-3">
                        <select name="rs" id="filter-rs" class="form-control" disabled>
                            <option value="<?= $unitrs; ?>"><?= $unitrs; ?></option>
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
                    </div><br>
                <!-- DataTables CSS -->
                <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
                <style>
                    #tabel-tiket th,
                    #tabel-tiket td {
                        vertical-align: top;
                        border: 1px solid #ddd; /* Warna soft gray */
                        padding: 8px;
                    }

                    /* Tambahan: pastikan border terlihat jelas */
                    #tabel-tiket {
                        border-collapse: collapse;
                    }
                    #tabel-tiket td:nth-child(2) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 5%;
                        width: 5%;
                    }
                    #tabel-tiket td:nth-child(3) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 5%;
                        width: 5%;
                    }
                    #tabel-tiket td:nth-child(5) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 40%;
                        width: 40%;
                    }
                    #tabel-tiket td:nth-child(8) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 5%;
                        width: 5%;
                    }
                    #tabel-tiket td:nth-child(10) {
                        white-space: normal !important;
                        word-wrap: break-word;
                        max-width: 10%;
                        width: 10%;
                    }
                </style>
                

                <!-- <table id="tabel-tiket" class="display" style="width:100%"> -->
                <table id="tabel-tiket" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tiket</th>
                            <th>Tanggal</th>
                            <th>Unit</th>
                            <th>Desc</th>
                            <th>Prioritas</th>
                            <th>Approve</th>
                            <th>Status</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

                <!-- Modal Approve -->
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
                                    <table id="dataheader" class="table table-striped dataTable dtr-inline"
                                        style="font-size: 12px;">
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
                                    <table id="example1" style="font-size: 12px;"
                                        class="table table-striped dataTable dtr-inline table-tiket"
                                        aria-describedby="example1_info">
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
                                    <input type="hidden" id="done-id-tiket" value="">
                                    <div id="approve-pesan"></div>
                                    <input class="form-control message" name="pesan" type="text"
                                        placeholder="Type a Message">
                                    <div class="form-group">
                                        <small>
                                            <label for="">Progresbar</label>
                                        </small>
                                        <div class="progress progress-sm active">
                                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                                id="progressBar" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 20%">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Detail Tiket Tarik -->
                <div class="modal fade" id="modalTiketTarik" tabindex="-1" role="dialog"
                    aria-labelledby="modalTiketTarikLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Tarik Kembali</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nomor Tiket</th>
                                            <th>Alasan</th>
                                            <th>Dibatalkan Oleh</th>
                                            <th>Tanggal</th>
                                            <th>KirimUlang</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-tiket-tarik">
                                        <!-- Data dari AJAX akan ditampilkan di sini -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Modal Edit Tiket -->
                <div class="modal fade" id="modalEditTiket" tabindex="-1" role="dialog"
                    aria-labelledby="modalEditTiketLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="form-edit-tiket" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Tiket</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="nomortiket" id="edit_nomortiket">

                                    <div class="form-group">
                                        <label>Unit</label>
                                        <select name="unit" id="unitx" class="form-control myselect">
                                            <option value="#">-- Pilih Unit --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>RS</label>
                                        <select name="rs" id="edit_rs" class="form-control">
                                            <option value="">-- Pilih Rs --</option>
                                            <!-- Opsi akan diisi via PHP atau AJAX -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Prioritas</label>
                                        <select name="skala_prioritas" id="edit_prioritas" class="form-control">
                                            <option value="">-- Pilih Prioritas --</option>
                                            <!-- Opsi akan diisi via PHP atau AJAX -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select name="kategori" id="edit_kategori" class="form-control">
                                            <option value="">-- Pilih Kategori --</option>
                                            <!-- Opsi akan diisi via PHP atau AJAX -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="description" id="edit_description"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="#" class="btn btn-warning" id="tarik"">Tarik Kembali</a>
                                    <button type=" button" class="btn btn-secondary"
                                        data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- jQuery & DataTables -->
                <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    //Tampil Tabel
    $(document).ready(function() {
        var table = $('#tabel-tiket').DataTable({
            ajax: {
                url: "<?= base_url('tiket/getTiketJsonbyuser') ?>", // Ganti dengan URL endpoint JSON
                dataSrc: 'data'
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                        $('#nomortiket').val(data.nomortiket); //
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
                    data: 'userapprove'
                },
                {
                    data: 'status',
                    render: function(data, type, row, meta) {
                        if (data == 0) {
                            return `<button class="btn btn-sm btn-info unapprove-tiket" data-id="${row.nomortiket}">Draft</button>`;
                        } else if (data == 1) {
                            return `<button class="btn btn-sm btn-primary approve-tiket" data-id="${row.nomortiket}">Terkirim</button>`;
                        } else if (data == 2) {
                            return `<button class="btn btn-sm btn-success approve-tiket" data-id="${row.nomortiket}">Process</button>`;
                        } else if (data == 3) {
                            return `<button class="btn btn-sm btn-danger approve-tiket" data-id="${row.nomortiket}">Closed</button>`;
                        } else if (data == 4) {
                            return `<button class="btn btn-sm btn-default approve-tiket" data-id="${row.nomortiket}">Reject</button>`;
                        } else {
                            return `<button class="btn btn-sm btn-warning" approve-tiket" data-id="${row.nomortiket}">Pendding</button>`;
                        }

                    }
                },
                {
                    data: 'kategori'
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        let nonEditableStatus = [2, 3, 4, 5]; // status yang tidak boleh edit/delete
                        let isDisabled = nonEditableStatus.includes(row.status) ? 'disabled' : '';

                        let tombolDelete = `
                        <button class="btn btn-sm btn-danger delete-tiket" data-id="${row.nomortiket}" ${isDisabled}>
                            <i class="fa fa-trash"></i>
                        </button>
                    `;

                        // <button class="btn btn-sm btn-primary edit-tiket" data-id="${row.nomortiket}" ${isDisabled}>
                        //         <i class="fa fa-pencil"></i>
                        //     </button>
                        let tombolEdit = `
                        <button class="btn btn-sm btn-primary edit-tiket" data-id="${row.nomortiket}" ${isDisabled}>
                                <i class="fa fa-pencil"></i>
                             </button>
                        <a href="${base_url}tiket/uploadtambahan/${row.nomortiket}" class="btn btn-sm btn-primary edit-tiket">
                            <i class="fa fa-upload"></i>
                        </a>
                    `;

                        let tombolDownload = '-';
                        if (row.nomortiket) {
                            tombolDownload = `
                            <a href="${base_url}tiket/cetakberkas/${row.nomortiket}" class="btn btn-sm btn-success" target="_blank">
                                <i class="fa fa-download"></i>
                            </a>
                        `;
                        }

                        return tombolDelete + ' ' + tombolEdit + ' ' + tombolDownload;
                    }

                }

            ]

        });

        // Fungsi umum filter
        function filterTabel() {
            // var rs = $('#filter-rs').val();
            var prioritas = $('#filter-prioritas').val();
            var status = $('#filter-status').val();
            var kategori = $('#filter-kategori').val();

            // table.column(4).search(rs) // RS di kolom ke-3
                table.column(5).search(prioritas) // Prioritas di kolom ke-4
                .column(8).search(kategori) // Kategori di kolom ke-5
                .column(7).search(status) // Status di kolom ke-6 (harus cek posisi)
                .draw();
        }

        // Event ketika select berubah
        $('#filter-rs, #filter-prioritas, #filter-status, #filter-kategori').on('change', function() {
            filterTabel();
        });
    });

    //tombol Hapus
    $(document).on('click', '.delete-tiket', function() {
        let id = $(this).data('id');
        if (confirm('Yakin ingin menghapus tiket ini beserta semua lampiran?')) {
            $.post("<?= base_url('tiket/delete') ?>", {
                id: id
            }, function(response) {
                if (response.status === 'success') {
                    alert('Tiket dan file lampiran berhasil dihapus.');
                    $('#tabel-tiket').DataTable().ajax.reload();
                }
            }, 'json');
        }
    });
</script>

<script>
    //Tampil edit tiket
    $(document).on('click', '.edit-tiket', function() {
        let nomortiket = $(this).data('id');

        $.ajax({
            url: '<?= base_url('tiket/getDetail') ?>',
            type: 'POST',
            data: {
                nomortiket: nomortiket
            },
            dataType: 'json',
            success: function(res) {
                const data = res.tiket;

                // Isi input biasa
                $('#edit_nomortiket').val(data.nomortiket);
                $('#edit_description').val(data.description);

                // RS
                let rsSelect = $('#edit_rs');
                rsSelect.empty().append('<option value="">-- Pilih RS --</option>');
                res.rs_options.forEach(item => {
                    rsSelect.append(
                        `<option value="${item.id}" ${item.id === data.rs ? 'selected' : ''}>${item.nama}</option>`
                    );
                });


                // UNIT
                let unitSelect = $('#unitx');
                unitSelect.empty().append('<option value="">-- Pilih Unit --</option>');
                res.unit_options.forEach(item => {
                    unitSelect.append(
                        `<option value="${item.id}" ${item.id === data.unit ? 'selected' : ''}>${item.nama}</option>`
                    );
                });

                // PRIORITAS
                let prioritasSelect = $('#edit_prioritas');
                prioritasSelect.empty().append('<option value="">-- Pilih Prioritas --</option>');
                res.prioritas_options.forEach(item => {
                    prioritasSelect.append(
                        `<option value="${item.id}" ${item.id === data.skala_prioritas ? 'selected' : ''}>${item.nama}</option>`
                    );
                });

                // KATEGORI
                let kategoriSelect = $('#edit_kategori');
                kategoriSelect.empty().append('<option value="">-- Pilih Kategori --</option>');
                res.kategori_options.forEach(item => {
                    kategoriSelect.append(
                        `<option value="${item.id}" ${item.id === data.kategori ? 'selected' : ''}>${item.nama}</option>`
                    );
                });

                // Tampilkan modal
                $('#modalEditTiket').modal('show');
            }
        });
    });
</script>

<script>
    $('#form-edit-tiket').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '<?= base_url('tiket/update') ?>', // ganti sesuai route controller kamu
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#modalEditTiket').modal('hide');
                    alert('Tiket berhasil diperbarui!');
                    $('#tabel-tiket').DataTable().ajax.reload();
                    // reload datatable atau halaman kalau perlu
                } else {
                    alert('Gagal update tiket!');
                }
            },
            error: function() {
                alert('Terjadi kesalahan AJAX saat update.');
            }
        });
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
    const base_url = "<?= base_url() ?>";
</script>


<script>
    function loadPesan(idComplain) {
        const base_url = "<?= base_url(); ?>";
        const userDeptId = "<?= $dept_id; ?>";

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

                // console.log("User Dept ID:", userDeptId);

                if (response.length > 0) {
                    response.forEach(item => {
                        tombolHapus = `
                         <a href="#" class="float-right btn-tool btn-hapus-pesan" 
                            data-id="${item.id}" 
                            data-idcomplain="${item.idcomplain}" 
                            data-pesan="${item.pesan}" 
                            data-date="${item.date}">
                            <i class="fa fa-times"></i>
                        </a>
                    `;
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

<!-- approve modal -->
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
                                            ? `<a herf="#" class="btn btn-sm btn-info unapprove-tiket" data-id="${tiket.nomortiket}">Draft</a>`
                                            : tiket.status == 1
                                            ? `<a herf="#" class="btn btn-sm btn-primary" >Terkirim</a>`
                                            : tiket.status == 2
                                            ? `<a herf="#"  class="btn btn-sm btn-success approve-tiket" data-id="${tiket.nomortiket}">Process</a>`
                                            : tiket.status == 3
                                            ? `<a class="btn btn-sm btn-danger" onclick="done()" data-id="${tiket.nomortiket}">Closed</a>`
                                            : tiket.status == 4
                                            ? `<a herf="#" class="btn btn-sm btn-secondary approve-tiket" data-id="${tiket.nomortiket}">Reject</a>`
                                            : `<a herf="#" class="btn btn-sm btn-warning approve-tiket" data-id="${tiket.nomortiket}">Pending</a>`
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
                    $('#notiket').text(id);

                    $('#btn-download').off('click').on('click', function() {
                        var nomortiket = $('#done-id-tiket').val();
                        var url = "<?= base_url('tiket/cetakberkas/'); ?>" + nomortiket;
                        window.open(url, '_blank');
                    });


                    // Tampilkan modal untuk melihat detail tiket
                    let modal = new bootstrap.Modal(document.getElementById('modal-approve'));
                    loadProgressBar(id);
                    loadPesan(tiketList[0].id);
                    $('.message').val('');
                    modal.show();
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

                        $('#prioritas').html(
                            `<span class="badge ${badgeClass}">${header.skala_prioritas}</span>`);
                    } else {
                        $('#prioritas').html('-');
                    }


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
                        var progress = response.progresbar;

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
    $('#tarik').on('click', function() {
        $('#modalEditTiket').modal('hide');
        var id = $('#edit_nomortiket').val(); // Ambil dari input hidden

        Swal.fire({
            title: 'Tarik Tiket?',
            text: 'Masukkan alasan penarikan tiket:',
            input: 'text',
            inputPlaceholder: 'Alasan penarikan',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tarik',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Alasan tidak boleh kosong!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let alasan = result.value;

                $.ajax({
                    url: "<?= base_url('tiket/tarik') ?>",
                    type: 'POST',
                    data: {
                        nomortiket: id,
                        alasan: alasan
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            Swal.fire('Sukses!', 'Tiket berhasil ditarik.', 'success');
                            // reload atau redirect kalau perlu
                        } else {
                            Swal.fire('Gagal!', 'Tiket gagal ditarik.', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Terjadi kesalahan saat mengirim data.', 'error');
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).on('click', '.unapprove-tiket', function() {
        const nomortiket = $(this).data('id');

        $.ajax({
            url: '<?= base_url("tiket/getTiketTarik") ?>',
            method: 'POST',
            data: {
                nomortiket: nomortiket
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    let rows = '';
                    res.data.forEach(item => {
                        rows += `
                        <tr>
                            <td>${item.nomortiket}</td>
                            <td>${item.alasan}</td>
                            <td>${item.username}</td>
                            <td>${item.waktu_tarik}</td>
                             <td><button class='btn btn-primary btn-kirim-tiket' data-id="${item.nomortiket}">Kirim</button></td>
                        </tr>
                    `;
                    });
                    $('#tbody-tiket-tarik').html(rows);
                    $('#modalTiketTarik').modal('show');
                } else {
                    Swal.fire('Gagal', 'Data tidak ditemukan.', 'warning');
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengambil data.', 'error');
            }
        });
    });
</script>

<script>
    $(document).on('click', '.btn-kirim-tiket', function() {
        const nomortiket = $(this).data('id');

        Swal.fire({
            title: 'Kirim Tiket?',
            text: 'Apakah kamu yakin ingin mengembalikan tiket ini ke daftar aktif?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Kirim',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('tiket/kembalikanTiket') ?>",
                    type: "POST",
                    data: {
                        nomortiket: nomortiket
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            Swal.fire('Sukses', 'Tiket berhasil dikembalikan.', 'success');
                            // $('#tbody-tiket-tarik').DataTable().ajax.reload();
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
                    }
                });
            }
        });
    });
</script>