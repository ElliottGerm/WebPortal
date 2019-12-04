function showView(role, eid, inQueue) {
    event.preventDefault()

    if (role == 1) {
        var man_view = document.getElementById("manager_view");
        man_view.style.display = "inline";
        var man_view = document.getElementById("stu_feedback_view");
        man_view.style.display = "inline";
        // var queueButton = document.getElementById("joinButton");
        // queueButton.removeAttribute("disabled");
        // var deleteButton = document.getElementById("removeButton");
        // deleteButton.removeAttribute("disabled");
    }
    if (role == 2) {
        var ta_view = document.getElementById("ta_view");
        ta_view.style.display = "inline";
        // var dangerButton = document.getElementsByClassName("btn-danger");
        // console.log(dangerButton[0]);
        // dangerButton.style.display = "inline";
    }
    if (role == 3) {
        var ask_view = document.getElementById("stu_view");
        ask_view.style.display = "inline";

    }
    if (eid) {
        var logoutButton = document.getElementById("signOutButton");
        logoutButton.classList.remove("disabled");

        if (inQueue == 0) {
            var queueButton = document.getElementById("joinButton");
            queueButton.removeAttribute("disabled");
        }
    }

    var buttonId = document.getElementById(eid);
    // console.log(eid);
    buttonId.style.display = "inline";

}