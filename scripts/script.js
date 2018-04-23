$(document).ready(function() {
    var page = 1;
    var convPage = 1;
    loadPosts();
    var conversationInterval;
    var lastloadedTimestamp;


    $("#displayMore").click(function() {
        page++;
        $("#loadingImg").removeClass("d-none");
        loadPosts();
    });

    function loadPosts() {
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
    }

    $("#discuss-btn").click(function() {
        convPage = 1;
        $("#conversation").html("");
        $("#discussion-modal").modal();
        loadMessages();
    });

    function loadMessages() {
        $.ajax({
            url: "includes/ajax/ajax_load_messages.php",
            type: "POST",
            data: "convPage=" + convPage,
            cache: false,
            success: function(conversation) {
                $("#conversation").prepend(conversation);

            }
        });
    }

    $(".modal-body").on("click", "#moreMessages", function() {
        convPage++;
        $.ajax({
            url: "includes/ajax/ajax_load_messages.php",
            type: "POST",
            data: "convPage=" + convPage,
            cache: false,
            success: function(conversation) {
                $("#moreMessages").hide();
                $("#conversation").prepend(conversation);
            }
        });
    });

    $("#send-btn").click(function() {
        var msgBody = $("#msgBody").val();
        $.ajax({
            url: "includes/ajax/ajax_submit_message.php",
            type: "POST",
            data: "msgBody=" + msgBody,
            cache: false,
            success: function(data) {
                $("#msgBody").val('');
                $("#conversation").append(data);
                lastloadedTimestamp = $(".user-conv:last input[type=hidden]").val();
            }
        });
    });



    $("#discussion-modal").on("shown.bs.modal", function() {
        conversationInterval = setInterval(function() {
            $.ajax({
                url: "includes/ajax/ajax_load_new_messages.php",
                type: "POST",
                data: "lastTimeStamp=" + lastloadedTimestamp,
                cache: false,
                success: function(data) {
                    $("#conversation").append(data);
                    lastloadedTimestamp = $(".conversation-div:last input[type=hidden]").val();
                    console.log("Last time stamp: " + lastloadedTimestamp);
                }
            });
        }, 1000);

    });

    $("#discussion-modal").on("hidden.bs.modal", function() {
        clearInterval(conversationInterval);
    });

});