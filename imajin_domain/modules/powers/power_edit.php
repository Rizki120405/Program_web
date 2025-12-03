<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';
require_once '../../core/validation.php';

require_login();

global $pdo;
$error = '';
$success = '';

// Get power ID from URL
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $type = $_POST['type'] ?? '';
    $level = $_POST['level'] ?? '';
    
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
            // Update power
            $stmt = $pdo->prepare("UPDATE powers SET name = ?, description = ?, type = ?, level = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$name, $description, $type, $level, $power_id, $_SESSION['user_id']]);
            
            $success = 'Power updated successfully!';
            // Refresh power data
            $stmt = $pdo->prepare("SELECT * FROM powers WHERE id = ? AND user_id = ?");
            $stmt->execute([$power_id, $_SESSION['user_id']]);
            $power = $stmt->fetch();
        } catch (Exception $e) {
            $error = 'Error updating power: ' . $e->getMessage();
        }
    }
}

require_once '../../templates/header.php';
require_once '../../templates/sidebar.php';
?>

<div class="container">
    <h1>Edit Power</h1>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($power['name']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($power['description']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($power['type']); ?>">
        </div>
        
        <div class="form-group">
            <label for="level">Level:</label>
            <input type="text" id="level" name="level" value="<?php echo htmlspecialchars($power['level']); ?>">
        </div>
        
        <button type="submit" class="btn btn-primary">Update Power</button>
        <a href="power_list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once '../../templates/footer.php'; ?>