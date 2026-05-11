@extends('layouts.app')
@section('title', 'Registration Successful — Elevation Fitness Gym')

@section('content')
<div class="py-32" style="background:#0a0a0a;">
    <div class="max-w-xl mx-auto px-6 text-center">

        <div class="flex justify-center mb-8">
            <div class="w-24 h-24 rounded-full flex items-center justify-center"
                style="background:rgba(232,0,29,.1);border:2px solid var(--red);">
                <svg class="w-10 h-10" fill="none" stroke="#e8001d" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <h1 class="display text-white mb-3" style="font-size:4rem;">YOU'RE IN!</h1>
        <p class="text-gray-400 text-base mb-10">
            Welcome to the Elevation family,
            <strong class="text-white">{{ session('name') }}</strong>.
            Membership registered and activated.
        </p>

        <div class="card p-8 text-left mb-10" style="border-color:var(--red);">
            <h2 class="display text-white text-2xl mb-5">REGISTRATION DETAILS</h2>
            <div>
                <div class="flex justify-between py-3" style="border-bottom:1px solid #222;">
                    <span class="condensed text-gray-500 text-xs uppercase tracking-wider">Member ID</span>
                    <span class="text-white font-bold">#{{ str_pad(session('member_id'),6,'0',STR_PAD_LEFT) }}</span>
                </div>
                <div class="flex justify-between py-3" style="border-bottom:1px solid #222;">
                    <span class="condensed text-gray-500 text-xs uppercase tracking-wider">Receipt No.</span>
                    <span class="condensed font-bold" style="color:var(--red);">{{ session('receipt_no') }}</span>
                </div>
                <div class="flex justify-between py-3">
                    <span class="condensed text-gray-500 text-xs uppercase tracking-wider">Status</span>
                    <span class="px-3 py-1 condensed text-xs font-bold uppercase tracking-wider"
                        style="background:rgba(34,197,94,.12);color:#86efac;border:1px solid rgba(34,197,94,.3);">
                        Active
                    </span>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('checkin.index') }}" class="btn-red   px-8 py-3 text-sm">Go to Check-In</a>
            <a href="{{ route('dashboard') }}" class="btn-ghost px-8 py-3 text-sm">Back to Dashboard</a>
        </div>

    </div>
</div>
@endsection