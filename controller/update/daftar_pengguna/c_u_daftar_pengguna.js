function update_daftar_pengguna(userid) {
    validateForm();
    $(".loader").fadeOut("slow");
}

function validateForm() {
    $('#bactive').click(function () {
        if (($('.userid').val() != "") && ($('.status').val() != "")) {
            $(".loader").fadeIn("fast");
            submitStatusForm();
        } else {
            alert("Mohon Lengkapi Form");
        }
    });
    $('#bgenerate').click(function () {
        if (($('.userid').val() != "") && ($('.password').val() != "")) {
            $(".loader").fadeIn("fast");
            submitPasswordForm();
        } else {
            alert("Mohon Lengkapi Form");
        }
    });
}

function submitStatusForm() {
    $.ajax({
        url: "/sid/model/update/daftar_pengguna/m_u_status.php",
        type: "POST",
        data: {
            "userid": $('.userid').val(),
            "status": $('.status').val()
        },
        success: function (result) {
            //console.log(result);
            window.location.href = "index.php"
        }
    });
}

function submitPasswordForm() {
    $.ajax({
        url: "/sid/model/update/daftar_pengguna/m_u_password.php",
        type: "POST",
        data: {
            "userid": $('.userid').val(),
            "password": $('.password').val()
        },
        success: function (result) {
            //console.log(result);
            window.location.href = "index.php"
        }
    });
}