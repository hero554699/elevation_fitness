<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Portal — Elevation Fitness Gym</title>
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
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex">

    {{-- Left Panel --}}
    <div class="hidden lg:flex lg:w-1/2 bg-gray-950 flex-col justify-between p-12 relative overflow-hidden">
        <div class="absolute inset-0" style="background:repeating-linear-gradient(-45deg,transparent,transparent 10px,rgba(232,0,29,.03) 10px,rgba(232,0,29,.03) 20px);"></div>
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-600"></div>

        <div class="relative">
            <div class="flex items-center gap-3 mb-16">
                <div class="w-8 h-8 bg-red-600 flex-shrink-0"
                    style="clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);"></div>
                <div>
                    <div class="display text-white text-xl tracking-widest leading-none">ELEVATION</div>
                    <div class="condensed text-gray-500 text-xs tracking-widest">FITNESS GYM · PORTAL</div>
                </div>
            </div>

            <h1 class="display text-white mb-4" style="font-size:3.5rem;line-height:1;">
                MANAGE<br>YOUR<br><span class="text-red-600">BRANCH.</span>
            </h1>
            <p class="text-gray-500 text-sm leading-relaxed max-w-xs">
                Access the Elevation Fitness Gym management system to oversee branch operations, staff performance, and member engagement.
            </p>
        </div>

        <div class="relative grid grid-cols-3 gap-4">
            <div class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center">
                <div class="display text-red-600 text-2xl">6</div>
                <div class="condensed text-gray-600 text-xs uppercase tracking-wider mt-1">Branches</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center">
                <div class="display text-white text-2xl">3K+</div>
                <div class="condensed text-gray-600 text-xs uppercase tracking-wider mt-1">Members</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center">
                <div class="display text-white text-2xl">2017</div>
                <div class="condensed text-gray-600 text-xs uppercase tracking-wider mt-1">Founded</div>
            </div>
        </div>
    </div>

    {{-- Right Panel --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Welcome back</h2>
                <p class="text-gray-500 text-sm">Please sign in to your account to continue.</p>
            </div>

            @if (session('status'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 mb-6 text-sm">
                {{ session('status') }}
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6 text-sm">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                        placeholder="name@elevationgym.com" required autofocus>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                        placeholder="••••••••" required>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded" style="accent-color:#E8001D;">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a href="#" class="text-sm text-red-600 font-medium hover:text-red-700">Forgot password?</a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors text-sm">
                    Sign In →
                </button>

            </form>

            <p class="text-center text-xs text-gray-400 mt-10">
                <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">← Back to Public Site</a>
            </p>

        </div>
    </div>

</body>

</html>