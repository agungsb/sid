function delete_riwayat_mengajar(id) {
    doDelete(id);
}

function doDelete(id) {
    $.ajax({
        url: "/sid/model/delete/daftar_pengguna/m_d_pengguna.php",
        type: "POST",
        data: {'id': id},
        success: function (result) {
            //console.log(result);
        }
    });
}

