<div class="box box-success">
  <div class="box-header ui-sortable-handle" style="cursor: move;">
    <i class="fa fa-comments-o"></i>
    <h3 class="box-title">Timeline--Tinggalkan Pesan di Sini</h3>
  </div>
  <div style="position: relative; overflow: hidden; width: auto; height: 250px;">
    <div class="box-body" style="overflow: auto; width: auto; height: 240px;" id="timeline-scroll">
      
      <ul class="timeline" id="timeline-message">
          <li class="time-label">
              <span class="bg-red">
                  Message
              </span>
          </li>
      <?php
        foreach ($data->result() as $row) {
      ?>
         <li>
              <i class="fa fa-envelope bg-blue"></i>
              <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i><?php echo $row->tanggal ?></span>

                  <h3 class="timeline-header text-blue"><?php echo $row->user ?></h3>

                  <div class="timeline-body">
                      <?php echo $row->message ?>
                  </div>
              </div>
          </li>
      <?php
        }
      ?>
          <li class="time-label">
              <a href="#" class="btn btn-xs bg-aqua" onclick="load_timeline(1)">See All... </a>
          </li>
      </ul>
    </div>
  </div>
  <!-- /.chat -->
  <div class="box-footer">
    <form action="#" method="post">
      <div class="input-group">
        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
          <span class="input-group-btn">
              <button type="button" class="btn btn-warning btn-flat" onclick="sendTimeline()">Send</button>
          </span>
      </div>
    </form>
  </div>
</div>
<script>
</script>