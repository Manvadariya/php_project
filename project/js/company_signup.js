document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector(".login-box form");
    const continueBtn = form.querySelector(".button input");
    const errorText = form.querySelector(".error-txt");

    form.onsubmit = (e) => {
        e.preventDefault(); // Prevent form submission
    };

    continueBtn.addEventListener("click", () => {
        // AJAX
        let xhr = new XMLHttpRequest(); // Create XMLHttpRequest object
        xhr.open("POST", "register_company.php", true); // Initialize request
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    console.log(data);
                    if (data.trim() === "success") {
                        location.href = "company_login.php"; // Redirect to company login page
                    } else {
                        errorText.textContent = data; // Display error message
                        errorText.style.display = "block";
                    }
                } else {
                    alert("Error: " + xhr.statusText); // Display error alert
                }
            }
        };

        // Create FormData object to send form data
        let formData = new FormData(form);
        xhr.send(formData); // Send form data to register_company.php
    });
});
