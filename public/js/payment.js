
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("paymentForm");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        if (!validateForm()) {
            return;
        }
        let stored = localStorage.getItem("bookingData");
        let data = JSON.parse(stored);

        // Ensure all localStorage data is present
        if (!data || !data.property_id || !data.user_id || !data.start_date || !data.end_date) {
            Swal.fire({
                icon: "error",
                title: "Booking information is missing",
                text: "Please start over.",
            });
            return;
        }





        // console.log(data);
        // Send payment and booking data to Laravel
        fetch("/booking", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(data), // Send localStorage booking data

        })
        .then(response => response.json())
        .then(responseData => {
            if(responseData.success) {
                localStorage.removeItem("bookingData"); // Clear stored booking data

                Swal.fire({
                    icon: "success",
                    title: "Payment Successful!",
                    text: "Your booking has been confirmed.",
                    showConfirmButton: false,
                    timer: 2000,
                });

                   // Redirect after 2 seconds
                   setTimeout(() => {
                    window.location.href = "/properties";
                }, 2000);
            }
        })
        // .then(data => console.log("Success:", data))
        // .catch(error => console.error("Error:", error));
        // event.target.submit();
    });


});



function validateForm() {
    let name = document.getElementById('name').value.trim();
    let expiry = document.getElementById('expiry').value.trim();
    let cvv = document.getElementById('cvv').value.trim();
    let cardNumber = document.getElementById('cardNumber').value.replace(/\s+/g, '');

    if (!name || !cardNumber || !expiry || !cvv) {
        errorMessage.textContent = "All fields are required!";
        errorMessage.style.display = 'block';
        return false;
    }


    if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
        exErr.innerHTML = "Invalid expiry date (MM/YY).";
        return false;
    }

    if (!/^\d{3}$/.test(cvv)) {
        cvvErr.innerHTML = "Invalid CVV.";
        return false;
    }

    if (!/^\d{16}$/.test(cardNumber)) {
        cardErr.innerHTML = "Invalid card number!";
        return false;
    }

    return true;
}
