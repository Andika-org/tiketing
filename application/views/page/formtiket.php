<link rel="stylesheet" type="text/css" href="<?php echo base_url('aset/dropzone.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('aset/basic.min.css') ?>">
<script type="text/javascript" src="<?php echo base_url('aset/jquery.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('aset/dropzone.min.js') ?>"></script>

<!-- include summernote css/js-->
<link href="summernote-bs5.css" rel="stylesheet">
<script src="summernote-bs5.js"></script>
<style type="text/css">
    body {
        background-color: #fff;
    }

    .dropzone {
        margin-top: 10px;
        border: 2px dashed #0087F7;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tambah Tiket</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Tambah Tiket</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="margin-top: -15px;">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6"><i class="fa fa-fw fa-edit"></i> Tiket

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 alert-remove">
                                    <?= $this->session->flashdata('message'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <!-- FORM -->
                                <div class="col-lg-12">
                                    <?php
                                    $randomNumber = rand(1, 1000);
                                    $notiket = date('Ymd') . '-' . 'TIK' . '-' . $randomNumber;  ?>
                                    <form method="post" id="form-tiket" enctype="multipart/form-data" action="<?= base_url('tiket/simpanjquery'); ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-group mb-3">
                                                    <input type="text" id="nomortiket" placeholder="NoTiket" class="form-control" name="nomortiket" value="<?= $notiket; ?>" readonly aria-describedby="basic-addon2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Unit Terkait</label>
                                                    <select name="unit" id="unit" class="form-control myselect" required>
                                                        <option value="">-- Pilih Unit --</option>
                                                        <?php foreach ($unit as $d) : ?>
                                                            <option value="<?= $d['DeptName'] ?>"><?= $d['DeptName'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                
                                                    <label for="exampleInputEmail1">Pilih RS</label>
                                                    <select name="rs" id="rs" class="form-control">
                                                        <option selected value="<?= $unitrs; ?>"><?= $unitrs; ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">SekalaPrioritas</label>
                                                    <select name="sekalaprioritas" id="sekalaprioritas" class="form-control" required>
                                                        <option value="">-- Pilih Sekala --</option>
                                                        <?php foreach ($prioritas as $d) : ?>
                                                            <option value="<?= $d['prioritas'] ?>"><?= $d['prioritas'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Description</label>
                                                    <textarea name="description" id="description" class="form-control" id=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Kategori</label>
                                                    <select name="kategori" class="form-control" id="kategori" required>
                                                        <option value="">-- Pilih Kategori --</option>
                                                        <?php foreach ($kategori as $d) : ?>
                                                            <option value="<?= $d['Kategori']; ?>"><?= $d['Kategori']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="exampleInputEmail1">Lampiran</label>
                                                <div class="dropzone">
                                                    <div class="dz-message">
                                                        <h3> Drag And Drop Lampiran File Upload</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-12" align="right">
                                    <br>
                                    <button type="submit" id="submit-all" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            Dropzone.autoDiscover = false;

            // Format file yang diizinkan
            let format = 'jpg|jpeg|png|pdf|doc|docx';
            let accepted = '.' + format.split('|').join(',.');

            // Variabel global untuk menyimpan ID tiket dari response
            let tiketIdVal = $('#nomortiket').val(); // ambil langsung dari input

            // Inisialisasi Dropzone
            var foto_upload = new Dropzone(".dropzone", {
                url: "<?php echo base_url('tiket/uploadLampiran'); ?>",
                maxFilesize: 20, // MB
                method: "post",
                parallelUploads: 10,
                autoProcessQueue: false,
                maxFiles: 20,
                acceptedFiles: accepted,
                paramName: "userfile",
                dictInvalidFileType: "Tipe file ini tidak diizinkan",
                addRemoveLinks: true,

                // Kirim ID tiket sebagai parameter upload
                params: function(files, xhr, chunk) {
                    return {
                        nomortiket: tiketIdVal
                    };
                },

                init: function() {
                    var dz = this;
                    var i = 1;
                    dz.on("sending", function(file, xhr, formData) {
                        // Update tiketIdVal dari input setiap kali sebelum kirim
                        tiketIdVal = $('#nomortiket').val();
                        formData.append("nomortiket", tiketIdVal);
                        formData.append("queue", i++);
                        formData.append("countUpload", foto_upload.files.length);
                        console.log("Mengirim nomortiket:", tiketIdVal);
                    });
                    // Saat file berhasil diupload
                    this.on("success", function(file, response) {
                        console.log("Upload sukses:", response);
                    });

                    // Saat upload gagal
                    this.on("error", function(file, errorMessage, xhr) {
                        console.error("Upload gagal:", errorMessage);
                        alert("Gagal mengupload lampiran.");
                    });

                    // Setelah semua file selesai diupload
                    this.on("queuecomplete", function() {
                        alert("Data dan lampiran berhasil diunggah.");
                        location.reload();
                    });
                }
            });

            // Saat form utama disubmit
            $('#form-tiket').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                    success: function(response) {
                        // Ambil tiket_id dari response
                        tiketIdVal = response.tiket_id;

                        if (foto_upload.getQueuedFiles().length > 0) {
                            foto_upload.processQueue(); // Mulai upload file
                        } else {
                            alert("Data berhasil disimpan tanpa file.");
                            location.reload();
                        }
                    },

                    error: function(xhr) {
                        console.error("Error:", xhr.responseText);
                        alert("Gagal menyimpan data.");
                    }
                });
            });
        </script>