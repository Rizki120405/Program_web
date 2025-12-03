<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';
require_once '../../core/validation.php';

require_login();

global $pdo;
$error = '';
$success = '';

// Get location ID from URL
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $climate = $_POST['climate'] ?? '';
    $population = $_POST['population'] ?? '';
    
    // Validate required fields
    $rules = [
        'name' => 'required|max:100',
        'description' => 'required|max:1000'
    ];
    
    $data = [
        'name' => $name,
        'description' => $description
    ];
    
    $errors = validate_data($data, $rules);
    
    if (empty($errors)) {
        try {
            // Update location
            $stmt = $pdo->prepare("UPDATE locations SET name = ?, description = ?, climate = ?, population = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$name, $description, $climate, $population, $location_id, $_SESSION['user_id']]);
            
            $success = 'Location updated successfully!';
            // Refresh location data
            $stmt = $pdo->prepare("SELECT * FROM locations WHERE id = ? AND user_id = ?");
            $stmt->execute([$location_id, $_SESSION['user_id']]);
            $location = $stmt->fetch();
        } catch (Exception $e) {
            $error = 'Error updating location: ' . $e->getMessage();
        }
    }
}

require_once '../../templates/header.php';
require_once '../../templates/sidebar.php';
?>

<div class="container">
    <h1>Edit Location</h1>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($location['name']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($location['description']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="climate">Climate:</label>
            <input type="text" id="climate" name="climate" value="<?php echo htmlspecialchars($location['climate']); ?>">
        </div>
        
        <div class="form-group">
            <label for="population">Population:</label>
            <input type="text" id="population" name="population" value="<?php echo htmlspecialchars($location['population']); ?>">
        </div>
        
        <button type="submit" class="btn btn-primary">Update Location</button>
        <a href="location_list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once '../../templates/footer.php'; ?>