@extends('admin.layouts.app')
@section('title', 'Edit Worker')
@section('page-title', 'Edit Worker')
@section('page-subtitle', 'Update worker information')

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

        <form action="{{ route('admin.workers.update', $worker->worker_id) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">First Name *</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $worker->first_name) }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Last Name *</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $worker->last_name) }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                        required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email', $worker->email) }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $worker->phone) }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Position *</label>
                <select name="position"
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                    required>
                    <option value="">— Select Position —</option>
                    @foreach($positions as $position)
                    <option value="{{ $position }}" {{ old('position', $worker->position) === $position ? 'selected':'' }}>
                        {{ $position }}
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
                        <option value="{{ $branch->branch_id }}" {{ old('branch_id', $worker->branch_id) == $branch->branch_id ? 'selected':'' }}>
                            {{ $branch->branch_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Date Hired</label>
                    <input type="date" name="date_hired" value="{{ old('date_hired', $worker->date_hired?->format('Y-m-d')) }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status *</label>
                <select name="status"
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100"
                    required>
                    <option value="active" {{ old('status', $worker->status) === 'active'   ? 'selected':'' }}>Active</option>
                    <option value="inactive" {{ old('status', $worker->status) === 'inactive' ? 'selected':'' }}>Inactive</option>
                </select>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-red-600 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                    Update Worker
                </button>
                <a href="{{ route('admin.workers.index') }}"
                    class="bg-gray-100 text-gray-700 border border-gray-200 px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection