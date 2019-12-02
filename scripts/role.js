function showView(role, eid) {
    event.preventDefault()

    if(role == 1){
        var man_view = document.getElementById("manager_view");
        man_view.style.display = "inline";
        var man_view = document.getElementById("stu_feedback_view");
        man_view.style.display = "inline";
    } 
    if(role == 2){
        var ta_view = document.getElementById("ta_view");
        ta_view.style.display = "inline";
    } 
    if(role == 3){
        var ask_view = document.getElementById("stu_view");
        ask_view.style.display = "inline";
    } 
    if(eid){
        var logoutButton = document.getElementById("signOutButton");
        logoutButton.classList.remove("disabled");
        var queueButton = document.getElementById("joinButton");
        queueButton.removeAttribute("disabled");
    }
}

