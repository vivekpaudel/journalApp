document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    // Login Validation
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            if (email === '' || password === '') {
                e.preventDefault();
                alert('Please fill in all fields.');
            }
        });
    }

    // Register Validation
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirm_password = document.getElementById('confirm_password').value;

            if (username === '' || email === '' || password === '') {
                e.preventDefault();
                alert('Please fill in all fields.');
                return;
            }

            if (password !== confirm_password) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });
    }
});


// Search Functionality
const searchInput = document.getElementById('searchInput');
const journalCards = document.querySelectorAll('.journal-card');

if (searchInput) {
    searchInput.addEventListener('keyup', function(e) {
        const term = e.target.value.toLowerCase();

        journalCards.forEach(function(card) {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const content = card.querySelector('.card-content').textContent.toLowerCase();

            if (title.indexOf(term) != -1 || content.indexOf(term) != -1) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
}



// Random Prompt Generator
const promptText = document.getElementById('promptText');
const newPromptBtn = document.getElementById('newPromptBtn');

const prompts = [
    "What made you smile today?",
    "What was the biggest challenge you faced?",
    "What is one thing you learned new?",
    "Describe your perfect day.",
    "What are you grateful for right now?",
    "What is a goal you want to achieve this month?",
    "Who inspired you recently?",
    "What is something you want to improve?"
];

if (newPromptBtn && promptText) {
    newPromptBtn.addEventListener('click', function() {
        const randomIndex = Math.floor(Math.random() * prompts.length);
        promptText.textContent = prompts[randomIndex];
        // Add a small animation effect
        promptText.style.opacity = 0;
        setTimeout(() => {
            promptText.style.opacity = 1;
        }, 200);
    });
}

// Mood Selector Logic
const moodOptions = document.querySelectorAll('.mood-option');
const moodInput = document.getElementById('moodInput');

if (moodOptions.length > 0) {
    moodOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all
            moodOptions.forEach(opt => opt.classList.remove('selected'));
            // Add to clicked
            this.classList.add('selected');
            // Update hidden input
            moodInput.value = this.getAttribute('data-mood');
        });
    });
}