function delete_riwayat_pendidikan() {
    //doDelete(id);
    $('body').on('click', '.bdelete', function () {
        $(".loader").fadeIn("fast");
        doDelete($(this).attr("id"));
    });
}

function doDelete(id) {
    $.ajax({
        url: "/sid/model/delete/riwayat_pendidikan/m_d_riwayat_pendidikan.php",
        type: "POST",
        data: {'id': id},
        success: function (result) {
            console.log(result);
            location.reload();
        }
    });
}