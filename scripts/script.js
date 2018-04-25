$(document).ready(function() {
    //Variable passed with the posts request 
    var page = 1;

    //Variable Passed with the message request
    var convPage = 1;

    //load Posts for index/profile.php
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

    $(".messages").click(function() {
        $.post("includes/ajax/ajax_load_last_messages.php", function(data) {
            $(".recentMessages").prepend(data);
        });
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

    //submit message
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


    //Update/load the conversation window
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
                }
            });
        }, 1000);

    });

    $("#discussion-modal").on("hidden.bs.modal", function() {
        clearInterval(conversationInterval);
    });

});