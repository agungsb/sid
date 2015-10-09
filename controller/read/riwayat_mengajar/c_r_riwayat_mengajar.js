function read_riwayat_mengajar() {
    var cList = [".kode_perguruan_tinggi", ".kode_program_studi", ".kode_jenjang_pendidikan", ".kode_mata_kuliah", ".kode_semester"];
    var fList = [select_program_studi, select_jenjang_pendidikan, select_mata_kuliah, select_semester];
    tagsInputHandler(0, cList, fList);
    tagsInputHandler(1, cList, fList);
    tagsInputHandler(2, cList, fList);
    tagsInputHandler(3, cList, fList);
    select_program_studi();

    $('#list').dataTable({
        "columns": [
            null,
            null,
            null,
            null,
            {"width": "5%"},
            null,
            null,
            {"width": "5%", "bSearchable": false},
            {"width": "5%", "bSearchable": false}
        ],
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
        "ajax": "/sid/model/read/riwayat_mengajar/server_processing.php",
        "iDisplayLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
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
function select_semester() {
    $(".kode_semester").on("change", function () {
        if ($(this).val() != "") {
            $(".tahun_akademik").removeAttr("disabled");
        } else {
            $(".tahun_akademik").attr("disabled", "disabled");
        }
    });
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
        $('#default_selection').attr("selected", "selected");
        $('.kode_semester').attr("disabled", "disabled");
        $('.tahun_akademik').attr("disabled", "disabled");
    });
}