@extends('layouts.app')
@section('title', 'Payments — Elevation Fitness Gym')

@section('content')
<div class="py-20" style="background:#0a0a0a;">
    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-12">
            <div class="flex items-center gap-3 mb-3">
                <div style="height:2px;width:40px;background:var(--red);"></div>
                <span class="condensed text-xs tracking-widest uppercase" style="color:var(--red);">Financial Records</span>
            </div>
            <h1 class="display text-white" style="font-size:3.8rem;">PAYMENT HISTORY</h1>
            <p class="text-gray-500 text-sm mt-2">Consolidated payment records across all branches.</p>
        </div>

        {{-- Summary cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-12">

            <div class="card p-6 red-glow" style="border-color:var(--red);">
                <div class="condensed text-gray-500 text-xs uppercase tracking-widest mb-2">Total Revenue</div>
                <div class="display text-white" style="font-size:2.5rem;">
                    ₱{{ number_format($totalRevenue, 2) }}
                </div>
            </div>

            <div class="card p-6">
                <div class="condensed text-gray-500 text-xs uppercase tracking-widest mb-2">Today's Revenue</div>
                <div class="display" style="font-size:2.5rem; color:var(--red);">
                    ₱{{ number_format($todayRevenue, 2) }}
                </div>
            </div>

            <div class="card p-6">
                <div class="condensed text-gray-500 text-xs uppercase tracking-widest mb-2">Total Transactions</div>
                <div class="display text-white" style="font-size:2.5rem;">
                    {{ number_format($totalPayments) }}
                </div>
            </div>

        </div>

        {{-- Payments table --}}
        <div class="card overflow-hidden">
            <div class="px-6 py-4" style="border-bottom:1px solid #2a2a2a;">
                <h2 class="display text-white text-xl">TRANSACTION RECORDS</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr style="background:#161616; border-bottom:1px solid #2a2a2a;">
                            <th class="text-left px-5 py-3 condensed text-xs uppercase tracking-widest text-gray-500">Receipt No.</th>
                            <th class="text-left px-5 py-3 condensed text-xs uppercase tracking-widest text-gray-500">Member</th>
                            <th class="text-left px-5 py-3 condensed text-xs uppercase tracking-widest text-gray-500">Plan</th>
                            <th class="text-left px-5 py-3 condensed text-xs uppercase tracking-widest text-gray-500">Type</th>
                            <th class="text-left px-5 py-3 condensed text-xs uppercase tracking-widest text-gray-500">Method</th>
                            <th class="text-right px-5 py-3 condensed text-xs uppercase tracking-widest text-gray-500">Amount</th>
                            <th class="text-left px-5 py-3 condensed text-xs uppercase tracking-widest text-gray-500">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr style="border-bottom:1px solid #1a1a1a;" class="hover:bg-gray-900 transition-colors">

                            <td class="px-5 py-4">
                                <span class="condensed text-xs font-bold" style="color:var(--red);">
                                    {{ $payment->receipt_no }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-white font-medium">{{ $payment->member_name }}</td>

                            <td class="px-5 py-4 text-gray-400">{{ $payment->plan_name }}</td>

                            <td class="px-5 py-4">
                                @php
                                $badge = [
                                'registration' => 'background:rgba(59,130,246,.15); color:#93c5fd; border:1px solid rgba(59,130,246,.3);',
                                'renewal' => 'background:rgba(34,197,94,.15); color:#86efac; border:1px solid rgba(34,197,94,.3);',
                                'day_pass' => 'background:rgba(234,179,8,.15); color:#fde047; border:1px solid rgba(234,179,8,.3);',
                                'trainer' => 'background:rgba(168,85,247,.15); color:#d8b4fe; border:1px solid rgba(168,85,247,.3);',
                                ];
                                $style = $badge[$payment->payment_type] ?? 'background:#222; color:#aaa;';
                                @endphp
                                <span class="condensed text-xs font-bold uppercase tracking-wider px-2 py-1 rounded-sm"
                                    style="{{ $style }}">
                                    {{ str_replace('_', ' ', $payment->payment_type) }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-gray-400 capitalize">{{ $payment->payment_method }}</td>

                            <td class="px-5 py-4 text-right text-white font-semibold">
                                ₱{{ number_format($payment->amount, 2) }}
                            </td>

                            <td class="px-5 py-4 text-gray-500">
                                {{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-gray-600">
                                No payment records found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($payments->hasPages())
            <div class="px-6 py-4" style="border-top:1px solid #2a2a2a;">
                {{ $payments->links() }}
            </div>
            @endif

        </div>

    </div>
</div>
@endsection