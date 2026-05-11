@extends('layouts.app')
@section('title', 'Register Member — Elevation Fitness Gym')

@section('content')
<div class="py-20" style="background:#0a0a0a;">
    <div class="max-w-5xl mx-auto px-6">

        <div class="mb-12">
            <div class="flex items-center gap-3 mb-3">
                <div style="height:2px;width:40px;background:var(--red);"></div>
                <span class="condensed text-xs tracking-widest uppercase" style="color:var(--red);">New Member</span>
            </div>
            <h1 class="display text-white" style="font-size:3.8rem;">REGISTER MEMBER</h1>
            <p class="text-gray-500 text-sm mt-2">Fill in the member's details below and select a plan.</p>
        </div>

        @if($errors->any())
        <div class="alert-err rounded p-4 mb-8">
            @foreach($errors->all() as $error)
            <p class="text-sm">⚠ {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form action="{{ route('member.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- LEFT: Personal info --}}
                <div class="card p-8">
                    <h2 class="display text-white text-2xl mb-6">PERSONAL INFO</h2>
                    <div class="space-y-5">
                        <div>
                            <label class="label">First Name *</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                class="input px-4 py-3 text-sm" placeholder="Juan" required>
                        </div>
                        <div>
                            <label class="label">Last Name *</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                class="input px-4 py-3 text-sm" placeholder="Dela Cruz" required>
                        </div>
                        <div>
                            <label class="label">Email Address *</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="input px-4 py-3 text-sm" placeholder="juan@example.com" required>
                        </div>
                        <div>
                            <label class="label">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="input px-4 py-3 text-sm" placeholder="09XXXXXXXXX">
                        </div>
                        <div>
                            <label class="label">Address</label>
                            <textarea name="address" rows="2" class="input px-4 py-3 text-sm resize-none"
                                placeholder="Street, Barangay, City">{{ old('address') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Plan + payment --}}
                <div class="space-y-6">
                    <div class="card p-8">
                        <h2 class="display text-white text-2xl mb-6">GYM &amp; PLAN</h2>
                        <div class="space-y-5">
                            <div>
                                <label class="label">Select Branch *</label>
                                <select name="branch_id" class="input px-4 py-3 text-sm" required>
                                    <option value="">— Choose a Branch —</option>
                                    @foreach($branches as $branch)
                                    <option value="{{ $branch->branch_id }}"
                                        {{ old('branch_id') == $branch->branch_id ? 'selected':'' }}>
                                        {{ $branch->branch_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="label">Membership Plan *</label>
                                <select name="plan_id" class="input px-4 py-3 text-sm" required>
                                    <option value="">— Choose a Plan —</option>
                                    @foreach($plans as $plan)
                                    <option value="{{ $plan->plan_id }}"
                                        {{ old('plan_id') == $plan->plan_id ? 'selected':'' }}>
                                        {{ $plan->plan_name }} — ₱{{ number_format($plan->price,2) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card p-8">
                        <h2 class="display text-white text-2xl mb-6">PAYMENT METHOD</h2>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="cash" class="sr-only peer"
                                    {{ old('payment_method','cash')==='cash' ? 'checked':'' }}>
                                <div class="card border-2 p-4 text-center transition-all
                                        peer-checked:border-red-600 peer-checked:bg-red-950"
                                    style="border-color:#3a3a3a;">
                                    <div class="text-2xl mb-1">💵</div>
                                    <div class="condensed font-bold text-xs uppercase tracking-wider">Cash</div>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="gcash" class="sr-only peer"
                                    {{ old('payment_method')==='gcash' ? 'checked':'' }}>
                                <div class="card border-2 p-4 text-center transition-all
                                        peer-checked:border-red-600 peer-checked:bg-red-950"
                                    style="border-color:#3a3a3a;">
                                    <div class="text-2xl mb-1">📱</div>
                                    <div class="condensed font-bold text-xs uppercase tracking-wider">GCash</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn-red w-full py-4 text-base">
                        Complete Registration →
                    </button>
                    <p class="text-gray-600 text-xs text-center">Payment is settled upon first visit at the branch.</p>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection