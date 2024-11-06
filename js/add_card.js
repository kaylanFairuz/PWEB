document.getElementById("addCardBtn").onclick = function () {
  document.getElementById("addCardModal").style.display = "block";
};

// Close the modal when the "X" is clicked
document.querySelector(".close-add-card").onclick = function () {
  document.getElementById("addCardModal").style.display = "none";
};

// Close the modal if clicked outside of the modal content
window.onclick = function (event) {
  if (event.target == document.getElementById("addCardModal")) {
    document.getElementById("addCardModal").style.display = "none";
  }
};

// Initialize content count
let contentCount = 1;

// Function to dynamically add more content sections
function addContentSection() {
  contentCount++;
  const contentSections = document.getElementById("contentSections");
  const newSection = document.createElement("div");
  newSection.classList.add("content-section");

  newSection.innerHTML = `
      <label for="contentImage${contentCount}">Content Image ${contentCount} (optional)</label>
      <input type="file" name="contentImage[]" accept="image/*" onchange="previewImage(event, 'contentImagePreview${contentCount}')" />
      <img id="contentImagePreview${contentCount}" src="" alt="Preview" class="image-preview" style="display:none;" />

      <label for="contentTitle${contentCount}">Content Title ${contentCount} (optional)</label>
      <input type="text" name="contentTitle[]" placeholder="Content Title ${contentCount} (optional)" />

      <label for="content${contentCount}">Content ${contentCount} (optional)</label>
      <textarea name="contentText[]" placeholder="Content ${contentCount} (optional)"></textarea>
  `;
  contentSections.appendChild(newSection);

  // Update the delete button visibility
  toggleDeleteButton();
}

// Function to delete the last content section
function deleteContent() {
  if (contentCount > 1) {
    const contentSections = document.getElementById("contentSections");
    contentSections.removeChild(contentSections.lastChild); // Remove the last added content section
    contentCount--;

    // Update the delete button visibility
    toggleDeleteButton();
  }
}

// Function to toggle the visibility of the delete button
function toggleDeleteButton() {
  const deleteButton = document.getElementById("deleteContentButton");
  if (contentCount > 1) {
    deleteButton.style.display = "inline-block"; // Show the delete button if there is more than one content
  } else {
    deleteButton.style.display = "none"; // Hide the delete button if there's only one content
  }
}

// Image preview function
function previewImage(event, previewId) {
  const preview = document.getElementById(previewId);
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      preview.src = reader.result;
      preview.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
}

toggleDeleteButton();
