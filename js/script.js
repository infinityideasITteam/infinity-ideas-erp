// JavaScript to handle form submission and basic validation
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    // Get the email and password values
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    // Simple validation check
    if (email === "" || password === "") {
        alert("Please fill out all fields.");
    } else {
        // Simulate a successful login
        alert("Login successful!");
    }
});
