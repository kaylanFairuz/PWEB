// Open delete cards modal and populate checkboxes
document.getElementById("deleteCardBtn").addEventListener("click", function () {
  // Fetch all cards to display in the delete modal
  fetch("php/get_all_cards.php")
    .then((response) => response.json())
    .then((cards) => {
      const deleteCardsList = document.getElementById("deleteCardsList");
      deleteCardsList.innerHTML = ""; // Clear the list first

      cards.forEach((card) => {
        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.name = "card_ids[]"; // Name should be the same for all checkboxes
        checkbox.value = card.id; // The card's ID to delete
        checkbox.id = `card-${card.id}`;

        const label = document.createElement("label");
        label.setAttribute("for", `card-${card.id}`);
        label.innerText = card.title;

        const div = document.createElement("div");
        div.appendChild(checkbox);
        div.appendChild(label);
        deleteCardsList.appendChild(div);
      });

      // Display the modal
      document.getElementById("deleteCardsModal").style.display = "block";
    })
    .catch((err) => console.error("Error fetching cards:", err));
});

// Close the delete modal
document
  .querySelector(".close-delete-cards")
  .addEventListener("click", function () {
    document.getElementById("deleteCardsModal").style.display = "none";
  });

// Close the modal when clicking outside of it
window.addEventListener("click", function (event) {
  if (event.target === document.getElementById("deleteCardsModal")) {
    document.getElementById("deleteCardsModal").style.display = "none";
  }
});
