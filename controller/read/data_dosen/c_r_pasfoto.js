function read_pasfoto() {
    $(".pasfoto").attr("src", "/sid/gambar/loader.gif");
    $(".nav_pasfoto").attr("src", "/sid/gambar/loader.gif");
    $(".imageBox").css("background", "url(/sid/gambar/loader.gif) 40px 55px no-repeat");
    $.ajax({
        url: "/sid/model/read/data_dosen/m_r_pasfoto.php",
        type: "GET",
        success: function (result) {
            var datas = JSON.parse(result);
            console.log(result);
            var pasfoto;
            $(".nav_user_gelar_akademik_depan").text(datas[0].gelar_akademik_depan);
            $(".nav_user_gelar_akademik_belakang").text(datas[0].gelar_akademik_belakang);
            $(".nav_nama_dosen").text(datas[0].nama_dosen + ",").attr("value", datas[0].nama_dosen);
            //console.log(result);
            if (datas.length > 0) {
                if (datas[0].pasfoto == "") {
                    pasfoto = "/sid/gambar/foto_default.png";
                } else {
                    pasfoto = datas[0].pasfoto;
                }
                $(".pasfoto").attr("src", pasfoto);
                $(".nav_pasfoto").attr("src", pasfoto);
                $(".imageBox").css("background", "url(" + pasfoto + ") 40px 55px no-repeat");
            }
            $(".loader").fadeOut("slow");
            $(".loading").fadeOut("slow");
        }
    });
}