<?php
require_once '../../config/app.php';
require_once '../../core/auth.php';
require_once '../../core/validation.php';

require_login();

global $pdo;
$error = '';
$success = '';

// Get available races and locations for dropdowns
$races = [];
$locations = [];
$powers = [];

try {
    $stmt = $pdo->prepare("SELECT id, name FROM races WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $races = $stmt->fetchAll();
    
    $stmt = $pdo->prepare("SELECT id, name FROM locations WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $locations = $stmt->fetchAll();
    
    $stmt = $pdo->prepare("SELECT id, name FROM powers WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $powers = $stmt->fetchAll();
} catch (Exception $e) {
    $error = "Error loading data: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $race_id = $_POST['race_id'] ?? null;
    $location_id = $_POST['location_id'] ?? null;
    $powers_selected = $_POST['powers'] ?? [];
    
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
            // Handle file upload if exists
            $portrait = null;
            if (isset($_FILES['portrait']) && $_FILES['portrait']['error'] === UPLOAD_ERR_OK) {
                $portrait = upload_file($_FILES['portrait'], UPLOAD_PATH);
                if (!$portrait) {
                    $errors['portrait'] = 'Failed to upload portrait image';
                }
            }
            
            if (empty($errors)) {
                // Insert character
                $stmt = $pdo->prepare("INSERT INTO characters (name, description, portrait, race_id, location_id, user_id) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $description, $portrait, $race_id ?: null, $location_id ?: null, $_SESSION['user_id']]);
                
                $character_id = $pdo->lastInsertId();
                
                // Insert power relationships
                if (!empty($powers_selected)) {
                    foreach ($powers_selected as $power_id) {
                        $stmt = $pdo->prepare("INSERT INTO character_powers (character_id, power_id) VALUES (?, ?)");
                        $stmt->execute([$character_id, $power_id]);
                    }
                }
                
                $success = 'Character created successfully!';
                // Redirect to prevent resubmission
                header('Location: character_list.php');
                exit;
            }
        } catch (Exception $e) {
            $error = 'Error creating character: ' . $e->getMessage();
        }
    }
}

require_once '../../templates/header.php';
require_once '../../templates/sidebar.php';
?>

<div class="container">
    <h1>Add Character</h1>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" required><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="race_id">Race:</label>
            <select id="race_id" name="race_id">
                <option value="">Select a race</option>
                <?php foreach ($races as $race): ?>
                    <option value="<?php echo $race['id']; ?>" <?php echo (isset($race_id) && $race_id == $race['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($race['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="location_id">Location:</label>
            <select id="location_id" name="location_id">
                <option value="">Select a location</option>
                <?php foreach ($locations as $location): ?>
                    <option value="<?php echo $location['id']; ?>" <?php echo (isset($location_id) && $location_id == $location['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($location['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="powers">Powers:</label>
            <?php foreach ($powers as $power): ?>
                <div class="checkbox-item">
                    <input type="checkbox" id="power_<?php echo $power['id']; ?>" name="powers[]" value="<?php echo $power['id']; ?>"
                        <?php echo (isset($powers_selected) && in_array($power['id'], $powers_selected)) ? 'checked' : ''; ?>>
                    <label for="power_<?php echo $power['id']; ?>"><?php echo htmlspecialchars($power['name']); ?></label>
                </div>
            <?php endforeach; ?>
            <?php if (empty($powers)): ?>
                <p>No powers available. <a href="../powers/power_add.php">Create a power first</a>.</p>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="portrait">Portrait:</label>
            <input type="file" id="portrait" name="portrait" accept="image/*">
        </div>
        
        <button type="submit" class="btn btn-primary">Add Character</button>
        <a href="character_list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once '../../templates/footer.php'; ?>