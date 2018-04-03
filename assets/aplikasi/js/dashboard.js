$(document).ready(function(){
    table = $('#mytable').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url+"bed/admin/subkamar/list",
            "type": "POST",
            "error" : function (status) {
                console.log(status.responseText);
            }
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ 0 ], //last column
            "orderable": false, //set not orderable
        },{ 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
    });
   $("#cariKamar").click(function () {
        $id_paviliun = $("#paviliun").val();
        //console.log($id_paviliun);
        $.ajax({
            url : base_url+"bed/admin/subkamar",
            method : "POST",
            data : {"id_paviliun":$id_paviliun},
            success : function (data) {
                //console.log(data);
                $("#hasilCari").html(data);
                load_timeline();
            },
            error : function (e) {
                //console.log(e);
            }
        });
        //$("#hasilCari").load(base_url+"bed/admin/subkamar");
   });
   $(document).bind("contextmenu",function(e){
        return false;
    });
   load_timeline();
});

function setPetugas() {
     //console.log($("#petugasname").text());
     $.ajax({
          url : base_url+"bed/admin/subkamar/petugas",
          method : "POST",
          data : {"petugas":$("#petugas").val()},
          success : function (data) {
              $("#petugasname").text(data);
          },
          error : function (e) {
              //console.log(e);
          }
      });
}
function sendTimeline() {
    var message = $("[name=message]").val();
    if (message==null || message=="") {
      return false;
    }
    var petugas = $("#petugasname").text();
    $.ajax({
        url : base_url+"bed/admin/timeline/tambah",
        method : "POST",
        data : {"message":message,"petugas":petugas},
        success : function (data) {
            load_timeline();
        },
        error : function (e) {
            //console.log(e);
        }
    });
}

function load_timeline(id=0) {
  console.log(id);
  //return false;
  $("#timeline").load(base_url+"bed/admin/timeline/"+id,function (){
      console.log("timeline is performed");
  });
}





