$(document).ready(function(){
    $(".btn-like").click(function(){
        alert("You've already liked this tweet!");
    });

    //$('#tweetfield').focus(function(){
    //    $(this).replaceWith(textbox = $(document.createElement('textarea')).attr({
    //        id : $(this).attr('id'),
    //        name : $(this).name,
    //        "class" : 'form form-control',
    //        placeholder: "What's happening?",
    //        rows : 6
    //    }));
    //});


    $('#tweetfield').keyup(function(){
        var len = $(this).val().length;
        $('#charNum').text(140 - len);
    });


    //$('#tweetfield').blur(function(){
    //    $(this).replaceWith(textbox = $(document.createElement('text')).attr({
    //        id : $(this).attr('id'),
    //        name : $(this).name,
    //        "class" : 'form form-control',
    //        placeholder: "What's happening?",
    //        rows : 6
    //    }));
    //});

    $(".btn-rt").click(function(){
        alert("You've already retwitted this tweet!")
    });
});