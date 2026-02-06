<?php
extract($_GET);
?>
<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-N2yAiKRjFukQkyIu"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<h1 class="m-0">Ubah Bed Kamar</h1>
						</div>
						<!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
								<li class="breadcrumb-item active">Ubah Bed Kamar</li>
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

			<div class="row">
				<div class="col-lg-12">

					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-lg-6"><i class="fa fa-fw fa-edit"></i> Ubah Bed Kamar

								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12 alert-remove">
									<?= $this->session->flashdata('message'); ?>
								</div>
							</div>
							<div class="row">
								<!-- FORM -->
								<div class="col-lg-12">
								<?php
								foreach ($filter as $data) :
								?>
								<form action="<?= base_url('updatebedlab/update_bedlab/'. $data->Kode_Kunjungan); ?>" method="post">
											<div class="row">
												<div class="col-lg-12">
													<div class="input-group mb-3">
														<input type="text" placeholder="Case ID" class="form-control" name="No_Pasien[]" value="<?= $data->No_Pasien; ?>" required aria-describedby="basic-addon2">
													</div>
												</div>
											</div>
										<div class="row">
										<div class="col-lg-3">
												<div class="form-group">
													<label for="exampleInputEmail1">Kode Kunjungan</label>
													<input type="text" class="form-control" name="Kode_Kunjungan[]" value="<?= $data->Kode_Kunjungan; ?>" readonly>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label for="exampleInputEmail1">Nama</label>
													<input type="text" class="form-control" name="Nama[]" value="<?= $data->Nama; ?>" readonly>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label for="exampleInputEmail1">Tanggal</label>
													<input type="text" class="form-control" name="modified_date[]" value="<?= $data->modified_date; ?>" readonly>
												</div>
											</div>
											<div class="col-md-3">
												<label for="exampleInputEmail1">Room</small></label>
												<select name="Ruang[]" class="form-control" >
													<option value="">- Pilih -</option>
													<?php
													foreach ($room as $ed) :
														if ($data->Ruang == $ed['OfficeName']) {
													?>
															<option selected value="<?= $ed['OfficeName']; ?>"><?= $ed['OfficeName']; ?></option>
														<?php
														} else {
														?>
															<option value="<?= $ed['OfficeName']; ?>"><?= $ed['OfficeName']; ?></option>
													<?php
														}
													endforeach;
													?>
												</select>
												<hr>
											</div>
										</div>
									<?php endforeach; ?>
									<div class="row">
									</div>
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-12" align="right">
									<br>
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
					</div>


					<script type="text/javascript">
						$(".myselect").select2({
							minimumInputLength: 3,
							allowClear: true,
							placeholder: 'masukkan penjamin'
						});
					</script>
