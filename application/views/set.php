<?php
$i = $this->uri->segment(3);
?>
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
                                <form action="http://localhost/whatsapp/cs/filterBroadcast" method="get">

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
									<button style="width:100%" type="submit" class="btn tbn-sm btn-primary">Cari</button>
                                    </div>
									<form method="POST" action="<?php echo base_url("form/xls") ?>" target="_blank">
                                    <div class="col-md-3">
											<input type="hidden" id="in1" class="form form-control form-control-sm" value="" onchange="searchdata('1')" name="tahun">
											<input type="hidden" id="in2" class="form form-control form-control-sm" value="" onchange="searchdata('1')" name="bln">
											<button type="submit" class="btn tbn-sm btn-primary">Export</button>
									</div>
									</form>
                                    </div>
                                </div>

                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                            <i class="fa fa-bullhorn"></i> <strong>Data Ceklis</strong>
                            </div>
                            <div class="card-body">
							<a href="<?= base_url('form/tambah/'. $i); ?>" class="btn btn-primary btn-sm" > <i class="fa fa-plus"></i> Tambah Ceklisan</a> -
							<a href="<?= base_url('form/editlis/'. $i); ?>" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> Edit Data</a> -				
							<a href="<?= base_url('form/del/'. $i); ?>" onclick="return confirm('Apakah data ini akan dihapus ?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"> Hapus</i></a> -
							<a href="<?= base_url('form/editceklis/'. $i); ?>" class="btn btn-danger btn-sm"> <i class="fa fa-edit"></i>Edit Ceklisan</a><br><br>

                            <div class="table-responsive">
								
                                <table class="table" border="1">
                                    <thead>
                                        <tr>
											<th class="bg-success">Action</th>
                                            <th class="bg-success">MR</th>
                                            <th class="bg-success">Nama</th>
                                            <th class="bg-success">Ruangan</th>
											<?php for($a=1;$a<=31;$a++) { ?>
											<th class="bg-info"><?= $a; ?></th>
											<?php } ?>      
                                        </tr>

                                    </thead>
									
									<?php 
									foreach($lis as $l) : 
									?>
                                    <tbody>
                                       <tr>
										   <td><input id="cb" type="checkbox" onchange="if (this.checked) { window.location.href='<?= base_url('form/ceklis/'. $l->idinput); ?>'}">
										   <td><?= $l->mr; ?></td>
										   <td><?= $l->nama; ?></td>
										   <td><?= $l->ruangrawat; ?></td>
										   <td><?= $l->tgl1; ?></td>
														<td><?= $l->tgl2; ?></td>
														<td><?= $l->tgl3; ?></td>
														<td><?= $l->tgl4; ?></td>
														<td><?= $l->tgl5; ?></td>
														<td><?= $l->tgl6; ?></td>
														<td><?= $l->tgl7; ?></td>
														<td<?= $l->tgl8; ?></td>
														<td<?= $l->tgl9; ?></td>
														<td<?= $l->tgl10; ?></td>
														<td<?= $l->tgl11; ?></td>
														<td<?= $l->tgl12; ?></td>
														<td<?= $l->tgl13; ?></td>
														<td><?= $l->tgl14; ?></td>
														<td><?= $l->tgl15; ?></td>
										   <td><?= $l->tgl16; ?>
														<td><?= $l->tgl17; ?></td>
														<td><?= $l->tgl18; ?></td>
														<td><?= $l->tgl19; ?></td>
														<td><?= $l->tgl20; ?></td>
														<td><?= $l->tgl21; ?></td>
														<td><?= $l->tgl22; ?></td>
														<td><?= $l->tgl23; ?></td>
														<td><?= $l->tgl24; ?></td>
														<td><?= $l->tgl25; ?></td>
														<td><?= $l->tgl26; ?></td>
														<td><?= $l->tgl27; ?></td>
														<td><?= $l->tgl28; ?></td>
														<td><?= $l->tgl29; ?></td>
														<td><?= $l->tgl30; ?></td>
														<td><?= $l->tgl31; ?></td>
									   </tr>
                                          
                                    </tbody>
									<?php endforeach; ?>
                                    <tfoot>
                                        <tr>
										<th class="bg-success">Action</th>
                                        <th class="bg-success">MR</th>
                                            <th class="bg-success">Nama</th>
                                            <th class="bg-success">Ruangan</th>
											<?php for($a=1;$a<=31;$a++) { ?>
											<th class="bg-info"><?= $a; ?></th>
											<?php } ?> 
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </section>
</div>
