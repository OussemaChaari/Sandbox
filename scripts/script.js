$(document).ready(function() {
    var page = 1;
    $.ajax({
        url: "includes/ajax/ajax_load_posts.php",
        type: "POST",
        data: "page=" + page,
        cache: false,
        success: function(data) {
            $("#loadingImg").addClass("d-none");
            $("#feed").html(data);
        }
    });


    $("#displayMore").click(function() {
        page++;
        $("#loadingImg").removeClass("d-none");
        $.ajax({
            url: "includes/ajax/ajax_load_posts.php",
            type: "POST",
            data: "page=" + page,
            cache: false,
            success: function(data) {
                $("#loadingImg").addClass("d-none");
                $("#feed").append(data);
            }
        });
    });





});