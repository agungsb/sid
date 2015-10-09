$(function () {
    read_pasfoto();
    $(".loader").fadeOut("slow");
    $(".upload_tools").hide();
    window.onload = function () {
        var options =
                {
                    imageBox: '.imageBox',
                    thumbBox: '.thumbBox',
                    spinner: '.spinner',
                    imgSrc: 'avatar.png'
                }
        var cropper;
        document.querySelector('#file').addEventListener('change', function () {
            if ($('.flUpload').val() != "") {
                var file = $('.flUpload')[0].files[0];
                var fileName = file.name;
                var fileExt = '.' + fileName.split('.').pop();
                if ((fileExt == ".jpg") || (fileExt == ".png")) { // Check file's extension
                    //console.log(fileExt);
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        options.imgSrc = e.target.result;
                        cropper = new cropbox(options);
                    }
                    reader.readAsDataURL(this.files[0]);
                    this.files = [];
                    $(".upload_tools").fadeIn("fast");
                } else {
                    alert("Format tidak mendukung!");
                    read_pasfoto();
                    $(".upload_tools").fadeOut("fast");
                }
            }
        })
        document.querySelector('#btnCrop').addEventListener('click', function () {
            $(".upload_tools").fadeOut("fast");
            $('.spinner').fadeIn("slow");
            if ($('.flUpload').val() != "") {
                var file = $('.flUpload')[0].files[0];
                var fileName = file.name;
                var fileExt = '.' + fileName.split('.').pop();
                if ((fileExt == ".jpg") || (fileExt == ".png")) { // Check file's extension
                    var img = cropper.getDataURL()
                    // similar behavior as clicking on a link
                    $.ajax({
                        url: "/sid/model/update/data_dosen/m_u_upload_pasfoto.php",
                        type: "POST",
                        data: {src: img, ext: fileExt},
                        success: function (result) {
                            var data = JSON.parse(result);
                            $('.spinner').fadeOut("fast");
                            location.reload();
                        }
                    });
                } else {
                    alert(fileExt);
                }
            }
            else {
                alert('Please select a file.')
            }
        });
        document.querySelector('#btnZoomIn').addEventListener('click', function () {
            cropper.zoomIn();
        });
        document.querySelector('#btnZoomOut').addEventListener('click', function () {
            cropper.zoomOut();
        });
        document.querySelector('#btnMoveUp').addEventListener('click', function () {
            moveUp();
        });
        document.querySelector('#btnMoveBottom').addEventListener('click', function () {
            moveBottom();
        });
        document.querySelector('#btnMoveLeft').addEventListener('click', function () {
            moveLeft();
        });
        document.querySelector('#btnMoveRight').addEventListener('click', function () {
            moveRight();
        });
        document.querySelector('#btnCancel').addEventListener('click', function () {
            location.reload();
        });

        function moveUp() {
            var el = $(".imageBox");
            var bg = el.css("backgroundPosition").split(' ');

            var bgX = parseInt(bg[0]);
            var bgY = parseInt(bg[1]);
            bgY -= 5;
            el.css("backgroundPosition", "" + bgX + 'px ' + bgY + 'px' + "");
        }

        function moveBottom() {
            var el = $(".imageBox");
            var bg = el.css("backgroundPosition").split(' ');

            var bgX = parseInt(bg[0]);
            var bgY = parseInt(bg[1]);
            bgY += 5;
            el.css("backgroundPosition", "" + bgX + 'px ' + bgY + 'px' + "");
        }

        function moveLeft() {
            var el = $(".imageBox");
            var bg = el.css("backgroundPosition").split(' ');

            var bgX = parseInt(bg[0]);
            var bgY = parseInt(bg[1]);
            bgX -= 5;
            el.css("backgroundPosition", "" + bgX + 'px ' + bgY + 'px' + "");
        }

        function moveRight() {
            var el = $(".imageBox");
            var bg = el.css("backgroundPosition").split(' ');

            var bgX = parseInt(bg[0]);
            var bgY = parseInt(bg[1]);
            bgX += 5;
            el.css("backgroundPosition", "" + bgX + 'px ' + bgY + 'px' + "");
        }
    };
})