/**
 * Script for handling the signup form validation and submission.
 *
 * It handles client-side
 * validation of the signup form, including username availability, password requirements,
 * and password confirmation matching. It also makes an AJAX request to check if the username
 * already exists in the database.
 */

document.addEventListener("DOMContentLoaded", function() {
    var isUserExists = false; 
    var usernameField = document.getElementById("username");
    var passwordField = document.getElementById("password");
    var confirmPasswordField = document.getElementById("confirm_password");
    var error_1 = document.getElementById("error1");
    var passwordError = document.getElementById("error2");
    var confirmPasswordError = document.getElementById("error3");
    var form = document.querySelector(".signupform");

    /**
     * Adds an event listener to the username field to check for its availability.
     * Sends an AJAX request to check if the username already exists in the database.
     * Updates the UI based on the response.
     */
    
    usernameField.addEventListener("blur", function() {
        var username = this.value;

        if(username.length > 0) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "mysql/checkUser.php");
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText === 'exists') {                       
                        isUserExists = true; 
                        usernameField.classList.add("error_input"); 
                        error_1.textContent = "Username already exists!";
                        error_1.style.opacity = "1";
                    } else {
                        isUserExists = false; 
                        usernameField.classList.remove("error_input"); 
                        error_1.style.opacity = "0";
                    }
                }
            };
            xhr.send('username=' + encodeURIComponent(username));
        }
    });

    usernameField.addEventListener('input', validateUsername);
    passwordField.addEventListener('input', validatePassword);
    confirmPasswordField.addEventListener('input', validatePassword);

    /**
     * Validates the password and confirm password fields.
     * Checks for password length and numerical character inclusion,
     * and matches the password with the confirm password field.
     */

    function validatePassword() {
        passwordError.textContent = '';
        confirmPasswordError.textContent = '';

        if (passwordField.value.length < 8 || !/\d/.test(passwordField.value)) {
            if (passwordField.value.length > 0) {
                passwordError.textContent = 'Password must be at least 8 characters with 1 number.';
                passwordError.style.opacity = "1";
            } else {
                passwordError.style.opacity = "0";
            }
        } else {
            passwordError.style.opacity = "0";
        }

        if (passwordField.value.trim() !== confirmPasswordField.value.trim()) {
            confirmPasswordError.textContent = 'Passwords do not match.';
            confirmPasswordError.style.opacity = "1";
        } else {
            confirmPasswordError.style.opacity = "0";
        }
    }
    /**
     * Validates the username field.
     * Checks if the username meets the minimum length requirement.
     */
    function validateUsername(){
        error_1.textContent = '';

        if(usernameField.value.length < 8){
            error_1.textContent = 'The username must be at least 8 characters long.';
            error_1.style.opacity = "1";
        } else {
            error_1.style.opacity = "0";
        }
    }
     /**
     * Adds an event listener to the form for the submit event.
     * Performs final validation and prevents submission if there are validation errors.
     */
    form.addEventListener('submit', function(event) {
        validateUsername();
        validatePassword();
        if (passwordError.textContent !== '' || confirmPasswordError.textContent !== '' || error_1.textContent !== '' || isUserExists) {
            event.preventDefault();
        }
    });
   
});