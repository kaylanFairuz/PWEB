/* Login and Register */
document.addEventListener("DOMContentLoaded", () => {
  const loginModal = document.getElementById("loginModal");
  const registerModal = document.getElementById("registerModal");
  const loginBtn = document.getElementById("loginBtn");
  const registerBtn = document.getElementById("registerBtn");
  const closeLoginBtn = document.querySelector(".close-login");
  const closeRegisterBtn = document.querySelector(".close-register");

  // Show the login modal and hide the register modal when the login button is clicked
  loginBtn.onclick = function () {
    registerModal.style.display = "none";
    loginModal.style.display = "block";
  };

  // Show the register modal and hide the login modal when the register button is clicked
  registerBtn.onclick = function () {
    loginModal.style.display = "none";
    registerModal.style.display = "block";
  };

  // Close the login modal when the 'X' button is clicked
  closeLoginBtn.addEventListener("click", function () {
    loginModal.style.display = "none";
  });

  // Close the register modal when the 'X' button is clicked
  closeRegisterBtn.addEventListener("click", function () {
    registerModal.style.display = "none";
  });

  // Close the modals if the user clicks outside of either modal
  window.onclick = function (event) {
    if (event.target == loginModal) {
      loginModal.style.display = "none";
    }
    if (event.target == registerModal) {
      registerModal.style.display = "none";
    }
  };
});

/* Account Dropdown */
const accountBtn = document.getElementById("accountBtn");
const dropdownMenu = document.getElementById("dropdownMenu");

accountBtn.addEventListener("click", (event) => {
  event.stopPropagation(); // Prevent event from bubbling up
  dropdownMenu.classList.toggle("show");
});

window.addEventListener("click", () => {
  dropdownMenu.classList.remove("show");
});
