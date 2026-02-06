<!-- Load library CSS & JS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url('aset/dropzone.min.css') ?>">
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url('aset/dropzone.min.js') ?>"></script>

<!-- Style tambahan -->
<style>
    body {
        background-color: #fff;
    }

    .dropzone {
        margin-top: 10px;
        border: 2px dashed #0087F7;
        background: #f9f9f9;
    }
</style>

<!-- Form Upload -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tambah Upload File</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Tambah Uload File</li>
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
                            <form id="form-tambahupload" enctype="multipart/form-data">
                                <input type="text" id="nomortiket" class="form-control" name="nomortiket" readonly value="<?= $this->uri->segment(3); ?>">

                                <div class="mb-3">
                                    <label for="dropzone" class="form-label">Lampiran File</label>
                                    <div class="dropzone" id="dropzoneArea">
                                        <div class="dz-message">
                                            <h5>Drag & Drop file disini atau klik untuk pilih file</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" id="submit-all" class="btn btn-primary">Upload Semua</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    Dropzone.autoDiscover = false; // Harus dimatikan dulu!

    $(document).ready(function() {
        // Format file yang diizinkan
        let format = 'jpg|jpeg|png|pdf|doc|docx';
        let accepted = '.' + format.split('|').join(',.');

        // Ambil nomortiket dari hidden input
        let tiketIdVal = $('#nomortiket').val();

        // Inisialisasi Dropzone
        var foto_upload = new Dropzone("#dropzoneArea", {
            url: "<?php echo base_url('tiket/uploadLampiran'); ?>",
            maxFilesize: 20, // MB
            method: "post",
            parallelUploads: 10,
            autoProcessQueue: false, // jangan auto upload
            maxFiles: 20,
            acceptedFiles: accepted,
            paramName: "userfile",
            dictInvalidFileType: "Tipe file ini tidak diizinkan",
            addRemoveLinks: true,

            params: function(files, xhr, chunk) {
                return {
                    nomortiket: tiketIdVal
                };
            },

            init: function() {
                var dz = this;
                var i = 1;

                dz.on("sending", function(file, xhr, formData) {
                    tiketIdVal = $('#nomortiket').val(); // refresh ambil dari input
                    formData.append("nomortiket", tiketIdVal);
                    formData.append("queue", i++);
                    formData.append("countUpload", foto_upload.files.length);
                });

                dz.on("success", function(file, response) {
                    console.log("Sukses upload:", response);
                });

                dz.on("error", function(file, errorMessage) {
                    console.error("Error upload:", errorMessage);
                    alert("Gagal mengupload file.");
                });

                dz.on("queuecomplete", function() {
                    alert("Semua file berhasil diupload.");
                    location.reload();
                });
            }
        });

        // Saat tombol form submit ditekan
        $('#form-tambahupload').on('submit', function(e) {
            e.preventDefault();

            if (foto_upload.getQueuedFiles().length > 0) {
                foto_upload.processQueue(); // Proses semua file
            } else {
                alert("Silahkan pilih file untuk diupload.");
            }
        });
    });
</script>