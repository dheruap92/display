$(document).ready(function(){
   //datatables
    table = $('#paviliun_table').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url+"bed/reservasi/kelola/list",
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

    table2 = $('#kamar_table').DataTable({
    });
    table3 = $('#bed_table').DataTable({
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

    $("#kamar_table").hide();

});

// reload table
function reload_table() {
    table.ajax.reload(null,false);
} 
function reload_kamar() {

}

function reload_bed() {
    
}

function lihat(id) {
    $("#kamar_table").show();
    $("#bed_table").hide();
    $("#kamar_t_b").html("");
    $(".id_paviliun").val(id);
    $(".id_paviliun").attr('disabled',true);
    $.ajax({
        url : base_url+"bed/reservasi/kelola/list_kamar",
        type: "POST",
        data: {"id":id},
        dataType: "JSON",
        success: function(data)
        {
            var no = 1;
            if(data.status==1) {
                $.each(data.data,function(i,data){
                    var body = "<tr><td></td><td>"+no+"</td><td>"+data.nama_kamar+"</td><td>"+data.kelas+"</td><td>"+data.nama_paviliun+"</td><td><button class='btn btn-xs btn-default' data-rel='tooltip' title='Lihat' onclick='lihat_kamar(\""+data.id_kamar+"\")'><i class='ace-icon fa fa-eye bigger-120'></i></button></td></tr>";
                    $("#kamar_t_b").append(body);
                    no++;
                });
            } 
        },
        error: function (e)
        {
            alert(0,'Error adding / update data');
            console.log(e.responseText);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}

function lihat_kamar(id) {
    $("#bed_t_b").html("");
    $("#bed_table").show();
    $("#id_kamar").val(id);
    $("#id_kamar").attr('disabled',true);
    $.ajax({
        url : base_url+"bed/reservasi/kelola/list_bed",
        type: "POST",
        data: {"id":id},
        dataType: "JSON",
        success: function(data)
        {
            console.log(data.data);
            var no = 1;
            if(data.status==1) {
                $.each(data.data,function(i,data){
                   var body = "<tr><td></td><td>"+no+
                   "</td><td>"+data.nama_paviliun+
                   "</td><td>"+data.nama_kamar+
                   "</td><td>"+data.kelas+
                   "</td><td>"+data.no_bed+
                   "</td><td>"+data.status+
                   "</td><td><button class='btn btn-xs btn-default' data-rel='tooltip' title='Lihat' onclick='lihat_kamar(\""+data.id_kamar+"\")'><i class='ace-icon fa fa-eye bigger-120'></i></button></td></tr>";
                    $("#bed_t_b").append(body);
                    no++;  
                });
            } 
        },
        error: function (e)
        {
            alert(0,'Error adding / update data');
            console.log(e.responseText);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}

function add_kamar() {
    save_method = 'add';
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add'); // Set Title to Bootstrap modal title
}
function add_bed() {
    save_method = 'add';
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_bed').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add'); // Set Title to Bootstrap modal title
}
function save_kamar() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    $('#modal_form').modal('hide'); // show bootstrap modal
    $(".id_paviliun").attr('disabled',false);
     // ajax add data
    var formData = $("#form").serialize();
    $.ajax({
        url : base_url+"bed/admin/kamar/tambah",
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data)
        { 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                bootbox.alert("Data Berhasil Ditambahkan");
                lihat($("#id_paviliun").val());
            } else {
                for (i=0;i<data.inputerror.length;i++) {
                    $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                } 
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (e)
        {
            bootbox.alert('Error adding / update data');
            console.log(e.responseText);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}

function save_bed() {
    $('#btnSave_bed').text('saving...'); //change button text
    $('#btnSave_bed').attr('disabled',true); //set button disable
    // $('#modal_form_bed').modal('hide'); // show bootstrap modal
    $(".id_paviliun").attr('disabled',false);
    $("#id_kamar").attr('disabled',false);
    // ajax add data
    var formData = $("#form_bed").serialize();
    $.ajax({
        url : base_url+"bed/admin/bed/tambah",
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data)
        { 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                bootbox.alert("Data Berhasil Ditambahkan");
                lihat_kamar($("#id_kamar").val());
            } else {
                for (i=0;i<data.inputerror.length;i++) {
                    $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                } 
            }
            console.log(formData);
 
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (e)
        {
            bootbox.alert('Error adding / update data');
            console.log(e.responseText);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}




