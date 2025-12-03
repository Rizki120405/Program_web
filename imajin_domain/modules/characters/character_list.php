<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';

require_login();

global $pdo;

// Get all characters with their associated race and location
$stmt = $pdo->prepare("
    SELECT c.id, c.name, c.description, c.portrait, c.created_at, 
           r.name as race_name, l.name as location_name
    FROM characters c
    LEFT JOIN races r ON c.race_id = r.id
    LEFT JOIN locations l ON c.location_id = l.id
    WHERE c.user_id = ?
    ORDER BY c.name ASC
");
$stmt->execute([$_SESSION['user_id']]);
$characters = $stmt->fetchAll();
?>

<?php require_once '../../templates/header.php'; ?>
<?php require_once '../../templates/sidebar.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Characters</h1>
        <a href="character_add.php" class="btn btn-primary">Add Character</a>
    </div>
    
    <?php if (empty($characters)): ?>
        <p>No characters found. <a href="character_add.php">Create your first character</a>.</p>
    <?php else: ?>
        <div class="item-grid">
            <?php foreach ($characters as $character): ?>
                <div class="card">
                    <?php if ($character['portrait']): ?>
                        <img src="../../assets/uploads/portraits/<?php echo htmlspecialchars($character['portrait']); ?>" 
                             alt="<?php echo htmlspecialchars($character['name']); ?>" class="card-img-top">
                    <?php endif; ?>
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($character['name']); ?></h3>
                        <p class="card-text"><?php echo htmlspecialchars(substr($character['description'], 0, 100)); ?>...</p>
                        
                        <?php if ($character['race_name']): ?>
                            <p><strong>Race:</strong> <?php echo htmlspecialchars($character['race_name']); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($character['location_name']): ?>
                            <p><strong>Location:</strong> <?php echo htmlspecialchars($character['location_name']); ?></p>
                        <?php endif; ?>
                        
                        <div class="card-actions">
                            <a href="character_detail.php?id=<?php echo $character['id']; ?>" class="btn btn-info">View</a>
                            <a href="character_edit.php?id=<?php echo $character['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="character_delete.php?id=<?php echo $character['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this character?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../../templates/footer.php'; ?>