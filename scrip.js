document.getElementById('feedbackForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let form = event.target;

    // Validate form inputs
    if (!validateForm(form)) {
        return;
    }

    let formData = new FormData(form);

    fetch('submit feedback.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        let responseDiv = document.getElementById('response');
        if (data.status === 'success') {
            form.reset();
            responseDiv.innerHTML = `<p style="color: green;">${data.message} You can submit again.</p>`;
        } else {
            responseDiv.innerHTML = `<p style="color: red;">${data.message}</p>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('response').innerHTML = `<p style="color: red;">An error occurred. Please try again.</p>`;
    });
});

function validateForm(form) {
    let name = form['name'].value.trim();
    let email = form['email'].value.trim();
    let feedback = form['feedback'].value.trim();
    let rating = form['rating'].value;

    let responseDiv = document.getElementById('response');
    responseDiv.innerHTML = "";  // Clear any previous messages

    if (name === "" || email === "" || feedback === "" || rating === "") {
        responseDiv.innerHTML = `<p style="color: red;">All fields are required.</p>`;
        return false;
    }

    if (!validateEmail(email)) {
        responseDiv.innerHTML = `<p style="color: red;">Please enter a valid email address.</p>`;
        return false;
    }

    if (isNaN(rating) || rating < 1 || rating > 5) {
        responseDiv.innerHTML = `<p style="color: red;">Please select a valid rating.</p>`;
        return false;
    }

    return true;
}

function validateEmail(email) {
    // Basic email validation pattern
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
}
