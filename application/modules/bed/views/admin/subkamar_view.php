<?php 
$style= "";
foreach($kamar as $row) { ?>
<div class="col-md-4" style="height:100px;margin:10px 0">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo strtoupper($row->nama_kamar)." -- ".strtoupper($row->kelas)?></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body" style="" id="hasilBed">
        <?php 
          $id_kamar = $row->id_kamar;
          $data_bed  = $this->admin->getBedById($id_kamar)->result();
          foreach  ( $data_bed as $rows ) {
            if($rows->status=='1') {
              $style ="color:red";
              echo '<div class="col-md-3 col-sm-4" style="'.$style.'"><i class="fa fa-fw fa-bed fa-lg" onclick="return(cekout('.$rows->id_bed.',\''.$row->nama_kamar.'\',\''.$row->kelas.'\',\''.$rows->no_bed.'\'))"></i></div>';
            } else {
              $style ="color:green";
              echo '<div class="col-md-3 col-sm-4" style="'.$style.'"><i class="fa fa-fw fa-bed fa-lg" onclick="return(cekin('.$rows->id_bed.',\''.$row->nama_kamar.'\',\''.$row->kelas.'\',\''.$rows->no_bed.'\'))"></i></div>';
            }
         
          }
        ?>
        <script>
        function cekin(id_bed,kamar,kelas,no_bed) {
          var paviliun = $("#paviliun option:selected").text();
          var petugas = $("#petugasname").text();
          bootbox.confirm("Yakin Untuk Cekin",function (result){
              if (result) {
                 $.ajax({
                    url : base_url+"bed/reservasi/cekin/tambah",
                    method : "POST", 
                    data : {"id_bed":id_bed,"kamar":kamar,"kelas":kelas,"paviliun":paviliun,"petugas":petugas,'no_bed':no_bed},
                    success : function (data) {
                        //console.log(data);
                        $("#cariKamar").trigger("click");
                        $id_paviliun = $("#paviliun").val();
                        table.ajax.reload();
                    }
                  });
              }
          });

        }

        function cekout(id_bed,kamar,kelas,no_bed) {
          var paviliun = $("#paviliun option:selected").text();
          var petugas = $("#petugasname").text();
          bootbox.confirm("Yakin Untuk Cekout",function (result){
              if (result) {
                   $.ajax({
                      url : base_url+"bed/reservasi/cekin/out",
                      type: "POST",
                      data: {"id_bed":id_bed,"kamar":kamar,"kelas":kelas,"paviliun":paviliun,"petugas":petugas,'no_bed':no_bed},
                      dataType: "JSON",
                      success: function(data)
                      { 
                          $("#cariKamar").trigger("click");
                          $id_paviliun = $("#paviliun").val();
                          table.ajax.reload();
                     
                      },
                      error: function (e)
                      {
                          console.log(e);
                          bootbox.alert('Error adding / update data'); 
                      }
                  });
              }
          });
        }
        </script>
      </div>
    </div>
</div>
<?php } ?>
<div class="col-md-12" >
   
</div>
<div class="col-md-6" style="margin:30px 0">
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">Table Perkelas</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <table class="table table-condensed">
              <tr>
                  <th>Kelas</th>
                  <th>Total Bed</th>
                  <th>Terisi</th>
                </tr>
              <?php 
                foreach ($kelas as $row_kelas) {
              ?>
                <tr>
                  <td><?php echo $row_kelas->kelas ?></td>
                  <td><?php echo $row_kelas->tersedia ?></td>
                  <td><?php echo $row_kelas->terisi?></td>
                </tr>
              <?php      
                   }
                
              ?>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
</div>
<div class="col-md-6" style="margin:30px 0">
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">Table Keseluruhan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
           <table class="table table-hover" id="mytable">
                <thead>
                  <tr>
                    <th>Paviliun</th>
                    <th>Tersedia</th>
                    <th>Digunakan</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($totalTersedia as $row) {
                  $terisi = ($row->jumlah)-($row->terisi);
                  echo "<tr>
                    <td>".strtoupper($row->nama_paviliun)."</td>
                    <td>".$row->jumlah."</td>
                    <td>".$terisi."</td>
                  </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
      </div>
</div>
