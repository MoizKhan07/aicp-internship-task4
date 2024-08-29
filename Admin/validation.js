function validateForm(event) {
    // Prevent the form from submitting
    event.preventDefault();
    
    // Get the values of username and password fields
    var username = document.getElementById('admin-username').value;
    var password = document.getElementById('admin-password').value;

    // Validate the username and password
    if (username === 'admin' && password === 'admin') {
        alert('Login successful!');
        // Optionally, you can proceed with the form submission here
        // document.querySelector('form').submit();
    } else {
        alert('Invalid username or password. Please try again.');
    }
}