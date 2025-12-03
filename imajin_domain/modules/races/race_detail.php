<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';

require_login();

global $pdo;

$race_id = $_GET['id'] ?? null;

if (!$race_id) {
    header('Location: race_list.php');
    exit;
}

// Get race details
$stmt = $pdo->prepare("SELECT * FROM races WHERE id = ? AND user_id = ?");
$stmt->execute([$race_id, $_SESSION['user_id']]);
$race = $stmt->fetch();

if (!$race) {
    header('Location: race_list.php');
    exit;
}

// Get associated characters
$characters = [];
$stmt = $pdo->prepare("SELECT id, name FROM characters WHERE race_id = ? AND user_id = ?");
$stmt->execute([$race_id, $_SESSION['user_id']]);
$characters = $stmt->fetchAll();

require_once '../../templates/header.php';
require_once '../../templates/sidebar.php';
?>

<div class="container">
    <div class="detail-header">
        <h1><?php echo htmlspecialchars($race['name']); ?></h1>
        <div class="actions">
            <a href="race_edit.php?id=<?php echo $race['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="race_delete.php?id=<?php echo $race['id']; ?>" 
               class="btn btn-danger" 
               onclick="return confirm('Are you sure you want to delete this race?')">Delete</a>
        </div>
    </div>
    
    <div class="detail-content">
        <div class="detail-info">
            <h2>Details</h2>
            <p><?php echo nl2br(htmlspecialchars($race['description'])); ?></p>
            
            <?php if ($race['traits']): ?>
                <h3>Traits</h3>
                <p><?php echo nl2br(htmlspecialchars($race['traits'])); ?></p>
            <?php endif; ?>
            
            <?php if (!empty($characters)): ?>
                <h3>Characters of this Race</h3>
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