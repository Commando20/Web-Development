
$("#easy").click(function () {
    $("#easy").fadeOut();
    $("#average").fadeOut();
    $("#hard").fadeOut();
    $("#game1").fadeIn("slow");
});


$("#tryAgain").click(function () {
    $("#tryAgain").hide();
    $("<p>You are incorrect. I was thinking of $randNum.<br>Try again!</p>").hide();
});