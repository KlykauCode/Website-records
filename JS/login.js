/**
 * Script for handling the login form validation and submission.
 * 
 * The script waits for the DOM to be fully loaded before querying for elements
 * and attaching event listeners. It performs client-side validation of the login
 * form, makes an AJAX request to validate credentials, and handles the response.
 */
document.addEventListener("DOMContentLoaded", function() {
    var loginForm = document.querySelector(".loginform");
    var usernameField = document.getElementById("username");
    var passwordField = document.getElementById("password");
    var userError = document.getElementById("user-error");
    var passError = document.getElementById("pass-error");
    var isFormValid = false;
    /**
     * Adds an event listener to the login form for the submit event.
     * 
     * Prevents form submission if the credentials are invalid. Makes an AJAX
     * request to a server-side script to check the validity of the credentials.
     * Updates the UI based on the response from the server.
     */

    loginForm.addEventListener('submit', function(event) {
        // Preventing default form submission to handle via AJAX.
        if (!isFormValid) {
            event.preventDefault();
            // Trimming input values and resetting error messages.
            var username = usernameField.value.trim();
            var password = passwordField.value.trim();
            
            userError.textContent = '';
            passError.textContent = '';
            userError.style.opacity = 0;
            passError.style.opacity = 0;
            /**
             * Creating and configuring an XMLHttpRequest to send the credentials
             * to the server for validation.
             */
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "mysql/loginCheck.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            /**
             * Handling the response from the server.
             * 
             * Displays appropriate error messages for invalid credentials and
             * triggers form submission for valid credentials.
             */
            xhr.onreadystatechange = function() {
                // Handling the response only if the request is complete.
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;
                    if(response === 'invalid user') {
                        userError.textContent = "User does not exist";
                        userError.style.opacity = 1;
                    } else if (response === 'invalid password') {
                        passError.textContent = "Incorrect password";
                        passError.style.opacity = 1;
                    } else if (response === 'valid') {
                        isFormValid = true;
                        loginForm.querySelector('[type="submit"]').click();
                    }
                }
            };
            // Sending the request with the username and password.
            xhr.send('username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password));
        } else {
            // Resetting form validity for subsequent submissions.
            isFormValid = false; 
        }
    });
});