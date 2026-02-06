<?php
extract($_GET);
?>
<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-N2yAiKRjFukQkyIu"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

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
							</div>
							<div class="row">
								<!-- FORM -->
								<div class="col-lg-12">
								<?php
								foreach ($filter as $data) :
								?>
								<form action="<?= base_url('updatebed/update_bed/'. $data->caseid); ?>" method="post">
											<div class="row">
												<div class="col-lg-12">
													<div class="input-group mb-3">
														<input type="text" placeholder="Case ID" class="form-control" name="caseid" value="<?= $data->caseid; ?>" required aria-describedby="basic-addon2">
													</div>
												</div>
											</div>
										<div class="row">
										<div class="col-lg-3">
												<div class="form-group">
													<label for="exampleInputEmail1">Mr</label>
													<input type="text" class="form-control" name="PatientCode" value="<?= $data->PatientCode; ?>" readonly>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label for="exampleInputEmail1">Nama</label>
													<input type="text" class="form-control" name="Description" value="<?= $data->Description; ?>" readonly>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label for="exampleInputEmail1">Status</label>
													<input type="text" class="form-control" name="status" value="<?= $data->casestatus; ?>" readonly>
												</div>
											</div>
											<div class="col-md-3">
												<label for="exampleInputEmail1">Room</small></label>
												<select name="room" class="form-control" required>
													<option value="">- Pilih -</option>
													<?php
													foreach ($room as $ed) :
														if ($data->Room == $ed['OfficeName']) {
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
									<button type="submit" class="btn btn-primary save"><i class="fa fa-save"></i> Save</button>
								</div>
							</div>
							</form>
						</div>
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

					<script>
					$(function(){
						$('.save').on("click", function(){
							if(confirm('Are you sure to save')) {
							
							return true;
							}

							return false;
							});
						});
					</script>
					<script>
					<?php if ($this->session->flashdata('message')) { ?>
					Swal.fire({
						title: 'Are you sure?',
							text: "You won't be able to revert this!",
							icon: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Yes, delete it!'
							}).then((result) => {
							if (result.isConfirmed) {
								Swal.fire(
								'Deleted!',
								'Your file has been deleted.',
								'success'
								)
							}
						})
					<?php } ?>
					</script>

					

