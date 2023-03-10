@include('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body class="mt-5 pt-5">
    <form id="paymentForm" class="mt-5">
        <div class="form-group">
            {{-- <label for="email">Email Address</label> --}}
            <input type="email" id="email-address" required value="{{$user_email}}" readonly hidden/>
        </div>
        <div class="form-group">
            {{-- <label for="amount">Amount</label> --}}
            <input type="tel" id="amount" required readonly value="{{$sum_amount}}" hidden/>
        </div>
        <div class="form-group">
            {{-- <label for="first-name">First Name</label> --}}
            <input type="text" id="first-name" readonly value="{{$user_name}}" hidden/>
        </div>
        <div class="form-group">
            {{-- <label for="last-name">Last Name</label> --}}
            <input type="text" id="last-name" readonly value="{{$user_name}}" hidden/>
        </div>
        <div class="form-submit">
            <button class="button btn btn-lg btn-success ms-5 " type="submit" onclick="payWithPaystack(event)"> Pay </button>
        </div>
    </form>

    <script src="https://js.paystack.co/v1/inline.js"></script>
</body>

</html>

<script>
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);

    function payWithPaystack(e) {
        e.preventDefault();

        let handler = PaystackPop.setup({
            key: 'pk_test_270f2e657ce9444f10ed0bc75ced8e2ce4a8ed7b', // Replace with your public key
            email: document.getElementById("email-address").value,
            amount: document.getElementById("amount").value * 100,
            ref: '' + Math.floor((Math.random() * 1000000000) +
                1
            ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            onClose: function() {
                alert('Window closed.');
            },
            callback: function(response) {
                let reference = response.reference;
                // $.ajax({
                //     type: "GET",
                //     url: "{{ URL::to('/cart/verify-payment') }}/"+reference,
                //     success: function(response) {
                //         // the transaction status is in response.data.status
                //         console.log(response);
                //     }
                // });

                window.location = "verify-payment/" + reference;

            }
        });

        handler.openIframe();
    }
</script>
