        

var signInButton = document.getElementById('signInButton').childNodes[0];
var textnode = document.createTextNode("Logout");

signInButton.replaceChild(textnode, signInButton.childNodes[0]);
var a = document.querySelector('a[href="login.php"]');
if (a) {
  a.setAttribute('href', 'logout.php')
}