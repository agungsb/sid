function loginValidation() {
    validField();
}

function validate_login() {
    $(".loader").fadeIn("fast");
    $("#log_message").hide();
    var userid = $("#userid").val();
    var password = $("#password").val();
    $.ajax({
        url: "/sid/model/login.php",
        data: {"id": userid, "password": password},
        type: "POST",
        success: function(result) {
            $("#log_message").fadeOut("slow");
            if (result == true) {
                $(".loader").fadeOut("fast");
                location.reload();
            } else {
                $("#userid").val("");
                $("#password").val("");
                $(".loader").fadeOut("fast");
                $("#log_message").addClass("bg-red");
                $("#log_message").text(result);
                $("#log_message").fadeIn("slow");
            }
        }
    });
}

function validField() {
    $("#blogin").on("click", function() {
        if (($("#userid").val() == "") || ($("#password").val() == "")) {
            $("#log_message").text("Mohon Lengkapi Form");
            $("#log_message").addClass("bg-red");
            $("#log_message").text("Mohon lengkapi form!");
            $("#log_message").fadeIn("fast");
        } else {
            validate_login();
        }
    });
    $("#userid").on("keypress", function(e) {
        if (e.which == 13) { // Jika user menekan tombol Enter
            if (($("#userid").val() == "") || ($("#password").val() == "")) {
                $("#log_message").text("Mohon Lengkapi Form");
                $("#log_message").addClass("bg-red");
                $("#log_message").text("Mohon lengkapi form!");
                $("#log_message").fadeIn("fast");
            } else {
                validate_login();
            }
        }
    });
    $("#password").on("keypress", function(e) {
        if (e.which == 13) { // Jika user menekan tombol Enter
            if (($("#userid").val() == "") || ($("#password").val() == "")) {
                $("#log_message").text("Mohon Lengkapi Form");
                $("#log_message").addClass("bg-red");
                $("#log_message").text("Mohon lengkapi form!");
                $("#log_message").fadeIn("fast");
            } else {
                validate_login();
            }
        }
    });
}

/* ALTERNATIVE LOGIN VALIDATION
 
 function validField(selector1, selector2, target) {
 selector1.on("change keydown keyup keypress", function() {
 if ((selector1.val() != "") && (selector2.val() !== "")) {
 target.removeAttr("disabled");
 } else {
 target.attr("disabled", "disabled");
 }
 });
 selector2.on("change keydown keyup keypress", function() {
 if ((selector1.val() != "") && (selector2.val() !== "")) {
 target.removeAttr("disabled");
 } else {
 target.attr("disabled", "disabled");
 }
 });
 }
 function validate_login() {
 $("#login").on("submit", function () {
 $.ajax({
 url: "/sid/model/login.php",
 data: $(this).serialize(),
 type: "POST",
 success: function (result) {
 alert(result);
 }
 });
 });
 } */