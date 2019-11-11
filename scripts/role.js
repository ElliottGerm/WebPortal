function showView(role) {

    // event.preventDefault()
    if(role == 1){
        var ta_view = document.getElementById("manager_view");
        ta_view.style.display = "inline";
    } 
    if(role == 3){
        var ta_view = document.getElementById("ta_view");
        ta_view.style.display = "inline";
    } 
}
