function read_data_dosen() {
    $("#tanggal_lahir").datepicker({
        //dateFormat: "yy-mm-dd",
        dateFormat: "dd-mm-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "-74:-20"
    });
    $("#mulai_masuk_dosen").datepicker({
        //dateFormat: "yy-mm-dd",
        dateFormat: "dd-mm-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "1990:2015"
    });
    $("#tanggal_keluar_sertifikasi_dosen").datepicker({
        //dateFormat: "yy-mm-dd",
        dateFormat: "dd-mm-yy",
        changeYear: true,
        changeMonth: true,
        yearRange: "1990:2015"
    });
    $.ajax({
        url: "/sid/model/read/data_dosen/m_r_data_dosen.php",
        type: "GET",
        success: function(result) {
            var datas = JSON.parse(result);
            var pasfoto = "";
            console.log(result);
            for (var data in datas) {
                $(".user_gelar_akademik_depan").text(datas[data].gelar_akademik_depan).css("backgroundImage", "none");
                $(".user_gelar_akademik_belakang").text(datas[data].gelar_akademik_belakang).css("backgroundImage", "none");
                $(".nama_dosen").text(datas[data].nama_dosen + ",").attr("value", datas[data].nama_dosen).css("backgroundImage", "none");
                $(".nidn").text(datas[data].nidn).attr("value", datas[data].nidn).css("backgroundImage", "none");
                gelar_akademik_depan($(".gelar_akademik_depan"), datas[data].gelar_akademik_depan);
                gelar_akademik_belakang($(".gelar_akademik_belakang"), datas[data].gelar_akademik_belakang);
                $(".nip_lama").attr("value", datas[data].nip_lama).css("backgroundImage", "none");
                $(".nip_baru").text(datas[data].nip_baru).attr("value", datas[data].nip_baru).css("backgroundImage", "none");
                $(".no_ktp").attr("value", datas[data].no_ktp).css("backgroundImage", "none");
                select_jenis_kelamin(datas[data].jenis_kelamin);
                select_tempat_lahir(datas[data].tempat_lahir);
                $(".tanggal_lahir").attr("value", ddMmYy(datas[data].tanggal_lahir)).css("backgroundImage", "none");
                $(".alamat").attr("value", datas[data].alamat).css("backgroundImage", "none");
                select_kota($(".kode_kota"), datas[data].kode_kota, datas[data].nama_kota);
                select_provinsi($(".kode_provinsi"), datas[data].kode_provinsi, datas[data].nama_provinsi);
                $(".kode_pos").attr("value", datas[data].kode_pos).css("backgroundImage", "none");
                select_negara(datas[data].nama_negara);
                $(".telepon").attr("value", datas[data].telepon).css("backgroundImage", "none");
                $(".hp").attr("value", datas[data].hp).css("backgroundImage", "none");
                select_perguruan_tinggi(datas[data].nama_perguruan_tinggi);
                select_fakultas(datas[data].nama_fakultas);
                select_jurusan($(".kode_jurusan"), datas[data].kode_jurusan, datas[data].nama_jurusan);
                select_program_studi($(".kode_program_studi"), datas[data].kode_program_studi, datas[data].nama_program_studi);
                select_status_aktif(datas[data].status_aktif);
                select_golongan(datas[data].golongan);
                $(".jabatan_fungsional").val(datas[data].jabatan_fungsional).css("backgroundImage", "none");
                $(".jabatan_struktural").val(datas[data].jabatan_struktural).css("backgroundImage", "none");
                $(".mulai_masuk_dosen").attr("value", ddMmYy(datas[data].mulai_masuk_dosen)).css("backgroundImage", "none");
                $(".mulai_semester").attr("value", datas[data].mulai_semester).css("backgroundImage", "none");
                if (datas[data].pasfoto == "") {
                    pasfoto = "/sid/gambar/foto_default.png";
                } else {
                    pasfoto = datas[data].pasfoto;
                }
                $(".pasfoto").attr("src", pasfoto);
                $(".no_sertifikasi_dosen").attr("value", datas[data].no_sertifikasi_dosen).css("backgroundImage", "none");
                $(".tanggal_keluar_sertifikasi_dosen").attr("value", ddMmYy(datas[data].tanggal_keluar_sertifikasi_dosen)).css("backgroundImage", "none");
                $(".email").attr("value", datas[data].email).css("backgroundImage", "none");
            }
            $(".loader").fadeOut("slow");
        }
    });
}
function myTrim(x) {
    return x.replace(/^\s+|\s+$/gm, '');
}

function gelar_akademik_depan(elt, data) {
    elt.attr("value", data).css("backgroundImage", "none");
    /**
     * Typeahead
     */
    var gelarakademikdepan = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: '/sid/js/assets/gelar_akademik_depan.json',
            filter: function(list) {
                return $.map(list, function(gelar_akademik_depan) {
                    return {name: gelar_akademik_depan};
                });
            }
        }
    });

    gelarakademikdepan.initialize();
    elt = $('.gelar_akademik_depan');
    elt.tagsinput({
        typeaheadjs: {
            name: 'gelar_akademik_depan',
            displayKey: 'name',
            valueKey: 'name',
            source: gelarakademikdepan.ttAdapter(),
        },
        freeInput: false,
        trimValue: true
    });
    elt.on("itemAdded", function(event) {
        $(".loader").fadeIn("slow");
        updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
    });
    elt.on("itemRemoved", function(event) {
        $(".loader").fadeIn("slow");
        updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
    });
}

function gelar_akademik_belakang(elt, data) {
    elt.attr("value", data).css("backgroundImage", "none");
    /**
     * Typeahead
     */
    var gelar_akademik_belakang = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: '/sid/js/assets/gelar_akademik_belakang.json',
            filter: function(list) {
                return $.map(list, function(gelar_akademik_belakang) {
                    return {name: gelar_akademik_belakang};
                });
            }
        }
    });

    gelar_akademik_belakang.initialize();
    elt.tagsinput({
        typeaheadjs: {
            name: 'gelar_akademik_belakang',
            displayKey: 'name',
            valueKey: 'name',
            source: gelar_akademik_belakang.ttAdapter(),
        },
        freeInput: false,
        trimValue: true
    });
    elt.on("itemAdded", function(event) {
        $(".loader").fadeIn("slow");
        updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
    });
    elt.on("itemRemoved", function(event) {
        $(".loader").fadeIn("slow");
        updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
    });
}

function select_jenis_kelamin(data) {
    $(".jenis_kelamin").css("backgroundImage", "none");
    if (data == "L") {
        $("#L").attr("selected", "selected");
    } else if (data == "P") {
        $("#P").attr("selected", "selected");
    }
}

function select_tempat_lahir(data) {
    $.ajax({
        url: "/sid/model/feeds/m_r_select_kota.php",
        type: "GET",
        success: function(feedback) {
            var datas = JSON.parse(feedback);
            $(".tempat_lahir").html("").css("backgroundImage", "none"); // Reset combo box
            for (var result in datas) {
                if (data == datas[result].nama_kota) {
                    $(".tempat_lahir").append('<option id="' + datas[result].nama_kota + '" value="' + datas[result].nama_kota + '" selected="selected">' + datas[result].nama_kota + '</option>');
                } else {
                    $(".tempat_lahir").append('<option id="' + datas[result].nama_kota + '" value="' + datas[result].nama_kota + '">' + datas[result].nama_kota + '</option>');
                }
            }
        }
    });
}

function select_kota(elt, value, text) {
    elt.css("backgroundImage", "none");
    /**
     * Typeahead
     */
    var kota = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama_kota'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        //prefetch: '/sid/js/assets/cities.json'
        prefetch: '/sid/model/feeds/m_r_select_kota.php'
    });
    kota.initialize();

    elt = $('.kode_kota');
    elt.tagsinput({
        maxTags: 1,
        itemValue: 'kode_kota',
        itemText: 'nama_kota',
        typeaheadjs: {
            name: 'kota',
            displayKey: 'nama_kota',
            source: kota.ttAdapter()
        }
    });
    elt.tagsinput('add', {"kode_kota": value, "nama_kota": text});
    elt.on("itemAdded", function(event) {
        $(".loader").fadeIn("slow");
        updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
    });
    elt.on("itemRemoved", function(event) {
        $(".loader").fadeIn("slow");
        updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
    });
}

function select_provinsi(elt, value, text) {
    elt.css("backgroundImage", "none");
    /**
     * Typeahead
     */
    var provinsi = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama_provinsi'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        //prefetch: '/sid/js/assets/cities.json'
        prefetch: '/sid/model/feeds/m_r_select_provinsi.php'
    });
    provinsi.initialize();

    elt = $('.kode_provinsi');
    elt.tagsinput({
        maxTags: 1,
        itemValue: 'kode_provinsi',
        itemText: 'nama_provinsi',
        typeaheadjs: {
            name: 'provinsi',
            displayKey: 'nama_provinsi',
            source: provinsi.ttAdapter()
        }
    });
    elt.tagsinput('add', {"kode_provinsi": value, "nama_provinsi": text});
    elt.on("itemAdded", function(event) {
        $(".loader").fadeIn("slow");
        updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
    });
    elt.on("itemRemoved", function(event) {
        if (elt.val() == "") {
            alert("Isian ini tidak boleh kosong");
            //elt.tagsinput('add', {"kode_program_studi": value, "nama_program_studi": text});
        } else {
            $(".loader").fadeIn("slow");
            updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
        }
    });
}

function select_negara(data) {
    $.ajax({
        url: "/sid/model/feeds/m_r_select_negara.php",
        type: "GET",
        success: function(feedback) {
            var datas = JSON.parse(feedback);
            $(".kode_negara").html("").css("backgroundImage", "none"); // Reset combo box
            for (var result in datas) {
                if (data == datas[result].nama_negara) {
                    $(".kode_negara").append('<option id="' + datas[result].kode_negara + '" value="' + datas[result].kode_negara + '" selected="selected">' + datas[result].nama_negara + '</option>');
                    //console.log(datas[result].nama_negara + ", " + $("#" + datas[result].kode_negara).attr("selected") + " SELECTED");
                } else {
                    $(".kode_negara").append('<option id="' + datas[result].kode_negara + '" value="' + datas[result].kode_negara + '">' + datas[result].nama_negara + '</option>');
                    //console.log(datas[result].nama_negara + ", " + $("#" + datas[result].kode_negara).attr("selected") + " REMOVE SELECTED");
                }
            }
        }
    });
}

function select_perguruan_tinggi(data) {
    $.ajax({
        url: "/sid/model/feeds/m_r_select_perguruan_tinggi.php",
        type: "GET",
        success: function(feedback) {
            var datas = JSON.parse(feedback);
            $(".kode_perguruan_tinggi").html("").css("backgroundImage", "none"); // Reset combo box
            for (var result in datas) {
                if (data == datas[result].nama_perguruan_tinggi) {
                    $(".kode_perguruan_tinggi").append('<option id="' + datas[result].kode_perguruan_tinggi + '" value="' + datas[result].kode_perguruan_tinggi + '" selected="selected">' + datas[result].nama_perguruan_tinggi + '</option>');
                } else {
                    $(".kode_perguruan_tinggi").append('<option id="' + datas[result].kode_perguruan_tinggi + '" value="' + datas[result].kode_perguruan_tinggi + '">' + datas[result].nama_perguruan_tinggi + '</option>');
                }
            }
        }
    });
}

function select_fakultas(data) {
    $.ajax({
        url: "/sid/model/feeds/m_r_select_fakultas.php",
        type: "GET",
        success: function(feedback) {
            var datas = JSON.parse(feedback);
            $(".kode_fakultas").html("").css("backgroundImage", "none"); // Reset combo box
            for (var result in datas) {
                if (data == datas[result].nama_fakultas) {
                    $(".kode_fakultas").append('<option id="fakultas_' + datas[result].kode_fakultas + '" value="' + datas[result].kode_fakultas + '" selected="selected">' + datas[result].nama_fakultas + '</option>');
                } else {
                    $(".kode_fakultas").append('<option id="fakultas_' + datas[result].kode_fakultas + '" value="' + datas[result].kode_fakultas + '">' + datas[result].nama_fakultas + '</option>');
                }
            }
        }
    });
}

function select_jurusan(elt, value, text) {
    elt.css("backgroundImage", "none");
    /**
     * Typeahead
     */
    var jurusan = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama_jurusan'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        //prefetch: '/sid/js/assets/cities.json'
        prefetch: '/sid/model/feeds/m_r_select_jurusan.php'
    });
    jurusan.initialize();

    elt = $('.kode_jurusan');
    elt.tagsinput({
        maxTags: 1,
        itemValue: 'kode_jurusan',
        itemText: 'nama_jurusan',
        typeaheadjs: {
            name: 'jurusan',
            displayKey: 'nama_jurusan',
            source: jurusan.ttAdapter()
        }
    });
    elt.tagsinput('add', {"kode_jurusan": value, "nama_jurusan": text});
    elt.on("itemAdded", function(event) {
        $(".loader").fadeIn("slow");
        updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
    });
    elt.on("itemRemoved", function(event) {
        if (elt.val() == "") {
            alert("Isian ini tidak boleh kosong");
            //elt.tagsinput('add', {"kode_program_studi": value, "nama_program_studi": text});
        } else {
            $(".loader").fadeIn("slow");
            updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
        }
    });
}

function select_program_studi(elt, value, text) {
    elt.css("backgroundImage", "none");
    /**
     * Typeahead
     */
    var programstudi = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama_program_studi'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        //prefetch: '/sid/js/assets/cities.json'
        prefetch: '/sid/model/feeds/m_r_select_program_studi.php'
    });
    programstudi.initialize();

    elt = $('.kode_program_studi');
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
    elt.tagsinput('add', {"kode_program_studi": value, "nama_program_studi": text});
    elt.on("itemAdded", function(event) {
        $(".loader").fadeIn("slow");
        updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
    });
    elt.on("itemRemoved", function(event) {
        if (elt.val() == "") {
            alert("Isian ini tidak boleh kosong");
            //elt.tagsinput('add', {"kode_program_studi": value, "nama_program_studi": text});
        } else {
            $(".loader").fadeIn("slow");
            updateDataDosen(elt.attr("name"), escapeHtml(event.target.value));
        }
    });
}

function select_golongan(data) {
    $(".golongan").css("backgroundImage", "none");
    if (data == "III/b") {
        $("#IIIb").attr("selected", "selected");
    } else if (data == "III/c") {
        $("#IIIc").attr("selected", "selected");
    } else if (data == "III/d") {
        $("#IIId").attr("selected", "selected");
    } else if (data == "IV/a") {
        $("#IVa").attr("selected", "selected");
    } else if (data == "IV/b") {
        $("#IVb").attr("selected", "selected");
    } else if (data == "IV/c") {
        $("#IVc").attr("selected", "selected");
    } else if (data == "IV/d") {
        $("#IVd").attr("selected", "selected");
    } else if (data == "IV/e") {
        $("#IVe").attr("selected", "selected");
    }
}

function select_status_aktif(data) {
    $.ajax({
        url: "/sid/model/feeds/m_r_select_status_aktif.php",
        type: "GET",
        success: function(feedback) {
            var datas = JSON.parse(feedback);
            $(".status_aktif").html("").css("backgroundImage", "none"); // Reset combo box
            for (var result in datas) {
                if (data == datas[result].nama_status_aktif) {
                    $(".status_aktif").append('<option id="jurusan_' + datas[result].kode_status_aktif + '" value="' + datas[result].kode_status_aktif + '" selected="selected">' + datas[result].nama_status_aktif + '</option>');
                } else {
                    $(".status_aktif").append('<option id="jurusan_' + datas[result].kode_status_aktif + '" value="' + datas[result].kode_status_aktif + '">' + datas[result].nama_status_aktif + '</option>');
                }
            }
        }
    });
}

function ddMmYy(data) { // Fungsi untuk konversi data DATE (formatnya yy-mm-dd) dari database ke tampilan (formatnya dd-mm-yy)
    var split = data.split("-");
    var getDate = split[2] + "-" + split[1] + "-" + split[0];
    return getDate;
}

function escapeHtml(text) {
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) {
        return map[m];
    });
}