const form = document.querySelector(".login-box form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
    e.preventDefault();
};
continueBtn.addEventListener("click", () => {
    // Ajax
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST", "", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if(data == "success") {
                    location.href = "login.php";
                }
                else {
                    errorText.textContent    = data;
                    errorText.style.display = "block";
                }
            } else {
                alert("Error: " + xhr.statusText);
            }
        }
    }
    // we have to send the form data through ajax to php
    let formData = new FormData(form); // creating new formData object
    xhr.send(formData); // sending the form data to php
});