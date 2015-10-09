function create_riwayat_mengajar() {
    validateForm();
}

function validateForm() {
    $('#bcreate').click(function () {
        if (($('.kode_program_studi').val() != "") && ($('.kode_jenjang_pendidikan').val() != "") && ($('.kode_mata_kuliah').val() != "") && ($('.kode_semester').val() != "") && ($('.tahun_akademik').val() != "")) {
            $(".loader").fadeIn("fast");
            submitForm();
        } else {
            alert("Mohon Lengkapi Form");
        }
    });
}

function submitForm() {
    $.ajax({
        url: "/sid/model/create/riwayat_mengajar/m_c_riwayat_mengajar.php",
        data: {
            "kode_program_studi": $('.kode_program_studi').val(),
            "kode_jenjang_pendidikan": $('.kode_jenjang_pendidikan').val(),
            "kode_mata_kuliah": $('.kode_mata_kuliah').val(),
            "kode_semester": $('.kode_semester').val(),
            "tahun_akademik": $('.tahun_akademik').val()
        },
        type: "POST",
        success: function (result) {
            console.log(result);
            location.reload();
        }
    });
}