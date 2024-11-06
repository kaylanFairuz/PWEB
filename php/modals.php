<section id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close-login">&times;</span>
        <h2>Login</h2>
        <form action="../php/login.php" method="POST">
            <input id="email" name="email" required placeholder="Email" />
            <div style="color:red;">
                <?php if (isset($_SESSION['email_error'])): ?>
                    <p><?php echo $_SESSION['email_error']; ?></p>
                <?php endif; ?>
            </div>

            <input type="password" id="password" name="password" required placeholder="Password" />
            <div style="color:red;">
                <?php if (isset($_SESSION['password_error'])): ?>
                    <p><?php echo $_SESSION['password_error']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <input type="checkbox" name="remember" id="remember" />
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit">Login</button>

            <p>Don't have an account? <a href="javascript:void(0)" id="registerBtn">Make one</a></p>
        </form>
    </div>
</section>
<section id="registerModal" class="modal">
    <div class="modal-content">
        <span class="close-register">&times;</span>
        <h2>Register</h2>
        <form method="POST" action="../php/register.php">
            <input name="email" required placeholder="Email" />
            <div style="color:red;">
                <?php if (isset($_SESSION['register_email_error'])): ?>
                    <p><?php echo $_SESSION['register_email_error']; ?></p>
                <?php endif; ?>
            </div>

            <input type="password" name="password" required placeholder="Password" />
            <div style="color:red;">
                <?php if (isset($_SESSION['register_password_error'])): ?>
                    <p><?php echo $_SESSION['register_password_error']; ?></p>
                <?php endif; ?>
            </div>

            <button type="submit">Register</button>
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