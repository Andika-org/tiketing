<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content" style="margin-top: 15px;">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $contdone; ?></h3>
                            <p>Closed</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?= base_url('cs/filter/?kategori=IP&DoctorID=all&status=OPEN&tanggal=' . date('Y-m-d')); ?>"
                            class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $pendding; ?></h3>
                            <p>Pending</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?= base_url('cs/filter/?kategori=OP&DoctorID=all&status=OPEN&tanggal=' . date('Y-m-d')); ?>"
                            class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $proses; ?></h3>
                            <p>Proses</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?= base_url('cs/filter/?kategori=OP&DoctorID=all&status=OPEN&tanggal=' . date('Y-m-d')); ?>"
                            class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $contreject; ?></h3>
                            <p>Reject</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                            <ion-icon name="ban-outline"></ion-icon>
                        </div>
                        <a href="<?= base_url('cs/filter/?kategori=IP&DoctorID=all&status=OPEN&tanggal=' . date('Y-m-d')); ?>"
                            class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-8 connectedSortable">
                    <!-- DIRECT CHAT -->
                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-fw fa-calendar-alt"></i> <?= date('d M Y'); ?> | New
                                > List Patient</h3>

                            <div class="card-tools">
                                <span title="3 New Messages" class="badge badge-primary">New :</span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Case ID</th>
                                            <th>Nama</th>
                                            <th>Gender</th>
                                            <th>Kategori</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                            <!--/.direct-chat-messages-->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="<?= base_url('cs/patient'); ?>" style="width: 100%;"
                                class="btn btn-primary bg-gradient-primary">Redirect
                                WhatsApp</a>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-chat -->
                    <!-- <form action="<?= base_url('cs/multiTest'); ?>" method="post">
                      <?php
                        //$test = $this->db->get('TESTINGWA')->result();
                        //foreach($test as $fr):
                        ?>
                            <input type="text" value="<?= $fr->Telpon; ?>" name="phone[]" class="form-control"> 
                            
                            <input type="text" value="<?= $fr->Pesan; ?>"  name="message[]" class="form-control">
                           
                            
                        <?php
                        //endforeach;
                        ?>
                        
                        <Button type="submit" class="fa fa-sucess">Kirim</Button>
                    </form> -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-4 connectedSortable">
                    <!-- Calendar -->
                    <div class="card bg-gradient-success">
                        <div class="card-header border-0">

                            <h3 class="card-title">
                                <i class="fa fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                        data-toggle="dropdown" data-offset="-52">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Add new event</a>
                                        <a href="#" class="dropdown-item">Clear events</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- Map card -->
                    <div class="card bg-gradient-primary">
                        <!-- /.card-body-->
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div hidden id="sparkline-1"></div>
                                    <div class="text-white">Feedback</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div hidden id="sparkline-2"></div>
                                    <div class="text-white">Open</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div hidden id="sparkline-3"></div>
                                    <div class="text-white">Close</div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>