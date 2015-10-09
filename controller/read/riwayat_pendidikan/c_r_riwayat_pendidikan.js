function read_riwayat_pendidikan() {
    var cList = [".kode_perguruan_tinggi", ".kode_gelar_akademik", ".kode_jenjang_pendidikan", ".tanggal_ijazah"];
    var fList = [select_gelar_akademik, select_jenjang_pendidikan, select_tanggal_ijazah];
    tagsInputHandler(0, cList, fList);
    tagsInputHandler(1, cList, fList);
    tagsInputHandler(2, cList, fList);
    select_perguruan_tinggi();
    $('#list').dataTable({
        "columns": [
            null,
            null,
            null,
            {"width": "5%"},
            {"width": "5%", "bSearchable": false},
            {"width": "5%", "bSearchable": false}
        ],
        order: [
            [3, "desc"], [2, "desc"], [0, "desc"]
        ],
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": false,
        "bAutoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "/sid/model/read/riwayat_pendidikan/server_processing.php",
        "iDisplayLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
    });
    $('div.dataTables_filter input').attr('placeholder', 'Pencarian...');
    $(".loader").fadeOut("slow");
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
    // Biarkan saja kosong
}

function tagsInputHandler(i, c, f) {
    $(c[i]).on("itemAdded", function () {
        $(c[i + 1]).removeAttr("disabled");
        f[i]();
    });
    $(c[i]).on("itemRemoved", function () {
        for (var ii = i + 1; ii < f.length; ii++) {
            $(c[ii]).tagsinput("removeAll");
            $(c[ii]).tagsinput("destroy");
            $(c[ii]).attr("disabled", "disabled");
        }
        $('#tanggal_ijazah').attr("disabled", "disabled");
    });
}