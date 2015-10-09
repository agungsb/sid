function delete_riwayat_mengajar() {
    $('body').on('click', '.bdelete', function () {
        //alert($(this).attr("id"));
        $(".loader").fadeIn("fast");
        doDelete($(this).attr("id"));
    });
}

function doDelete(id) {
    $.ajax({
        url: "/sid/model/delete/riwayat_mengajar/m_d_riwayat_mengajar.php",
        type: "POST",
        data: {'id': id},
        success: function (result) {
            console.log(result);
            location.reload();
        }
    });
}


