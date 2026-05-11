@extends('admin.layouts.app')
@section('title', 'Dashboard — Elevation Fitness Gym')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of all gym operations')

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
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Total Revenue</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">₱{{ number_format($totalRevenue, 2) }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">All time</p>
            </div>
            <div style="width:48px;height:48px;background:#DCFCE7;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">💰</div>
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
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Active Workers</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">{{ $totalWorkers }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">All branches</p>
            </div>
            <div style="width:48px;height:48px;background:#EFF6FF;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🧑‍💼</div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Active Coaches</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">{{ $totalCoaches }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">All branches</p>
            </div>
            <div style="width:48px;height:48px;background:#F5F3FF;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🏋️</div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Total Branches</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">{{ $branches->count() }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">Davao Region</p>
            </div>
            <div style="width:48px;height:48px;background:#FEF9C3;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">📍</div>
        </div>
    </div>

</div>

<div style="display:grid;grid-template-columns:1.6fr 1fr;gap:20px;">

    <div class="card">
        <div style="padding:20px 24px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;">
            <h2 style="font-size:15px;font-weight:700;color:var(--navy);">Recent Member Signups</h2>
            <a href="{{ route('admin.members.index') }}" style="font-size:13px;color:var(--red);font-weight:600;text-decoration:none;">View all →</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Branch</th>
                    <th>Plan</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentMembers as $member)
                <tr>
                    <td>
                        <div style="font-weight:600;color:var(--navy);">{{ $member->first_name }} {{ $member->last_name }}</div>
                        <div style="font-size:12px;color:#9CA3AF;">{{ $member->email }}</div>
                    </td>
                    <td style="color:#6B7280;">{{ $member->branch?->branch_name ?? '—' }}</td>
                    <td style="color:#6B7280;">{{ $member->plan?->plan_name ?? '—' }}</td>
                    <td>
                        @if($member->payment_status === 'paid')
                        <span class="badge-paid">Paid</span>
                        @else
                        <span class="badge-unpaid">Unpaid</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;color:#9CA3AF;padding:32px;">No members yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card">
        <div style="padding:20px 24px;border-bottom:1px solid var(--border);">
            <h2 style="font-size:15px;font-weight:700;color:var(--navy);">Members per Branch</h2>
        </div>
        <div style="padding:8px 0;">
            @foreach($branches as $branch)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 24px;border-bottom:1px solid var(--border);">
                <div>
                    <div style="font-size:14px;font-weight:600;color:var(--navy);">{{ $branch->branch_name }}</div>
                    <div style="font-size:12px;color:#9CA3AF;">{{ $branch->workers_count }} workers · {{ $branch->coaches_count }} coaches</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:20px;font-weight:700;color:var(--red);">{{ $branch->members_count }}</div>
                    <div style="font-size:11px;color:#9CA3AF;">members</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection