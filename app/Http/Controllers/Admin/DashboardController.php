<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Worker;
use App\Models\Coach;
use App\Models\Branch;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            // Super Admin sees GLOBAL stats
            $totalMembers    = Member::count();
            $activeMembers   = Member::where('status', 'active')->count();
            $totalWorkers    = Worker::where('status', 'active')->count();
            $totalCoaches    = Coach::where('status', 'active')->count();
            $totalRevenue    = Payment::sum('amount');
            $pendingPayments = Member::where('payment_status', 'unpaid')->count();

            $branches = Branch::withCount([
                'members',
                'workers',
                'coaches',
            ])->get();

            $recentMembers = Member::with('branch', 'plan')
                ->latest()
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'totalMembers',
                'activeMembers',
                'totalWorkers',
                'totalCoaches',
                'totalRevenue',
                'pendingPayments',
                'branches',
                'recentMembers'
            ));
        } else {
            // Branch Admin sees ONLY their branch stats
            $branchId = $user->branch_id;

            $totalMembers    = Member::where('branch_id', $branchId)->count();
            $activeMembers   = Member::where('branch_id', $branchId)->where('status', 'active')->count();
            $totalWorkers    = Worker::where('branch_id', $branchId)->where('status', 'active')->count();
            $totalCoaches    = Coach::where('branch_id', $branchId)->where('status', 'active')->count();
            $totalRevenue    = Payment::whereHas('member', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })->sum('amount');
            $pendingPayments = Member::where('branch_id', $branchId)->where('payment_status', 'unpaid')->count();

            // Only get current branch data
            $branches = Branch::where('branch_id', $branchId)->withCount([
                'members',
                'workers',
                'coaches',
            ])->get();

            $recentMembers = Member::with('branch', 'plan')
                ->where('branch_id', $branchId)
                ->latest()
                ->take(5)
                ->get();

            return view('admin.branch-dashboard', compact(
                'totalMembers',
                'activeMembers',
                'totalWorkers',
                'totalCoaches',
                'totalRevenue',
                'pendingPayments',
                'branches',
                'recentMembers'
            ));
        }
    }
}
