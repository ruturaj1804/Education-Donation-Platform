document.addEventListener('DOMContentLoaded', function() {
    // Show Razorpay or PayPal button based on selection
    document.getElementById('payment-method').addEventListener('change', function() {
        const paymentMethod = this.value;
        const razorpayButton = document.getElementById('razorpay-button');
        const paypalButton = document.getElementById('paypal-button');

        // Hide both buttons initially
        razorpayButton.style.display = 'none';
        paypalButton.style.display = 'none';

        if (paymentMethod === 'razorpay') {
            // Show Razorpay button
            razorpayButton.style.display = 'block';
        } else if (paymentMethod === 'paypal') {
            // Show PayPal button
            paypalButton.style.display = 'block';
        }
    });

    // Handle Razorpay payment when button is clicked
    document.getElementById('razorpay-button').addEventListener('click', function() {
        const donationAmount = document.getElementById('amount').value;
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;

        if (donationAmount < 1) {
            alert("Please enter a valid donation amount.");
            return;
        }

        // Razorpay payment link (merchant link)
        const razorpayUrl = `https://razorpay.me/@misalruturajchandrakant`;

        // Redirect to Razorpay URL
        window.location.href = razorpayUrl;
    });

    // Handle PayPal payment
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault();  // Prevent the default form submission

        const paymentMethod = document.getElementById('payment-method').value;
        const donationAmount = document.getElementById('amount').value;
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;

        if (paymentMethod === 'paypal') {
            // PayPal payment link with dynamic parameters (amount, name, etc.)
            const paypalUrl = `https://www.paypal.com/ncp/payment/CJZBYHWP428XQ`; // PayPal link

            // Redirect to PayPal
            window.location.href = paypalUrl;
        }
    });
});
