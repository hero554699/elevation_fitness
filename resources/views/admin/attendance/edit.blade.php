@extends('admin.layouts.app')
@section('title', 'Edit Check-In')
@section('page-title', 'Edit Check-In')
@section('page-subtitle', 'Update check-in record')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <form action="{{ route('admin.attendance.update', $attendance->attendance_id) }}" method="POST">
            @csrf @method('PUT')

            {{-- Branch Selection --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Branch <span class="text-red-600">*</span></label>
                <select name="branch_id" id="branch_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <option value="">-- Select Branch --</option>
                    @foreach($branches as $branch)
                    <option value="{{ $branch->branch_id }}" {{ $attendance->branch_id == $branch->branch_id ? 'selected' : '' }}>
                        {{ $branch->branch_name }}
                    </option>
                    @endforeach
                </select>
                @error('branch_id')
                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Member Selection (AJAX) --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Member <span class="text-red-600">*</span></label>
                <select name="member_id" id="member_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <option value="{{ $attendance->member_id }}">{{ $attendance->member?->first_name }} {{ $attendance->member?->last_name }}</option>
                </select>
                @error('member_id')
                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Check-in Date --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Check-in Date <span class="text-red-600">*</span></label>
                <input type="date" name="check_in_date" value="{{ old('check_in_date', $attendance->check_in_date->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                @error('check_in_date')
                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Check-in Time --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Check-in Time <span class="text-red-600">*</span></label>
                <input type="time" name="check_in_time" value="{{ old('check_in_time', $attendance->check_in_time) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                @error('check_in_time')
                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Update Check-In
                </button>
                <a href="{{ route('admin.attendance.index') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // AJAX to load members by branch
    document.getElementById('branch_id').addEventListener('change', function() {
        const branchId = this.value;
        const memberSelect = document.getElementById('member_id');

        if (!branchId) {
            memberSelect.innerHTML = '<option value="">-- Select Member --</option>';
            return;
        }

        fetch(`{{ route('admin.attendance.getMembersByBranch') }}?branch_id=${branchId}`)
            .then(response => response.json())
            .then(data => {
                memberSelect.innerHTML = '<option value="">-- Select Member --</option>';
                data.forEach(member => {
                    const option = document.createElement('option');
                    option.value = member.id;
                    option.textContent = `${member.name} (${member.email})`;
                    memberSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    });

    // Load members on page load
    window.addEventListener('load', function() {
        const branchId = document.getElementById('branch_id').value;
        if (branchId) {
            const event = new Event('change');
            document.getElementById('branch_id').dispatchEvent(event);
        }
    });
</script>

@endsection