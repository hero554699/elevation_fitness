@extends('admin.layouts.app')
@section('title', 'New Check-In')
@section('page-title', 'New Check-In')
@section('page-subtitle', 'Record a new member check-in')

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

        <form action="{{ route('admin.attendance.store') }}" method="POST" class="p-8">
            @csrf

            <!-- Header Info Card -->
            <div class="mb-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-start">
                    <span class="text-2xl mr-3">📋</span>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">New Check-In Record</h3>
                        <p class="text-sm text-gray-600">Fill in the details below to record a member check-in. Required fields are marked with <span class="text-red-500 font-bold">*</span></p>
                    </div>
                </div>
            </div>

            <!-- SECTION: Check-In Details -->
            <div class="mb-8">
                <div class="flex items-center mb-5">
                    <span class="text-2xl mr-3">⏱️</span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Check-In Details</h2>
                        <p class="text-sm text-gray-500">Select member and record check-in time</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-5">
                    <div class="grid grid-cols-2 gap-5">
                        <!-- BRANCH FIELD -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Branch <span class="text-red-500">*</span>
                            </label>

                            @if(Auth::user()->isBranchAdmin())
                            <!-- Branch Admin: Show as disabled text input -->
                            <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm bg-gray-100 cursor-not-allowed" disabled value="{{ Auth::user()->branch?->branch_name ?? 'N/A' }}">
                            <input type="hidden" name="branch_id" value="{{ Auth::user()->branch_id }}">
                            <p class="text-xs text-gray-500 mt-1">Your branch (auto-assigned)</p>
                            @else
                            <!-- Super Admin: Show dropdown -->
                            <select id="branch_id" name="branch_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition" required>
                                <option value="">— Select Branch —</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->branch_id }}">
                                    {{ $branch->branch_name }}
                                </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Select member's branch</p>
                            @endif
                        </div>

                        <!-- MEMBER FIELD -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Member <span class="text-red-500">*</span>
                            </label>
                            <select id="member_id" name="member_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition" required @if(Auth::user()->isBranchAdmin()) @else disabled @endif>
                                <option value="">— Select Member —</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Active members from selected branch</p>
                        </div>
                    </div>

                    <!-- DATE AND TIME -->
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Check-In Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="check_in_date"
                                value="{{ old('check_in_date', date('Y-m-d')) }}"
                                min="{{ date('Y-m-d') }}"
                                max="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition" required>
                            <p class="text-xs text-gray-500 mt-1">Today only (no past/future dates)</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Check-In Time <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="check_in_time" value="{{ old('check_in_time', date('H:i')) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition" required>
                            <p class="text-xs text-gray-500 mt-1">Time of check-in</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="bg-red-600 text-white px-8 py-2.5 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                    ✅ Record Check-In
                </button>
                <a href="{{ route('admin.attendance.index') }}" class="bg-gray-100 text-gray-700 border border-gray-300 px-8 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors">
                    ✕ Cancel
                </a>
            </div>

        </form>
    </div>
</div>

<!-- AJAX Script for Loading Members -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const branchSelect = document.getElementById('branch_id');
        const memberSelect = document.getElementById('member_id');

        // If Super Admin: Load members when branch changes
        if (branchSelect) {
            branchSelect.addEventListener('change', function() {
                loadMembers(this.value);
            });
        }
        // If Branch Admin: Load members on page load
        else {
            const branchInput = document.querySelector('input[name="branch_id"]');
            if (branchInput) {
                loadMembers(branchInput.value);
            }
        }

        function loadMembers(branchId) {
            if (!branchId) {
                memberSelect.innerHTML = '<option value="">— Select Member —</option>';
                memberSelect.disabled = true;
                return;
            }

            fetch(`{{ route('admin.attendance.getMembersByBranch') }}?branch_id=${branchId}`)
                .then(response => response.json())
                .then(data => {
                    let html = '<option value="">— Select Member —</option>';
                    data.forEach(member => {
                        html += `<option value="${member.id}">${member.name} (${member.email})</option>`;
                    });
                    memberSelect.innerHTML = html;
                    memberSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error loading members:', error);
                    memberSelect.innerHTML = '<option value="">Error loading members</option>';
                    memberSelect.disabled = true;
                });
        }
    });
</script>

@endsection