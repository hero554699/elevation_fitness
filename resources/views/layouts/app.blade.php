<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Elevation Fitness Gym')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700&family=Barlow+Condensed:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --red: #e8001d;
            --dark: #0a0a0a;
            --gray: #1a1a1a;
            --mid: #2a2a2a;
            --light: #f0f0f0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Barlow', sans-serif;
            background: var(--dark);
            color: var(--light);
        }

        h1,
        h2,
        h3,
        h4,
        .display {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.05em;
        }

        .condensed {
            font-family: 'Barlow Condensed', sans-serif;
        }

        .btn-red {
            display: inline-block;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            background: var(--red);
            color: #fff;
            border: 2px solid var(--red);
            transition: background .2s, color .2s;
            cursor: pointer;
        }

        .btn-red:hover {
            background: transparent;
            color: var(--red);
        }

        .btn-ghost {
            display: inline-block;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            background: transparent;
            color: var(--light);
            border: 2px solid #444;
            transition: border-color .2s, color .2s;
            cursor: pointer;
        }

        .btn-ghost:hover {
            border-color: var(--red);
            color: var(--red);
        }

        .card {
            background: var(--gray);
            border: 1px solid var(--mid);
        }

        .input {
            background: var(--mid);
            border: 1px solid #3a3a3a;
            color: var(--light);
            width: 100%;
            font-family: 'Barlow', sans-serif;
            transition: border-color .2s;
        }

        .input:focus {
            outline: none;
            border-color: var(--red);
        }

        select.input option {
            background: #2a2a2a;
        }

        .nav-link {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            font-size: .9rem;
            color: #aaa;
            transition: color .2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--red);
        }

        .label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: .7rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #666;
            display: block;
            margin-bottom: .4rem;
        }

        .red-glow {
            box-shadow: 0 0 30px rgba(232, 0, 29, .18);
        }

        .stripe-bg {
            background: repeating-linear-gradient(-45deg, transparent, transparent 10px,
                    rgba(232, 0, 29, .025) 10px, rgba(232, 0, 29, .025) 20px);
        }

        .alert-ok {
            background: rgba(34, 197, 94, .1);
            border: 1px solid rgba(34, 197, 94, .35);
            color: #86efac;
        }

        .alert-err {
            background: rgba(232, 0, 29, .1);
            border: 1px solid rgba(232, 0, 29, .35);
            color: #fca5a5;
        }

        .alert-warn {
            background: rgba(234, 179, 8, .1);
            border: 1px solid rgba(234, 179, 8, .35);
            color: #fde047;
        }
    </style>
</head>

<body>

    {{-- ══════════════════════════════════════════ NAVBAR ══ --}}
    <nav style="background:#0f0f0f; border-bottom:2px solid var(--red);">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div style="width:34px;height:34px;background:var(--red);
                        clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);"></div>
                <div class="leading-none">
                    <div class="display text-white text-2xl tracking-widest">ELEVATION</div>
                    <div class="condensed text-gray-500 text-xs tracking-widest">FITNESS GYM</div>
                </div>
            </a>

            {{-- Nav links — only show when logged in --}}
            @auth
            <div class="hidden md:flex items-center gap-7">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home')       ? 'active':'' }}">Home</a>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard')  ? 'active':'' }}">Dashboard</a>
                <a href="{{ route('member.register') }}" class="nav-link {{ request()->routeIs('member.*')   ? 'active':'' }}">Register</a>
                <a href="{{ route('checkin.index') }}" class="nav-link {{ request()->routeIs('checkin.*')  ? 'active':'' }}">Check-In</a>
                <a href="{{ route('renewal.index') }}" class="nav-link {{ request()->routeIs('renewal.*')  ? 'active':'' }}">Renewal</a>
                <a href="{{ route('payments.index') }}" class="nav-link {{ request()->routeIs('payments.*') ? 'active':'' }}">Payments</a>
            </div>
            @endauth

            {{-- Right side buttons --}}
            @auth
            <div class="hidden md:flex items-center gap-4">
                <span class="condensed text-gray-500 text-xs uppercase tracking-wider">
                    {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-ghost px-5 py-2 text-sm">Log Out</button>
                </form>
            </div>
            @else
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}" class="btn-ghost px-5 py-2 text-sm">Log In</a>
                <a href="{{ route('register') }}" class="btn-red   px-5 py-2 text-sm">Sign Up</a>
            </div>
            @endauth

        </div>
    </nav>

    {{-- ══════════════════════════════════════════ CONTENT ══ --}}
    <main>
        @yield('content')
    </main>

    {{-- ══════════════════════════════════════════ FOOTER ══ --}}
    <footer style="background:#0f0f0f; border-top:1px solid var(--mid);" class="mt-20 py-14">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <h3 class="display text-white text-2xl mb-3">ELEVATION FITNESS GYM</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Premium-quality gym facilities at affordable prices. Serving the Davao Region since 2017.</p>
            </div>
            <div>
                <h4 class="condensed text-gray-400 text-xs uppercase tracking-widest mb-3">Branches</h4>
                <ul class="text-gray-600 text-sm space-y-1">
                    <li>
                        <a href="https://www.google.com/maps/search/Elevation+Fitness+Gym+Sta.+Ana+Avenue+Davao+City" target="_blank" class="hover:text-blue-600">
                            Sta. Ana Avenue, Davao City
                        </a>
                    </li>
                    <li>
                        <a href="https://www.google.com/maps/search/Elevation+Fitness+Gym+Buhangin+Davao+City" target="_blank" class="hover:text-blue-600">
                            Buhangin, Davao City
                        </a>
                    </li>
                    <li>
                        <a href="https://www.google.com/maps/search/Elevation+Fitness+Gym+Ecoland+Quimpo+Blvd+Davao+City" target="_blank" class="hover:text-blue-600">
                            Ecoland (Quimpo Blvd), Davao City
                        </a>
                    </li>
                    <li>
                        <a href="https://www.google.com/maps/search/Elevation+Fitness+Gym+Lanang+Davao+City" target="_blank" class="hover:text-blue-600">
                            Lanang, Davao City
                        </a>
                    </li>
                    <li>
                        <a href="https://www.google.com/maps/search/Elevation+Fitness+Gym+Panabo+City" target="_blank" class="hover:text-blue-600">
                            Panabo City
                        </a>
                    </li>
                    <li>
                        <a href="https://www.google.com/maps/search/Elevation+Fitness+Gym+Tagum+City" target="_blank" class="hover:text-blue-600">
                            Tagum City
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="condensed text-gray-400 text-xs uppercase tracking-widest mb-3">Hours</h4>
                <p class="text-gray-600 text-sm">Monday – Saturday<br>6:00 AM – 10:00 PM</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-10 pt-6 text-center text-gray-700 text-xs" style="border-top:1px solid #1a1a1a;">
            &copy; {{ date('Y') }} Elevation Fitness Gym &nbsp;·&nbsp; IT6 Project Deliverable — Obillo, Hero Camillus
        </div>
    </footer>

</body>

</html>