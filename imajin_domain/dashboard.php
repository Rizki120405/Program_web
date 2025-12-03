<?php
require_once 'config/app.php';
require_once 'core/auth.php';

// Redirect if not logged in
require_login();

require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<div class="container">
    <h1>Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    
    <div class="dashboard-menu">
        <h2>Manage Your Content</h2>
        <div class="menu-grid">
            <a href="modules/characters/character_list.php" class="menu-item">
                <h3>Characters</h3>
                <p>View and manage characters</p>
            </a>
            <a href="modules/locations/location_list.php" class="menu-item">
                <h3>Locations</h3>
                <p>View and manage locations</p>
            </a>
            <a href="modules/powers/power_list.php" class="menu-item">
                <h3>Powers</h3>
                <p>View and manage powers</p>
            </a>
            <a href="modules/races/race_list.php" class="menu-item">
                <h3>Races</h3>
                <p>View and manage races</p>
            </a>
        </div>
    </div>
</div>

<?php
require_once 'templates/footer.php';
?>