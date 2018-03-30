$(function(){
var page=1;
var username= '<?php echo $_SESSION["username"] ?>';
if (window.location.pathname === "/Social/public/index.php"){

    $.ajax({
        url:"includes/ajax/ajax_load_posts.php",
        type:"POST",
        data:"page="+page+"&username="+username,
        cache: false,
        success: function(data){
            $("#loadingImg").addClass("d-none");
            $("#feed").html(data);
        }
    });


    $("#displayMore").click(function(){
        page++;
        console.log(page);
        $("#loadingImg").removeClass("d-none");
        $.ajax({
            url:"includes/ajax/ajax_load_posts.php",
            type:"POST",
            data:"page="+page+"&username="+username,
            cache: false,
            success: function(data){
                $("#loadingImg").addClass("d-none");
                $("#feed").append(data);
            }
        });
    });

}

});
