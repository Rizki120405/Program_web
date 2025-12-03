<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';
require_once '../../core/validation.php';

require_login();

global $pdo;
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $traits = $_POST['traits'] ?? '';
    
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
            // Insert race
            $stmt = $pdo->prepare("INSERT INTO races (name, description, traits, user_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $description, $traits, $_SESSION['user_id']]);
            
            $success = 'Race created successfully!';
            // Redirect to prevent resubmission
            header('Location: race_list.php');
            exit;
        } catch (Exception $e) {
            $error = 'Error creating race: ' . $e->getMessage();
        }
    }
}

require_once '../../templates/header.php';
require_once '../../templates/sidebar.php';
?>

<div class="container">
    <h1>Add Race</h1>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" required><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="traits">Traits:</label>
            <textarea id="traits" name="traits" rows="3"><?php echo isset($traits) ? htmlspecialchars($traits) : ''; ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Add Race</button>
        <a href="race_list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once '../../templates/footer.php'; ?>