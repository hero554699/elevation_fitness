@extends('admin.layouts.app')
@section('title', 'Coaches')
@section('page-title', 'Coaches')
@section('page-subtitle', 'Manage all gym coaches and trainers')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div></div>
    {{-- Fix: Block Add button for Super Admin --}}
    @if(Auth::user()->isBranchAdmin())
    <a href="{{ route('admin.coaches.create') }}"
        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors flex items-center gap-2">
        + Add Coach
    </a>
    @endif
</div>

<div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Coach</th>
                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Specialty</th>
                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Branch</th>
                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date Hired</th>
                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coaches as $coach)
            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="font-semibold text-gray-900">{{ $coach->first_name }} {{ $coach->last_name }}</div>
                    <div class="text-xs text-gray-400 mt-0.5">{{ $coach->email ?? '—' }}</div>
                    <div class="text-xs text-gray-400">{{ $coach->phone ?? '—' }}</div>
                </td>
                <td class="px-5 py-4 text-sm text-gray-600">{{ $coach->specialty }}</td>
                <td class="px-5 py-4 text-sm text-gray-600">{{ $coach->branch?->branch_name ?? '—' }}</td>
                <td class="px-5 py-4 text-sm text-gray-500">
                    {{ $coach->date_hired ? \Carbon\Carbon::parse($coach->date_hired)->format('M d, Y') : '-' }}
                </td>
                <td class="px-5 py-4">
                    @if($coach->status === 'active')
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                    @else
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">Inactive</span>
                    @endif
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.coaches.show', $coach->coach_id) }}"
                            class="bg-green-50 text-green-700 border border-green-200 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-green-600 hover:text-white transition-colors">
                            View
                        </a>

                        {{-- Fix: Block Edit and Delete for Super Admin --}}
                        @if(Auth::user()->isBranchAdmin())
                        <a href="{{ route('admin.coaches.edit', $coach->coach_id) }}"
                            class="bg-blue-50 text-blue-600 border border-blue-200 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-600 hover:text-white transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('admin.coaches.destroy', $coach->coach_id) }}" method="POST"
                            onsubmit="return confirm('Delete this coach?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-600 hover:text-white transition-colors">
                                Delete
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-5 py-12 text-center text-gray-400">No coaches found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($coaches->hasPages())
    <div class="px-5 py-4 border-t border-gray-200">{{ $coaches->links() }}</div>
    @endif
</div>

@endsection