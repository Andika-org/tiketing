<?php
extract($_GET);
?>
<div class="content-wrapper" style="background-color: white;">
  <!-- Main content -->
  <section class="content" style="margin-top: 15px;">
    <div class="container">
      <div class="container">
      <div class="card">
                    <div class="card-body"> 
                       <form action="<?= base_url('Cs/showresume');?>" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="date" class="form-control" required name="tanggalawal" value="<?= @$tanggalawal; ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" value="<?= @$tanggalawal; ?>" class="form-control" required name="tanggalakhir">
                                 </div>
                                 <div class="col-md-3">
                                    <select name="unit" id="unit"  class="form-control">
                                        <option value="Radiology">Radiology</option>
                                    <?php foreach ($Unit as $data) : ?>
                                       <option value="<?= $data['sDescription'] ?>"><?= $data['sDescription'] ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                 </div>
                            
                            <div class="col-md-3">
                                <div class="col-md-12">
                                    <button style=" -webkit-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0); box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);" type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-filter"></i> Tampilkan</button>

				
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card-header bg-primary">
            <table>
              <tbody>
                <tr>
                  <td style="padding-bottom: 10%; padding-top: 11%"><i class="fa fa-building fa-5x" style="width: 20px;"></i><div class="text-white"><b>DOCTOR SENDER</b></div></td>
                  <td style="padding-bottom: 20%; padding-top: 11%;">
                  </td>
                </tr>
                <tr>
                </tr>
              </tbody>
            </table>
            
          </div>
          <div class="card-body">
          <div class="row">
          
          </div>
            
            <?= $this->session->flashdata('message'); ?>
            <table id="example1" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Dokter</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <!-- datanya di sini -->
              <tbody>
              <?php
              extract($_GET);
              if (isset($tanggalawal)) {
                  // ambil dokter
                  $no=1;
                  // $dokter = $this->db->get_where('Doctor', ['active'=>'T'])->result();
                  $dokter = $this->db->query("SELECT * FROM Doctor WHERE active = 'T' AND [DoctorID] NOT IN (0)")->result();
                  foreach($dokter as $dok):
                  
                    // QUERY DOKTER PENGIRIM
                    $data2 = $this->db->query("SELECT * FROM Activity a, MedicalProcedure m, Cases c, TransactionHeader t WHERE a.Activity = m.ProcedureCode AND a.[Case ID] = c.[Case ID]
                    AND a.TransactionID = t.TransactionID AND m.Category = '$unit' AND t.Transaction_Date between '$tanggalawal' and '$tanggalakhir' AND a.DoctSender = '$dok->DoctorID'");

                    $dokSender = $data2->num_rows();
                    if($dokSender < 1)
                    {
                      echo'';
                    }else{
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $dok->FirstName; ?></td>
                        <td><?= $dokSender; ?></td>
                    </tr>
                  <?php 

                    }
                endforeach;
              }
              ?>
                  
              </tbody>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Nama Dokter</th>
                  <th>Jumlah</th>
                </tr>
              </tfoot>
            </table>

          </div>
        </div>
        <div class="col-md-6">
          <div class="card-header bg-primary">
            <table>
              <tbody>
                <tr>
                  <td style="padding-bottom: 10%; padding-top: 11%">
									<i class="fa fa-building fa-5x" style="width: 20px;"></i>
									<div class="text-white"><b>DOCTOR SENDER</b></div>
									</td>
                  <td style="padding-bottom: 10%; padding-top: 11%;">

                  </td>
                </tr>
                <tr>
                </tr>
              </tbody>
            </table>
            <div class="row">
            </div>
          </div>
					<br>
          <table id="example2" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Dokter</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <!-- datanya di sini -->
              <tbody>
              <?php
              extract($_GET);
              if (isset($tanggalawal)) {
                  // ambil dokter
                  $no=1;
                  // $dokter = $this->db->get_where('Doctor', ['active'=>'T'])->result();
                  $dokter = $this->db->query("SELECT * FROM Doctor WHERE active = 'T' AND [DoctorID] NOT IN (0)")->result();
                  foreach($dokter as $dok):
                  
                    // QUERY DOKTER PENGIRIM
                    $data3 = $this->db->query("SELECT * FROM Activity a, MedicalProcedure m, Cases c, TransactionHeader t WHERE a.Activity = m.ProcedureCode AND a.[Case ID] = c.[Case ID]
                    AND a.TransactionID = t.TransactionID AND m.Category = '$unit' AND t.Transaction_Date between '$tanggalawal' and '$tanggalakhir' AND a.DoctReader = '$dok->DoctorID'");

                    $dokReader = $data3->num_rows();
                    if($dokReader < 1)
                    {
                      echo'';
                    }else{
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $dok->FirstName; ?></td>
                        <td><?= $dokReader; ?></td>
                    </tr>
                  <?php 

                    }
                endforeach;
              }
              ?>
                  
              </tbody>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Nama Dokter</th>
                  <th>Jumlah</th>
                </tr>
              </tfoot>
            </table>

        </div>
      </div>
    </div>
</div>
</section>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#dokter').select2();
  });
</script>
