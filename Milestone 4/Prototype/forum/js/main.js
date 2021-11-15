//Comment
function showComment(){
    var commentArea = document.getElementById("comment-area");

    if (commentArea.style.display == "none") {
        commentArea.style.display = "block";
    } else {
        commentArea.style.display = "none";
    }
}

//Reply
function showReply(){
    var replyArea = document.getElementById("reply-area");
    
    if (replyArea.style.display == "none") {
        replyArea.style.display = "block";
    } else {
        replyArea.style.display = "none";
    }
}