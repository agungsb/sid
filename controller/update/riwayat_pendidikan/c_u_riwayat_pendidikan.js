function update_riwayat_pendidikan(kode) {
    feedForm(kode);
    select_perguruan_tinggi();
    select_gelar_akademik();
    select_tanggal_ijazah();
    select_jenjang_pendidikan();
    validateForm();
}

function validateForm() {
    $('#bedit').click(function () {
        if (($('.kode_perguruan_tinggi').val() != "") && ($('.kode_gelar_akademik').val() != "") && ($('.tanggal_ijazah').val() != "") && ($('.kode_jenjang_pendidikan').val() != null)) {
            $(".loader").fadeIn("fast");
            submitForm();
        } else {
            alert("Mohon Lengkapi Form");
        }
    });
}

function submitForm() {
    $.ajax({
        url: "/sid/model/update/riwayat_pendidikan/m_u_riwayat_pendidikan.php",
        data: {
            "kode_perguruan_tinggi": $('.kode_perguruan_tinggi').val(),
            "kode_gelar_akademik": $('.kode_gelar_akademik').val(),
            "tanggal_ijazah": $('.tanggal_ijazah').val(),
            "kode_jenjang_pendidikan": $('.kode_jenjang_pendidikan').val(),
            "kode_riwayat_pendidikan_dosen": $('.kode_riwayat_pendidikan_dosen').val()
        },
        type: "POST",
        success: function (result) {
            console.log(result);
            window.location.href = "/sid/user/data/riwayat_pendidikan";
        }
    });
}

function feedForm(kode) {
    $.ajax({
        url: "/sid/model/read/riwayat_pendidikan/m_r_riwayat_pendidikan.php",
        type: "POST",
        data: {"kode": kode},
        success: function (result) {
            var datas = JSON.parse(result);
            for (var data in datas) {
                var t_i = ddMmYy(datas[data].tanggal_ijazah);
                $(".kode_perguruan_tinggi").tagsinput('add', {"kode_perguruan_tinggi": datas[data].kode_perguruan_tinggi, "nama_perguruan_tinggi": datas[data].nama_perguruan_tinggi});
                $(".kode_gelar_akademik").tagsinput('add', {"kode_gelar_akademik": datas[data].kode_gelar_akademik, "nama_gelar_akademik": datas[data].nama_gelar_akademik});
                $(".tanggal_ijazah").val(t_i).css("backgroundImage", "none");
                $(".kode_jenjang_pendidikan").tagsinput('add', {"kode_jenjang_pendidikan": datas[data].kode_jenjang_pendidikan, "nama_jenjang_pendidikan": datas[data].nama_jenjang_pendidikan});
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

function select_gelar_akademik() {
    var gelarakademik = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama_gelar_akademik'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        //prefetch: '/sid/js/assets/cities.json'
        prefetch: '/sid/model/feeds/m_r_select_gelar_akademik.php'
    });
    gelarakademik.initialize();

    var elt = $('.kode_gelar_akademik');
    elt.tagsinput({
        maxTags: 1,
        itemValue: 'kode_gelar_akademik',
        itemText: 'nama_gelar_akademik',
        typeaheadjs: {
            name: 'gelarakademik',
            displayKey: 'nama_gelar_akademik',
            source: gelarakademik.ttAdapter()
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

function select_tanggal_ijazah() {
    $("#tanggal_ijazah").datepicker({
        //dateFormat: "yy-mm-dd",
        dateFormat: "dd-mm-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "-54:-0",
        defaultDate: "2014-01-01"
    });
}

function ddMmYy(data) { // Fungsi untuk konversi data dari database ke tampilan
    var split = data.split("-");
    var getDate = split[2] + "-" + split[1] + "-" + split[0];
    return getDate;
}
        