<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Reservasi
        <small>Cekin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Reservasi</a></li>
        <li class="active">Cekin</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $data_reservasi[0]->cekin ?></h3>
                    <p>Total Cekin</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $data_reservasi[0]->cekout?></h3>
                    <p>Total Cekout</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $data_reservasi[0]->total ?></h3>
                    <p>Total Reservasi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-lg-5 col-xs-12">
            <div class="box box-default collapsed-box">
                <div class="box-header">
                    Aksi Table
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <button class="btn btn-xs btn-success" data-rel="tooltip" title="Add Data" onClick="add()"><i class="glyphicon glyphicon-plus"></i>Cekin</button>
                    <button class="btn btn-xs btn-warning" data-rel="tooltip" title="Add Data" onClick="out()"><i class="glyphicon glyphicon-plus"></i>Cekout</button>
                    <button class="btn btn-xs btn-default" data-rel="tooltip" title="Refresh data" onClick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xs-12">
            <div class="box box-default collapsed-box">
                <div class="box-header">
                    Pencarian
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <form>
                      <div class="row">
                        <div class="col-xs-5">
                          Nama : 
                          <input type="text" class="form-control" placeholder=".col-xs-5">
                        </div>
                        <div class="col-xs-5">
                          No MR
                          <input type="text" class="form-control" placeholder=".col-xs-4">
                        </div>
                        <div class="col-xs-2">
                          &nbsp&nbsp
                          <button type="button" class="btn btn-default">Cari</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <table id="mytable" class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th><input type="checkbox" id="check-all"></th>
                                  <th>No</th>
                                  <th>ID</th>
                                  <th>Nama</th>
                                  <th>Nomor MR</th>
                                  <th>Jenis Kelamin</th>
                                  <th>Tanggal Cekin</th>
                                  <th>Tanggal Cekout</th>
                                  <th>Status Reservasi</th>
                                  <th>Bed Info</th>
                                  <th>Petugas</th>
                                  <th>Modified</th>
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th><input type="checkbox" id="check-all"></th>
                                  <th>No</th>
                                  <th>ID</th>
                                  <th>Nama</th>
                                  <th>Nomor MR</th>
                                  <th>Jenis Kelamin</th>
                                  <th>Tanggal Cekin</th>
                                  <th>Tanggal Cekout</th>
                                  <th>Status Reservasi</th>
                                  <th>Bed Info</th>
                                  <th>Petugas</th>
                                  <th>Modified</th>
                                  <th>Aksi</th>
                              </tr>
                          </tfoot>
                      </table>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
<!-- Modal Form -->
<!-- Bootstrap modal -->
<!-- cekin -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-horizontal" class='has-error' method="post">
                  <div class="box box-warning">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <form role="form">
                        <div class="form-group">
                          <label class="control-label" >Nama</label>
                          <input type="hidden" class="form-control input-sm" id="id_pk" name="id_pk" placeholder="Enter ..." >
                          <input type="text" class="form-control input-sm" id="nama" name="nama" placeholder="Enter ...">
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label" >Nomor MR</label>
                          <input type="text" class="form-control input-sm" id="no_mr" name="no_mr" placeholder="Enter ...">
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label" >Jenis Kelamin</label>
                          <select class="form-control" name="jk" style="width: 100%;">
                            <option value='lk'>Laki-Laki</option>
                            <option value='pr'>Prempuan</option>
                          </select>
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label" >Pilihan Bed</label>
                          <select class="form-control select2" name="id_bed" id="idBed" style="width: 100%;">
                            <?php
                              foreach($bed->result() as $row) {
                                echo "<option value='".$row->id_bed."'>".$row->nama_paviliun."--".$row->nama_kamar."--".$row->kelas."--".$row->no_bed."</option>";
                              } 
                             ?>
                          </select>
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group">
                          <label>Tanggal Cekin:</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="tgl_cekin" id="tgl_cekin" class="form-control pull-right datepicker">
                          </div>
                          <!-- /.input group -->
                        </div>
                      </form>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- cekout -->
<div class="modal fade" id="modal_form_out" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form2" class="form-horizontal" class='has-error' method="post">
                  <div class="box box-warning">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <form role="form">
                        <div class="form-group">
                          <label class="control-label" >Nama / Nomor MR / JK / Id Reservasi</label>
                          <select class="form-control select2" name="id_reservasi" style="width: 100%;">
                            <?php
                              foreach ($reservasi->result() as $row) {
                                echo "<option value='".$row->id_reservasi."'>".$row->nama."/".$row->no_mr."/".$row->jk."/".$row->id_reservasi."</option>";
                              }
                             ?>                            
                          </select>
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group">
                          <label>Tanggal Cekout:</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="tgl_cekout" id="tgl_cekout" class="form-control pull-right datepicker">
                          </div>
                          <!-- /.input group -->
                        </div>
                      </form>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>  
  var base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/aplikasi/js/cekin.js"> </script>