let form = document.querySelector("#signupForm");

    // Add event listeners to input fields
    form
    .querySelector("#validateNameInput")
    .addEventListener("change", function() {
    validateName(this);
});

    form
    .querySelector("#validateEmailInput")
    .addEventListener("change", function() {
    validateEmail(this);
});

    form
    .querySelector("#validatePasswordInput")
    .addEventListener("change", function() {
    validatePassword(this);
});

    // Reusable function for input validation
    const validateInput = function(inputElement, regex, errorMessage) {
    let small = inputElement.nextElementSibling;
    if (regex.test(inputElement.value)) {
    small.innerHTML = "<b>Valid</b>";
    small.classList.remove("text-red-400");
    small.classList.add("text-green-400");
} else {
    small.innerHTML = errorMessage;
    small.classList.remove("text-green-400");
    small.classList.add("text-red-400");
}
};

    // Validation functions for each input
    // Validation function for name
    const validateName = function(inputElement) {
    validateInput(
        inputElement,
        /^[A-Za-z]+\s[A-Za-z]+$/,
        "<b>Name is not valid</b>"
    );
};

    // Validation function for email
    const validateEmail = function(inputElement) {
    validateInput(
        inputElement,
        /^[a-zA-Z0-9.-]+[@]{1}[a-zA-Z0-9.-]+[.]{1}[a-z]{2,10}$/,
        "<b>Email is not valid</b>"
    );
};

    // Validation function for password
    const validatePassword = function(inputElement) {
    validateInput(
        inputElement,
        /^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{8,}$/,
        "<b>Password must be at least 8 characters and include at least one letter and one number.</b>"
    );
};