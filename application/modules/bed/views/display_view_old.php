<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/AdminLTE-2.3.11/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/AdminLTE-2.3.11/dist/css/AdminLTE.min.css">

  <link href='http://fonts.googleapis.com/css?family=Open+Sans|Baumans' rel='stylesheet' type='text/css'>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    /*css reset*/
      /* http://meyerweb.com/eric/tools/css/reset/ 
         v2.0 | 20110126
         License: none (public domain)
      */

      html, body, div, span, applet, object, iframe,
      h1, h2, h3, h4, h5, h6, p, blockquote, pre,
      a, abbr, acronym, address, big, cite, code,
      del, dfn, em, img, ins, kbd, q, s, samp,
      small, strike, strong, sub, sup, tt, var,
      b, u, i, center,
      dl, dt, dd, ol, ul, li,
      fieldset, form, label, legend,
      table, caption, tbody, tfoot, thead, tr, th, td,
      article, aside, canvas, details, embed, 
      figure, figcaption, footer, header, hgroup, 
      menu, nav, output, ruby, section, summary,
      time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
      }
      /* HTML5 display-role reset for older browsers */
      article, aside, details, figcaption, figure, 
      footer, header, hgroup, menu, nav, section {
        display: block;
      }
      body {
        line-height: 1;
      }
      ol, ul {
        list-style: none;
      }
      blockquote, q {
        quotes: none;
      }
      blockquote:before, blockquote:after,
      q:before, q:after {
        content: '';
        content: none;
      }
      table {
        border-collapse: collapse;
        border-spacing: 0;
      }
    /*akhir css reset*/
    #header {
      padding : 10px;
      opacity: 0.8;
      margin : 10px 0;
    }

    #header .judul {
      font-family : 'Baumans',cursive;
      color : #000;
      text-shadow: 2px 2px grey
    }
    #slide .box {
      height: 600px;
      box-shadow : 1px 1px 20px rgba(0,0,0,.5);
    }
    #mytable {
      margin-top : 10px;
    }
    #mytable td, #mytable th {
      font-size: 20px;
      font-weight : bold;
      padding : 3px;
    }
    body {
        border-top : 1px solid #e56038;
        background : #ebe8de;
        background-image: url("<?php echo base_url() ?>assets/aplikasi/images/bg-texture.png");
        font-family : 'Open Sans', sans-serif;
        color : #333333;
    }
    td {
      font-size: 35px;
      font-weight : bold;
      text-align: center;
    }
    th {
      font-size : 45px;
      font-weight : bold;
      color : red;
      text-align: center
    }
    h1 {
      font-size : 50px;
      font-weight : bold;
      text-align: center;
      color : #e56038;
      display: block;
      background-color: #f0f0f0;
    }
    .text-pengumuman {
      font-size: 22px;
      font-weight: bold;
    }
    .text_berjalan {
      font-size : 36px;
      font-weight : bold;
      color : #000000;
    }
  
  </style>

</head>
<body>
  <div class="container">
    <!-- Automatic element centering -->
    <div class="jumbotron" id="header">
      <div class="container">
        <h1 class="judul">Display Kamar RSUD Pariaman</h1>
      </div>
    </div>
    <div class="row" id="slide">
        <!-- /.col -->
      <div class="col-xs-6" >
        <div class="box box-solid">
          <!-- /.box-header -->
          <div class="box-body">
            <div id="mycaraosel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php
                $no=0;
                $active = ""; 
                  foreach ($paviliun as $row) { 
                  $no++;
                  if($no==1) {
                    $active = "active";
                  } else {
                    $active = "";
                  }
                ?>
                  <div class="item <?php echo $active ?>">
                  <h1><?php echo strtoupper($row->nama_paviliun) ?></h1>
                    <table class="table table-hover">
                     <tr>
                        <th>Kelas</th>
                        <th>Total Bed</th>
                        <th>Terisi</th>
                      </tr>
                    <?php 
                      foreach ($kelas as $row_kelas) {
                         if ($row->nama_paviliun==$row_kelas->nama_paviliun) {
                    ?>
                      <tr>
                        <td><?php echo $row_kelas->kelas ?></td>
                        <td><?php echo $row_kelas->total ?></td>
                        <td><?php echo $row_kelas->terisi?></td>
                      </tr>
                    <?php      
                         }
                      }
                    ?>
                      
                    </table>
                </div>
                <?php } ?>
              </div>
              </a>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <div class="box box-solid">
          <div class="box-body">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <h1>KESELURUHAN</h1>
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
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <marquee>
        <?php
        $textpengumuman = "Berita Terbaru :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; 
        foreach ($pengumuman as $row) {
         // if ($row->status_reservasi=='0') {
            //$textpengumuman.= "".$row->nama." ==  Bangsal ".strtoupper($row->nama_paviliun)."&nbsp&nbsp--||--&nbsp&nbsp";
         // }
            $textpengumuman .= $row->judul."::".$row->text_pengumuman."&nbsp&nbsp||&nbsp&nbsp";
        }
        ?>
        <p class="text_berjalan"><?php echo $textpengumuman ?></p>
      </marquee>
    </div>
  </div>

<!-- /.center -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url() ?>assets/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() ?>assets/AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
      $("#mycaraosel").carousel({
        interval : 5000
      });
      setInterval(function(){
        window.location = "<?php echo base_url() ?>bed/panel";
        console.log(nilai++);
      },180000);
  });
</script>
</body>
</html>