function select(id) {
    div = document.getElementById("selection-menu");
    element = document.getElementById(id);
    input = document.getElementById('input_'+ id);

    if(element.className === "inactive"){
        element.classList.remove("inactive");
        element.classList.add("active");
        input.classList.remove("inactive");
        input.classList.add("active");
    } else {
        element.classList.remove("active");
        element.classList.add("inactive");
        input.classList.remove("active");
        input.classList.add("inactive");
    }

    for (var opt, j = 0; opt = div.children[j]; j++) {
        if (opt.className == "active" && opt.tagName == "INPUT") {
          opt.disabled = '';
        } else if(opt.className == "inactive" && opt.tagName == "INPUT")
        {
          opt.disabled = 'disabled';
        }
    }

}
