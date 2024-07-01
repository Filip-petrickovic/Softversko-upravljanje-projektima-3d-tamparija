document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const pass = document.getElementById('pass').value;

    try {
        const response = await fetch('/autoplac%20mvc%20projekat/public/users/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `email=${encodeURIComponent(email)}&pass=${encodeURIComponent(pass)}`
        });

        const data = await response.json();

        document.getElementById('emailError').textContent = '';
        document.getElementById('passError').textContent = '';
        
        if (data.success) {
            window.location.href = '../..';
        } else {
            if (data.errors.email) {
                document.getElementById('emailError').textContent = data.errors.email;
            }
            if (data.errors.pass) {
                document.getElementById('passError').textContent = data.errors.pass;
            }
        }
    } catch (error) {
        console.error('Error:', error);
    }
});