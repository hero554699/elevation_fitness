@extends('layouts.app')
@section('title', 'Dashboard — Elevation Fitness Gym')

@section('content')
<div class="py-20" style="background:#0a0a0a;">
    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-12">
            <div class="flex items-center gap-3 mb-3">
                <div style="height:2px;width:40px;background:var(--red);"></div>
                <span class="condensed text-xs tracking-widest uppercase" style="color:var(--red);">Staff Panel</span>
            </div>
            <h1 class="display text-white" style="font-size:3.8rem;">DASHBOARD</h1>
            <p class="text-gray-500 text-sm mt-1">
                Welcome back, <strong class="text-white">{{ Auth::user()->name }}</strong>.
                Select a module below to get started.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <a href="{{ route('member.register') }}"
                class="card p-7 block"
                style="transition:border-color .2s;"
                onmouseover="this.style.borderColor='#3a0a0a'"
                onmouseout="this.style.borderColor='#2a2a2a'">
                <div class="text-3xl mb-4">📋</div>
                <h3 class="display text-white text-2xl mb-1">REGISTER</h3>
                <p class="text-gray-500 text-sm">Add a new gym member to the system.</p>
            </a>

            <a href="{{ route('checkin.index') }}"
                class="card p-7 block"
                style="transition:border-color .2s;"
                onmouseover="this.style.borderColor='#3a0a0a'"
                onmouseout="this.style.borderColor='#2a2a2a'">
                <div class="text-3xl mb-4">✅</div>
                <h3 class="display text-white text-2xl mb-1">CHECK-IN</h3>
                <p class="text-gray-500 text-sm">Log a member's daily attendance.</p>
            </a>

            <a href="{{ route('renewal.index') }}"
                class="card p-7 block"
                style="transition:border-color .2s;"
                onmouseover="this.style.borderColor='#3a0a0a'"
                onmouseout="this.style.borderColor='#2a2a2a'">
                <div class="text-3xl mb-4">🔄</div>
                <h3 class="display text-white text-2xl mb-1">RENEWAL</h3>
                <p class="text-gray-500 text-sm">Process a membership renewal.</p>
            </a>

            <a href="{{ route('payments.index') }}"
                class="card p-7 block"
                style="transition:border-color .2s;"
                onmouseover="this.style.borderColor='#3a0a0a'"
                onmouseout="this.style.borderColor='#2a2a2a'">
                <div class="text-3xl mb-4">💳</div>
                <h3 class="display text-white text-2xl mb-1">PAYMENTS</h3>
                <p class="text-gray-500 text-sm">View all payment transaction records.</p>
            </a>

        </div>
    </div>
</div>
@endsection