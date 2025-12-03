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

// Get location to check ownership
$stmt = $pdo->prepare("SELECT * FROM locations WHERE id = ? AND user_id = ?");
$stmt->execute([$location_id, $_SESSION['user_id']]);
$location = $stmt->fetch();

if (!$location) {
    header('Location: location_list.php');
    exit;
}

// Delete associated records first
try {
    // Delete character-location relationships (if any)
    // Delete location-character relationships (if any)
    
    // Delete the location
    $stmt = $pdo->prepare("DELETE FROM locations WHERE id = ? AND user_id = ?");
    $stmt->execute([$location_id, $_SESSION['user_id']]);
    
    $_SESSION['message'] = 'Location deleted successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Error deleting location: ' . $e->getMessage();
}

header('Location: location_list.php');
exit;
?>