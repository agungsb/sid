function read_detail_dosen(nidn) {
    loadDataRiwayatPendidikan(nidn);
    loadDataRiwayatMengajar(nidn);
    loadDataDosen(nidn);
    $(".loader").fadeOut("slow");
}

function loadDataDosen(nidn) {
    var url = "/sid/model/read/data_dosen/m_r_data_dosen.php?nidn=" + nidn;
    $.ajax({
        url: url,
        type: "GET",
        success: function(result) {
            var datas = JSON.parse(result);
            //console.log(url);
            for (var data in datas) {
                decidePasFoto(datas[data].pasfoto, "");
                loadedEl(".nidn", datas[data].nidn);
                loadedEl(".nama_dosen", datas[data].nama_dosen);
                loadedEl(".gelar_akademik_depan", datas[data].gelar_akademik_depan);
                loadedEl(".gelar_akademik_belakang", datas[data].gelar_akademik_belakang);
                loadedEl(".nip_lama", datas[data].nip_lama);
                loadedEl(".nip_baru", datas[data].nip_baru);
                loadedEl(".no_ktp", datas[data].no_ktp);
                loadedEl(".jenis_kelamin", datas[data].jenis_kelamin);
                decideJenisKelamin(datas[data].jenis_kelamin);
                loadedEl(".tempat_lahir", datas[data].tempat_lahir);
                loadedEl(".tanggal_lahir", ddMmYy(datas[data].tanggal_lahir));
                loadedEl(".alamat", datas[data].alamat);
                loadedEl(".nama_kota", datas[data].nama_kota);
                loadedEl(".nama_provinsi", datas[data].nama_provinsi);
                loadedEl(".kode_pos", datas[data].kode_pos);
                loadedEl(".nama_negara", datas[data].nama_negara);
                loadedEl(".telepon", datas[data].telepon);
                loadedEl(".hp", datas[data].hp);
                loadedEl(".email", datas[data].email);
                loadedEl(".nama_perguruan_tinggi", datas[data].nama_perguruan_tinggi);
                loadedEl(".nama_fakultas", datas[data].nama_fakultas);
                loadedEl(".nama_jurusan", datas[data].nama_jurusan);
                loadedEl(".nama_program_studi", datas[data].nama_program_studi);
                loadedEl(".golongan", datas[data].golongan);
                loadedEl(".pangkat", datas[data].pangkat);
                loadedEl(".jabatan_fungsional", datas[data].jabatan_fungsional);
                loadedEl(".jabatan_struktural", datas[data].jabatan_struktural);
                loadedEl(".status_aktif", datas[data].status_aktif);
                loadedEl(".mulai_masuk_dosen", ddMmYy(datas[data].mulai_masuk_dosen));
                loadedEl(".no_sertifikasi_dosen", datas[data].no_sertifikasi_dosen);
                loadedEl(".tanggal_keluar_sertifikasi_dosen", ddMmYy(datas[data].tanggal_keluar_sertifikasi_dosen));
            }
        }
    });
}

function loadDataRiwayatPendidikan(nidn) {
    $('#tabel_riwayat_pendidikan').dataTable({
        order: [
            [3, "desc"], [2, "desc"], [0, "desc"]
        ],
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "/sid/model/read/detail_riwayat_pendidikan/server_processing.php?nidn=" + nidn,
        "iDisplayLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
    });
    $('div.dataTables_filter input').attr('placeholder', 'Pencarian...');
}

function loadDataRiwayatMengajar(nidn) {
    $('#tabel_riwayat_mengajar').dataTable({
        order: [
            [6, "desc"], [5, "desc"], [2, "desc"]
        ],
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "/sid/model/read/detail_riwayat_mengajar/server_processing.php?nidn=" + nidn,
        "iDisplayLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
    });
    $('div.dataTables_filter input').attr('placeholder', 'Pencarian...');
}

function loadedEl(selector, data) {
    $(selector).text(data).css("backgroundImage", "none");
}

function decidePasFoto(data) {
    var pasfoto;
    if (data == "") {
        pasfoto = "/sid/gambar/foto_default.png";
    } else {
        pasfoto = data;
    }
    $(".pasfoto").attr("src", pasfoto);
}

function decideJenisKelamin(data) {
    if (data == "L") {
        loadedEl($(".jenis_kelamin"), "Laki-laki");
    } else if (data == "P") {
        loadedEl($(".jenis_kelamin"), "Perempuan");
    }
}

function ddMmYy(data) { // Fungsi untuk konversi data DATE (formatnya yy-mm-dd) dari database ke tampilan (formatnya dd-mm-yy)
    var split = data.split("-");
    var getDate = split[2] + "-" + split[1] + "-" + split[0];
    return getDate;
}