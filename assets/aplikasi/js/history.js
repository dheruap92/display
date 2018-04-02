$(document).ready(function(){
   //datatables
    table = $('#mytable').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url+"bed/reservasi/history/list",
            "type": "POST",
            "data": {"type":"history"},
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

     //Date picker
    $('.datepicker').datepicker({
      format: 'yyyy/mm/dd',
      autoclose: true
    });

     //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().removeClass('has-error');
        $(this).next().empty();
    });

    // ceck all selecter
    $("#check-all").click(function() {
        $(".data-check").prop('checked',$(this).prop('checked'));
    });

});

// reload table
function reload_table() {
    table.ajax.reload(null,false);
} 

// function lihat
function lihat(nama) {
    $("#modal_form").modal("show");
    $.ajax({
        url : base_url+"bed/reservasi/history/riwayat",
        type: "POST",
        data: {"nama":nama},
        success: function(data)
        { 
            $("#isi_riwayat").html(data);;
        },
        error: function (e)
        {
            console.log(e);
            bootbox.alert("Terjadi Galat");
        }
    });
}



