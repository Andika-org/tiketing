<!-- /.content-wrapper -->
<footer class="main-footer">
    Dev.IT Radjak Hospital - <?= date('Y'); ?>
    <div class="float-right d-none d-sm-inline-block">
        Cileungsi-Div IT
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('vendor/plugins/'); ?>jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('vendor/plugins/'); ?>jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('vendor/plugins/'); ?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('vendor/plugins/'); ?>chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('vendor/plugins/'); ?>sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url('vendor/plugins/'); ?>jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('vendor/plugins/'); ?>jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('vendor/plugins/'); ?>moment/moment.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('vendor/plugins/'); ?>tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('vendor/plugins/'); ?>summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('vendor/plugins/'); ?>overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('vendor/dist/'); ?>js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('vendor/dist/'); ?>js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('vendor/dist/'); ?>js/pages/dashboard.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?= base_url('vendor/plugins/'); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>jszip/jszip.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('vendor/plugins/'); ?>datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable.destroy({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>


<script>
    $(function() {
        $("#example2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<script>
    $(function() {
        $("#example3").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
        $('#example3').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<!-- Modal -->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keluar Sistem !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda ingin keluar dari sistem customer care sekarang ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary bg-gradient-secondary" data-dismiss="modal">Tidak</button>
                <a href="<?= base_url('cs/logout'); ?>" type="button" class="btn btn-sm btn-danger bg-gradient-danger">Ya</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="save" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin mengupdate data ini ?
            </div>
            <?php
            foreach ($filter as $data) :
            ?>
                <form action="<?= base_url('updatebed/update_bed/' . $data->caseid); ?>" method="post">
                    <div class="modal-footer">
                        <a href="<?= base_url('updatebed/update_bed/' . $data->caseid); ?>" type="button" class="btn btn-sm btn-secondary bg-gradient-secondary">Ya</a>
                        <button type="button" class="btn btn-sm btn-danger bg-gradient-danger" data-dismiss="modal">Tidak</button>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="notifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Kepuasan !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Page Form Kepuasan sedang dalam pembuatan!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary bg-gradient-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="perbaikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Page Ulang Tahun !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sedang dalam perbaikan!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary bg-gradient-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('alerts/sweetalert2.all.min.js'); ?>"></script>
<script src="<?= base_url('alerts/myscript.js'); ?>"></script>



</body>

</html>