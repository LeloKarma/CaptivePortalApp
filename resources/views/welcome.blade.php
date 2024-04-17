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

  <!-- Welcome message -->
  <div class="bg-gray-200 py-4">
      <div class="max-w-6xl mx-auto text-center">
          <p class="text-lg text-gray-700">Welcome to our Wi-Fi Portal! Choose a plan below to get started.</p>
      </div>
  </div>

<!-- Wi-Fi plan cards -->
@foreach($wifiPlans as $plan)
<div class="max-w-sm rounded overflow-hidden shadow-lg bg-white mx-auto my-4">
    <!-- Plan details -->
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">{{ $plan->name }}</div>
        <p class="text-gray-700 text-base">
            Data Limit: {{ $plan->datalimit }} | Duration: {{ $plan->duration }} | Amount: {{ $plan->amount }}
        </p>
    </div>
    <!-- Purchase button -->
    <div class="px-6 py-4">
        <button onclick="showConfirmationModal({{ $plan->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Purchase
        </button>
    </div>
</div>
@endforeach

<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-8 max-w-md">
        <h2 class="text-xl font-bold mb-4">Confirm Purchase</h2>
        <p class="mb-4">Are you sure you want to purchase this plan?</p>
        <div class="flex justify-end">
        <button onclick="redirectToPayment()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
            Yes, Confirm
        </button>

            <button onclick="hideConfirmationModal()" class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Cancel
            </button>
        </div>
    </div>
</div>

<script>
    // Plan ID variable to store the selected plan ID
    let selectedPlanId = null;

    // Show confirmation modal and set the selected plan ID
    function showConfirmationModal(planId) {
        selectedPlanId = planId;
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    // Hide confirmation modal and reset selectedPlanId
    function hideConfirmationModal() {
        selectedPlanId = null; // Reset selectedPlanId
        document.getElementById('confirmationModal').classList.add('hidden');
    }

    // Redirect to payment page with selected plan ID
    function redirectToPayment() {
        if (selectedPlanId !== null) {
            console.log("Redirecting to payment page for plan ID:", selectedPlanId);
            // Redirect to payment page with plan ID
            window.location.href = "/payment?planId=" + selectedPlanId;
        } else {
            // Plan not selected, show error or handle accordingly
            console.error("No plan selected for purchase.");
        }
    }
</script>
