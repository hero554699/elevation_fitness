@extends('admin.layouts.app')
@section('title', 'Add Member')
@section('page-title', 'Add Member')
@section('page-subtitle', 'Register a new gym member manually')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">

        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 m-6">
            <div class="flex items-start">
                <div class="text-red-500 text-xl mr-3">⚠️</div>
                <div>
                    <h3 class="text-red-800 font-semibold mb-2">Validation Errors</h3>
                    <ul class="text-red-700 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('admin.members.store') }}" method="POST" class="p-8">
            @csrf

            <!-- Header Info Card -->
            <div class="mb-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-start">
                    <span class="text-2xl mr-3">👤</span>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">New Member Registration</h3>
                        <p class="text-sm text-gray-600">Fill in the details below to register a new gym member. Required fields are marked with <span class="text-red-500 font-bold">*</span></p>
                    </div>
                </div>
            </div>

            <!-- SECTION: Basic Information -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">📋</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Basic Information</h2>
                        <p class="text-sm text-gray-500">Enter the member's personal details</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., John" required>
                            <p class="text-xs text-gray-500 mt-1">Member's first name</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., Doe" required>
                            <p class="text-xs text-gray-500 mt-1">Member's last name</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: Contact Details -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">📞</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Contact Details</h2>
                        <p class="text-sm text-gray-500">How we can reach the member</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., john@example.com" required>
                            <p class="text-xs text-gray-500 mt-1">Valid email for contact & communication</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., 09123456789" required>
                            <p class="text-xs text-gray-500 mt-1">Mobile number for notifications</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                        <textarea name="address" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition resize-none"
                            placeholder="Street address, city, province...">{{ old('address') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Complete physical address</p>
                    </div>
                </div>
            </div>

            <!-- SECTION: Membership Assignment -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">🏋️</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Membership Assignment</h2>
                        <p class="text-sm text-gray-500">Select branch and membership plan</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Branch <span class="text-red-500">*</span>
                            </label>
                            <select name="branch_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition" required>
                                <option value="">— Select Branch —</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->branch_id }}" {{ old('branch_id') == $branch->branch_id ? 'selected':'' }}>
                                    {{ $branch->branch_name }}
                                </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Which branch will this member use</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Membership Plan <span class="text-red-500">*</span>
                            </label>
                            <select name="plan_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition" required>
                                <option value="">— Select Plan —</option>
                                @foreach($plans as $plan)
                                <option value="{{ $plan->plan_id }}" {{ old('plan_id') == $plan->plan_id ? 'selected':'' }}>
                                    {{ $plan->plan_name }} — ₱{{ number_format($plan->price, 2) }}
                                </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Select appropriate membership tier</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: Membership Status -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">✅</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Status & Payment</h2>
                        <p class="text-sm text-gray-500">Set membership and payment status</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Membership Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition" required>
                                <option value="pending" {{ old('status','pending') === 'pending' ? 'selected':'' }}>
                                    ⏳ Pending - Awaiting activation
                                </option>
                                <option value="active" {{ old('status') === 'active' ? 'selected':'' }}>
                                    ✅ Active - Currently active
                                </option>
                                <option value="expired" {{ old('status') === 'expired' ? 'selected':'' }}>
                                    ❌ Expired - Membership ended
                                </option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Current membership status</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Payment Status <span class="text-red-500">*</span>
                            </label>
                            <select name="payment_status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition" required>
                                <option value="unpaid" {{ old('payment_status','unpaid') === 'unpaid' ? 'selected':'' }}>
                                    💳 Unpaid - Payment pending
                                </option>
                                <option value="paid" {{ old('payment_status') === 'paid' ? 'selected':'' }}>
                                    💰 Paid - Payment received
                                </option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Current payment status</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="bg-red-600 text-white px-8 py-2.5 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                    ✅ Save Member
                </button>
                <a href="{{ route('admin.members.index') }}" class="bg-gray-100 text-gray-700 border border-gray-300 px-8 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors">
                    ✕ Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection