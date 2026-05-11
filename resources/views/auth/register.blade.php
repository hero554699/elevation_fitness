<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — Elevation Fitness Gym</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;600&family=Barlow+Condensed:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --red: #e8001d;
            --dark: #0a0a0a;
            --gray: #1a1a1a;
            --mid: #2a2a2a;
        }

        body {
            font-family: 'Barlow', sans-serif;
            background: var(--dark);
            color: #f0f0f0;
        }

        .display {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: .05em;
        }

        .condensed {
            font-family: 'Barlow Condensed', sans-serif;
        }

        .input {
            background: var(--mid);
            border: 1px solid #3a3a3a;
            color: #f0f0f0;
            width: 100%;
            font-family: 'Barlow', sans-serif;
            transition: border-color .2s;
        }

        .input:focus {
            outline: none;
            border-color: var(--red);
        }

        .btn-red {
            background: var(--red);
            color: #fff;
            border: 2px solid var(--red);
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            transition: background .2s, color .2s;
            cursor: pointer;
            width: 100%;
        }

        .btn-red:hover {
            background: transparent;
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

        .card {
            background: var(--gray);
            border: 1px solid var(--mid);
        }

        .stripe-bg {
            background: repeating-linear-gradient(-45deg, transparent, transparent 10px,
                    rgba(232, 0, 29, .025) 10px, rgba(232, 0, 29, .025) 20px);
        }
    </style>
</head>

<body>

    <div class="min-h-screen flex stripe-bg">
        <div class="fixed left-0 top-0 bottom-0 w-1" style="background:var(--red);"></div>

        <div class="m-auto w-full max-w-md px-6 py-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 justify-center mb-10">
                <div style="width:32px;height:32px;background:var(--red);
                        clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);"></div>
                <div class="leading-none">
                    <div class="display text-white text-xl tracking-widest">ELEVATION</div>
                    <div class="condensed text-gray-500 text-xs tracking-widest">FITNESS GYM</div>
                </div>
            </a>

            <div class="card p-8">
                <div class="mb-8">
                    <h1 class="display text-white" style="font-size:2.8rem;">CREATE ACCOUNT</h1>
                    <p class="text-gray-500 text-sm mt-1">Register a staff account to access the system.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="input px-4 py-3 text-sm"
                            placeholder="Juan Dela Cruz" required autofocus autocomplete="name">
                        @error('name')
                        <p class="text-xs mt-1" style="color:#fca5a5;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="input px-4 py-3 text-sm"
                            placeholder="juan@example.com" required autocomplete="username">
                        @error('email')
                        <p class="text-xs mt-1" style="color:#fca5a5;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label">Password</label>
                        <input type="password" name="password"
                            class="input px-4 py-3 text-sm"
                            placeholder="••••••••" required autocomplete="new-password">
                        @error('password')
                        <p class="text-xs mt-1" style="color:#fca5a5;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="input px-4 py-3 text-sm"
                            placeholder="••••••••" required autocomplete="new-password">
                        @error('password_confirmation')
                        <p class="text-xs mt-1" style="color:#fca5a5;">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-red py-4 text-sm">Create Account →</button>

                    <p class="text-center text-gray-600 text-xs pt-2">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="condensed font-bold uppercase tracking-wider"
                            style="color:var(--red);">Log In</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>