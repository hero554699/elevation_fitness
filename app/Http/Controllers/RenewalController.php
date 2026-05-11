<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RenewalController extends Controller
{
    // Shows the renewal form
    // Loads plans for the dropdown
    public function index()
    {
        $plans = DB::table('membership_plans')->get();
        return view('renewal.index', compact('plans'));
    }

    // Handles renewal form submission
    // Verifies member exists first before calling the procedure
    // Calls sp_renew_membership — extends expiry, logs renewal, records payment in one transaction
    // Trigger 1 fires automatically on payment insert and updates audit log
    public function store(Request $request)
    {
        $request->validate([
            'member_id'      => 'required|integer|min:1',
            'plan_id'        => 'required|integer',
            'payment_method' => 'required|in:cash,gcash',
        ]);

        $member = DB::table('members')->where('member_id', $request->member_id)->first();

        if (!$member) {
            return back()
                ->withErrors(['member_id' => 'Member ID not found. Please check and try again.'])
                ->withInput();
        }

        DB::statement('CALL sp_renew_membership(?, ?, ?, @new_expiry, @receipt_no, @message)', [
            $request->member_id,
            $request->plan_id,
            $request->payment_method,
        ]);

        $result = DB::selectOne('SELECT @new_expiry AS new_expiry, @receipt_no AS receipt_no, @message AS message');

        return back()->with([
            'renewal_success' => true,
            'new_expiry'      => $result->new_expiry,
            'receipt_no'      => $result->receipt_no,
            'renewal_message' => $result->message,
            'member_name'     => $member->first_name . ' ' . $member->last_name,
        ]);
    }
}