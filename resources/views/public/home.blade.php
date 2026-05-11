<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elevation Fitness Gym — Davao City</title>
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

<body class="bg-gray-950 text-white">

    <nav class="fixed top-0 left-0 right-0 z-50 bg-gray-950 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-8 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-7 h-7 bg-red-600 flex-shrink-0"
                    style="clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);"></div>
                <div>
                    <div class="display text-white text-lg tracking-widest leading-none">ELEVATION</div>
                    <div class="condensed text-gray-500 text-xs tracking-widest">FITNESS GYM</div>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <a href="#plans" class="text-gray-400 text-sm font-medium hover:text-white transition-colors">Plans</a>
                <a href="#branches" class="text-gray-400 text-sm font-medium hover:text-white transition-colors">Branches</a>
                <a href="#join" class="bg-red-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">Join Now</a>
                <a href="{{ route('admin.login') }}" class="text-gray-400 text-sm font-medium hover:text-white transition-colors">LogIN</a>
            </div>
        </div>
    </nav>

    <section class="relative stripe-bg" style="padding-top:140px; padding-bottom:80px;">
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-600"></div>
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden pointer-events-none select-none opacity-5">
            <span class="display text-white" style="font-size:18vw;white-space:nowrap;line-height:1;">ELEVATE</span>
        </div>
        <div class="relative max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-2 gap-16 items-center">
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-px w-8 bg-red-600"></div>
                        <span class="condensed text-xs tracking-widest uppercase text-red-500">Davao City, Philippines · Est. 2017</span>
                    </div>
                    <h1 class="display text-white mb-5 leading-none" style="font-size:5rem;">
                        NOWHERE<br>TO GO<br><span class="text-red-600">BUT UP.</span>
                    </h1>
                    <p class="text-gray-400 text-base mb-8 leading-relaxed" style="font-weight:300; max-width:420px;">
                        Premium gym facilities at affordable prices — open-air cardio & strength equipment, indoor cycling, Zumba, and personal training across 6 branches in the Davao Region.
                    </p>
                    <div class="flex gap-3">
                        <a href="#join" class="bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors text-sm">Join Now</a>
                        <a href="#plans" class="border border-gray-700 text-white px-8 py-3 rounded-lg font-semibold hover:border-red-600 hover:text-red-500 transition-colors text-sm">View Plans</a>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
                        <div class="display text-red-600" style="font-size:3rem;">3,000+</div>
                        <div class="condensed text-gray-500 text-xs uppercase tracking-widest mt-1">Registered Members Across All Branches</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
                            <div class="display text-white" style="font-size:3rem;">6</div>
                            <div class="condensed text-gray-500 text-xs uppercase tracking-widest mt-1">Branches</div>
                        </div>
                        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
                            <div class="display text-white" style="font-size:3rem;">2017</div>
                            <div class="condensed text-gray-500 text-xs uppercase tracking-widest mt-1">Year Founded</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="plans" class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-8">
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-3">
                    <div class="h-px w-8 bg-red-600"></div>
                    <span class="condensed text-xs tracking-widest uppercase text-red-500">Membership Plans</span>
                </div>
                <h2 class="display text-white" style="font-size:2.5rem;">CHOOSE YOUR COMMITMENT</h2>
            </div>
            @php
            $planCards = [
            ['name'=>'1-Day Pass','price'=>'₱150', 'sub'=>'per day', 'tag'=>'', 'features'=>['Open-air Gym Access','Cardio & Strength Equipment']],
            ['name'=>'1-Month', 'price'=>'₱1,000','sub'=>'per month','tag'=>'', 'features'=>['Open-air Gym','Cardio & Strength','Indoor Cycling','Zumba','Free Parking']],
            ['name'=>'3-Month', 'price'=>'₱2,700','sub'=>'₱900/mo', 'tag'=>'POPULAR', 'features'=>['Open-air Gym','Cardio & Strength','Indoor Cycling','Zumba','Free Parking']],
            ['name'=>'6-Month', 'price'=>'₱4,500','sub'=>'₱750/mo', 'tag'=>'SAVE 25%', 'features'=>['Open-air Gym','Cardio & Strength','Indoor Cycling','Zumba','Free Parking']],
            ['name'=>'1-Year', 'price'=>'₱6,500','sub'=>'₱542/mo', 'tag'=>'BEST VALUE','features'=>['Open-air Gym','Cardio & Strength','Indoor Cycling','Zumba','Free Parking']],
            ];
            @endphp
            <div class="grid grid-cols-5 gap-4">
                @foreach($planCards as $plan)
                @php $featured = in_array($plan['tag'], ['POPULAR','BEST VALUE']); @endphp
                <div class="relative rounded-xl p-5 flex flex-col {{ $featured ? 'bg-gray-800 border-2 border-red-600 shadow-lg shadow-red-900/20' : 'bg-gray-800 border border-gray-700' }}">
                    @if($plan['tag'])
                    <div class="absolute -top-3 left-4">
                        <span class="condensed text-xs font-bold tracking-widest px-2.5 py-1 bg-red-600 text-white rounded-sm">{{ $plan['tag'] }}</span>
                    </div>
                    @endif
                    <div class="condensed text-gray-400 text-xs uppercase tracking-widest mb-1">{{ $plan['name'] }}</div>
                    <div class="display text-white mb-0.5" style="font-size:1.9rem;">{{ $plan['price'] }}</div>
                    <div class="condensed text-gray-500 text-xs mb-4">{{ $plan['sub'] }}</div>
                    <ul class="space-y-1.5 mb-5 flex-1">
                        @foreach($plan['features'] as $f)
                        <li class="text-gray-400 text-xs flex items-start gap-1.5">
                            <span class="text-red-600 mt-0.5">■</span> {{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="#join" onclick="selectPlan('{{ $plan['name'] }}')" class="block text-center bg-red-600 text-white py-2 rounded-lg text-xs font-semibold hover:bg-red-700 transition-colors">Choose Plan</a>
                </div>
                @endforeach
            </div>
            <p class="text-gray-600 text-xs mt-4 text-center">Personal Training: ₱1,500–₱2,000 for 12 sessions · One-on-one instructor</p>
        </div>
    </section>

    <section id="branches" class="py-20 bg-gray-950">
        <div class="max-w-7xl mx-auto px-8">
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-3">
                    <div class="h-px w-8 bg-red-600"></div>
                    <span class="condensed text-xs tracking-widest uppercase text-red-500">Locations</span>
                </div>
                <h2 class="display text-white" style="font-size:2.5rem;">OUR BRANCHES</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($branches as $branch)
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5 hover:border-red-900 transition-colors flex flex-col justify-between">
                    <div>
                        <div class="text-xl mb-2">📍</div>
                        <h3 class="display text-white text-xl mb-1">{{ $branch->branch_name }}</h3>
                        <p class="text-gray-500 text-sm mb-4">{{ $branch->location }}</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="#join" onclick="selectBranch('{{ $branch->branch_name }}')" class="text-red-500 text-sm font-semibold hover:text-red-400 transition-colors">Join this branch →</a>
                        @if($branch->maps_url)
                        <a href="{{ $branch->maps_url }}" target="_blank" class="flex items-center gap-1.5 text-gray-500 text-xs font-medium hover:text-white transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            View on Maps
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="join" class="py-20 bg-gray-900">
        <div class="max-w-2xl mx-auto px-8">
            <div class="mb-10 text-center">
                <div class="flex items-center gap-3 mb-3 justify-center">
                    <div class="h-px w-8 bg-red-600"></div>
                    <span class="condensed text-xs tracking-widest uppercase text-red-500">Get Started</span>
                    <div class="h-px w-8 bg-red-600"></div>
                </div>
                <h2 class="display text-white mb-2" style="font-size:2.5rem;">JOIN ELEVATION</h2>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Fill in your details below. After submitting, visit your chosen branch with your reference number to complete payment and activate your membership.
                </p>
            </div>
            @if($errors->any())
            <div class="bg-red-900 border border-red-700 text-red-200 rounded-xl p-4 mb-6">
                @foreach($errors->all() as $error)
                <div class="text-sm">⚠ {{ $error }}</div>
                @endforeach
            </div>
            @endif
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-7">
                <form action="{{ route('public.join') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">First Name *</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full px-3 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-900" placeholder="Juan" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Last Name *</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full px-3 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-900" placeholder="Dela Cruz" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Email Address *</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-900" placeholder="juan@example.com" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Phone Number *</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-900" placeholder="09XXXXXXXXX" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="w-full px-3 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-900" placeholder="Street, Barangay, City">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Select Branch *</label>
                            <select name="branch_id" class="w-full px-3 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-900" required>
                                <option value="">— Choose Branch —</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->branch_id }}" {{ old('branch_id') == $branch->branch_id ? 'selected':'' }}>{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Membership Plan *</label>
                            <select name="plan_id" class="w-full px-3 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-900" required>
                                <option value="">— Choose Plan —</option>
                                @foreach($plans as $plan)
                                <option value="{{ $plan->plan_id }}" {{ old('plan_id') == $plan->plan_id ? 'selected':'' }}>{{ $plan->plan_name }} — ₱{{ number_format($plan->price, 2) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="bg-gray-700 border border-gray-600 rounded-lg p-3.5">
                        <p class="text-xs text-gray-400 leading-relaxed">
                            📌 After submitting, you will receive a <strong class="text-white">reference number</strong>. Bring this to your chosen branch to complete payment and activate your membership.
                        </p>
                    </div>
                    <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors text-sm tracking-wide">Submit Registration →</button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-gray-950 border-t border-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <div class="display text-white text-xl mb-3">ELEVATION FITNESS GYM</div>
                <p class="text-gray-500 text-sm leading-relaxed">Premium gym facilities at affordable prices. Serving the Davao Region since 2017.</p>
            </div>
            <div>
                <h4 class="condensed text-gray-400 text-xs uppercase tracking-widest mb-3">Branches</h4>
                <ul class="text-gray-600 text-sm space-y-1.5">
                    @foreach($branches as $branch)
                    <li>
                        <a href="{{ $branch->maps_url ?? '#' }}" target="_blank" class="hover:text-red-500 transition-colors flex items-center gap-1.5">
                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $branch->branch_name }} — {{ $branch->location }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="condensed text-gray-400 text-xs uppercase tracking-widest mb-3">Hours</h4>
                <p class="text-gray-600 text-sm">Monday – Saturday<br>6:00 AM – 10:00 PM</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-8 mt-10 pt-6 border-t border-gray-900 text-center text-gray-700 text-xs">
            &copy; {{ date('Y') }} Elevation Fitness Gym &nbsp;·&nbsp; IT6 Project Deliverable — Obillo, Hero Camillus
        </div>
    </footer>

    <script>
        function selectPlan(planName) {
            const selectElement = document.querySelector('select[name="plan_id"]');
            if (!selectElement) return;
            for (let i = 0; i < selectElement.options.length; i++) {
                const option = selectElement.options[i];
                if (option.text.toLowerCase().includes(planName.toLowerCase())) {
                    selectElement.selectedIndex = i;
                    break;
                }
            }
            document.getElementById('join').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function selectBranch(branchName) {
            const branchSelect = document.querySelector('select[name="branch_id"]');
            if (!branchSelect) return;
            for (let i = 0; i < branchSelect.options.length; i++) {
                const option = branchSelect.options[i];
                if (option.text.trim().toLowerCase().includes(branchName.trim().toLowerCase())) {
                    branchSelect.selectedIndex = i;
                    break;
                }
            }
            document.getElementById('join').scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>

</body>

</html>