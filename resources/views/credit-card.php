<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Payment</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            position: absolute;
        }

        .error {
            color: red;
            font-size: 14px;
            display: none;
            margin-top: 10px;
        }

        .success {
            color: green;
            font-size: 16px;
            display: none;
            margin-top: 10px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"], input[type="password"], input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
        }

        .form-group div {
            width: 48%;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        .alert {
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
        }
        .card-logos { display: flex; justify-content: flex-end; margin-bottom: 10px; }
        .card-logos img { height: 20px; margin-left: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center">Confirm Your Purchase</h2>
        <div class="card-logos">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" alt="Mastercard">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa">
        </div>
        <p id="errorMessage" class="error"></p>
        <p id="successMessage" class="success"></p>
        
        <form id="paymentForm"  {{rout}} method="POST" >
        @csrf
        <label for="name">Name on Card</label>
            <input type="text" name="name" id="name" placeholder="John Doe" required>

            <div class="form-group">
                <div>
                    <label for="expiry">Expiry</label>
                    <input type="text" name="expiry" id="expiry" placeholder="MM/YY" required>
                </div>
                <div>
                    <label for="cvv">CVV</label>
                    <input type="password" name="cvv" id="cvv" maxlength="3" placeholder="123" required>
                </div>
            </div>

            <label for="cardNumber">Card Number</label>
            <input type="tel" name="cardNumber" id="cardNumber" maxlength="16" placeholder="1111 2222 3333 4444" required>

            <button type="submit">Complete Payment</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#paymentForm").submit(function (event) {
                event.preventDefault(); 

                let name = $("#name").val().trim();
                let cardNumber = $("#cardNumber").val().replace(/\s+/g, '');
                let expiry = $("#expiry").val().trim();
                let cvv = $("#cvv").val().trim();
                let errorMessage = $("#errorMessage");
                let successMessage = $("#successMessage");

                if (!name || !cardNumber || !expiry || !cvv) {
                    errorMessage.text("All fields are required!").fadeIn();
                    return;
                }

                if (!/^\d{16}$/.test(cardNumber)) {
                    errorMessage.text("Invalid card number!").fadeIn();
                    return;
                }

                if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
                    errorMessage.text("Invalid expiry date (MM/YY).").fadeIn();
                    return;
                }

                if (!/^\d{3}$/.test(cvv)) {
                    errorMessage.text("Invalid CVV.").fadeIn();
                    return;
                }

                errorMessage.hide(); 

                $.ajax({
                    url: "/process-payment", 
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content") 
                    },
                    data: {
                        name: name,
                        cardNumber: cardNumber,
                        expiry: expiry,
                        cvv: cvv
                    },
                    dataType: "json", 
                    success: function (response) {
                        if (response.success) {
                            successMessage.text("Payment successful! Redirecting...").fadeIn();
                            setTimeout(function () {
                                window.location.href = "/checkout"; 
                            }, 2000);
                        } else {
                            errorMessage.text(response.message).fadeIn();
                        }
                    },
                    error: function (xhr) {
                        let errorMsg = "An error occurred. Please try again.";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        errorMessage.text(errorMsg).fadeIn();
                    }
                });
            });
        });
    </script>
</body>
</html>
