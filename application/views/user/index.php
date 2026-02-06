<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="m-0">User</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">User</li>
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
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6"><i class="fa fa-fw fa-edit"></i> User

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h2>Daftar Pengguna</h2>
                    <a href="<?= site_url('user/create') ?>" class="btn btn-success">Add User</a><br><br>
                    <table id="example1" class="table table-striped dataTable dtr-inline"
                        aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Unit RS</th>
                                <th>Level</th>
                                <th>Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u): ?>
                            <tr>
                                <td><?= $u->id ?></td>
                                <td><?= $u->username ?></td>
                                <td><?= $u->full_name ?></td>
                                <td><?= $u->email ?></td>
                                <td><?= $u->unitrs ?></td>
                                <?php if($u->user_level == 1){
                                    $userx = "Admin";
                                }else{
                                    $userx = "User";
                                }
                                ?>
                                <td><?= $userx ?></td>
                                <td><?= $u->user_aktif ? 'Ya' : 'Tidak' ?></td>
                                <td>
                                    <a href="<?= site_url('user/edit/' . $u->id) ?>" class="btn btn-warning btn-sm"><i
                                            class="fa fa-pencil"></i></a> |
                                    <a href="<?= site_url('user/delete/' . $u->id) ?>"
                                        onclick="return confirm('Hapus user ini?')" class="btn btn-danger btn-sm"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</div>