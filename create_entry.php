<?php
require_once 'includes/header.php';
?>

<div class="form-container">
    <h2>✍️ Write New Entry</h2>

    <!-- Random Prompt Feature -->
    <div class="prompt-box">
        <h4>💡 Feeling stuck?</h4>
        <p id="promptText">What made you smile today?</p>
        <button type="button" id="newPromptBtn" class="btn-secondary">Get New Prompt</button>
    </div>

    <form action="actions/add_entry.php" method="POST">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" required placeholder="Entry Title...">
        </div>

        <div class="form-group">
            <label>How are you feeling?</label>
            <input type="hidden" id="moodInput" name="mood" value="neutral">
            <div class="mood-selector">
                <div class="mood-option selected" data-mood="neutral">😐</div>
                <div class="mood-option" data-mood="happy">😊</div>
                <div class="mood-option" data-mood="sad">😢</div>
                <div class="mood-option" data-mood="stressed">😫</div>
            </div>
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea name="content" required placeholder="Write your thoughts here..."></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Save Entry</button>
            <a href="dashboard.php" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>