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
    var commentBlock = '<div id="display"><p>' + userInput + '</p></div> ';

    // var display = document.getElementById("display");
    // var display = getElementsByClassName("display-area");
    // var theForm = document.getElementById("theForm");
    // var linebreak = document.createElement("br");
    // display.insertAdjacentHTML('beforeend', userInput);
    // display.appendChild(linebreak);
    theForm.reset();
    $("#newPost").append(commentBlock);

}

// function showChat(id) {
//     if (id == "cs149") {
//         x = document.getElementById("cs149");
//     } else if (id == "cs159") {
//         x = document.getElementById("cs159");
//     }

//     if (x.style.display === "none") {
//         x.style.display = "block";
//     } else {
//         x.style.display = "none";
//     }
// }


function getDate() {
    var A = new Date();
    var R = A.getDate();

}