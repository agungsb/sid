function read_list_dosen() {
    $('#list').dataTable({
        "columns": [
            null,
            null,
            null,
            null,
            null,
            null,
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
        "ajax": "/sid/model/read/list_dosen/server_processing.php",
        "iDisplayLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
    });
    $('div.dataTables_filter input').attr('placeholder', 'Pencarian...');
    $(".loader").fadeOut("slow");
}    