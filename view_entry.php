<?php
// view_entry.php
require_once 'config/db.php';
require_once 'includes/header.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$entry_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch entry AND verify ownership (Security!)
$sql = "SELECT * FROM entries WHERE id = :id AND user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $entry_id, 'user_id' => $user_id]);
$entry = $stmt->fetch(PDO::FETCH_ASSOC);

// If entry doesn't exist or doesn't belong to user
if (!$entry) {
    echo "<div class='container'><h3>Entry not found or access denied.</h3><a href='dashboard.php' class='btn-primary'>Go Back</a></div>";
    require_once 'includes/footer.php';
    exit();
}
?>

<div class="form-container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
        <a href="dashboard.php" style="color:#5c6bc0; text-decoration:none;">← Back to Dashboard</a>
        <span class="card-date"><?php echo date('F d, Y - h:i A', strtotime($entry['created_at'])); ?></span>
    </div>

    <h2 style="margin-bottom:1rem;"><?php echo htmlspecialchars($entry['title']); ?></h2>
    
    <div style="margin-bottom:1.5rem; font-size:1.5rem;">
        <?php 
        $mood = $entry['mood'];
        if ($mood == 'happy') echo '😊 Happy';
        elseif ($mood == 'sad') echo '😢 Sad';
        elseif ($mood == 'stressed') echo '😫 Stressed';
        else echo '😐 Neutral';
        ?>
    </div>

    <div style="background:#f9f9f9; padding:1.5rem; border-radius:8px; line-height:1.8; color:#333; white-space: pre-wrap;">
        <?php echo htmlspecialchars($entry['content']); ?>
    </div>

    <div class="form-actions" style="margin-top:2rem;">
        <a href="edit_entry.php?id=<?php echo $entry['id']; ?>" class="btn btn-edit" style="text-align:center;">✏️ Edit Entry</a>
        <a href="actions/delete_entry.php?id=<?php echo $entry['id']; ?>" class="btn btn-delete" style="text-align:center;" onclick="return confirm('Are you sure you want to delete this memory permanently?');">🗑️ Delete Entry</a>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>