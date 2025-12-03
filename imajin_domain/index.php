<?php
// Main landing page
require_once 'config/app.php';
require_once 'templates/header.php';
?>

<div class="container">
    <h1>Welcome to Imajin Domain</h1>
    <p>Explore characters, locations, powers, and races in your imagination.</p>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <p><a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a></p>
    <?php else: ?>
        <p><a href="login.php" class="btn btn-primary">Login</a> 
           <a href="register.php" class="btn btn-secondary">Register</a></p>
    <?php endif; ?>
</div>

<?php
require_once 'templates/footer.php';
?>