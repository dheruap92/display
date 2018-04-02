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
            <div class="box box-default">
                <div class="box-header">
                    Aksi Table
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <button class="btn btn-xs btn-default" data-rel="tooltip" title="Refresh data" onClick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
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
                                  <th>Aksi</th>
                              </tr>
                          </tfoot>
                      </table>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->

<script>  
  var base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/aplikasi/js/cekout.js"> </script>