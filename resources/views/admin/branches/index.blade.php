@extends('admin.layouts.app')
@section('title', 'Branches')
@section('page-title', 'Branches')
@section('page-subtitle', 'Overview of all Elevation Fitness Gym locations')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @foreach($branches as $branch)
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition-shadow">
        <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-white font-bold text-lg">{{ $branch->branch_name }}</h3>
                    <p class="text-red-100 text-sm mt-0.5">{{ $branch->location }}</p>
                </div>
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center text-xl">
                    📍
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 divide-x divide-gray-100 border-b border-gray-100">
            <div class="px-4 py-4 text-center">
                <p class="text-2xl font-bold text-gray-900">{{ $branch->members_count }}</p>
                <p class="text-xs text-gray-400 mt-0.5 font-medium">Members</p>
            </div>
            <div class="px-4 py-4 text-center">
                <p class="text-2xl font-bold text-gray-900">{{ $branch->workers_count }}</p>
                <p class="text-xs text-gray-400 mt-0.5 font-medium">Workers</p>
            </div>
            <div class="px-4 py-4 text-center">
                <p class="text-2xl font-bold text-gray-900">{{ $branch->coaches_count }}</p>
                <p class="text-xs text-gray-400 mt-0.5 font-medium">Coaches</p>
            </div>
        </div>

        <div class="px-6 py-4">
            <a href="{{ route('admin.branches.show', $branch->branch_id) }}"
                class="w-full bg-gray-50 text-gray-700 border border-gray-200 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-600 hover:text-white hover:border-red-600 transition-colors flex items-center justify-center gap-2">
                View Branch Details →
            </a>
        </div>
    </div>
    @endforeach
</div>

@endsection