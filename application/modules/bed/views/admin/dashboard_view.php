<script>  
  var base_url = "<?php echo base_url() ?>";
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php if (!empty($this->session->flashdata("message"))) {?>   
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo $this->session->flashdata("message"); ?></strong>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-lg-4 col-xs-12">
            <div class="row">
              <div class="col-lg-12 col-lg-12">
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Tolong Nama Petugas di set dulu ketika pergantian sift.cukup 1 kali saja di set</strong>
                </div>
              </div>
              <div class="col-lg-12 col-lg-12">
                   <div class="box box-success">
                        <div class="box-header">
                            <h5>User Set</h5>
                        </div>
                        <div class="box-body">
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                          <label for="petugas">Petugas : <b id="petugasname"><?php echo $this->session->has_userdata("petugas")?$this->session->userdata("petugas"):"noname" ?></b></label>
                                          <input type="text" class="form-control" id="petugas" placeholder="Masukkan Petugas" value="<?php echo  $this->session->userdata("petugas") ?>">
                                        </div>        
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">--</label>
                                          <button type="button" class="btn btn-xs btn-primary form-control" onclick="setPetugas()">SET</button>
                                        </div>         
                                    </div>
                                </div>  
                            </div>
                             <div class="row">
                                <div class="col-lg-8">
                                    <select name="paviliun" id="paviliun" class="form-control">
                                        <option value="">-- Select One --</option>
                                        <?php
                                            foreach ($paviliun as $r) {
                                                echo '<option value="'.$r->id_paviliun.'">'.$r->nama_paviliun.'</option>';
                                            } 
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-default" id="cariKamar">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
            </div>
           
        </div>
        <div class="col-lg-8 col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h5>Log Activity</h5>
                </div>
                <div class="box-body">
                    <table id="mytable" class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th><input type="checkbox" id="check-all"></th>
                                  <th>No</th>
                                  <th>Paviliun</th>
                                  <th>Kamar</th>
                                  <th>Kelas</th>
                                  <th>Nomor Bed</th>
                                  <th>Tanggal</th>
                                  <th>Aksi</th>
                                  <th>Petugas</th>
                              </tr>
                          </thead>
                      </table>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
           
        </div>
    </div>
    <div class="row" style="margin-top:10px" id="hasilCari">
     
    </div>
</section><!-- /.content -->

<script type="text/javascript" src="<?php echo base_url()?>assets/aplikasi/js/dashboard.js"> </script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/AdminLTE-2.3.11/dist/js/demo.js" type="text/javascript"></script>