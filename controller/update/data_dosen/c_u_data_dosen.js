function update_data_dosen(column, data) {
    if ((column == "gelar_akademik_depan") || (column == "gelar_akademik_belakang")) {
        $(".user_" + column).text(data);
        $(".nav_user_" + column).text(data);
        //console.log("Update " + column);
    } else if (column == "kode_program_studi") {
        $(".nama_program_studi").text($("#prodi_" + data).text());
        //console.log("Update #prodi_" + data);
    } else if (column == "nama_dosen") {
        $("." + column).text(data + ",");
        $(".nav_" + column).text(data + ", ");
    } else {
        $("." + column).text(data);
        //console.log("Update " + column);
    }
    $(".loader").fadeOut("slow");
}

function updateDataDosen(column, data) {
    if ((column == "gelar_akademik_depan") || (column == "gelar_akademik_belakang")) {
        data = data.replace(",", ", "); // Pisahkan gelar yang lebih dari satu dengan koma+spasi
    }
    //console.log(data);
    $.ajax({
        url: "/sid/model/update/data_dosen/m_u_data_dosen.php",
        type: "POST",
        data: {
            "column": column,
            "data": data
        },
        success: function(result) {
            //console.log(result);
            if ((column == "gelar_akademik_depan") || (column == "nama_dosen") || (column == "gelar_akademik_belakang") || (column == "nidn") || (column == "nip_baru") || (column == "kode_program_studi")) {// Jika yang di-update berhubungan dengan top display...
                update_data_dosen(column, data); // Update juga top display-nya
            } else { // Jika yang di-update tidak berhubungan dengan top display...
                $(".loader").fadeOut("slow"); // Animasi fade out
            }
            console.log(result);
            //location.reload();
        }
    });
}