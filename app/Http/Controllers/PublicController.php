<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Branch;
use App\Models\MembershipPlan;

class PublicController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        $plans = MembershipPlan::all();
        return view('public.home', compact('branches', 'plans'));
    }

    public function join(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:members,email',
            'phone'      => 'required|string|max:20',
            'address'    => 'nullable|string',
            'branch_id'  => 'required|exists:branches,branch_id',
            'plan_id'    => 'required|exists:membership_plans,plan_id',
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
            'status'         => 'pending',
            'payment_status' => 'unpaid',
            'reference_no'   => $reference,
        ]);

        return redirect()->route('public.success')->with([
            'reference_no' => $reference,
            'name'         => $request->first_name . ' ' . $request->last_name,
            'plan_id'      => $request->plan_id,
        ]);
    }

    public function success()
    {
        if (!session('reference_no')) {
            return redirect()->route('home');
        }

        $plan = MembershipPlan::find(session('plan_id'));
        return view('public.success', compact('plan'));
    }
}