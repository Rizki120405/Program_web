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

// Get power to check ownership
$stmt = $pdo->prepare("SELECT * FROM powers WHERE id = ? AND user_id = ?");
$stmt->execute([$power_id, $_SESSION['user_id']]);
$power = $stmt->fetch();

if (!$power) {
    header('Location: power_list.php');
    exit;
}

// Delete associated records first
try {
    // Delete character-power relationships
    $stmt = $pdo->prepare("DELETE FROM character_powers WHERE power_id = ?");
    $stmt->execute([$power_id]);
    
    // Delete the power
    $stmt = $pdo->prepare("DELETE FROM powers WHERE id = ? AND user_id = ?");
    $stmt->execute([$power_id, $_SESSION['user_id']]);
    
    $_SESSION['message'] = 'Power deleted successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Error deleting power: ' . $e->getMessage();
}

header('Location: power_list.php');
exit;
?>