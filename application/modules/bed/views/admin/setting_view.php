<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="<?php echo site_url()?>bed/admin"><?php echo $link1 ?></a>
        <small><?php echo $link2 ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $link1 ?></a></li>
        <li class="active"><?php echo $link2 ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-8 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                   <form action="" method="POST" role="form">

                     <legend>Form title</legend>
                   
                     <div class="form-group">
                        <div class="col-md-2">
                          <label for="">Lagu</label>
                        </div>
                        <div class="col-md-6">
                          <select class="form-control select2" id="song">
                          <label for="">Backsound</label>
                            <?php
                              $song = directory_map("./assets/aplikasi/audio");
                              foreach ($song as $key=>$value) {
                                  echo "<option val='".$value."'>".$value."</option>";
                              }
                            ?>
                          </select>  
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary" onclick="pilih()">Play</button>
                        </div>
                     </div>
                   </form>
                </div>
            </div>
        </div>
    </div>    
</section><!-- /.content -->

<script>	
	var base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/aplikasi/js/setting.js"> </script>


