// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function() {

    // Select the registration form and add a submit event listener
    const registerForm = document.querySelector('#register-form');
    registerForm.addEventListener('submit', async function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        // Reset previous errors
        resetErrors();

        // Gather form data
        const username = document.querySelector('#username').value.trim();
        const email = document.querySelector('#email').value.trim();
        const pass = document.querySelector('#pass').value.trim();
        const provera = document.querySelector('#provera').value.trim();

        // Client-side validation
        let valid = true;
        
        if (!username) {
            showErrorMessage('username', 'Niste uneli korisničko ime');
            valid = false;
        }
        
        if (!email) {
            showErrorMessage('email', 'Niste uneli email adresu');
            valid = false;
        } else if (!validateEmail(email)) {
            showErrorMessage('email', 'Pogrešno uneta email adresa');
            valid = false;
        }

        if (!pass) {
            showErrorMessage('pass', 'Niste uneli lozinku');
            valid = false;
        } else if (pass.length < 6) {
            showErrorMessage('pass', 'Šifra mora imati više od 6 karaktera');
            valid = false;
        }

        if (!provera) {
            showErrorMessage('provera', 'Niste uneli ponovljenu lozinku');
            valid = false;
        } else if (provera !== pass) {
            showErrorMessage('provera', 'Lozinke se ne podudaraju');
            valid = false;
        }

        if (!valid) {
            return; // Exit if there are validation errors
        }

        // Prepare data to send to the server
        const formData = new FormData(registerForm);
        try {
            // Send POST request to server
            const response = await fetch('/public/users/register', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error('Network response was not ok.');
            }

            // Parse JSON response
            const responseData = await response.json();

            // Handle response from server
            if (responseData.success) {
                // Redirect to login page or do something else
                window.location.href = '../..';
            } else {
                // Display errors returned from server
                Object.keys(responseData.errors).forEach(key => {
                    showErrorMessage(key, responseData.errors[key]);
                });
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });

    // Function to reset previous errors
    function resetErrors() {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(message => message.textContent = '');
    }

    // Function to display error messages
    function showErrorMessage(field, message) {
        const errorElement = document.querySelector(`#${field}-error`);
        if (errorElement) {
            errorElement.textContent = message;
        }
    }

    // Function to validate email format
    function validateEmail(email) {
        const re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
});
