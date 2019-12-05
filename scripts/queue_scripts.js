function createQueueEntry() {
    var table = document.getElementById("queue-table");
    var row = table.insertRow(-1);
    var fName = row.insertCell(0);
    var lName = row.insertCell(1);
    var classNum = row.insertCell(2);
    fName.innerHTML = document.getElementById("first").value;
    lName.innerHTML = document.getElementById("last").value;
    classNum.innerHTML = document.getElementById("numClass").value;
}

function populateQuery() {
    var table = document.getElementById("queue-table");
    var row = table.insertRow(-1);
    var fName = row.insertCell(0);
    var lName = row.insertCell(1);
    var classNum = row.insertCell(2);
    fName.innerHTML = document.getElementById("first").value;
    lName.innerHTML = document.getElementById("last").value;
    classNum.innerHTML = document.getElementById("numClass").value;
}

function removeQueryEntry() {
    var table = document.getElementById("queue-table");
    var row = table.deleteRow(1);
}