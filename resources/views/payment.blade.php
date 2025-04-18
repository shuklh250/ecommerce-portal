<!DOCTYPE html>
<html>

<head>
    <title>Laravel Razorpay Payment</title>
</head>

<body style="text-align:center; padding:100px;">
    <h2>Pay ₹{{ $showAmount }} Using Razorpay</h2>

    <form action="{{ route('payment.verify') }}" method="POST">
        @csrf
        <button id="rzp-button" type="button">Pay Now</button>
    </form>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ $razorpayKey }}",
            "amount": "{{ $amount }}",
            "currency": "INR",
            "name": "Demo Shop",
            "description": "Testing payment",
            "order_id": "{{ $orderId ?? '' }}",
            "handler": function (response) {
                // Form auto-submit after payment success
                var form = document.forms[0];
                var input_payment = document.createElement("input");
                input_payment.type = "hidden";
                input_payment.name = "razorpay_payment_id";
                input_payment.value = response.razorpay_payment_id;
                form.appendChild(input_payment);

                var input_order = document.createElement("input");
                input_order.type = "hidden";
                input_order.name = "razorpay_order_id";
                input_order.value = response.razorpay_order_id;
                form.appendChild(input_order);

                var input_signature = document.createElement("input");
                input_signature.type = "hidden";
                input_signature.name = "razorpay_signature";
                input_signature.value = response.razorpay_signature;
                form.appendChild(input_signature);

                form.submit();
            },
            "theme": {
                "color": "#F37254"
            }
        };

        var rzp1 = new Razorpay(options);

        document.getElementById('rzp-button').onclick = function (e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>

</html>