<!Doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
  <!-- Logo area and branding name -->
  <div class="bg-gray-800 py-4">
      <div class="max-w-6xl mx-auto flex items-center justify-center">
          <img src="" alt="Logo" class="h-12 mr-2">
          <span class="text-xl font-semibold text-white">SDM Wi-Fi Portal</span>
      </div>
  </div>
  <!-- Loading view -->
  <div id="loading" class="hidden text-center">
        <p>Loading...</p>
        <!-- Add loading animation or spinner here -->
    </div>

<!-- Payment form -->
<div class="max-w-md mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Payment Details</h2>
    <form action="{{ route('payment.handlePayment') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="planId" value="{{ $planId }}">
        <!-- Input field for the phone number -->
        <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number">
        
        <!-- Purchase button -->
        <button id="purchaseBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="purchasePlan()">
            Initiate payment
        </button>
        <div id="loader" class="hidden"> <!-- Hidden by default -->
            <!-- Loader/spinner element -->
        </div>
        <div id="errorMessage" class="hidden"> <!-- Hidden by default -->
            <!-- Error message element -->
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
function purchasePlan() {

    // Display loading view
    document.getElementById('loading').classList.remove('hidden');
    // Hide purchase button
    document.getElementById('purchaseBtn').classList.add('hidden');


    // Retrieve planId from the hidden input field
    var planId = document.querySelector('input[name="planId"]').value;

    // Retrieve phone number entered by the user
    var phoneNumber = document.getElementById('phoneNumber').value;

    // Disable button and show loader
    document.getElementById('purchaseBtn').disabled = true;
    document.getElementById('loader').classList.remove('hidden');
    
    // Send AJAX request to server
    axios.post('/payment', {
        planId: planId,
        phoneNumber: phoneNumber
    })
    .then(function (response) {
        // Handle success response
        window.location.href = '/thank-you'; // Redirect to thank you page
    })
    .catch(function (error) {
        // Handle error response
        document.getElementById('errorMessage').classList.remove('hidden');
        document.getElementById('errorMessage').innerText = 'Payment failed. Please try again.';
        // Enable button and hide loader
        document.getElementById('purchaseBtn').disabled = false;
        document.getElementById('loader').classList.add('hidden');
    })

    .finally(function () {
        // Hide loading view
        document.getElementById('loading').classList.add('hidden');
        // Show purchase button
        document.getElementById('purchaseBtn').classList.remove('hidden');
    });
}
</script>

</body>
</html>
