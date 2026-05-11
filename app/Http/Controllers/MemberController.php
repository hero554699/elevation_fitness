<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    // Shows the registration form
    // Loads branches and plans for the dropdowns
    public function create()
    {
        $branches = DB::table('branches')->get();
        $plans    = DB::table('membership_plans')->get();
        return view('member.register', compact('branches', 'plans'));
    }

    // Handles form submission
    // Calls stored procedure sp_register_member
    // Procedure checks duplicate email, inserts member + payment in a transaction
    // Trigger 1 fires automatically and sets status to active
    public function store(Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|max:150',
            'phone'          => 'nullable|string|max:20',
            'address'        => 'nullable|string',
            'branch_id'      => 'required|integer',
            'plan_id'        => 'required|integer',
            'payment_method' => 'required|in:cash,gcash',
        ]);

        DB::statement('CALL sp_register_member(?, ?, ?, ?, ?, ?, ?, ?, @member_id, @receipt_no, @message)', [
            $request->first_name,
            $request->last_name,
            $request->email,
            $request->phone   ?? '',
            $request->address ?? '',
            $request->branch_id,
            $request->plan_id,
            $request->payment_method,
        ]);

        $result = DB::selectOne('SELECT @member_id AS member_id, @receipt_no AS receipt_no, @message AS message');

        // member_id > 0 means success
        if ((int) $result->member_id > 0) {
            return redirect()->route('member.success')->with([
                'member_id'  => $result->member_id,
                'receipt_no' => $result->receipt_no,
                'message'    => $result->message,
                'name'       => $request->first_name . ' ' . $request->last_name,
            ]);
        }


        return back()->withErrors(['email' => $result->message])->withInput();
    }

    public function success()
    {
        if (!session('receipt_no')) {
            return redirect()->route('member.register');
        }
        return view('member.success');
    }
}