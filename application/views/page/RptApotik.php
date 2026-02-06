<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<div class="content-wrapper" style="background-color: white;">
  <!-- Main content -->
  <section class="content" style="margin-top: 15px;">
    <div class="container">
      <div class="container">
        <div class="row">
          <div class="card col-12">
            <div class="card-body">
              <!-- <form action="<?= base_url('Cs/showData'); ?>" method="GET"> -->
              <div class="row">

                <div class="col-md-2">
                  <input type="date" id="tgl1" class="form-control tanggalawal" value="<?php echo date("Y-m-d") ?>" onchange="searchdata('1')" name="tanggalawal">
                </div>

                <div class="col-md-2">
                  <input type="date" id="tgl2" class="form-control tanggalakhir" value="<?php echo date("Y-m-d") ?>" onchange="searchdata('1')" name="tanggalakhir">
                </div>

                <div class="col-md-2">
                  <select name="kategori" id="category" onchange="searchdata('1')" class="form-control kategori" data-live-search="true">
                    <option selected value="IP">IP</option>
                    <option value="OP">OP</option>
										<option value="OB">OB</option>
                  </select>
                </div>

                <div class="col-md-2">
                  <select name="penjamin" id="penjamin" onchange="searchdata('1')" class="form-control penjamin" data-live-search="true">
                    <option selected value="">Semua</option>
                    <option value="24">BPJS</option>
                  </select>
                </div>

                <div class="col-md-3">
                  <form method="POST" action="<?php echo base_url("Cs/export") ?>" target="_blank">
                    <div class="form-group">
                      <input type="hidden" id="out1" class="form form-control form-control-sm tanggalawal" value="<?php echo date("Y-m-d") ?>" onchange="searchdata('1')" name="tanggalawal">
                      <input type="hidden" id="out2" class="form form-control form-control-sm tanggalakhir" value="<?php echo date("Y-m-d") ?>" onchange="searchdata('1')" name="tanggalakhir">
                      <input type="hidden" id="out3" class="form form-control form-control-sm category" value="IP" onchange="searchdata('1')" name="category">
                      <input type="hidden" id="out4" class="form form-control form-control-sm penjamin" value="" onchange="searchdata('1')" name="penjamin">
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-primary"> Expr Rincian</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- ./row -->
            <div class="row">
              <div class="col-12 col-12">
                <div class="card card-primary card-tabs">
                  <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Rincian</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" onclick="searchresume()" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Resume</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                      <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <section class="content" style="margin-top: 15px;">
                          <div class="container">
                            <div class="container">
                            </div>
                            <div class="card">
                              <div class="card-header">
                                <div class="row">
                                  <div class="col-md-6">

                                    <input type="text" name="cari" class="form-control search" placeholder="Search.." onkeyup="searchdata('1')">
                                  </div>
                                  <div class="col-md-6">
                                    <select class=" form-control limitperpage" onchange="searchdata('1')">
                                      <option value="5">5</option>
                                      <option value="50">50</option>
                                      <option value="100">100</option>
                                      <option value="150">150</option>
                                      <option value="200">200</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <?= $this->session->flashdata('message'); ?>
                              <table id="table" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>No.</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Penjamin</th>
                                  </tr>
                                </thead>
                                <!-- datanya di sini -->
                                <tbody class="dataobat">

                                </tbody>
                              </table>
                              <!-- paginationnya disini -->
                              <div class="datapagination">
                              </div>
                            </div>
                          </div>

                      </div>
                      <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        <section class="content" style="margin-top: 15px;">
                          <div class="container">
                            <div class="container">

                            </div>
                            <?= $this->session->flashdata('message'); ?>
														<input type="hidden" id="in1" class="form form-control form-control-sm tanggalawal" value="<?php echo date("Y-m-d") ?>" onchange="searchresume('1')" name="tanggalawal">
														<input type="hidden" id="in2" class="form form-control form-control-sm tanggalakhir" value="<?php echo date("Y-m-d") ?>" onchange="searchresume('1')" name="tanggalakhir">
														<input type="hidden" id="in3" class="form form-control form-control-sm category" value="IP" onchange="searchresume('1')" name="category">
                            <section class="content" style="margin-top: 15px;">
											                    <!-- DIRECT CHAT -->
						<div class="card direct-chat direct-chat-primary">
                        <!-- /.card-header -->
						<div class="alert alert-warning" role="alert">
							 <b><i><small>*Scroll Table Untuk melihat lebih banyak data</i></small></b>
							</div>
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
                                <table class="table table-head-fixed text-nowrap">
                              <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Nama Obat</th>
                                  <th>Jumlah</th>
                                </tr>
                              </thead>
                              <!-- datanya di sini -->
                              <tbody class="dataresume">
                              </tbody>
                            </table>
                            <!-- paginationnya disini -->
                            <div class="pagination">
                            </div>
                          </div>
                      </div>
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
          </div>

        </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!-- Jquery Export Excel -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#tgl1').change(function() {
      $('#out1').val($(this).val());
      $('#myDIVTag').html('<b>' + $(this).val() + '</b>');
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tgl2').change(function() {
      $('#out2').val($(this).val());
      $('#myDIVTag').html('<b>' + $(this).val() + '</b>');
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#category').change(function() {
      $('#out3').val($(this).val());
      $('#myDIVTag').html('<b>' + $(this).val() + '</b>');
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#penjamin').change(function() {
      $('#out4').val($(this).val());
      $('#myDIVTag').html('<b>' + $(this).val() + '</b>');
    });
  });
</script>
<!-- End Jquery Export Excel -->

<!-- Jquery Export Excel -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#tgl1').change(function() {
      $('#in1').val($(this).val());
      $('#myDIVTag').html('<b>' + $(this).val() + '</b>');
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tgl2').change(function() {
      $('#in2').val($(this).val());
      $('#myDIVTag').html('<b>' + $(this).val() + '</b>');
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#category').change(function() {
      $('#in3').val($(this).val());
      $('#myDIVTag').html('<b>' + $(this).val() + '</b>');
    });
  });
</script>
<!-- End Jquery Export Excel -->

<!-- Jquery Rincian -->
<script>
  function searchdata(pagestart) { // nama function buat pagination atau proses search,perpage atau page change
    //-- filter class
    // var ini bisa di tambah kalo mau nambahin kriteria pencarian lain selain input search
    var search = $(".search").val();
    var tanggalawal = $(".tanggalawal").val();
    var tanggalakhir = $(".tanggalakhir").val();
    var kategori = $(".kategori").val();
    var penjamin = $(".penjamin").val();
    var limitperpage = $(".limitperpage").val();
    var page = pagestart;

    var form_data = new FormData();
    form_data.append('cari', search);
    form_data.append('tanggalawal', tanggalawal);
    form_data.append('tanggalakhir', tanggalakhir);
    form_data.append('kategori', kategori);
    form_data.append('penjamin', penjamin);
    form_data.append('limitperpage', limitperpage);
    form_data.append('page', page);


    $.ajax({
      url: "<?php echo base_url("cs/ajaxdata") ?>",
      dataType: 'JSON',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      beforeSend: function() {
        //$(".preloader").show();
      },
      success: function(x) {
        //$(".preloader").hide();
        $('#inline').prop('checked', true);
        $('tbody.dataobat').html(x.listdata);
        $(".datapagination").html(x.pagination);
        //alert(x.tesaja);
      },
      error: function(response) {
        alert('Try Again');
        //$(".preloader").hide();
      }
    });

  }
</script>
<!-- End Jquery Rincian -->

<!-- Jquery Resume -->
<script>
  function searchresume(page) {
    var cari = $(".cari").val();
    var tanggalawal = $(".tanggalawal").val();
    var tanggalakhir = $(".tanggalakhir").val();
    var kategori = $(".kategori").val();
    var limitperpage = $(".limit").val();
    var page = page;

    var form_data = new FormData();
    form_data.append('cari', cari);
    form_data.append('tanggalawal', tanggalawal);
    form_data.append('tanggalakhir', tanggalakhir);
    form_data.append('kategori', kategori);
    form_data.append('limit', limitperpage);
    form_data.append('page', page);
    // ini untuk proses post ke controller seperti pemanggian input type text name='nama'

    $.ajax({
      url: "<?php echo base_url("cs/ajaxresume") ?>",
      dataType: 'JSON',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      beforeSend: function() {
        //$(".preloader").show();
      },
      success: function(x) {
        $('.dataresume').html(x.listdata);
        $(".pagination").html(x.pagination);
      },
      error: function(response) {
        alert('Try Again');
        //$(".preloader").hide();
      }
    });
  }
</script>
<!-- End Jquery Resume -->
