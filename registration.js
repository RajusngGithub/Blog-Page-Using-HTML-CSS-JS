document.getElementById('registrationForm').addEventListener('submit', function(event) {
    const password = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        event.preventDefault();
    }
    alert("Registration successful!");
    this.submit();
});