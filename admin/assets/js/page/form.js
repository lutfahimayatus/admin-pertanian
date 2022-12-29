$(document).ready(function () {
    var images = [];
    var file = $("input[type=file]");
    var html = '';
    file.change(function () {
        // remove all element insde div
        $('#preview').empty();
        images = [];

        var files = this.files;
        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = {};
                image = e.target.result;
                images.push(image);
            }
            reader.readAsDataURL(files[i]);
        }
        html = "";
        setTimeout(function () {

            for (var i = 0; i < images.length; i++) {
                html += '<div class="col-6"> <img src="' + images[i] + '" width="400" height="400" class="img-thumbnail"/></div>';
            }
            $("#preview").html(html);
        }, 1000);
    }
    );
});
