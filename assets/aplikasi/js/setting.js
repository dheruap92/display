$(document).ready(function(){
   

});

function pilih() {
    var nilai = $("#song").val();
    $.ajax({
        url : base_url+"bed/admin/setting/lagu",
        data : {"nilai":nilai},
        method : "POST",
        success : function (data) {
            console.log(data);
            alert("Data Berhasil di Ubah");
        },
        error : function(e) {
            console.log(e);
        }
    });
}



