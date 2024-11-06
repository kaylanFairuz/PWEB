<?php
session_start();

// Check if user is an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); // Redirect to visitor homepage if not admin
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>CTheEarth | Admin Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/admin_main.css" />
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
</head>

<body>
    <header>
        <div>
            <img src="assets/logo.png" alt="logo" width="138px" height="66px" />
        </div>
        <nav>
            <ul>
                <li><a href="admin_index.php">Home</a></li>
                <li><a href="pages/about.php">About</a></li>
                <?php if (isset($_SESSION['user_email'])): ?>
                    <li>
                        <div class="dropdown">
                            <button class="dropbtn" id="accountBtn">
                                <img src="assets/defaultpp.png" alt="Profile Picture" class="profile-pic" />
                                <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Account'; ?>
                            </button>
                            <div class="dropdown-content" id="dropdownMenu">
                                <a href="php/logout.php">Logout</a>
                            </div>
                        </div>
                    </li>
                <?php else: ?>
                    <li><a href="javascript:void(0)" id="loginBtn">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <section class="banner">
        <?php include 'php/banner-slides.php'; ?>
    </section>
    <section class="admin-options">
        <p>Welcome, Admin! Use the options below to manage cards.</p>
        <div class="admin-buttons">
            <a href="javascript:void(0)" id="addCardBtn" class="admin-button">Add New Card</a>
            <a href="javascript:void(0)" id="deleteCardBtn" class="admin-button">Delete Cards</a>
        </div>
    </section>
    <section class="main-content">
        <?php include 'php/main-content.php'; ?>
        <?php include 'php/archive-bar.php'; ?>
    </section>
    <footer>
        <a href="https://www.instagram.com/_kaylanfa_/">
            <img
                src="assets/instagram.png"
                alt="instagram"
                width="60px"
                height="60px" />
        </a>
        <a href="https://www.linkedin.com/in/kaylanfairuza/">
            <img
                src="assets/linkedin.png"
                alt="linkedin"
                width="60px"
                height="60px" />
        </a>
    </footer>

    <script src="js/main.js" defer></script>
    <script src="js/login.js" defer></script>
    <script src="js/add_card.js" defer></script>
    <script src="js/delete_card.js" defer></script>

    <section id="addCardModal" class="modal">
        <div class="modal-content">
            <span class="close-add-card">&times;</span>
            <h2>Add Card</h2>
            <form id="addCardForm" action="php/add_card.php" method="POST" enctype="multipart/form-data">
                <!-- Title Field -->
                <label for="cardTitle">Title</label>
                <input id="cardTitle" name="cardTitle" type="text" required placeholder="Enter Card Title" />

                <!-- Card Image Field -->
                <label for="cardImage">Card Image</label>
                <input type="file" id="cardImage" name="cardImage" accept="image/*" required onchange="previewImage(event, 'cardImagePreview')" />
                <img id="cardImagePreview" src="" alt="Preview" class="image-preview" style="display:none;" />

                <!-- Content Title 1 -->
                <label for="contentTitle1">Content Title 1 (optional)</label>
                <input type="text" name="contentTitle[]" placeholder="Content Title 1 (optional)" />

                <!-- Content Image 1 -->
                <label for="contentImage1">Content Image 1</label>
                <input type="file" name="contentImage[]" accept="image/*" required onchange="previewImage(event, 'contentImagePreview1')" />
                <img id="contentImagePreview1" src="" alt="Preview" class="image-preview" style="display:none;" />

                <!-- Content 1 -->
                <label for="content1">Content 1 (optional)</label>
                <textarea name="contentText[]" placeholder="Content 1 (optional)"></textarea>

                <!-- Add More Content Section -->
                <div id="contentSections">

                </div>

                <!-- Delete Content Button -->
                <button type="button" id="deleteContentButton" onclick="deleteContent()">Delete Content</button>

                <!-- Add More Content Button -->
                <button type="button" onclick="addContentSection()">Add More Content</button>

                <!-- Submit Button -->
                <button type="submit">Submit</button>
            </form>
        </div>
    </section>
    <section id="deleteCardsModal" class="modal">
        <div class="modal-content">
            <span class="close-delete-cards">&times;</span>
            <h2>Delete Cards</h2>
            <form id="deleteCardsForm" action="php/delete_cards.php" method="POST">
                <p>Select the cards you want to delete:</p>
                <div id="deleteCardsList">
                    <!-- Dynamically populated checkboxes go here -->
                </div>
                <button type="submit">Delete Selected Cards</button>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (isset($_SESSION['email_error']) || isset($_SESSION['password_error'])): ?>
                document.getElementById("loginModal").style.display = "block";
                <?php unset($_SESSION['email_error'], $_SESSION['password_error']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['register_email_error']) || isset($_SESSION['register_password_error'])): ?>
                document.getElementById("registerModal").style.display = "block";
                <?php unset($_SESSION['register_email_error'], $_SESSION['register_password_error']); ?>
            <?php endif; ?>
        });
    </script>
</body>

</html>