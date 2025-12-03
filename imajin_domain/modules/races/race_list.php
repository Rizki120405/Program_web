<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';

require_login();

global $pdo;

// Get all races
$stmt = $pdo->prepare("SELECT * FROM races WHERE user_id = ? ORDER BY name ASC");
$stmt->execute([$_SESSION['user_id']]);
$races = $stmt->fetchAll();
?>

<?php require_once '../../templates/header.php'; ?>
<?php require_once '../../templates/sidebar.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Races</h1>
        <a href="race_add.php" class="btn btn-primary">Add Race</a>
    </div>
    
    <?php if (empty($races)): ?>
        <p>No races found. <a href="race_add.php">Create your first race</a>.</p>
    <?php else: ?>
        <div class="item-grid">
            <?php foreach ($races as $race): ?>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($race['name']); ?></h3>
                        <p class="card-text"><?php echo htmlspecialchars(substr($race['description'], 0, 100)); ?>...</p>
                        
                        <div class="card-actions">
                            <a href="race_detail.php?id=<?php echo $race['id']; ?>" class="btn btn-info">View</a>
                            <a href="race_edit.php?id=<?php echo $race['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="race_delete.php?id=<?php echo $race['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this race?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../../templates/footer.php'; ?>