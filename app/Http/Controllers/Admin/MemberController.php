<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Branch;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    private function branchFilter($query)
    {
        if (Auth::user()->isBranchAdmin()) {
            $query->where('branch_id', Auth::user()->branch_id);
        }
        return $query;
    }

    public function index()
    {
        $members = $this->branchFilter(Member::with('branch', 'plan'))
            ->latest()
            ->paginate(15);

        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        $branches = Auth::user()->isSuperAdmin()
            ? Branch::all()
            : Branch::where('branch_id', Auth::user()->branch_id)->get();

        $plans = MembershipPlan::all();
        return view('admin.members.create', compact('branches', 'plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|unique:members,email',
            'phone'          => 'required|string|max:20',
            'address'        => 'nullable|string',
            'branch_id'      => 'required|exists:branches,branch_id',
            'plan_id'        => 'required|exists:membership_plans,plan_id',
            'payment_status' => 'required|in:unpaid,paid',
            'status'         => 'required|in:pending,active,expired',
        ]);

        $reference = 'EFG-' . strtoupper(substr(md5(uniqid()), 0, 8));

        Member::create([
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'branch_id'      => $request->branch_id,
            'plan_id'        => $request->plan_id,
            'status'         => $request->status,
            'payment_status' => $request->payment_status,
            'reference_no'   => $reference,
        ]);

        return redirect()->route('admin.members.index')
            ->with('success', 'Member added successfully.');
    }

    public function show(Member $member)
    {
        $this->authorizeMember($member);
        $member->load('branch', 'plan');
        return view('admin.members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $this->authorizeMember($member);
        $branches = Auth::user()->isSuperAdmin()
            ? Branch::all()
            : Branch::where('branch_id', Auth::user()->branch_id)->get();

        $plans = MembershipPlan::all();
        return view('admin.members.edit', compact('member', 'branches', 'plans'));
    }

    public function update(Request $request, Member $member)
    {
        $this->authorizeMember($member);

        $request->validate([
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|unique:members,email,' . $member->member_id . ',member_id',
            'phone'          => 'required|string|max:20',
            'address'        => 'nullable|string',
            'branch_id'      => 'required|exists:branches,branch_id',
            'plan_id'        => 'required|exists:membership_plans,plan_id',
            'payment_status' => 'required|in:unpaid,paid',
            'status'         => 'required|in:pending,active,expired',
        ]);

        $member->update($request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'address',
            'branch_id',
            'plan_id',
            'payment_status',
            'status',
        ]));

        return redirect()->route('admin.members.index')
            ->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $this->authorizeMember($member);
        $member->delete();
        return redirect()->route('admin.members.index')
            ->with('success', 'Member deleted successfully.');
    }

    public function markPaid(Member $member)
    {
        $this->authorizeMember($member);
        $member->update([
            'payment_status'   => 'paid',
            'status'           => 'active',
            'membership_start' => now(),
            'membership_end'   => now()->addDays($member->plan->duration_days),
        ]);

        return back()->with('success', 'Payment confirmed. Member is now active.');
    }

    private function authorizeMember(Member $member)
    {
        if (Auth::user()->isBranchAdmin() && $member->branch_id !== Auth::user()->branch_id) {
            abort(403, 'You can only manage members in your branch.');
        }
    }
}
