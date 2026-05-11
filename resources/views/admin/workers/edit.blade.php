@extends('admin.layouts.app')
@section('title', 'Edit Worker')
@section('page-title', 'Edit Worker')
@section('page-subtitle', 'Update staff information')

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

        <form action="{{ route('admin.workers.update', $worker) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <!-- Header Info Card -->
            <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-start justify-between">
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">✏️</span>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Update Staff Information</h3>
                            <p class="text-sm text-gray-600">Editing staff member <strong>{{ $worker->first_name }} {{ $worker->last_name }}</strong> | ID: <code class="bg-green-100 px-2 py-1 rounded text-xs">{{ $worker->worker_id }}</code></p>
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
                        <p class="text-sm text-gray-500">Staff member's personal details</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="first_name" value="{{ old('first_name', $worker->first_name) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., Maria" required>
                            <p class="text-xs text-gray-500 mt-1">Staff member's first name</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="last_name" value="{{ old('last_name', $worker->last_name) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., Santos" required>
                            <p class="text-xs text-gray-500 mt-1">Staff member's last name</p>
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
                            <input type="email" name="email" value="{{ old('email', $worker->email) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., maria@gym.com" required>
                            <p class="text-xs text-gray-500 mt-1">Professional email address</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $worker->phone) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                                placeholder="e.g., 09123456789">
                            <p class="text-xs text-gray-500 mt-1">Mobile number for contact</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: Position & Assignment -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">💼</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Position & Assignment</h2>
                        <p class="text-sm text-gray-500">Staff role and workplace assignment</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Position <span class="text-red-500">*</span>
                        </label>
                        <select name="position"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition"
                            required>
                            <option value="">— Select Position —</option>
                            @foreach($positions as $position)
                            <option value="{{ $position }}" {{ old('position', $worker->position) === $position ? 'selected':'' }}>
                                {{ $position }}
                            </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Job position or role in the gym</p>
                    </div>

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
                                <option value="{{ $branch->branch_id }}" {{ old('branch_id', $worker->branch_id) == $branch->branch_id ? 'selected':'' }}>
                                    {{ $branch->branch_name }}
                                </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Primary workplace branch</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Date Hired</label>
                            <input type="date" name="date_hired" value="{{ old('date_hired', $worker->date_hired) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition">
                            <p class="text-xs text-gray-500 mt-1">Employment start date</p>
                        </div>
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
                            <option value="active" {{ old('status', $worker->status) === 'active' ? 'selected':'' }}>
                                ✅ Active - Currently employed
                            </option>
                            <option value="inactive" {{ old('status', $worker->status) === 'inactive' ? 'selected':'' }}>
                                ❌ Inactive - Not employed
                            </option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Employee availability status</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <button type="submit"
                    class="bg-red-600 text-white px-8 py-2.5 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                    💾 Update Worker
                </button>
                <a href="{{ route('admin.workers.show', $worker) }}"
                    class="bg-gray-100 text-gray-700 border border-gray-300 px-8 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors">
                    ← Back
                </a>
            </div>

        </form>
    </div>
</div>

@endsection