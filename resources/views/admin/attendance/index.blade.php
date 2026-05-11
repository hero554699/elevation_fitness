@extends('admin.layouts.app')
@section('title', 'Attendance')
@section('page-title', 'Attendance')
@section('page-subtitle', 'Manage member check-ins')

@section('content')

{{-- Header Section --}}
<div class="flex justify-between items-center mb-6">
    <div></div>
    <a href="{{ route('admin.attendance.create') }}"
        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors flex items-center gap-2">
        + New Check-In
    </a>
</div>

{{-- Success Message --}}
@if(session('success'))
<div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
    ✅ {{ session('success') }}
</div>
@endif

{{-- Table Card --}}
<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Member</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Branch</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Check-in Date</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Check-in Time</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Created At</th>
                <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($attendances as $attendance)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="font-semibold text-gray-900">{{ $attendance->member?->first_name }} {{ $attendance->member?->last_name }}</div>
                    <div class="text-xs text-gray-400 mt-0.5">{{ $attendance->member?->email ?? '—' }}</div>
                </td>
                <td class="px-5 py-4 text-sm text-gray-600">
                    {{ $attendance->branch?->branch_name ?? '—' }}
                </td>
                <td class="px-5 py-4 text-sm text-gray-600">
                    {{ \Carbon\Carbon::parse($attendance->check_in_date)->format('M d, Y') }}
                </td>
                <td class="px-5 py-4 text-sm text-gray-600">
                    {{ $attendance->check_in_time }}
                </td>
                <td class="px-5 py-4 text-xs text-gray-500">
                    {{ $attendance->created_at->format('M d, Y H:i') }}
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.attendance.edit', $attendance->attendance_id) }}"
                            class="bg-blue-50 text-blue-600 border border-blue-200 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-600 hover:text-white transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('admin.attendance.destroy', $attendance->attendance_id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Delete this check-in?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-600 hover:text-white transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                    No check-in records found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if($attendances->hasPages())
    <div class="px-5 py-4 border-t border-gray-200 bg-gray-50">
        {{ $attendances->links() }}
    </div>
    @endif
</div>

@endsection