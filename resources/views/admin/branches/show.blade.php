@extends('admin.layouts.app')
@section('title', $branch->branch_name)
@section('page-title', $branch->branch_name)
@section('page-subtitle', $branch->location)

@section('content')

<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-white border border-gray-200 rounded-xl p-5">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Members</p>
        <p class="text-3xl font-bold text-gray-900">{{ $totalMembers }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $activeMembers }} active</p>
    </div>
    <div class="bg-white border border-gray-200 rounded-xl p-5">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Pending Payments</p>
        <p class="text-3xl font-bold text-orange-500">{{ $pendingPayments }}</p>
        <p class="text-xs text-gray-400 mt-1">Need confirmation</p>
    </div>
    <div class="bg-white border border-gray-200 rounded-xl p-5">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Active Workers</p>
        <p class="text-3xl font-bold text-gray-900">{{ $totalWorkers }}</p>
        <p class="text-xs text-gray-400 mt-1">This branch</p>
    </div>
    <div class="bg-white border border-gray-200 rounded-xl p-5">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Active Coaches</p>
        <p class="text-3xl font-bold text-gray-900">{{ $totalCoaches }}</p>
        <p class="text-xs text-gray-400 mt-1">This branch</p>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-sm font-bold text-gray-900">Members</h2>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Plan</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Payment</th>
                </tr>
            </thead>
            <tbody>
                @forelse($branch->members as $member)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-5 py-3">
                        <div class="text-sm font-semibold text-gray-900">{{ $member->first_name }} {{ $member->last_name }}</div>
                        <div class="text-xs text-gray-400">{{ $member->email }}</div>
                    </td>
                    <td class="px-5 py-3 text-xs text-gray-500">{{ $member->plan?->plan_name ?? '—' }}</td>
                    <td class="px-5 py-3">
                        @if($member->status === 'active')
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                        @elseif($member->status === 'expired')
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">Expired</span>
                        @else
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Pending</span>
                        @endif
                    </td>
                    <td class="px-5 py-3">
                        @if($member->payment_status === 'paid')
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">Paid</span>
                        @else
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">Unpaid</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-8 text-center text-gray-400 text-sm">No members in this branch.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="space-y-6">
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-sm font-bold text-gray-900">Workers</h2>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Position</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($branch->workers as $worker)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-5 py-3 text-sm font-medium text-gray-900">{{ $worker->first_name }} {{ $worker->last_name }}</td>
                        <td class="px-5 py-3 text-xs text-gray-500">{{ $worker->position }}</td>
                        <td class="px-5 py-3">
                            @if($worker->status === 'active')
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                            @else
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-5 py-6 text-center text-gray-400 text-sm">No workers assigned.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-sm font-bold text-gray-900">Coaches</h2>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Specialty</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($branch->coaches as $coach)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-5 py-3 text-sm font-medium text-gray-900">{{ $coach->first_name }} {{ $coach->last_name }}</td>
                        <td class="px-5 py-3 text-xs text-gray-500">{{ $coach->specialty }}</td>
                        <td class="px-5 py-3">
                            @if($coach->status === 'active')
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                            @else
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-5 py-6 text-center text-gray-400 text-sm">No coaches assigned.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="mt-6">
    <a href="{{ route('admin.branches.index') }}"
        class="bg-gray-100 text-gray-700 border border-gray-200 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors inline-flex items-center gap-2">
        ← Back to Branches
    </a>
</div>

@endsection