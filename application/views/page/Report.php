<!-- Content Wrapper. Contains page content -->
<?php
extract($_GET);
?>
<div class="content-wrapper" style="background-color: white;">
    <!-- Main content -->
    <section class="content" style="margin-top: 15px;">
        <div class="container">
            <div class="container">
                <div class="card">
                    <div class="card-body">

                        <form action="<?= base_url('Cs/showData'); ?>" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="date" class="form-control" required name="tanggalawal" value="<?= @$tanggalawal; ?>">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" value="<?= @$tanggalawal; ?>" class="form-control" required name="tanggalakhir">
                                </div>
                                <div class="col-md-3">
                                    <select name="unit" id="unit" class="form-control">
                                        <option value="Radiology">Radiology</option>
                                        <?php foreach ($Unit as $data) : ?>
                                            <option value="<?= $data['sDescription'] ?>"><?= $data['sDescription'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <div class="col-md-12">
                                        <button style=" -webkit-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0); box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);" type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-filter"></i> Tampilkan</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="fa fa-calendar"></i> <?= date('d-m-Y'); ?>
                        </div>
                        <!-- <div class="right">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                                Tampil Doctor Sender
                            </button> -
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                                Tampil Doctor Reader
                        </div> -->
                    </div>


                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Large Modal</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>One fine body&hellip;</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                </div>
                <div class="card-body">
                    <!-- <a href="<?= base_url('cs/export?tanggalawal=' . @$tanggalawal . '&tanggalakhir=' . @$tanggalakhir . '&unit=' . @$unit); ?>" class="btn btn-primary">Export Excel</a>
                     <br><br> -->
                    <?= $this->session->flashdata('message'); ?>
                    <table id="example1" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Case ID</th>
                                <th>Nama Pasien</th>
                                <th>TglTransaction</th>
                                <th>Kode Tindakan</th>
                                <th>Nama Tindakan</th>
                                <th>Category</th>
                                <th>Kode Dokter</th>
                                <th>Dr.Pengirim</th>
                                <th>Dr.Baca</th>
                            </tr>
                        </thead>
                        <!-- datanya di sini -->
                        <tbody class="datapasien">
                            <?php
                            extract($_GET);
                            if (isset($tanggalawal)) {

                                $data2 = $this->db->query("SELECT (Activity.[Case ID]) As caseid,
                                                    Cases.Description As NamaPasien,
                                                    TransactionHeader.Transaction_Date As TglTransaction,
                                                     Activity.Activity AS KodeTindakan,
                                                      MedicalProcedure.Description As NamaTindakan,
                                                       MedicalProcedure.Category,
                                                        Activity.DoctSender,
                                                         Doctor.FirstName As DrPengirim,
                                                          Activity.DoctReader as DokterBaca
                                                           FROM Activity 
                                                           INNER JOIN MedicalProcedure ON Activity.Activity = MedicalProcedure.ProcedureCode 
                                                           INNER JOIN Doctor ON Doctor.DoctorID = Activity.DoctSender 
                                                           INNER JOIN Cases ON cases.[Case ID] = (Activity.[Case ID]) 
                                                           iNNER JOIN TransactionHeader ON TransactionHeader.TransactionID = Activity.TransactionID 
                                                           WHERE Cases.Description LIKE '%%' ESCAPE '!' 
                                                           AND MedicalProcedure.Category  = '$unit' 
                                                           AND TransactionHeader.Transaction_Date between '$tanggalawal' and '$tanggalakhir'")->result();
                                $no = 1;
                                foreach ($data2 as $d) :
                            ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $d->caseid; ?></td>
                                        <td><?= $d->NamaPasien; ?></td>
                                        <td><?= $d->TglTransaction; ?></td>
                                        <td><?= $d->KodeTindakan; ?></td>
                                        <td><?= $d->NamaTindakan; ?></td>
                                        <td><?= $d->Category; ?></td>
                                        <td><?= $d->DoctSender; ?></td>
                                        <td><?= $d->DrPengirim; ?></td>
                                        <td><?= $d->DokterBaca; ?></td>
                                    </tr>
                            <?php
                                endforeach;
                            } else {
                                echo "";
                            }

                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Case ID</th>
                                <th>Nama Pasien</th>
                                <th>TglTransaction</th>
                                <th>Kode Tindakan</th>
                                <th>Nama Tindakan</th>
                                <th>Category</th>
                                <th>Kode Dokter</th>
                                <th>Dr.Pengirim</th>
                                <th>Dr.Baca</th>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- <form action="<?= base_url('cs/requestSendMessage'); ?>" method="POST">
                            <input type="text" value="hZARONfwPbO9" name="instance_key">
                            <input type="text" value="tess123" name="message">
                            <input type="text" value="6282113583847" name="jid">
                            <button type="submit">kirim</button>
                        </form> -->

                </div>
            </div>
        </div>
</div>
</section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dokter').select2();
    });
</script>