<div class="container">
    <div class="container">
        <div class="container">
            <div class="container">
                <!-- FORM LOGIN -->
                <form action="<?= base_url('welcome/proses_login'); ?>" method="post">
                    <div class="row" style="margin-top: 100px;">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="jumbotron"
                                style="height: 450px; background: url('<?= base_url('assets/img/bg_Blue.jpg'); ?>');  background-size: cover; -webkit-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(100, 149, 237); box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);;">

                                <div class="row">
                                    <div align="center" class="col-md">
                                        <img src="<?= base_url('assets/img/logo.png'); ?>" height="150px" width="150px">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md">
                                        <input type="text" style="border: none;" name="UserName" required
                                            class="form-control" placeholder="username...">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md">
                                        <input style="border: none;" type="password" name="Pass" required
                                            class="form-control" placeholder="password...">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md">
                                        <button
                                            style="width:100%; -webkit-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0); box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);"
                                            type="submit" class="btn btn-dark">Masuk</button>
                                        <br>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md" style="text-align: center;">
                                        <small class="text-white">Made With ❤</small><br>
                                        <small class="text-white">IT Abdul Radjak Group</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </form>
                <!-- AKHIR FORM LOGIN -->
            </div>
        </div>
    </div>
</div>