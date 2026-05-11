@extends('admin.layouts.app')
@section('title', 'View Member')
@section('page-title', 'Member Details')
@section('page-subtitle', 'Full information for this member')

@section('content')

<div class="max-w-3xl">

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden mb-6">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-red-600 flex items-center justify-content text-white font-bold text-lg flex items-center justify-center">
                    {{ strtoupper(substr($member->first_name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">{{ $member->first_name }} {{ $member->last_name }}</h2>
                    <p class="text-sm text-gray-500">{{ $member->email }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                @if($member->status === 'active')
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                @elseif($member->status === 'expired')
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Expired</span>
                @else
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Pending</span>
                @endif
                @if($member->payment_status === 'paid')
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Paid</span>
                @else
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">Unpaid</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-2 gap-0">
            <div class="px-6 py-4 border-b border-r border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Phone</p>
                <p class="text-sm font-medium text-gray-800">{{ $member->phone ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Address</p>
                <p class="text-sm font-medium text-gray-800">{{ $member->address ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-r border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Branch</p>
                <p class="text-sm font-medium text-gray-800">{{ $member->branch?->branch_name ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Plan</p>
                <p class="text-sm font-medium text-gray-800">{{ $member->plan?->plan_name ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-r border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Membership Start</p>
                <p class="text-sm font-medium text-gray-800">{{ $member->membership_start?->format('F d, Y') ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Membership End</p>
                <p class="text-sm font-medium text-gray-800">{{ $member->membership_end?->format('F d, Y') ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-r border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Reference No.</p>
                <p class="text-sm font-mono font-medium text-gray-800">{{ $member->reference_no ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Last Check-In</p>
                <p class="text-sm font-medium text-gray-800">{{ $member->last_checkin?->format('F d, Y') ?? 'Never' }}</p>
            </div>
            <div class="px-6 py-4 border-r border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Registered</p>
                <p class="text-sm font-medium text-gray-800">{{ $member->created_at->format('F d, Y') }}</p>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.members.edit', $member->member_id) }}"
            class="bg-blue-50 text-blue-600 border border-blue-200 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-600 hover:text-white transition-colors">
            Edit Member
        </a>
        @if($member->payment_status === 'unpaid')
        <form action="{{ route('admin.members.markPaid', $member->member_id) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                ✓ Mark as Paid
            </button>
        </form>
        @endif
        <a href="{{ route('admin.members.index') }}"
            class="bg-gray-100 text-gray-700 border border-gray-200 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors">
            ← Back to Members
        </a>
    </div>

</div>

@endsection