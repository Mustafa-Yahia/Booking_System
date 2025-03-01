
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let isValid = true;

            let name = document.getElementById("name").value.trim();
            let namePattern = /^[A-Za-z\s]+$/;
            let nameError = document.getElementById("nameError");
            if (!namePattern.test(name) || name.startsWith(" ") || name.endsWith(" ")) {
                nameError.classList.remove("d-none");
                isValid = false;
            } else {
                nameError.classList.add("d-none");
            }

            let email = document.getElementById("email").value.trim();
            let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            let emailError = document.getElementById("emailError");
            if (!emailPattern.test(email)) {
                emailError.classList.remove("d-none");
                isValid = false;
            } else {
                emailError.classList.add("d-none");
            }

            let phone = document.getElementById("phone").value.trim();
            let phonePattern = /^(079|078|077)[0-9]{7}$/;
            let phoneError = document.getElementById("phoneError");
            if (phone !== "" && !phonePattern.test(phone)) {
                phoneError.classList.remove("d-none");
                isValid = false;
            } else {
                phoneError.classList.add("d-none");
            }

            let password = document.getElementById("password").value;
            let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            let passwordError = document.getElementById("passwordError");
            if (!passwordPattern.test(password)) {
                passwordError.classList.remove("d-none");
                isValid = false;
            } else {
                passwordError.classList.add("d-none");
            }

            let confirmPassword = document.getElementById("confirmPassword").value;
            let confirmPasswordError = document.getElementById("confirmPasswordError");
            if (confirmPassword !== password) {
                confirmPasswordError.classList.remove("d-none");
                isValid = false;
            } else {
                confirmPasswordError.classList.add("d-none");
            }

            let address = document.getElementById("address").value.trim();
            let addressPattern = /^[A-Za-z\s]+$/;
            let addressError = document.getElementById("addressError");
            if (address !== "" && !addressPattern.test(address)) {
                addressError.classList.remove("d-none");
                isValid = false;
            } else {
                addressError.classList.add("d-none");
            }

            if (isValid) {
                Swal.fire({
                    title: "Success!",
                    text: "Registration successful!",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    document.getElementById("registerForm").submit();
                });
            }
        });

