@extends('admin.layouts.app')
@section('title', 'Members')
@section('page-title', 'Members')
@section('page-subtitle', 'Manage all registered gym members')

@section('content')

{{-- Header Section --}}
<div class="flex justify-between items-center mb-6">
    <div></div>
    {{-- Fix 2 — Block Add Button for Super Admin (Tailwind Styled) --}}
    @if(Auth::user()->isBranchAdmin())
    <a href="{{ route('admin.members.create') }}"
        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors flex items-center gap-2">
        + Add Member
    </a>
    @endif
</div>

{{-- Table Card --}}
<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Member</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Branch</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Plan</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Payment</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Reference</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($members as $member)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="font-semibold text-gray-900">{{ $member->first_name }} {{ $member->last_name }}</div>
                    <div class="text-xs text-gray-400 mt-0.5">{{ $member->email }}</div>
                    <div class="text-xs text-gray-400">{{ $member->phone }}</div>
                </td>
                <td class="px-5 py-4 text-sm text-gray-600">
                    {{ $member->branch?->branch_name ?? '—' }}
                </td>
                <td class="px-5 py-4 text-sm text-gray-600">
                    {{ $member->plan?->plan_name ?? '—' }}
                </td>
                <td class="px-5 py-4">
                    @if($member->status === 'active')
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                    @elseif($member->status === 'expired')
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Expired</span>
                    @else
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Pending</span>
                    @endif
                </td>
                <td class="px-5 py-4">
                    @if($member->payment_status === 'paid')
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Paid</span>
                    @else
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">Unpaid</span>
                    @endif
                </td>
                <td class="px-5 py-4 text-xs text-gray-500 font-mono">
                    {{ $member->reference_no }}
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-2">
                        {{-- View is always visible --}}
                        <a href="{{ route('admin.members.show', $member->member_id) }}"
                            class="bg-green-50 text-green-700 border border-green-200 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-green-600 hover:text-white transition-colors">
                            View
                        </a>

                        {{-- Fix 2 — Restricted Actions for Branch Admins Only --}}
                        @if(Auth::user()->isBranchAdmin())
                        <a href="{{ route('admin.members.edit', $member->member_id) }}"
                            class="bg-blue-50 text-blue-600 border border-blue-200 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-600 hover:text-white transition-colors">
                            Edit
                        </a>

                        @if($member->payment_status === 'unpaid')
                        <form action="{{ route('admin.members.markPaid', $member->member_id) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-700 transition-colors">
                                ✓ Mark Paid
                            </button>
                        </form>
                        @endif

                        <form action="{{ route('admin.members.destroy', $member->member_id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Delete this member?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-600 hover:text-white transition-colors">
                                Delete
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-5 py-12 text-center text-gray-400">
                    No members found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if($members->hasPages())
    <div class="px-5 py-4 border-t border-gray-200 bg-gray-50">
        {{ $members->links() }}
    </div>
    @endif
</div>

@endsection