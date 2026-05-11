@extends('admin.layouts.app')
@section('title', 'Branch Dashboard')
@section('page-title', Auth::user()->branch?->branch_name . ' — Dashboard')
@section('page-subtitle', 'Overview of your branch operations')

@section('content')

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:28px;">

    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Total Members</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">{{ number_format($totalMembers) }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">{{ $activeMembers }} active</p>
            </div>
            <div style="width:48px;height:48px;background:#FEE2E2;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">👥</div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Pending Payments</p>
                <p style="font-size:32px;font-weight:700;color:var(--orange);margin-top:4px;">{{ $pendingPayments }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">Need confirmation</p>
            </div>
            <div style="width:48px;height:48px;background:#FFEDD5;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">⏳</div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Branch Revenue</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">₱{{ number_format($totalRevenue, 2) }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">All time</p>
            </div>
            <div style="width:48px;height:48px;background:#DCFCE7;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">💰</div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Active Workers</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">{{ $totalWorkers }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">This branch</p>
            </div>
            <div style="width:48px;height:48px;background:#EFF6FF;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🧑‍💼</div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Active Coaches</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">{{ $totalCoaches }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">This branch</p>
            </div>
            <div style="width:48px;height:48px;background:#F5F3FF;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🏋️</div>
        </div>
    </div>

</div>

<div style="display:grid;grid-template-columns:1fr;gap:20px;">
    <div class="card">
        <div style="padding:20px 24px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;">
            <h2 style="font-size:15px;font-weight:700;color:var(--navy);">Recent Member Signups — {{ Auth::user()->branch?->branch_name }}</h2>
            <a href="{{ route('admin.members.index') }}" style="font-size:13px;color:var(--red);font-weight:600;text-decoration:none;">View all →</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentMembers as $member)
                <tr>
                    <td>
                        <div style="font-weight:600;color:var(--navy);">{{ $member->first_name }} {{ $member->last_name }}</div>
                        <div style="font-size:12px;color:#9CA3AF;">{{ $member->email }}</div>
                    </td>
                    <td style="color:#6B7280;">{{ $member->plan?->plan_name ?? '—' }}</td>
                    <td>
                        @if($member->status === 'active')
                        <span class="badge-active">Active</span>
                        @elseif($member->status === 'expired')
                        <span class="badge-expired">Expired</span>
                        @else
                        <span class="badge-pending">Pending</span>
                        @endif
                    </td>
                    <td>
                        @if($member->payment_status === 'paid')
                        <span class="badge-paid">Paid</span>
                        @else
                        <span class="badge-unpaid">Unpaid</span>
                        @endif
                    </td>
                    <td>
                        @if($member->payment_status === 'unpaid')
                        <form action="{{ route('admin.members.markPaid', $member->member_id) }}" method="POST" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-primary" style="padding:6px 12px;font-size:12px;">✓ Mark Paid</button>
                        </form>
                        @endif
                        <a href="{{ route('admin.members.show', $member->member_id) }}" class="btn-view" style="padding:6px 12px;font-size:12px;">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:#9CA3AF;padding:32px;">No members yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection