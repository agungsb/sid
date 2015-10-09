function read_data_navigasi() {
    $.ajax({
        url: "/sid/model/read/data_dosen/m_r_data_dosen.php",
        type: "GET",
        success: function (result) {
            var datas = JSON.parse(result);
            var pasfoto = "";
            //console.log(result);
            for (var data in datas) {
                $(".nav_user_gelar_akademik_depan").text(datas[data].gelar_akademik_depan).css("backgroundImage", "none");
                $(".nav_user_gelar_akademik_belakang").text(datas[data].gelar_akademik_belakang).css("backgroundImage", "none");
                $(".nav_nama_dosen").text(datas[data].nama_dosen + ",").attr("value", datas[data].nama_dosen).css("backgroundImage", "none");
                if (datas[data].pasfoto == "") {
                    pasfoto = "/sid/gambar/foto_default.png";
                } else {
                    pasfoto = datas[data].pasfoto;
                }
                $(".nav_pasfoto").attr("src", pasfoto);
                $(".nav_nidn").text("NIDN: " + datas[data].nidn);
            }
        }
    });
}
function myTrim(x) {
    return x.replace(/^\s+|\s+$/gm, '');
}