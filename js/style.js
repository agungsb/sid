$(function() {
    $('.submit, .csubmit').hide();
    action(".editable_input_text");
    action(".editable_select");
    function action(selector) {
        var getValue;
        $(selector).on("focus", function() {
            $('.submit, .csubmit').fadeOut('fast');
            $(this).css({
                "background": "#eee"
            });
            getValue = $(this).val();
            $(this).parent().find('.submit, .csubmit').fadeIn('fast');
        });
        $(selector).on("blur", function() {
            if ($(this).val() == getValue) {
                $(this).val(getValue);
            }
            $(this).css({
                "background": "transparent",
                "color": "#555",
                "border": "none"
            });
        });
        $(selector).on("change", function() {
            if ((selector == ".editable_select") || ($(this).hasClass('hasDatepicker'))) { // Important! Agar event change pada tag input['text'] tidak konflik dengan event change pada tag select
                //console.log($(this).attr("name")); // Fungsi ini dimaksudkan agar event change hanya bekerja pada tag select dan tag input yang memiliki class hasDatepicker
                getValue = $(this).val();
                $(".loader").fadeIn("slow");
                updateDataDosen($(this).attr("name"), escapeHtml(getValue));
            }
        });
        $(selector).on("keypress", function(e) {
            if (e.which == 13) { // Jika user menekan tombol Enter
                if ($(this).val() != getValue) { // Jika ada perubahan pada value, barulah update ke database
                    if ($(this).attr("name") == "email") {
                        validateEmail($(this), getValue);
                    } else {
                        console.log($(this).attr("name"));
                        getValue = $(this).val();
                        $(".loader").fadeIn("slow");
                        updateDataDosen($(this).attr("name"), escapeHtml(getValue));
                    }
                }
            }
        });
        $(selector).parent('div').find(".submit").on("click", function() {
            var elt = $(this).parent('div').find(selector);
            if ((elt.val() != getValue)) { // Jika ada perubahan pada value, barulah update ke database
                if (elt.attr("name") == "email") {
                    validateEmail(elt, getValue);
                } else {
                    getValue = elt.val();
                    $(".loader").fadeIn("slow");
                    updateDataDosen(elt.attr("name"), escapeHtml(getValue));
                }
            } else {
                $(".submit, .csubmit").fadeOut("fast");
            }
        });
        $(selector).parent('div').find(".csubmit").on("click", function() {
            $(this).parent('div').find(selector).val(getValue);
            $(".submit, .csubmit").fadeOut("fast");
        });
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

    function validateEmail(el, getValue) {
        var x = $(el).val();
        var atpos = x.indexOf("@unj.ac.id");
        var dotpos = x.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
            alert("Domain e-mail haruslah unj.ac.id");
            $(el).val(getValue);
            return false;
        } else {
            //alert("Berubah");
            $(".loader").fadeIn("slow");
            updateDataDosen($(el).attr("name"), escapeHtml(x));
        }
    }
});