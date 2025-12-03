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

// Get character to check ownership and for portrait deletion
$stmt = $pdo->prepare("SELECT * FROM characters WHERE id = ? AND user_id = ?");
$stmt->execute([$character_id, $_SESSION['user_id']]);
$character = $stmt->fetch();

if (!$character) {
    header('Location: character_list.php');
    exit;
}

// Delete associated records first
try {
    // Delete character-power relationships
    $stmt = $pdo->prepare("DELETE FROM character_powers WHERE character_id = ?");
    $stmt->execute([$character_id]);
    
    // Delete character-location relationships (if any)
    // Delete character-race relationships (if any)
    
    // Delete the character
    $stmt = $pdo->prepare("DELETE FROM characters WHERE id = ? AND user_id = ?");
    $stmt->execute([$character_id, $_SESSION['user_id']]);
    
    // Delete portrait file if it exists
    if ($character['portrait'] && file_exists(UPLOAD_PATH . $character['portrait'])) {
        unlink(UPLOAD_PATH . $character['portrait']);
    }
    
    $_SESSION['message'] = 'Character deleted successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Error deleting character: ' . $e->getMessage();
}

header('Location: character_list.php');
exit;
?>