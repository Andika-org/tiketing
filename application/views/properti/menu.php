<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="<?= base_url('cs'); ?>" class="nav-link <?php if ($this->uri->segment(2) == '') {
                                                                    echo "active";
                                                                } else {
                                                                    echo "";
                                                                } ?>">
                <i class="nav-icon fa fa-tachometer"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <?php
        if ($user == 45) {
        ?>
        <li class="nav-item">
            <a href="<?= base_url('tiket/viewapprove'); ?>" class="nav-link">
                <i class="nav-icon fa fa-file"></i>
                <p>
                    Approve
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('tiket/batalkirim'); ?>" class="nav-link">
                <i class="nav-icon fa fa-file"></i>
                <p>
                    Batal
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('user'); ?>" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>
                    User
                </p>
            </a>
        </li>
        <?php } else { ?>
        <li class="nav-item">
            <a href="<?= base_url('tiket'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'patient') {
                                                                        echo "active";
                                                                    } else {
                                                                        echo "";
                                                                    } ?>">
                <i class="nav-icon fa fa-table"></i>
                <p>
                    E-ticketing
                </p>
            </a>
        </li>
        <?php } ?>

        <li class="nav-item">
            <a href="" data-toggle="modal" data-target="#logout" class="nav-link">
                <i class="nav-icon fa fa-power-off"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>