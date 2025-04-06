document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("paymentForm");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // منع الإرسال الافتراضي للنموذج

        if (!validateForm()) {
            return;
        }

        let stored = localStorage.getItem("bookingData");
        let data = JSON.parse(stored);

        // ✅ التحقق من وجود البيانات في localStorage
        if (!data || !data.property_id || !data.user_id || !data.start_date || !data.end_date) {
            Swal.fire({
                icon: "error",
                title: "Booking information is missing",
                text: "Please start over.",
            });
            return;
        }

        // ✅ إرسال بيانات الحجز والدفع إلى Laravel
        fetch("/booking", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(responseData => {
            if (responseData.success) {
                localStorage.removeItem("bookingData"); // حذف بيانات الحجز من التخزين المحلي

                // ✅ إرسال إشعار بعد نجاح الدفع
                sendNotification(data.user_id, "Your booking has been confirmed!");

                Swal.fire({
                    icon: "success",
                    title: "Payment Successful!",
                    text: "Your booking has been confirmed.",
                    showConfirmButton: false,
                    timer: 2000,
                });

                // ✅ إعادة التوجيه بعد 2 ثانية
                setTimeout(() => {
                    window.location.href = "/properties";
                }, 2000);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire({
                icon: "error",
                title: "Server Error",
                text: "Could not connect to the server. Please try again later.",
            });
        });
    });
});

function sendNotification(userId, title, message) {
    fetch("/send-notification", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            user_id: userId,
            title: title,
            message: message
        }),
    })
    .then(response => response.json())
    .then(data => console.log("Notification sent:", data))
    .catch(error => console.error("Notification Error:", error));
}


// ✅ دالة التحقق من صحة البيانات
function validateForm() {
    let name = document.getElementById('name').value.trim();
    let expiry = document.getElementById('expiry').value.trim();
    let cvv = document.getElementById('cvv').value.trim();
    let cardNumber = document.getElementById('cardNumber').value.replace(/\s+/g, '');

    if (!name || !cardNumber || !expiry || !cvv) {
        Swal.fire({ icon: "error", title: "Validation Error", text: "All fields are required!" });
        return false;
    }

    if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
        Swal.fire({ icon: "error", title: "Validation Error", text: "Invalid expiry date (MM/YY)." });
        return false;
    }

    if (!/^\d{3}$/.test(cvv)) {
        Swal.fire({ icon: "error", title: "Validation Error", text: "Invalid CVV." });
        return false;
    }

    if (!/^\d{16}$/.test(cardNumber)) {
        Swal.fire({ icon: "error", title: "Validation Error", text: "Invalid card number!" });
        return false;
    }

    return true;
}
