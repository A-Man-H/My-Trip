/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show1");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn1')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show1')) {
      myDropdown.classList.remove('show1');
    }
  }
}