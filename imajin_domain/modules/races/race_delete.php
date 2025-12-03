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

// Get race to check ownership
$stmt = $pdo->prepare("SELECT * FROM races WHERE id = ? AND user_id = ?");
$stmt->execute([$race_id, $_SESSION['user_id']]);
$race = $stmt->fetch();

if (!$race) {
    header('Location: race_list.php');
    exit;
}

// Delete associated records first
try {
    // Delete character-race relationships (if any)
    // Update characters to remove race reference
    
    // Delete the race
    $stmt = $pdo->prepare("DELETE FROM races WHERE id = ? AND user_id = ?");
    $stmt->execute([$race_id, $_SESSION['user_id']]);
    
    $_SESSION['message'] = 'Race deleted successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Error deleting race: ' . $e->getMessage();
}

header('Location: race_list.php');
exit;
?>