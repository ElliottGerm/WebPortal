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



// Add items to an unordered list
document.getElementById('add-to-list').onclick = function() {
  var list = document.getElementById('list');
  var newLI = document.createElement('li');
  newLI.innerHTML = 'A new item';
  list.appendChild(newLI);
  setTimeout(function() {
    newLI.className = newLI.className + " show";
  }, 10);
}