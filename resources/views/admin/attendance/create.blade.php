@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-2xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6">
            <a href="{{ route('admin.attendance.index') }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">← Back to Attendance</a>
            <h1 class="text-3xl font-bold text-gray-900 mt-2">Record New Check-In</h1>
            <p class="mt-2 text-sm text-gray-600">Register a member's check-in to the gym</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
        <div class="mb-4 px-4 py-3 rounded-md bg-red-50 border border-red-200">
            <h3 class="text-red-800 font-medium text-sm mb-2">Please fix the following errors:</h3>
            <ul class="list-disc list-inside text-red-700 text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Check-In Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.attendance.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Branch Selection -->
                <div>
                    <label for="branch_id" class="block text-sm font-medium text-gray-700">Branch <span class="text-red-600">*</span></label>
                    <select id="branch_id" name="branch_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2" required onchange="loadMembers()">
                        <option value="">-- Select a branch --</option>
                        @foreach ($branches as $branch)
                        <option value="{{ $branch->branch_id }}" {{ old('branch_id') == $branch->branch_id ? 'selected' : '' }}>
                            {{ $branch->branch_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('branch_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Member Selection -->
                <div>
                    <label for="member_id" class="block text-sm font-medium text-gray-700">Member <span class="text-red-600">*</span></label>
                    <select id="member_id" name="member_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2" required>
                        <option value="">-- Select a member --</option>
                        @if (old('member_id'))
                        <option value="{{ old('member_id') }}" selected>
                            Member ID: {{ old('member_id') }}
                        </option>
                        @endif
                    </select>
                    @error('member_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Check-In Date -->
                <div>
                    <label for="check_in_date" class="block text-sm font-medium text-gray-700">Check-In Date <span class="text-red-600">*</span></label>
                    <input type="date" id="check_in_date" name="check_in_date" value="{{ old('check_in_date', now()->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2" required>
                    @error('check_in_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Check-In Time -->
                <div>
                    <label for="check_in_time" class="block text-sm font-medium text-gray-700">Check-In Time <span class="text-red-600">*</span></label>
                    <input type="time" id="check_in_time" name="check_in_time" value="{{ old('check_in_time', now()->format('H:i')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2" required>
                    @error('check_in_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex gap-3 pt-6 border-t">
                    <button type="submit" class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Record Check-In
                    </button>
                    <a href="{{ route('admin.attendance.index') }}" class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function loadMembers() {
        const branchId = document.getElementById('branch_id').value;
        const memberSelect = document.getElementById('member_id');

        if (!branchId) {
            memberSelect.innerHTML = '<option value="">-- Select a member --</option>';
            return;
        }

        fetch(`{{ route('admin.attendance.getMembersByBranch') }}?branch_id=${branchId}`)
            .then(response => response.json())
            .then(data => {
                memberSelect.innerHTML = '<option value="">-- Select a member --</option>';
                data.forEach(member => {
                    const option = document.createElement('option');
                    option.value = member.id;
                    option.textContent = `${member.name} (${member.email})`;
                    memberSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
</script>
@endsection