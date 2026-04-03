<?php
require_once 'config/db.php';
require_once 'includes/header.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$entry_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch entry AND verify ownership
$sql = "SELECT * FROM entries WHERE id = :id AND user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $entry_id, 'user_id' => $user_id]);
$entry = $stmt->fetch(PDO::FETCH_ASSOC);

// If entry doesn't exist or doesn't belong to user
if (!$entry) {
    echo "<div class='container'><h3>Entry not found or access denied.</h3><a href='dashboard.php'>Go Back</a></div>";
    require_once 'includes/footer.php';
    exit();
}
?>

<div class="form-container">
    <h2>✏️ Edit Entry</h2>

    <form action="actions/update_entry.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $entry['id']; ?>">
        
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($entry['title']); ?>" required>
        </div>

        <div class="form-group">
            <label>How are you feeling?</label>
            <input type="hidden" id="moodInput" name="mood" value="<?php echo htmlspecialchars($entry['mood']); ?>">
            <div class="mood-selector">
                <div class="mood-option <?php echo ($entry['mood'] == 'neutral') ? 'selected' : ''; ?>" data-mood="neutral">😐</div>
                <div class="mood-option <?php echo ($entry['mood'] == 'happy') ? 'selected' : ''; ?>" data-mood="happy">😊</div>
                <div class="mood-option <?php echo ($entry['mood'] == 'sad') ? 'selected' : ''; ?>" data-mood="sad">😢</div>
                <div class="mood-option <?php echo ($entry['mood'] == 'stressed') ? 'selected' : ''; ?>" data-mood="stressed">😫</div>
            </div>
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea name="content" required><?php echo htmlspecialchars($entry['content']); ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Update Entry</button>
            <a href="dashboard.php" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>