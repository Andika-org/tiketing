<div class="content-wrapper">
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">

            <div class="card-header">
                <i class="fa fa-id-card"></i> <strong>Tiket</strong><br>
                <small>(*</small>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6" align="right">
                    </div><br>

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="<?= base_url('tiket/cetakberkas/' . $qdata['nomortiket']); ?>" target="_blank" class="btn btn-sm btn-success">
                                            <i class="fa fa-download"></i>
                                            Download Lampiran </a>
                                    </div>
                                    <div class="col-md-6" align="right">
                                        Tiket Komplain
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="<?= base_url('tiket/updatecomplain/' . $qdata['id']); ?>" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor Tiket</label>
                                        <input type="text" name="nomortiket" class="form-control" id="exampleInputEmail1" value="<?= $qdata['nomortiket']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">UserName</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" value="<?= $qdata['username']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">DateTime</label>
                                        <input type="text" name="datetime" id="" class="form-control" value="<?= date('d-m-Y', strtotime($qdata['tanggal'])) . '/' .  date('H:i', strtotime($qdata['waktu'])); ?> WIB" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Unit Terkait</label>
                                        <input type="text" name="unit" id="" class="form-control" value="<?= $qdata['unit']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">RS</label>
                                        <input type="text" name="unit" id="" class="form-control" value="<?= $qdata['rs']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Complaint</label>
                                        <textarea name="complain" class="form-control" id="" readonly> <?= $qdata['description']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Proses</label>
                                        <select name="status" id="pilihstatus" onchange="checkpilihan()" class="form-control">
                                            <option value="#">-- Pilih --</option>
                                            <?php
                                            foreach ($qstatus as $d) :
                                                if ($d['id_status'] == $qdata['status']) {
                                            ?>
                                                    <option selected value="<?= $d['id_status']; ?>"><?= $d['statusname']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $d['id_status']; ?>"><?= $d['statusname']; ?></option>
                                                <?php } ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Estimasi</label>
                                        <input type="date" name="estimasi" class="form-control" id="" value="<?= $qdata['estimasi'] ?>">
                                    </div>
                                    <div class="form-group" style="display:none" id="xprogresbar">
                                        <div class="col-4">
                                            <label for="text">Progresbar</label>
                                            <input type="number" name="progresbar" id="textprogres" class="form-control" placeholder="number 30%">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Keterangan</label>
                                        <textarea name="keterangan" class="form-control" value="" id=""></textarea>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
            <!-- DataTables CSS -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        </div>
</div>
</section>
</div>

<script>
    $(document).ready(function() {
        function checkpilihan() {
            var status = $('#pilihstatus').val();

            if (status == '2' || status == '3') {
                $('#xprogresbar').show();

                if (status == '3') {
                    $('#textprogres').val('100');
                } else {
                    $('#textprogres').val(''); // kosongkan kalau status 2
                }
            } else {
                $('#xprogresbar').hide();
                $('#textprogres').val('');
            }
        }

        $('#pilihstatus').on('change', checkpilihan);
        checkpilihan();
    });
</script>