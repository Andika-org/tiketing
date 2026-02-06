<a href="<?= base_url('form/tambah/'. $l->idinput); ?>" class="btn btn-primary btn-sm" > <i class="fa fa-plus"></i></a>
<a href="<?= base_url('form/editceklis/'. $l->idbln); ?>" class="btn btn-danger btn-sm"> <i class="fa fa-edit"></i></a>
										<a href="<?= base_url('form/editlis/'. $l->idinput); ?>" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i></a>				
										<a href="<?= base_url('form/del/' . $l->idinput); ?>" onclick="return confirm('Apakah data ini akan dihapus ?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        <td colspan="4" class="bg-success"><?= $l->bln; ?>-<?= $l->tahun; ?></td>


                                        <div class="card">
                            <div class="card-header">
                                FIlter
                            </div>
                            <div class="card-body">
                                <div class="row">
								<form action="<?= base_url('form/filter'); ?>" method="GET">
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
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
									<div class="col-md-6">
                                        <button style="width:100%" type="submit" class="btn tbn-sm btn-primary">Cari</button>
                                    </div>
								</form>
								</div>
								<div class="row">
									<div class="col-md-2">
									<form method="POST" action="<?php echo base_url("form/xls") ?>" target="_blank">
											<input type="hidden" id="in1" class="form form-control form-control-sm" value="" onchange="searchdata('1')" name="tahun">
											<input type="hidden" id="in2" class="form form-control form-control-sm" value="" onchange="searchdata('1')" name="bln">
									</div>
                                        <button type="submit" class="btn tbn-sm btn-primary">Ex</button>
									</form>
									</div>
                            </div>
                        </div>
