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

        
        if ($user->isSuperAdmin()) {
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