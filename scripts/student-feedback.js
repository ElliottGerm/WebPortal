

function appendText() {
    var txt3 = document.createElement("p"); // Create with DOM
    txt3.innerHTML = "Another one";
    $("p").append(txt3); // Append the new elements 
}

function showInput() {
    event.preventDefault()
    var userInput = document.getElementById("userInput").value;
    userInput = userInput.replace(" ", '&nbsp;');
    userInput = userInput.replace(/\n|\r/g, '<br>');
    console.log(userInput);
    var commentBlock = '<div id="display">' + userInput + '</div> ';
    theForm.reset();
    $("#newPost").append(commentBlock);

}

//Adds spacing and line break formatting to comments
function formatComment() {
    // Waits for html to finish loading
    $( document ).ready(function() {
        console.log( "ready!" );
        allComments = document.getElementsByClassName("commentBlock");
        console.log(allComments.length);
        var i;
        for(i = 0; i < allComments.length; i++){
            allComments[i].innerHTML = allComments[i].innerHTML.replace(" ", '&nbsp');
            allComments[i].innerHTML = allComments[i].innerHTML.replace(/\n|\r/g, "<br>");
            console.log(allComments[i]);
        }
    });
}

// function resetForm() {
//     var form = document.getElementById("commentForm");
//     form.reset();
// }

function submitForm(postId){
    document.getElementById(postId).submit();
}