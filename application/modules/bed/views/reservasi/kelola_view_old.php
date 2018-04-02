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
    <div class="row">
    	<div class="col-lg-6 col-xs-12">
          <div class="box box-primary">
              <div class="box-header">
                <h3>Table Paviliun</h3>

              </div>
              <div class="box-body table-responsive no-padding">
                  <table id="paviliun_table" class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="check-all"></th>
                                <th>No</th>
                                <th>Nama Paviliun</th>
                                <th>Keterangan</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><input type="checkbox" id="check-all"></th>
                                <th>No</th>
                                <th>Nama Paviliun</th>
                                <th>Keterangan</th>
                                <th>aksi</th>
                            </tr>
                        </tfoot>
                    </table>
              </div>
          </div>
      </div>
      <div class="col-lg-6 col-xs-12">
          <div class="box box-primary">
              <div class="box-header">
                <h3>Table Kamar | <button class="btn btn-xs btn-success" data-rel="tooltip" title="Add Data" onClick="add_kamar()"><i class="glyphicon glyphicon-plus"></i>Add</button></h3>
              </div>
              <div class="box-body table-responsive no-padding">
                  <table id="kamar_table" class="table table-hover">
                       <thead>
                          <tr>
                              <th><input type="checkbox" id="check-all"></th>
                              <th>No</th>
                              <th>Nama Kamar</th>
                              <th>Kelas</th>
                              <th>Paviliun</th>
                              <th>Aksi</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                              <th><input type="checkbox" id="check-all"></th>
                              <th>No</th>
                              <th>Nama Kamar</th>
                              <th>Kelas</th>
                              <th>Paviliun</th>
                              <th>Aksi</th>
                          </tr>
                        </tfoot>
                        <tbody id="kamar_t_b">
                        </tbody>
                    </table>
              </div>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-xs-12">
          <div class="box box-primary">
              <div class="box-header">
                <h3>Table Bed | <button class="btn btn-xs btn-success" data-rel="tooltip" title="Add Data" onClick="add_bed()"><i class="glyphicon glyphicon-plus"></i>Add</button></h3>
              </div>
              <div class="box-body table-responsive no-padding">
                  <table id="bed_table" class="table table-hover">
                       <thead>
                          <tr>
                            <th><input type="checkbox" id="check-all"></th>
                            <th>No</th>
                            <th>Nama Paviliun</th>
                            <th>Nama Kamar</th>
                            <th>Kelas</th>
                            <th>Nomor Bed</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th><input type="checkbox" id="check-all"></th>
                            <th>No</th>
                            <th>Nama Paviliun</th>
                            <th>Nama Kamar</th>
                            <th>Kelas</th>
                            <th>Nomor Bed</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </tfoot>
                        <tbody id="bed_t_b">
                        </tbody>
                    </table>
              </div>
          </div>
      </div>
    </div>
</section><!-- /.content -->
<!-- Modal Form -->
<!-- Bootstrap modal -->
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
                          <label class="control-label" id="paviliun_text">Paviliun</label>
                          <input type="hidden" class="form-control input-sm" id="id_pk" name="id_pk" placeholder="Enter ..." >
                          <select class="form-control id_paviliun" style="width: 100%;" name="id_paviliun" id="id_paviliun" disable>
                          <?php
                              foreach ($paviliun as $row) {
                                echo "<option value=".$row->id_paviliun.">".strtoupper($row->nama_paviliun)."</option>";
                              }
                          ?>
                          </select>
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label" >Nama Kamar</label>
                          <input type="text" class="form-control input-sm" id="nama_kamar" name="nama_kamar" placeholder="Enter ...">
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label" >Kelas</label>
                          <select class="form-control" name="kelas" style="width: 100%;">
                            <option selected="selected" value='kelas I'>Kelas I</option>
                            <option value="kelas II">Kelas II</option>
                            <option value="kelas III">Kelas III</option>
                            <option value="utama">Utama</option>
                            <option value="VIP">VIP</option>
                            <option value="VVIP">VVIP</option>
                          </select>
                          <span class="help-block">Help block with error</span>
                        </div>
                      

                      </form>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave_bed" onclick="save_kamar()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal_form_bed" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form_bed" class="form-horizontal" class='has-error' method="post">
                  <div class="box box-warning">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <form role="form">
                        <div class="form-group">
                          <label class="control-label" >Paviliun</label>
                          <input type="hidden" class="form-control input-sm" id="id_pk" name="id_pk" placeholder="Enter ..." >
                          <select class="form-control id_paviliun" style="width: 100%;" name="id_paviliun" id="id_paviliun">
                          <?php
                              foreach ($paviliun as $row) {
                                echo "<option value=".$row->id_paviliun.">".strtoupper($row->nama_paviliun)."</option>";
                              }
                          ?>
                          </select>
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group">
                          <label class="control-label" >Kamar</label>
                          <select class="form-control" style="width: 100%;" name="id_kamar" id="id_kamar">
                             <?php
                              foreach ($kamar as $row) {
                                    echo "<option value=".$row->id_kamar.">".strtoupper($row->nama_kamar)."</option>";
                                  }
                              ?>
                          </select>
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label" >Nomor Bed</label>
                          <input type="text" class="form-control input-sm" id="no_bed" name="no_bed" placeholder="Enter ...">
                          <span class="help-block">Help block with error</span>
                        </div>
                      </form>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save_bed()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>  
  var base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/aplikasi/js/kelola.js"> </script>