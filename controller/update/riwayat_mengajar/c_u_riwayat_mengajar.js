function update_riwayat_mengajar(kode) {
    feedForm(kode);
    select_perguruan_tinggi();
    select_program_studi();
    select_jenjang_pendidikan();
    select_mata_kuliah();
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
        url: "/sid/model/update/riwayat_mengajar/m_u_riwayat_mengajar.php",
        data: {
            "kode_program_studi": $('.kode_program_studi').val(),
            "kode_jenjang_pendidikan": $('.kode_jenjang_pendidikan').val(),
            "kode_mata_kuliah": $('.kode_mata_kuliah').val(),
            "kode_semester": $('.kode_semester').val(),
            "tahun_akademik": $('.tahun_akademik').val(),
            "kode_riwayat_mengajar_dosen": $('.kode_riwayat_mengajar_dosen').val()
        },
        type: "POST",
        success: function (result) {
            console.log(result);
            window.location.href = "/sid/user/data/riwayat_mengajar"
        }
    });
}

function feedForm(kode) {
    $.ajax({
        url: "/sid/model/read/riwayat_mengajar/m_r_riwayat_mengajar.php",
        type: "POST",
        data: {"kode": kode},
        success: function (result) {
            var datas = JSON.parse(result);
            for (var data in datas) {
                $(".kode_perguruan_tinggi").tagsinput('add', {"kode_perguruan_tinggi": datas[data].kode_perguruan_tinggi, "nama_perguruan_tinggi": datas[data].nama_perguruan_tinggi});
                $(".kode_program_studi").tagsinput('add', {"kode_program_studi": datas[data].kode_program_studi, "nama_program_studi": datas[data].nama_program_studi});
                $(".kode_jenjang_pendidikan").tagsinput('add', {"kode_jenjang_pendidikan": datas[data].kode_jenjang_pendidikan, "nama_jenjang_pendidikan": datas[data].nama_jenjang_pendidikan});
                $(".kode_mata_kuliah").tagsinput('add', {"kode_mata_kuliah": datas[data].kode_mata_kuliah, "nama_mata_kuliah": datas[data].nama_mata_kuliah});
                select_semester(datas[data].nama_semester);
                $(".kode_semester").css("backgroundImage", "none");
                $(".tahun_akademik").val(datas[data].tahun_akademik).css("backgroundImage", "none");
            }
            $(".loader").fadeOut("slow");
        }
    });
}

function select_perguruan_tinggi() {
    var perguruantinggi = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama_perguruan_tinggi'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        //prefetch: '/sid/js/assets/cities.json'
        prefetch: '/sid/model/feeds/m_r_select_perguruan_tinggi.php'
    });
    perguruantinggi.initialize();

    var elt = $('.kode_perguruan_tinggi');
    elt.tagsinput({
        maxTags: 1,
        itemValue: 'kode_perguruan_tinggi',
        itemText: 'nama_perguruan_tinggi',
        typeaheadjs: {
            name: 'perguruantinggi',
            displayKey: 'nama_perguruan_tinggi',
            source: perguruantinggi.ttAdapter()
        }
    });
}

function select_program_studi() {
    var programstudi = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama_program_studi'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        //prefetch: '/sid/js/assets/cities.json'
        prefetch: '/sid/model/feeds/m_r_select_program_studi.php'
    });
    programstudi.initialize();

    var elt = $('.kode_program_studi');
    elt.tagsinput({
        maxTags: 1,
        itemValue: 'kode_program_studi',
        itemText: 'nama_program_studi',
        typeaheadjs: {
            name: 'programstudi',
            displayKey: 'nama_program_studi',
            source: programstudi.ttAdapter()
        }
    });
}

function select_jenjang_pendidikan() {
    var jenjangpendidikan = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama_jenjang_pendidikan'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        //prefetch: '/sid/js/assets/cities.json'
        prefetch: '/sid/model/feeds/m_r_select_jenjang_pendidikan.php'
    });
    jenjangpendidikan.initialize();

    var elt = $('.kode_jenjang_pendidikan');
    elt.tagsinput({
        maxTags: 1,
        itemValue: 'kode_jenjang_pendidikan',
        itemText: 'nama_jenjang_pendidikan',
        typeaheadjs: {
            name: 'jenjangpendidikan',
            displayKey: 'nama_jenjang_pendidikan',
            source: jenjangpendidikan.ttAdapter()
        }
    });
}

function select_mata_kuliah() {
    var matakuliah = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama_mata_kuliah'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '/sid/model/feeds/m_r_select_mata_kuliah.php'
    });
    matakuliah.initialize();
    var elt = $('.kode_mata_kuliah');
    elt.tagsinput({
        maxTags: 1,
        itemValue: 'kode_mata_kuliah',
        itemText: 'nama_mata_kuliah',
        typeaheadjs: {
            name: 'matakuliah',
            displayKey: 'nama_mata_kuliah',
            source: matakuliah.ttAdapter()
        }
    });
}

function select_semester(data) {
    if (data == "Ganjil") {
        $("#" + data.toLowerCase()).attr("selected", "selected");
    } else if (data == "Genap") {
        $("#" + data.toLowerCase()).attr("selected", "selected");
    }
}
        