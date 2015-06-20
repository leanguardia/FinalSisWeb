$(document).ready(function(){

    $('#tweetfield').keyup(function(){
        var len = $(this).val().length;
        $('#charNum').text(140 - len);
    });

    $(".btn-rt").click(function(){
        alert("You've already retwitted this tweet!")
    });
});