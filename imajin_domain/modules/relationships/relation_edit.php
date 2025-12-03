<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';
require_once '../../core/validation.php';

require_login();

global $pdo;
$error = '';
$success = '';

// Get relationship ID from URL
$relation_id = $_GET['id'] ?? null;

if (!$relation_id) {
    header('Location: relation_list.php');
    exit;
}

// Get relationship details
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

// Get available characters for dropdowns
$characters = [];

try {
    $stmt = $pdo->prepare("SELECT id, name FROM characters WHERE user_id = ? ORDER BY name ASC");
    $stmt->execute([$_SESSION['user_id']]);
    $characters = $stmt->fetchAll();
} catch (Exception $e) {
    $error = "Error loading characters: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $character1_id = $_POST['character1_id'] ?? '';
    $character2_id = $_POST['character2_id'] ?? '';
    $relation_type = $_POST['relation_type'] ?? '';
    $description = $_POST['description'] ?? '';
    
    // Validate required fields
    $rules = [
        'character1_id' => 'required',
        'character2_id' => 'required',
        'relation_type' => 'required|max:100',
        'description' => 'required|max:1000'
    ];
    
    $data = [
        'character1_id' => $character1_id,
        'character2_id' => $character2_id,
        'relation_type' => $relation_type,
        'description' => $description
    ];
    
    $errors = validate_data($data, $rules);
    
    // Check if relationship already exists (excluding current relationship)
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM relationships WHERE ((character1_id = ? AND character2_id = ?) OR (character1_id = ? AND character2_id = ?)) AND id != ?");
        $stmt->execute([$character1_id, $character2_id, $character2_id, $character1_id, $relation_id]);
        
        if ($stmt->rowCount() > 0) {
            $errors['duplicate'] = 'This relationship already exists';
        }
    }
    
    if (empty($errors) && $character1_id == $character2_id) {
        $errors['same_character'] = 'Cannot create relationship between a character and itself';
    }
    
    if (empty($errors)) {
        try {
            // Update relationship
            $stmt = $pdo->prepare("UPDATE relationships SET character1_id = ?, character2_id = ?, relation_type = ?, description = ? WHERE id = ?");
            $stmt->execute([$character1_id, $character2_id, $relation_type, $description, $relation_id]);
            
            $success = 'Relationship updated successfully!';
            // Refresh relationship data
            $stmt = $pdo->prepare("
                SELECT r.*, c1.name as character1_name, c2.name as character2_name
                FROM relationships r
                JOIN characters c1 ON r.character1_id = c1.id
                JOIN characters c2 ON r.character2_id = c2.id
                WHERE r.id = ? AND c1.user_id = ? AND c2.user_id = ?
            ");
            $stmt->execute([$relation_id, $_SESSION['user_id'], $_SESSION['user_id']]);
            $relation = $stmt->fetch();
        } catch (Exception $e) {
            $error = 'Error updating relationship: ' . $e->getMessage();
        }
    }
}

require_once '../../templates/header.php';
require_once '../../templates/sidebar.php';
?>

<div class="container">
    <h1>Edit Relationship</h1>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="character1_id">Character 1:</label>
            <select id="character1_id" name="character1_id" required>
                <option value="">Select a character</option>
                <?php foreach ($characters as $character): ?>
                    <option value="<?php echo $character['id']; ?>" 
                        <?php echo ($relation['character1_id'] == $character['id'] || (isset($character1_id) && $character1_id == $character['id'])) ? 'selected' : ''; ?>
                        <?php echo ($relation['character2_id'] == $character['id'] || (isset($character2_id) && $character2_id == $character['id'])) ? 'disabled' : ''; ?>>
                        <?php echo htmlspecialchars($character['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="character2_id">Character 2:</label>
            <select id="character2_id" name="character2_id" required>
                <option value="">Select a character</option>
                <?php foreach ($characters as $character): ?>
                    <option value="<?php echo $character['id']; ?>" 
                        <?php echo ($relation['character2_id'] == $character['id'] || (isset($character2_id) && $character2_id == $character['id'])) ? 'selected' : ''; ?>
                        <?php echo ($relation['character1_id'] == $character['id'] || (isset($character1_id) && $character1_id == $character['id'])) ? 'disabled' : ''; ?>>
                        <?php echo htmlspecialchars($character['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="relation_type">Relationship Type:</label>
            <input type="text" id="relation_type" name="relation_type" value="<?php echo isset($relation['relation_type']) ? htmlspecialchars($relation['relation_type']) : (isset($relation_type) ? htmlspecialchars($relation_type) : ''); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" required><?php echo isset($relation['description']) ? htmlspecialchars($relation['description']) : (isset($description) ? htmlspecialchars($description) : ''); ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Relationship</button>
        <a href="relation_list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once '../../templates/footer.php'; ?>