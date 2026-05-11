@extends('admin.layouts.app')
@section('title', 'Edit Coach')
@section('page-title', 'Edit Coach')
@section('page-subtitle', 'Update coach information')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">

        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 m-6">
            <div class="flex items-start">
                <div class="text-red-500 text-xl mr-3">⚠️</div>
                <div>
                    <h3 class="text-red-800 font-semibold mb-2">Validation Errors</h3>
                    <ul class="text-red-700 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('admin.coaches.update', $coach) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')

            <!-- Header Info Card -->
            <div class="mb-8 p-4 bg-purple-50 border border-purple-200 rounded-lg">
                <div class="flex items-start justify-between">
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">✏️</span>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Update Coach Information</h3>
                            <p class="text-sm text-gray-600">Editing coach <strong>{{ $coach->first_name }} {{ $coach->last_name }}</strong> | ID: <code class="bg-purple-100 px-2 py-1 rounded text-xs">{{ $coach->coach_id }}</code></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: Basic Information -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">📋</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Basic Information</h2>
                        <p class="text-sm text-gray-500">Coach's personal details</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="first_name" value="{{ old('first_name', $coach->first_name) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., Juan" required>
                            <p class="text-xs text-gray-500 mt-1">Coach's first name</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="last_name" value="{{ old('last_name', $coach->last_name) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., Cruz" required>
                            <p class="text-xs text-gray-500 mt-1">Coach's last name</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: Contact Details -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">📞</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Contact Details</h2>
                        <p class="text-sm text-gray-500">Communication information</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', $coach->email) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., juan@gym.com" required>
                            <p class="text-xs text-gray-500 mt-1">Professional email address</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $coach->phone) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., 09123456789">
                            <p class="text-xs text-gray-500 mt-1">Mobile number for contact</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: Expertise & Specialization -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">⚡</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Expertise & Specialization</h2>
                        <p class="text-sm text-gray-500">Coach's specialization and experience</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Specialty <span class="text-red-500">*</span>
                        </label>
                        <select name="specialty"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                            required>
                            <option value="">— Select Specialty —</option>
                            @foreach($specialties as $specialty)
                            <option value="{{ $specialty }}" {{ old('specialty', $coach->specialty) === $specialty ? 'selected':'' }}>
                                {{ $specialty }}
                            </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Primary area of expertise (Yoga, CrossFit, Cardio, etc.)</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
                        <textarea name="bio" rows="4"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition resize-none"
                            placeholder="Brief bio or professional background...">{{ old('bio', $coach->bio) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Coach's background, experience, and achievements</p>
                    </div>
                </div>
            </div>

            <!-- SECTION: Assignment & Employment -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">🏋️</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Assignment & Employment</h2>
                        <p class="text-sm text-gray-500">Branch assignment and employment details</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Branch <span class="text-red-500">*</span>
                            </label>
                            <select name="branch_id"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                required>
                                <option value="">— Select Branch —</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->branch_id }}" {{ old('branch_id', $coach->branch_id) == $branch->branch_id ? 'selected':'' }}>
                                    {{ $branch->branch_name }}
                                </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Primary workplace branch</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Date Hired</label>
                            <input type="date" name="date_hired" value="{{ old('date_hired', $coach->date_hired) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition">
                            <p class="text-xs text-gray-500 mt-1">Employment start date</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: Certifications -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">📜</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Certifications</h2>
                        <p class="text-sm text-gray-500">Professional credentials and certifications</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    @if($coach->certification_file)
                    <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-700">
                            📎 <strong>Current file:</strong> <a href="{{ asset('storage/' . $coach->certification_file) }}" target="_blank" class="underline">View Certificate</a>
                        </p>
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Update Certification File <span class="text-gray-500 text-xs">(Optional)</span>
                        </label>
                        <div class="relative">
                            <input type="file" name="certification_file"
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2.5 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-red-50 file:text-red-700
                                hover:file:bg-red-100 file:cursor-pointer">
                        </div>
                        <p class="text-xs text-gray-500 mt-2">📎 Accepted formats: PDF, JPG, PNG | Maximum size: 2MB | Leave empty to keep current file</p>
                    </div>
                </div>
            </div>

            <!-- SECTION: Status -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">✅</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Employment Status</h2>
                        <p class="text-sm text-gray-500">Current employment status</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                            required>
                            <option value="active" {{ old('status', $coach->status) === 'active' ? 'selected':'' }}>
                                ✅ Active - Currently employed
                            </option>
                            <option value="inactive" {{ old('status', $coach->status) === 'inactive' ? 'selected':'' }}>
                                ❌ Inactive - Not employed
                            </option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Coach availability status</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <button type="submit"
                    class="bg-red-600 text-white px-8 py-2.5 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                    💾 Update Coach
                </button>
                <a href="{{ route('admin.coaches.show', $coach) }}"
                    class="bg-gray-100 text-gray-700 border border-gray-300 px-8 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors">
                    ← Back
                </a>
            </div>

        </form>
    </div>
</div>

@endsection