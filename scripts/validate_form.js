function validateForm() {
    var a = document.getElementById('start_date').value
    var b = document.getElementById('end_date').value
    var c = document.getElementById('start_time').value
    var d = document.getElementById('end_time').value

    if (!a || !b) {
        alert("Please fill in both date fields");
        return false;
    }

    if (a > b) {
        alert("Start date must be before end date");
        return false;
    }

    if (a == b && c > d) {
        alert("Start time must be before end time");
        return false;
    }
}