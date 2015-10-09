function read_daftar_pengguna() {
    select_pengguna();
    $('#list').dataTable({
        "columns": [
            null,
            null,
            {"width": "5%", "bSearchable": false},
            {"width": "5%", "bSearchable": false},
            {"width": "5%", "bSearchable": false}
        ],
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "/sid/model/read/daftar_pengguna/server_processing.php",
        "iDisplayLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
    });
    $('div.dataTables_filter input').attr('placeholder', 'Pencarian...');
    $(".loader").fadeOut("slow");
}

function select_pengguna() {
    $.ajax({
        url: "/sid/model/feeds/m_r_select_pengguna.php",
        type: "GET",
        success: function (result) {
            //console.log(result);
            var datas = JSON.parse(result);
            if (datas.length > 0) {
                $(".userid").html("<option></option>");
                for (var data in datas) {
                    $(".userid").append("<option value='" + datas[data].nidn + "'>" + datas[data].nidn + "</option>");
                }
            } else {
                $(".userid").attr("disabled", "disabled");
            }
        }
    });
}
        