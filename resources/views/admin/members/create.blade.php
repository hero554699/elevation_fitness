@extends('admin.layouts.app')
@section('title', 'Add Member')
@section('page-title', 'Add Member')
@section('page-subtitle', 'Register a new gym member manually')

@section('content')

<div style="max-width:720px;">
    <div class="card" style="padding:32px;">

        @if($errors->any())
        <div class="alert-error" style="margin-bottom:24px;">
            @foreach($errors->all() as $error)
                <div>⚠ {{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form action="{{ route('admin.members.store') }}" method="POST">
            @csrf

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
                <div>
                    <label class="form-label">First Name *</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Last Name *</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-input" required>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
                <div>
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Phone Number *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-input" required>
                </div>
            </div>

            <div style="margin-bottom:20px;">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-input" rows="2">{{ old('address') }}</textarea>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
                <div>
                    <label class="form-label">Branch *</label>
                    <select name="branch_id" class="form-input" required>
                        <option value="">— Select Branch —</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->branch_id }}" {{ old('branch_id') == $branch->branch_id ? 'selected':'' }}>
                                {{ $branch->branch_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Membership Plan *</label>
                    <select name="plan_id" class="form-input" required>
                        <option value="">— Select Plan —</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->plan_id }}" {{ old('plan_id') == $plan->plan_id ? 'selected':'' }}>
                                {{ $plan->plan_name }} — ₱{{ number_format($plan->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:28px;">
                <div>
                    <label class="form-label">Membership Status *</label>
                    <select name="status" class="form-input" required>
                        <option value="pending"  {{ old('status','pending') === 'pending'  ? 'selected':'' }}>Pending</option>
                        <option value="active"   {{ old('status') === 'active'   ? 'selected':'' }}>Active</option>
                        <option value="expired"  {{ old('status') === 'expired'  ? 'selected':'' }}>Expired</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Payment Status *</label>
                    <select name="payment_status" class="form-input" required>
                        <option value="unpaid" {{ old('payment_status','unpaid') === 'unpaid' ? 'selected':'' }}>Unpaid</option>
                        <option value="paid"   {{ old('payment_status') === 'paid'   ? 'selected':'' }}>Paid</option>
                    </select>
                </div>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn-primary">Save Member</button>
                <a href="{{ route('admin.members.index') }}" class="btn-secondary">Cancel</a>
            </div>

        </form>
    </div>
</div>

@endsection