<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';

require_login();

global $pdo;

$relation_id = $_GET['id'] ?? null;

if (!$relation_id) {
    header('Location: relation_list.php');
    exit;
}

// Get relationship to check ownership
$stmt = $pdo->prepare("
    SELECT r.*, c1.name as character1_name, c2.name as character2_name
    FROM relationships r
    JOIN characters c1 ON r.character1_id = c1.id
    JOIN characters c2 ON r.character2_id = c2.id
    WHERE r.id = ? AND c1.user_id = ? AND c2.user_id = ?
");
$stmt->execute([$relation_id, $_SESSION['user_id'], $_SESSION['user_id']]);
$relation = $stmt->fetch();

if (!$relation) {
    header('Location: relation_list.php');
    exit;
}

// Delete the relationship
try {
    $stmt = $pdo->prepare("DELETE FROM relationships WHERE id = ?");
    $stmt->execute([$relation_id]);
    
    $_SESSION['message'] = 'Relationship deleted successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Error deleting relationship: ' . $e->getMessage();
}

header('Location: relation_list.php');
exit;
?>