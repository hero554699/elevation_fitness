<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::withCount([
            'members',
            'workers',
            'coaches',
        ])->get();

        return view('admin.branches.index', compact('branches'));
    }

    public function show(Branch $branch)
    {
        $branch->load([
            'members.plan',
            'workers',
            'coaches',
        ]);

        $totalMembers    = $branch->members->count();
        $activeMembers   = $branch->members->where('status', 'active')->count();
        $totalWorkers    = $branch->workers->where('status', 'active')->count();
        $totalCoaches    = $branch->coaches->where('status', 'active')->count();
        $pendingPayments = $branch->members->where('payment_status', 'unpaid')->count();

        return view('admin.branches.show', compact(
            'branch',
            'totalMembers',
            'activeMembers',
            'totalWorkers',
            'totalCoaches',
            'pendingPayments'
        ));
    }
}
