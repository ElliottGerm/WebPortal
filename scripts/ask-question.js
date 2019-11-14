// $(document).ready(function() {
//     $("p").click(function() {
//         $(this).hide();
//     });
// });

function appendText() {
    // var txt1 = "<p>Text.</p>"; // Create element with HTML  
    // var txt2 = $("<p></p>").text("Text."); // Create with jQuery
    var txt3 = document.createElement("p"); // Create with DOM
    txt3.innerHTML = "Another one";
    $("p").append(txt3); // Append the new elements 
}

function showInput() {
    // console.log('showInput called...')
    var A = new Date();
    var R = A.getDate();
    // var date = new Date();
    // var timeStamp = date.getTime();
    // var day = date.getDay()
    // var month = date.getMonth() + 1
    // var year = date.getFullYear()
    // timeStamp = day + "/" + month + "/" + year
    event.preventDefault()
    var userInput = document.getElementById("userInput").value;
    userInput = userInput.replace(" ", '&nbsp;');
    userInput = userInput.replace(/\n|\r/g, '<br>');
    console.log(userInput);
    var commentBlock = '<div id="display">' + userInput + '</div> ';
    // var commentBlock = '<div id="display"><pre>' + userInput + '</pre></div> ';
    // var display = document.getElementById("display");
    // var display = getElementsByClassName("display-area");
    // var theForm = document.getElementById("theForm");
    // var linebreak = document.createElement("br");
    // display.insertAdjacentHTML('beforeend', userInput);
    // display.appendChild(linebreak);
    theForm.reset();
    $("#newPost").append(commentBlock);

}




function getDate() {
    var A = new Date();
    var R = A.getDate();

}