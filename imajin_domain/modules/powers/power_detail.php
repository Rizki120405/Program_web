<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';

require_login();

global $pdo;

$power_id = $_GET['id'] ?? null;

if (!$power_id) {
    header('Location: power_list.php');
    exit;
}

// Get power details
$stmt = $pdo->prepare("SELECT * FROM powers WHERE id = ? AND user_id = ?");
$stmt->execute([$power_id, $_SESSION['user_id']]);
$power = $stmt->fetch();

if (!$power) {
    header('Location: power_list.php');
    exit;
}

// Get associated characters
$characters = [];
$stmt = $pdo->prepare("
    SELECT c.id, c.name 
    FROM characters c
    INNER JOIN character_powers cp ON c.id = cp.character_id
    WHERE cp.power_id = ? AND c.user_id = ?
");
$stmt->execute([$power_id, $_SESSION['user_id']]);
$characters = $stmt->fetchAll();

require_once '../../templates/header.php';
require_once '../../templates/sidebar.php';
?>

<div class="container">
    <div class="detail-header">
        <h1><?php echo htmlspecialchars($power['name']); ?></h1>
        <div class="actions">
            <a href="power_edit.php?id=<?php echo $power['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="power_delete.php?id=<?php echo $power['id']; ?>" 
               class="btn btn-danger" 
               onclick="return confirm('Are you sure you want to delete this power?')">Delete</a>
        </div>
    </div>
    
    <div class="detail-content">
        <div class="detail-info">
            <h2>Details</h2>
            <p><?php echo nl2br(htmlspecialchars($power['description'])); ?></p>
            
            <?php if ($power['type']): ?>
                <h3>Type</h3>
                <p><?php echo htmlspecialchars($power['type']); ?></p>
            <?php endif; ?>
            
            <?php if ($power['level']): ?>
                <h3>Level</h3>
                <p><?php echo htmlspecialchars($power['level']); ?></p>
            <?php endif; ?>
            
            <?php if (!empty($characters)): ?>
                <h3>Characters with this Power</h3>
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