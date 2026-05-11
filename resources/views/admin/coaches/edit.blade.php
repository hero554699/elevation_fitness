@extends('admin.layouts.app')
@section('title', 'Edit Coach')
@section('page-title', 'Edit Coach')
@section('page-subtitle', 'Update coach information')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white border border-gray-200 rounded-xl p-8">

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
            @foreach($errors->all() as $error)
            <div class="text-sm">⚠ {{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form action="{{ route('admin.coaches.update', $coach->coach_id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">First Name *</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $coach->first_name) }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Last Name *</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $coach->last_name) }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                        required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $coach->email) }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $coach->phone) }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Specialty *</label>
                <select name="specialty"
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                    required>
                    <option value="">— Select Specialty —</option>
                    @foreach($specialties as $specialty)
                    <option value="{{ $specialty }}" {{ old('specialty', $coach->specialty) === $specialty ? 'selected':'' }}>
                        {{ $specialty }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Branch *</label>
                    <select name="branch_id"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                        required>
                        <option value="">— Select Branch —</option>
                        @foreach($branches as $branch)
                        <option value="{{ $branch->branch_id }}" {{ old('branch_id', $coach->branch_id) == $branch->branch_id ? 'selected':'' }}>
                            {{ $branch->branch_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Date Hired</label>
                    <input type="date" name="date_hired" value="{{ old('date_hired', $coach->date_hired?->format('Y-m-d')) }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Bio</label>
                <textarea name="bio" rows="3"
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 resize-none">{{ old('bio', $coach->bio) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Certifications (PDF, JPG, or PNG)</label>
                @if($coach->certification_path)
                <div class="mb-2 flex items-center gap-3 p-3 bg-gray-50 border border-gray-200 rounded-lg">
                    <span class="text-xs text-gray-500">Current file:</span>
                    <a href="{{ asset($coach->certification_path) }}"
                        target="_blank"
                        class="text-xs text-red-600 font-semibold hover:underline">
                        View Current File
                    </a>
                </div>
                @endif
                <input type="file" name="certification_file"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 border border-gray-200 rounded-lg p-1 focus:outline-none">
                <p class="mt-1 text-xs text-gray-500">Leave blank to keep the current file. Maximum file size: 2MB</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status *</label>
                <select name="status"
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                    required>
                    <option value="active" {{ old('status', $coach->status) === 'active'   ? 'selected':'' }}>Active</option>
                    <option value="inactive" {{ old('status', $coach->status) === 'inactive' ? 'selected':'' }}>Inactive</option>
                </select>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-red-600 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                    Update Coach
                </button>
                <a href="{{ route('admin.coaches.index') }}"
                    class="bg-gray-100 text-gray-700 border border-gray-200 px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection