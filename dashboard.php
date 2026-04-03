<?php
// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// Now continue with normal code
require_once 'config/db.php';
require_once 'includes/header.php';


// Fetch entries for the logged-in user
$sql = "SELECT * FROM entries WHERE user_id = :user_id ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Display Success/Error Messages -->
<?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] == 'created'): ?>
        <div class="alert alert-success">Entry created successfully!</div>
    <?php elseif ($_GET['msg'] == 'updated'): ?>
        <div class="alert alert-success">Entry updated successfully!</div>
    <?php elseif ($_GET['msg'] == 'deleted'): ?>
        <div class="alert alert-success">Entry deleted successfully!</div>
    <?php elseif ($_GET['msg'] == 'error'): ?>
        <div class="alert alert-error">Something went wrong. Please try again.</div>
    <?php endif; ?>
<?php endif; ?>

<div class="dashboard-header">
    <h2>My Entries</h2>
    <input type="text" id="searchInput" class="search-box" placeholder="Search entries...">
</div>

<?php if (count($entries) > 0): ?>
    <div class="journal-grid">
        <?php foreach ($entries as $entry): ?>
            <div class="journal-card">
                <div class="card-header">
                    <span class="card-date"><?php echo date('M d, Y', strtotime($entry['created_at'])); ?></span>
                    <span class="card-mood">
                        <?php 
                        $mood = $entry['mood'];
                        if ($mood == 'happy') echo '😊';
                        elseif ($mood == 'sad') echo '😢';
                        elseif ($mood == 'stressed') echo '😫';
                        else echo '😐';
                        ?>
                    </span>
                </div>
                <h3 class="card-title"><?php echo htmlspecialchars($entry['title']); ?></h3>
                <p class="card-content"><?php echo htmlspecialchars($entry['content']); ?></p>
                
                <div class="card-actions">
                    <a href="edit_entry.php?id=<?php echo $entry['id']; ?>" class="btn-edit">Edit</a>
                    <!-- JS Confirmation added inline -->
                    <a href="actions/delete_entry.php?id=<?php echo $entry['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this memory permanently?');">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="empty-state">
        <h3>No entries yet!</h3>
        <p>Start writing your first journal entry today.</p>
        <br>
        <a href="create_entry.php" class="btn-primary">Write New Entry</a>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>