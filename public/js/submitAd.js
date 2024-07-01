document.getElementById('adForm').addEventListener('submit', function(event) {
    event.preventDefault();

    fetch('objavi', {
        method: 'POST',
        body: new FormData(this),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.href= "/autoplac%20mvc%20projekat/public/"
        } else {
            if (data.errors) {
                // Display validation errors
                data.errors.forEach(error => {
                    alert(error);
                });
            } else {
                alert(data.message); // Display other error messages
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});