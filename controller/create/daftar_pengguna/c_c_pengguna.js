function create_riwayat_mengajar() {
    validateForm();
}

function validateForm() {
    $(".userid").change(function(){
        if($(this).val() != ""){
            $(".password").removeAttr("disabled");
        }else{
            $(".password").attr("disabled", "disabled");
        }
    });
    $('#bcreate').click(function () {
        if (($('.userid').val() != "") && ($('.password').val() != "") && ($('.level').val() != "")) {
            submitForm();
            //alert("New user added");
        } else {
            alert("Mohon Lengkapi Form");
        }
    });
}

function submitForm() {
    $.ajax({
        url: "/sid/model/create/daftar_pengguna/m_c_pengguna.php",
        data: {
            "userid": $('.userid').val(),
            "password": $('.password').val(),
            "level": $('.kode_mata_kuliah').val()
        },
        type: "POST",
        success: function (result) {
            //console.log(result);
            location.reload();
        }
    });
}