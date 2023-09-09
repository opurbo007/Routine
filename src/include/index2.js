// Hide the error message
setTimeout(function () {
   let errorMessage = document.getElementById("errorMessage");
   if (errorMessage) {
      errorMessage.style.display = "none";
   }
}, 3000);
// navbar toggle
function toggleNavbar() {
   const navContainer = document.querySelector(".nav-container");
   const toggleButton = document.querySelector(".toggle-button");

   navContainer.classList.toggle("hidden");
   toggleButton.classList.toggle("hidden");
}
