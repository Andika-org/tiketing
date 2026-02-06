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
                    <h2>Tambah Pengguna</h2>
                    <div class="container mt-4">
                        <h3><?= $judul ?></h3>
                        <form method="post" action="<?= site_url('user/store') ?>">

                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="full_name">Nama Lengkap</label>
                                <input type="text" class="form-control" name="full_name" id="full_name">
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>

                            <div class="form-group mb-3">
                                <label for="unitrs">Unit RS</label>
                                <select class="form-control" name="unitrs" id="unitrs">
                                    <option value="">-- Pilih Unit RS --</option>
                                    <?php foreach ($rs as $r): ?>
                                        <option value="<?= $r['Namars'] ?>"><?= $r['Namars'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="user_level">Level</label>
                                <input type="text" class="form-control" name="user_level" id="user_level">
                            </div>

                            <div class="form-group mb-3">
                                <label for="department">Departemen</label>
                                <select class="form-control" name="deptid" id="deptid">
                                    <option value="">-- Pilih Departemen --</option>
                                    <?php foreach ($dept as $d): ?>
                                        <option value="<?= $d['DeptID'] ?>"><?= $d['Deskripsi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="user_aktif">Aktif</label>
                                <select class="form-control" name="user_aktif" id="user_aktif">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </section>
</div>