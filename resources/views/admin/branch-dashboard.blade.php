@extends('admin.layouts.app')
@section('title', 'Branch Dashboard')
@section('page-title', Auth::user()->branch?->branch_name . ' — Dashboard')
@section('page-subtitle', 'Overview of your branch operations')

@section('content')

<!-- Enhanced Stat Cards Grid (2 rows x 3 columns) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <!-- Card 1: Total Members -->
    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-red-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total Members</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalMembers) }}</p>
                <p class="text-xs text-gray-400 mt-2">{{ $activeMembers }} active members</p>
            </div>
            <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center text-2xl">👥</div>
        </div>
    </div>

    <!-- Card 2: Pending Payments -->
    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-orange-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Pending Payments</p>
                <p class="text-3xl font-bold text-orange-600 mt-2">{{ $pendingPayments }}</p>
                <p class="text-xs text-gray-400 mt-2">Awaiting confirmation</p>
            </div>
            <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center text-2xl">⏳</div>
        </div>
    </div>

    <!-- Card 3: Branch Revenue -->
    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-green-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Branch Revenue</p>
                <p class="text-3xl font-bold text-green-600 mt-2">₱{{ number_format($totalRevenue, 2) }}</p>
                <p class="text-xs text-gray-400 mt-2">Total all-time</p>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-2xl">💰</div>
        </div>
    </div>

    <!-- Card 4: Active Workers -->
    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-blue-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Active Workers</p>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalWorkers }}</p>
                <p class="text-xs text-gray-400 mt-2">On your branch</p>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-2xl">🧑‍💼</div>
        </div>
    </div>

    <!-- Card 5: Active Coaches -->
    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-purple-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Active Coaches</p>
                <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalCoaches }}</p>
                <p class="text-xs text-gray-400 mt-2">On your branch</p>
            </div>
            <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center text-2xl">🏋️</div>
        </div>
    </div>

    <!-- Card 6: Current Date & Time (NEW!) -->
    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-indigo-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Current Date & Time</p>
                <p class="text-2xl font-bold text-indigo-600 mt-2" id="current-date">{{ now()->format('M d, Y') }}</p>
                <p class="text-lg font-semibold text-indigo-600" id="current-time">{{ now()->format('H:i:s') }}</p>
                <p class="text-xs text-gray-400 mt-2">Last updated now</p>
            </div>
            <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center text-2xl">🕐</div>
        </div>
    </div>

</div>

<!-- JavaScript for Real-Time Clock -->
<script>
    function updateDateTime() {
        const now = new Date();
        const dateString = now.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
        const timeString = now.toLocaleTimeString('en-US', {
            hour12: false,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        document.getElementById('current-date').textContent = dateString;
        document.getElementById('current-time').textContent = timeString;
    }

    // Update immediately
    updateDateTime();

    // Update every second
    setInterval(updateDateTime, 1000);
</script>

<!-- Recent Members Table -->
<div class="bg-white rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-900">Recent Member Signups — {{ Auth::user()->branch?->branch_name }}</h2>
        <a href="{{ route('admin.members.index') }}" class="text-sm text-red-600 font-semibold hover:text-red-700">View all →</a>
    </div>
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Plan</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Payment</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentMembers as $member)
            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">{{ $member->first_name }} {{ $member->last_name }}</div>
                    <div class="text-xs text-gray-400">{{ $member->email }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $member->plan?->plan_name ?? '—' }}</td>
                <td class="px-6 py-4">
                    @if($member->status === 'active')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">✓ Active</span>
                    @elseif($member->status === 'expired')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">✗ Expired</span>
                    @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-50 text-yellow-700">⏳ Pending</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if($member->payment_status === 'paid')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">✓ Paid</span>
                    @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">✗ Unpaid</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm space-x-2">
                    @if($member->payment_status === 'unpaid')
                    <form action="{{ route('admin.members.markPaid', $member->member_id) }}" method="POST" style="display:inline;">
                        @csrf @method('PATCH')
                        <button type="submit" class="text-blue-600 hover:text-blue-800 font-semibold">Mark Paid</button>
                    </form>
                    @endif
                    <a href="{{ route('admin.members.show', $member->member_id) }}" class="text-gray-600 hover:text-gray-900 font-semibold">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-gray-400 py-8">No members yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection