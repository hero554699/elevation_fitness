@extends('admin.layouts.app')
@section('title', 'View Coach')
@section('page-title', 'Coach Details')
@section('page-subtitle', 'Full information for this coach')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden mb-6">

        <div class="flex items-center gap-4 px-6 py-5 border-b border-gray-200">
            <div class="w-12 h-12 rounded-full bg-red-600 flex items-center justify-center text-white font-bold text-lg">
                {{ strtoupper(substr($coach->first_name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900">{{ $coach->first_name }} {{ $coach->last_name }}</h2>
                <p class="text-sm text-gray-500">{{ $coach->specialty }}</p>
            </div>
            <div class="ml-auto">
                @if($coach->status === 'active')
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                @else
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">Inactive</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-2">
            <div class="px-6 py-4 border-b border-r border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Email</p>
                <p class="text-sm font-medium text-gray-800">{{ $coach->email ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Phone</p>
                <p class="text-sm font-medium text-gray-800">{{ $coach->phone ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-r border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Branch</p>
                <p class="text-sm font-medium text-gray-800">{{ $coach->branch?->branch_name ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Date Hired</p>
                <p class="text-sm font-medium text-gray-800">{{ $coach->date_hired?->format('F d, Y') ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-r border-gray-100 col-span-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Bio</p>
                <p class="text-sm font-medium text-gray-800">{{ $coach->bio ?? '—' }}</p>
            </div>
            <div class="px-6 py-4 border-b border-r border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Certification File</p>
                @if($coach->certification_path)
                <a href="{{ asset('storage/' . $coach->certification_path) }}"
                    target="_blank"
                    class="text-sm font-semibold text-red-600 hover:underline">
                    View File
                </a>
                @else
                <p class="text-sm text-gray-400">No file uploaded</p>
                @endif
            </div>
            <div class="px-6 py-4 border-b border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Date Added</p>
                <p class="text-sm font-medium text-gray-800">{{ $coach->created_at->format('F d, Y') }}</p>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.coaches.edit', $coach->coach_id) }}"
            class="bg-blue-50 text-blue-600 border border-blue-200 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-600 hover:text-white transition-colors">
            Edit Coach
        </a>
        <a href="{{ route('admin.coaches.index') }}"
            class="bg-gray-100 text-gray-700 border border-gray-200 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors">
            ← Back to Coaches
        </a>
    </div>
</div>

@endsection