@extends('layouts.app')
@section('title', 'Renew Membership — Elevation Fitness Gym')

@section('content')
<div class="py-20" style="background:#0a0a0a;">
    <div class="max-w-5xl mx-auto px-6">

        <div class="mb-12">
            <div class="flex items-center gap-3 mb-3">
                <div style="height:2px;width:40px;background:var(--red);"></div>
                <span class="condensed text-xs tracking-widest uppercase" style="color:var(--red);">Membership</span>
            </div>
            <h1 class="display text-white" style="font-size:3.8rem;">RENEW MEMBERSHIP</h1>
            <p class="text-gray-500 text-sm mt-2">Keep your momentum going. Renew your plan and stay active.</p>
        </div>

        {{-- Success card shown after successful renewal --}}
        @if(session('renewal_success'))
        <div class="alert-ok rounded p-6 mb-8">
            <div class="condensed font-bold uppercase tracking-wider text-sm mb-3">✅ Renewal Successful!</div>
            <p class="text-sm mb-4">{{ session('renewal_message') }}</p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                <div>
                    <span class="condensed text-xs uppercase tracking-wider" style="color:rgba(134,239,172,.6);">Member</span>
                    <div class="font-bold mt-1">{{ session('member_name') }}</div>
                </div>
                <div>
                    <span class="condensed text-xs uppercase tracking-wider" style="color:rgba(134,239,172,.6);">New Expiry</span>
                    <div class="font-bold mt-1">
                        {{ \Carbon\Carbon::parse(session('new_expiry'))->format('F d, Y') }}
                    </div>
                </div>
                <div>
                    <span class="condensed text-xs uppercase tracking-wider" style="color:rgba(134,239,172,.6);">Receipt No.</span>
                    <div class="font-bold mt-1">{{ session('receipt_no') }}</div>
                </div>
            </div>
        </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
        <div class="alert-err rounded p-4 mb-8">
            @foreach($errors->all() as $error)
            <p class="text-sm">⚠ {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- LEFT: Renewal form --}}
            <div class="card p-8 red-glow" style="border-color:var(--red);">
                <h2 class="display text-white text-2xl mb-6">RENEWAL FORM</h2>

                <form action="{{ route('renewal.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="label">Member ID *</label>
                        <input type="number" name="member_id" value="{{ old('member_id') }}"
                            class="input px-4 py-3 text-sm"
                            placeholder="Enter member ID" required min="1">
                        <p class="text-gray-600 text-xs mt-1">Enter the numeric member ID from registration.</p>
                    </div>

                    <div>
                        <label class="label">Renewal Plan *</label>
                        <select name="plan_id" class="input px-4 py-3 text-sm" required>
                            <option value="">— Select Plan —</option>
                            @foreach($plans as $plan)
                            <option value="{{ $plan->plan_id }}"
                                {{ old('plan_id') == $plan->plan_id ? 'selected':'' }}>
                                {{ $plan->plan_name }} — ₱{{ number_format($plan->price, 2) }}
                            </option>
                            @endforeach
                        </select>
                        <p class="text-gray-600 text-xs mt-1">You may upgrade or downgrade from your previous plan.</p>
                    </div>

                    <div>
                        <label class="label">Payment Method *</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="cash" class="sr-only peer" checked>
                                <div class="card border-2 p-4 text-center transition-all
                                        peer-checked:border-red-600 peer-checked:bg-red-950"
                                    style="border-color:#3a3a3a;">
                                    <div class="text-2xl mb-1">💵</div>
                                    <div class="condensed font-bold text-xs uppercase tracking-wider">Cash</div>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="gcash" class="sr-only peer">
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
                        Process Renewal →
                    </button>

                </form>
            </div>

            {{-- RIGHT: How it works --}}
            <div class="space-y-5">

                <div class="card p-7">
                    <h3 class="display text-white text-xl mb-5">HOW RENEWAL WORKS</h3>
                    <ol class="space-y-4">
                        @php
                        $steps = [
                        'Staff checks your current plan expiry date in the system.',
                        'Select your renewal plan — upgrade or downgrade anytime.',
                        'Settle payment via cash or GCash at the branch.',
                        'Membership expiry is automatically extended by the stored procedure.',
                        'A receipt is issued and your record updates instantly.',
                        ];
                        @endphp
                        @foreach($steps as $i => $step)
                        <li class="flex gap-3 text-sm text-gray-400">
                            <span class="display text-xl flex-shrink-0" style="color:var(--red);">{{ $i + 1 }}</span>
                            <span class="mt-1">{{ $step }}</span>
                        </li>
                        @endforeach
                    </ol>
                </div>

                <div class="card p-6">
                    <h3 class="display text-white text-lg mb-2">EXPIRY EXTENSION LOGIC</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        If your membership is still active, the new plan duration is added on top of
                        your current expiry date. If expired, renewal starts from today.
                    </p>
                </div>

                <div class="card p-6">
                    <h3 class="display text-white text-lg mb-2">TRIGGER NOTE</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        When payment is recorded, <code class="text-xs" style="color:var(--red);">trg_after_payment_insert</code>
                        fires automatically — logging the status change to the audit table without any extra code.
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection