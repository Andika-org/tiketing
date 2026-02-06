<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                </div>
                <!-- DataTables CSS -->
                <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

                <table id="tabel-batal" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomortiket</th>
                            <th>Alasan</th>
                            <th>userbatal</th>
                            <th>waktubatal</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>
</div><!-- /.content-wrapper -->
<script>
    const base_url = "<?= base_url(); ?>";

    $(document).ready(function() {
        $('#tabel-batal').DataTable({
            processing: true,
            serverSide: false, // Set ke true kalau kamu mau pagination server-side
            ajax: {
                url: base_url + "tiket/getbatal", // Gunakan variabel base_url
                type: "GET",
                dataType: "json",
                dataSrc: 'data'
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Nomor urut
                    }
                },
                {
                    data: 'nomortiket'
                },
                {
                    data: 'alasan'
                },
                {
                    data: 'username'
                },
                {
                    data: 'waktu_tarik'
                }
            ]
        });
    });
</script>