<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="This is dummy description for the Application from blade"/>
<title>{{ $page_title ?? '' }}</title>
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
<link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
<script src="{{ mix('/js/app.js') }}" defer></script>
<!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "YOUR_KEY_ID",
    "amount": "2000", // 2000 paise = INR 20
    "name": "Merchant Name",
    "description": "Purchase Description",
    "image": "/your_logo.png",
    "handler": function (response){
        alert(response.razorpay_payment_id);
    },
    "prefill": {
        "name": "Gaurav Kumar",
        "email": "test@test.com"
    },
    "notes": {
        "address": "Hello World"
    },
    "theme": {
        "color": "#F37254"
    }
};
var rzp1 = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>  -->
</head>
<body>
<!-- <button id="rzp-button1" style="margin-top:50px;">Pay</button> -->
@inertia

</body>
</html>
