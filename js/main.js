/* Login Button */
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("loginModal");
  const loginBtn = document.getElementById("loginBtn");
  const closeBtn = document.querySelector(".close");

  // Show the modal when the login button is clicked
  loginBtn.onclick = function () {
    modal.style.display = "block";
  };

  // Close the modal when the 'X' button is clicked
  closeBtn.addEventListener("click", function () {
    modal.style.display = "none";
  });

  // Close the modal if the user clicks outside of it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
});

/* Archive */
const toggles = document.querySelectorAll(".archive-toggle");

toggles.forEach((toggle) => {
  toggle.addEventListener("click", () => {
    const dropdown = toggle.nextElementSibling;

    // Toggle display of the dropdown
    const isExpanded = dropdown.style.display === "block";
    dropdown.style.display = isExpanded ? "none" : "block";

    // Count the number of list items in the dropdown
    const itemCount = dropdown.querySelectorAll("li").length;

    // Update button text based on toggle state and item count
    const letter = toggle.dataset.letter; // Get the letter from data attribute
    toggle.textContent =
      (isExpanded ? "▸" : "▾") + " " + letter + " (" + itemCount + ")"; // Show count
  });
});

/* Banner */
const banner = document.querySelector(".banner");
const slides = document.querySelectorAll(".slide");

const imagesAndText = [
  {
    image: "assets/norway.jpg",
    title: "Norway",
    description: "See the Aurora Borealis on your trip at Norway.",
  },
  {
    image: "assets/greece.jpg",
    title: "Greece",
    description:
      "Experience the rich history and stunning landscapes of Greece.",
  },
  {
    image: "assets/iceland.jpg",
    title: "Iceland",
    description: "Discover the breathtaking natural wonders of Iceland.",
  },
];

let currentSlide = 0;

function changeSlide() {
  banner.style.backgroundImage = `url('${imagesAndText[currentSlide].image}')`;

  const activeSlide = slides[currentSlide];
  activeSlide.querySelector("h1").textContent =
    imagesAndText[currentSlide].title;
  activeSlide.querySelector("p").textContent =
    imagesAndText[currentSlide].description;

  slides.forEach((slide) => slide.classList.remove("active"));
  activeSlide.classList.add("active");

  currentSlide = (currentSlide + 1) % imagesAndText.length;
}

setInterval(changeSlide, 10000);
changeSlide();
