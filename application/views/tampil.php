<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: white;">
    <!-- Main content -->
    <section class="content" style="margin-top: 15px;">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-md">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                </div>

                        <div class="card">
                            <div class="card-header">
                                FIlter
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
									<select id="tahun" name="tahun" size="1" class="form-control tahun" onchange="searchdata('1')">
										<option value="">--Pilih Tahun--</option>
										<?php
										$tgl_akhir = date('Y') + 3;
										for ($i = $tgl_akhir; $i >= date('Y') - 1; $i -= 1) {
											echo "<option value='$i'> $i </option>";
										}
										?>
									</select>
                                    </div>
                                    <div class="col-md-3">
									<select id="bln" name="bln" size="1" class="form-control bln" onchange="searchdata('1')">
										<option value="">--Pilih Bulan--</option>
										<?php
										$tahun = date("Y");
										$bulan1 = date("m");
										$bulan = date("m") * 1 - 1;
										for ($i = 1; $i < 13; $i++) {
											$nbln = date("F", strtotime($tahun . '-' . $i . '-01'));
											$nrbln = date("m", strtotime($tahun . '-' . $i . '-01'));
											echo '<option value="' . $nbln . '">' . $nbln . '</option>';
										}
										?>
									</select>
                                    </div>
									<div class="col-md-3">
									<form method="POST" action="<?php echo base_url("form/xls") ?>" target="_blank">
											<input type="hidden" id="in1" class="form form-control form-control-sm" value="" onchange="searchdata('1')" name="tahun">
											<input type="hidden" id="in2" class="form form-control form-control-sm" value="" onchange="searchdata('1')" name="bln">
									</div>
									<div class="col-md-3">
                                        <button style="width:100%" type="submit" class="btn tbn-sm btn-primary">Export</button>
                                    </div>
									</form>
									</div>
                            </div>
                        </div>


						<div class="card">
                            <div class="card-header">
                            <i class="fa fa-bullhorn"></i> <strong>SEND DRAFT TO OUTBOX / BROADCAST</strong>
                            </div>
                            <div class="card-body">
							<div class="row">
											<div class="col-sm-2">
												<select class="form form-control form-control-sm limitperpage" onchange="searchdata('1')">
													<option value="5">5</option>
													<option value="50">50</option>
													<option value="100">100</option>
													<option value="150">150</option>
													<option value="200">200</option>
												</select>
											</div>
											<div class="form-group">
												<input type="text" class="form form-control form-control-sm search" placeholder="Search Nama.." onkeyup="searchdata('1')">
											</div>&nbsp;&nbsp;

										</div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
											<th>Caseid</th>
                                            <th>Mr</th>
                                            <th>Nama</th>
                                            <th>Ruangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="datalist">
                                       
                                        
                                          
                                    </tbody>
                                    <tfoot>
                                        <tr>
											<th>No.</th>
											<th>Caseid</th>
                                            <th>Mr</th>
                                            <th>Nama</th>
                                            <th>Ruangan</th>
                                        </tr>
                                    </tfoot>
                                </table>
								<!-- paginationnya disini -->
								<div class="datapagination">
										</div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </section>
</div>

<!-- Jquery Export Excel -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#tahun').change(function() {
			$('#in1').val($(this).val());
			$('#myDIVTag').html('<b>' + $(this).val() + '</b>');
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#bln').change(function() {
			$('#in2').val($(this).val());
			$('#myDIVTag').html('<b>' + $(this).val() + '</b>');
		});
	});
</script>
<!-- End Jquery Export Excel -->


<!-- Ajax Tampil Data -->
<script>
  $(document).ready(function() {
    //alert('tes');
    searchdata(1);
  });
</script>
<script>
  function searchdata(pagestart) { // nama function buat pagination atau proses search,perpage atau page change
    //-- filter class
    var search = $(".search").val();
	var tahun = $(".tahun").val();
	var bln = $(".bln").val();

    var limitperpage = $(".limitperpage").val();
    var page = pagestart;
    // var ini bisa di tambah kalo lu mau nambahin kriteria pencarian lain selain input search
    var form_data = new FormData();
    form_data.append('cari', search);
	form_data.append('tahun', tahun);
	form_data.append('bln', bln);

    form_data.append('limitperpage', limitperpage);
    form_data.append('page', page);
    // ini untuk proses post ke controller seperti pemanggian input type text name='nama'

    $.ajax({
      url: "<?php echo base_url("form/Ajaxtampil") ?>",
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
        //alert('uyee');
        //$(".preloader").hide();
        $('#inline').prop('checked', true);
        $('tbody.datalist').html(x.data);
        $(".datapagination").html(x.pagination);


      },
      error: function(response) {
        alert('Try Again');
        //$(".preloader").hide();
      }
    });

  }
</script>

