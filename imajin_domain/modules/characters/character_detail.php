<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';

require_login();

global $pdo;

$character_id = $_GET['id'] ?? null;

if (!$character_id) {
    header('Location: character_list.php');
    exit;
}

// Get character details
$stmt = $pdo->prepare("
    SELECT c.*, r.name as race_name, l.name as location_name
    FROM characters c
    LEFT JOIN races r ON c.race_id = r.id
    LEFT JOIN locations l ON c.location_id = l.id
    WHERE c.id = ? AND c.user_id = ?
");
$stmt->execute([$character_id, $_SESSION['user_id']]);
$character = $stmt->fetch();

if (!$character) {
    header('Location: character_list.php');
    exit;
}

// Get associated powers
$powers = [];
$stmt = $pdo->prepare("
    SELECT p.name, p.description
    FROM powers p
    INNER JOIN character_powers cp ON p.id = cp.power_id
    WHERE cp.character_id = ?
");
$stmt->execute([$character_id]);
$powers = $stmt->fetchAll();

require_once '../../templates/header.php';
require_once '../../templates/sidebar.php';
?>

<div class="container">
    <div class="detail-header">
        <h1><?php echo htmlspecialchars($character['name']); ?></h1>
        <div class="actions">
            <a href="character_edit.php?id=<?php echo $character['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="character_delete.php?id=<?php echo $character['id']; ?>" 
               class="btn btn-danger" 
               onclick="return confirm('Are you sure you want to delete this character?')">Delete</a>
        </div>
    </div>
    
    <div class="detail-content">
        <?php if ($character['portrait']): ?>
            <div class="detail-image">
                <img src="../../assets/uploads/portraits/<?php echo htmlspecialchars($character['portrait']); ?>" 
                     alt="<?php echo htmlspecialchars($character['name']); ?>">
            </div>
        <?php endif; ?>
        
        <div class="detail-info">
            <h2>Details</h2>
            <p><?php echo nl2br(htmlspecialchars($character['description'])); ?></p>
            
            <?php if ($character['race_name']): ?>
                <h3>Race</h3>
                <p><?php echo htmlspecialchars($character['race_name']); ?></p>
            <?php endif; ?>
            
            <?php if ($character['location_name']): ?>
                <h3>Location</h3>
                <p><?php echo htmlspecialchars($character['location_name']); ?></p>
            <?php endif; ?>
            
            <?php if (!empty($powers)): ?>
                <h3>Powers</h3>
                <ul>
                    <?php foreach ($powers as $power): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($power['name']); ?></strong>
                            <?php if ($power['description']): ?>
                                <p><?php echo htmlspecialchars($power['description']); ?></p>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../../templates/footer.php'; ?>