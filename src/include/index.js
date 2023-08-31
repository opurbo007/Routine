function dropdown() {
   document.querySelector("#submenu").classList.toggle("hidden");
   document.querySelector("#arrow").classList.toggle("rotate-0");
}
dropdown();
// view section
function dropdownview() {
   document.querySelector("#submenuview").classList.toggle("hidden");
   document.querySelector("#arrow2").classList.toggle("rotate-0");
}
dropdownview();
// routine ection
function dropdownRoutine() {
   document.querySelector("#submenuRoutine").classList.toggle("hidden");
   document.querySelector("#arrow3").classList.toggle("rotate-0");
}
dropdownRoutine();
// navbar toggle
function toggleNavbar() {
   const navContainer = document.querySelector(".nav-container");
   const toggleButton = document.querySelector(".toggle-button");

   navContainer.classList.toggle("hidden");
   toggleButton.classList.toggle("hidden");
}
// Hide the success message
setTimeout(function () {
   var successMessage = document.getElementById("successMessage");
   if (successMessage) {
      successMessage.style.display = "none";
   }
}, 3000);

// Hide the error message
setTimeout(function () {
   var errorMessage = document.getElementById("errorMessage");
   if (errorMessage) {
      errorMessage.style.display = "none";
   }
}, 3000);
