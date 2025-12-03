<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';

require_login();

global $pdo;

// Get all character relationships
$stmt = $pdo->prepare("
    SELECT r.*, c1.name as character1_name, c2.name as character2_name
    FROM relationships r
    JOIN characters c1 ON r.character1_id = c1.id
    JOIN characters c2 ON r.character2_id = c2.id
    WHERE c1.user_id = ? AND c2.user_id = ?
    ORDER BY r.relation_type ASC
");
$stmt->execute([$_SESSION['user_id'], $_SESSION['user_id']]);
$relationships = $stmt->fetchAll();
?>

<?php require_once '../../templates/header.php'; ?>
<?php require_once '../../templates/sidebar.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Character Relationships</h1>
        <a href="relation_add.php" class="btn btn-primary">Add Relationship</a>
    </div>
    
    <?php if (empty($relationships)): ?>
        <p>No relationships found. <a href="relation_add.php">Create your first relationship</a>.</p>
    <?php else: ?>
        <div class="item-grid">
            <?php foreach ($relationships as $relation): ?>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($relation['character1_name']); ?> & <?php echo htmlspecialchars($relation['character2_name']); ?></h3>
                        <p class="card-text"><strong>Type:</strong> <?php echo htmlspecialchars($relation['relation_type']); ?></p>
                        <p class="card-text"><?php echo htmlspecialchars(substr($relation['description'], 0, 100)); ?>...</p>
                        
                        <div class="card-actions">
                            <a href="relation_edit.php?id=<?php echo $relation['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="relation_delete.php?id=<?php echo $relation['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this relationship?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../../templates/footer.php'; ?>