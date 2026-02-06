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
                    <div class="container mt-4">
                        <div class="container mt-4">
                            <h3>Edit User</h3>
                            <form method="post" action="<?= site_url('user/update/' . $edituser->id) ?>">

                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" value="<?= $edituser->username ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password (Biarkan kosong jika tidak diubah)</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="********">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="full_name">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="full_name" id="full_name" value="<?= $edituser->full_name ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?= $edituser->email ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="unitrs">Unit RS</label>
                                    <select class="form-control" name="unitrs" id="unitrs">
                                        <option value="">-- Pilih Unit RS --</option>
                                        <?php foreach ($rs as $r): ?>
                                            <option value="<?= $r['Namars'] ?>" <?= ($edituser->unitrs == $r['Namars']) ? 'selected' : '' ?>>
                                                <?= $r['Namars'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="user_level">Level</label>
                                    <input type="text" class="form-control" name="user_level" id="user_level" value="<?= $edituser->user_level ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="dept_id">Departemen</label>
                                    <select class="form-control" name="dept_id" id="dept_id">
                                        <option value="">-- Pilih Departemen --</option>
                                        <?php foreach ($dept as $d): ?>
                                            <option value="<?= $d['DeptID'] ?>" <?= ($edituser->DeptID == $d['DeptID']) ? 'selected' : '' ?>>
                                                <?= $d['Deskripsi'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="user_aktif">Aktif</label>
                                    <select class="form-control" name="user_aktif" id="user_aktif">
                                        <option value="1" <?= $edituser->user_aktif ? 'selected' : '' ?>>Ya</option>
                                        <option value="0" <?= !$edituser->user_aktif ? 'selected' : '' ?>>Tidak</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="<?= site_url('user') ?>" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </section>
</div>