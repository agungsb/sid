function create_riwayat_pendidikan() {
    validateForm();
}

function validateForm() {
    $('#bcreate').click(function () {
        if (($('.kode_perguruan_tinggi').val() != "") && ($('.kode_gelar_akademik').val() != "") && ($('.tanggal_ijazah').val() != "") && ($('.kode_jenjang_pendidikan').val() != "")) {
            $(".loader").fadeIn("fast");
            submitForm();
        } else {
            alert("Mohon Lengkapi Form");
        }
    });
}

function submitForm() {
    $.ajax({
        url: "/sid/model/create/riwayat_pendidikan/m_c_riwayat_pendidikan.php",
        data: {
            "kode_perguruan_tinggi": $('.kode_perguruan_tinggi').val(),
            "kode_gelar_akademik": $('.kode_gelar_akademik').val(),
            "tanggal_ijazah": $('.tanggal_ijazah').val(),
            "kode_jenjang_pendidikan": $('.kode_jenjang_pendidikan').val()
        },
        type: "POST",
        success: function (result) {
            console.log(result);
            location.reload();
        }
    });
}