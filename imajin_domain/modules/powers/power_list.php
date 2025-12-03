<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';

require_login();

global $pdo;

// Get all powers
$stmt = $pdo->prepare("SELECT * FROM powers WHERE user_id = ? ORDER BY name ASC");
$stmt->execute([$_SESSION['user_id']]);
$powers = $stmt->fetchAll();
?>

<?php require_once '../../templates/header.php'; ?>
<?php require_once '../../templates/sidebar.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Powers</h1>
        <a href="power_add.php" class="btn btn-primary">Add Power</a>
    </div>
    
    <?php if (empty($powers)): ?>
        <p>No powers found. <a href="power_add.php">Create your first power</a>.</p>
    <?php else: ?>
        <div class="item-grid">
            <?php foreach ($powers as $power): ?>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($power['name']); ?></h3>
                        <p class="card-text"><?php echo htmlspecialchars(substr($power['description'], 0, 100)); ?>...</p>
                        
                        <div class="card-actions">
                            <a href="power_detail.php?id=<?php echo $power['id']; ?>" class="btn btn-info">View</a>
                            <a href="power_edit.php?id=<?php echo $power['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="power_delete.php?id=<?php echo $power['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this power?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../../templates/footer.php'; ?>