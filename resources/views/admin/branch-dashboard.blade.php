@extends('admin.layouts.app')
@section('title', 'Branch Dashboard')
@section('page-title', Auth::user()->branch?->branch_name . ' — Dashboard')
@section('page-subtitle', 'Overview of your branch operations')

@section('content')

<!-- Enhanced Stat Cards Grid (2 rows x 3 columns) -->
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:28px;">

    <!-- Card 1: Total Members -->
    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Total Members</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">{{ number_format($totalMembers) }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">{{ $activeMembers }} active members</p>
            </div>
            <div style="width:48px;height:48px;background:#FEE2E2;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">👥</div>
        </div>
    </div>

    <!-- Card 2: Branch Revenue -->
    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Branch Revenue</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">₱{{ number_format($totalRevenue, 2) }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">Total all-time</p>
            </div>
            <div style="width:48px;height:48px;background:#DCFCE7;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">💰</div>
        </div>
    </div>

    <!-- Card 3: Pending Payments -->
    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Pending Payments</p>
                <p style="font-size:32px;font-weight:700;color:var(--orange);margin-top:4px;">{{ $pendingPayments }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">Awaiting confirmation</p>
            </div>
            <div style="width:48px;height:48px;background:#FFEDD5;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">⏳</div>
        </div>
    </div>

    <!-- Card 4: Active Workers -->
    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Active Workers</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">{{ $totalWorkers }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">On your branch</p>
            </div>
            <div style="width:48px;height:48px;background:#EFF6FF;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🧑‍💼</div>
        </div>
    </div>

    <!-- Card 5: Active Coaches -->
    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Active Coaches</p>
                <p style="font-size:32px;font-weight:700;color:var(--navy);margin-top:4px;">{{ $totalCoaches }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:4px;">On your branch</p>
            </div>
            <div style="width:48px;height:48px;background:#F5F3FF;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🏋️</div>
        </div>
    </div>

    <!-- Card 6: Current Date & Time -->
    <div class="stat-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p style="font-size:12px;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Current Date & Time</p>
                <p style="font-size:24px;font-weight:700;color:var(--navy);margin-top:4px;" id="current-date">{{ now()->format('M d, Y') }}</p>
                <p style="font-size:14px;font-weight:600;color:var(--navy);" id="current-time">{{ now()->format('H:i:s') }}</p>
                <p style="font-size:12px;color:#6B7280;margin-top:2px;">Last updated now</p>
            </div>
            <div style="width:48px;height:48px;background:#FEF9C3;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🕐</div>
        </div>
    </div>

</div>

<!-- JavaScript for Real-Time Clock -->
<script>
    function updateDateTime() {
        const now = new Date();
        const dateString = now.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
        const timeString = now.toLocaleTimeString('en-US', {
            hour12: false,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        document.getElementById('current-date').textContent = dateString;
        document.getElementById('current-time').textContent = timeString;
    }

    // Update immediately
    updateDateTime();

    // Update every second
    setInterval(updateDateTime, 1000);
</script>

<!-- Recent Members Table and Members per Branch -->
<div style="display:grid;grid-template-columns:1.6fr 1fr;gap:20px;">

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
                        <span class="badge-paid">✓ Active</span>
                        @elseif($member->status === 'expired')
                        <span class="badge-unpaid">✗ Expired</span>
                        @else
                        <span style="display:inline-flex;align-items:center;padding:4px 12px;border-radius:6px;font-size:12px;font-weight:600;background:#FEF3C7;color:#A16207;">⏳ Pending</span>
                        @endif
                    </td>
                    <td>
                        @if($member->payment_status === 'paid')
                        <span class="badge-paid">✓ Paid</span>
                        @else
                        <span class="badge-unpaid">✗ Unpaid</span>
                        @endif
                    </td>
                    <td style="text-align:center;">
                        @if($member->payment_status === 'unpaid')
                        <form action="{{ route('admin.members.markPaid', $member->member_id) }}" method="POST" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit" style="background:none;border:none;color:var(--red);font-weight:600;cursor:pointer;text-decoration:none;font-size:12px;">Mark Paid</button>
                        </form>
                        @endif
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

    <div class="card">
        <div style="padding:20px 24px;border-bottom:1px solid var(--border);">
            <h2 style="font-size:15px;font-weight:700;color:var(--navy);">Branch Summary</h2>
        </div>
        <div style="padding:8px 0;">
            <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 24px;border-bottom:1px solid var(--border);">
                <div>
                    <div style="font-size:14px;font-weight:600;color:var(--navy);">{{ Auth::user()->branch?->branch_name }}</div>
                    <div style="font-size:12px;color:#9CA3AF;">{{ $totalWorkers }} workers · {{ $totalCoaches }} coaches</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:20px;font-weight:700;color:var(--red);">{{ $totalMembers }}</div>
                    <div style="font-size:11px;color:#9CA3AF;">members</div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
