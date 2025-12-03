<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';

require_login();

global $pdo;

// Get all locations
$stmt = $pdo->prepare("SELECT * FROM locations WHERE user_id = ? ORDER BY name ASC");
$stmt->execute([$_SESSION['user_id']]);
$locations = $stmt->fetchAll();
?>

<?php require_once '../../templates/header.php'; ?>
<?php require_once '../../templates/sidebar.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Locations</h1>
        <a href="location_add.php" class="btn btn-primary">Add Location</a>
    </div>
    
    <?php if (empty($locations)): ?>
        <p>No locations found. <a href="location_add.php">Create your first location</a>.</p>
    <?php else: ?>
        <div class="item-grid">
            <?php foreach ($locations as $location): ?>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($location['name']); ?></h3>
                        <p class="card-text"><?php echo htmlspecialchars(substr($location['description'], 0, 100)); ?>...</p>
                        
                        <div class="card-actions">
                            <a href="location_detail.php?id=<?php echo $location['id']; ?>" class="btn btn-info">View</a>
                            <a href="location_edit.php?id=<?php echo $location['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="location_delete.php?id=<?php echo $location['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this location?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../../templates/footer.php'; ?>