<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-N2yAiKRjFukQkyIu"></script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<h1 class="m-0">Update Bed kamar</h1>
						</div>
						<!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
								<li class="breadcrumb-item active">Update Bed Kamar</li>
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
								<div class="col-lg-6"><i class="fa fa-fw fa-edit"></i> Update Bed Kamar

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
									<form action="<?= base_url('updatebedlab/filterubahklslab'); ?>" method="GET">
										<div class="row">
											<div class="col-lg-6">
												<div class="input-group mb-3">
													<input type="text" placeholder="Mr Patient" class="form-control" name="No_Pasien" value="" required aria-describedby="basic-addon2">
													<input type="date" placeholder="tanggal" class="form-control" name="modified_date" value="" required aria-describedby="basic-addon2">
													<input type="date" placeholder="tanggal" class="form-control" name="modified_date1" value="" required aria-describedby="basic-addon2">
													<div class="input-group-append">
														<button class="btn btn-success" type="submit">Cari</button>
													</div>
												</div>
											</div>
										</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
</div>
