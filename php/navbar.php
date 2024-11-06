<div>
    <img src="../assets/logo.png" alt="logo" width="138px" height="66px" />
</div>
<nav>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <?php if (isset($_SESSION['user_email'])): ?>
            <li>
                <div class="dropdown">
                    <button class="dropbtn" id="accountBtn">
                        <img src="../assets/defaultpp.png" alt="Profile Picture" class="profile-pic" />
                        <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Account'; ?>
                    </button>
                    <div class="dropdown-content" id="dropdownMenu">
                        <a href="../php/logout.php">Logout</a>
                    </div>
                </div>
            </li>
        <?php else: ?>
            <li><a href="javascript:void(0)" id="loginBtn">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>