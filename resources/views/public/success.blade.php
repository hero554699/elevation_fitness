<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Submitted — Elevation Fitness Gym</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700&family=Barlow+Condensed:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .display {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.05em;
        }

        .condensed {
            font-family: 'Barlow Condensed', sans-serif;
        }

        .stripe-bg {
            background: repeating-linear-gradient(-45deg, transparent, transparent 10px,
                    rgba(232, 0, 29, .025) 10px, rgba(232, 0, 29, .025) 20px);
        }
    </style>
</head>

<body class="bg-gray-950 text-white min-h-screen flex items-center justify-center stripe-bg">

    <div class="fixed left-0 top-0 bottom-0 w-1 bg-red-600"></div>

    <div class="max-w-lg w-full mx-auto px-6 py-20 text-center">

        <div class="flex justify-center mb-8">
            <div class="w-24 h-24 rounded-full bg-red-600 bg-opacity-10 border-2 border-red-600 flex items-center justify-center">
                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <h1 class="display text-white mb-3" style="font-size:3.5rem;">YOU'RE REGISTERED!</h1>
        <p class="text-gray-400 text-base mb-10 leading-relaxed">
            Welcome, <strong class="text-white">{{ session('name') }}</strong>!
            Your registration has been submitted. Visit your chosen branch and show your reference number to complete payment and activate your membership.
        </p>

        <div class="bg-gray-900 border-2 border-red-600 rounded-xl p-8 mb-8">
            <p class="condensed text-xs uppercase tracking-widest text-gray-500 mb-2">Your Reference Number</p>
            <p class="display text-red-500 mb-6" style="font-size:2.5rem;letter-spacing:0.1em;">
                {{ session('reference_no') }}
            </p>

            @if($plan)
            <div class="border-t border-gray-800 pt-5">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Selected Plan</span>
                    <span class="text-sm font-semibold text-white">{{ $plan->plan_name }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Amount to Pay</span>
                    <span class="text-lg font-bold text-white">₱{{ number_format($plan->price, 2) }}</span>
                </div>
            </div>
            @endif
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 mb-8 text-left">
            <p class="condensed text-xs uppercase tracking-widest text-gray-500 mb-4">What to do next</p>
            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 mt-0.5">1</div>
                    <p class="text-sm text-gray-300">Screenshot or note down your reference number above.</p>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 mt-0.5">2</div>
                    <p class="text-sm text-gray-300">Visit your chosen Elevation branch during operating hours (Mon–Sat, 6AM–10PM).</p>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 mt-0.5">3</div>
                    <p class="text-sm text-gray-300">Show your reference number at the front desk and settle payment via cash or GCash.</p>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 mt-0.5">4</div>
                    <p class="text-sm text-gray-300">Your membership will be activated immediately after payment confirmation.</p>
                </div>
            </div>
        </div>

        <a href="{{ route('home') }}"
            class="inline-block bg-red-600 text-white px-10 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors text-sm">
            ← Back to Home
        </a>

    </div>

</body>

</html>