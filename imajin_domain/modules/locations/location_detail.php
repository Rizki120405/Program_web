<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';

require_login();

global $pdo;

$location_id = $_GET['id'] ?? null;

if (!$location_id) {
    header('Location: location_list.php');
    exit;
}

// Get location details
$stmt = $pdo->prepare("SELECT * FROM locations WHERE id = ? AND user_id = ?");
$stmt->execute([$location_id, $_SESSION['user_id']]);
$location = $stmt->fetch();

if (!$location) {
    header('Location: location_list.php');
    exit;
}

// Get associated characters
$characters = [];
$stmt = $pdo->prepare("SELECT id, name FROM characters WHERE location_id = ? AND user_id = ?");
$stmt->execute([$location_id, $_SESSION['user_id']]);
$characters = $stmt->fetchAll();

require_once '../../templates/header.php';
require_once '../../templates/sidebar.php';
?>

<div class="container">
    <div class="detail-header">
        <h1><?php echo htmlspecialchars($location['name']); ?></h1>
        <div class="actions">
            <a href="location_edit.php?id=<?php echo $location['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="location_delete.php?id=<?php echo $location['id']; ?>" 
               class="btn btn-danger" 
               onclick="return confirm('Are you sure you want to delete this location?')">Delete</a>
        </div>
    </div>
    
    <div class="detail-content">
        <div class="detail-info">
            <h2>Details</h2>
            <p><?php echo nl2br(htmlspecialchars($location['description'])); ?></p>
            
            <?php if ($location['climate']): ?>
                <h3>Climate</h3>
                <p><?php echo htmlspecialchars($location['climate']); ?></p>
            <?php endif; ?>
            
            <?php if ($location['population']): ?>
                <h3>Population</h3>
                <p><?php echo htmlspecialchars($location['population']); ?></p>
            <?php endif; ?>
            
            <?php if (!empty($characters)): ?>
                <h3>Characters in this Location</h3>
                <ul>
                    <?php foreach ($characters as $character): ?>
                        <li><a href="../characters/character_detail.php?id=<?php echo $character['id']; ?>">
                            <?php echo htmlspecialchars($character['name']); ?>
                        </a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../../templates/footer.php'; ?>