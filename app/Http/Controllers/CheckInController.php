<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckInController extends Controller
{
    // Shows the check-in page
    // Also loads today's attendance log for the right panel
    public function index()
    {
        $branches = DB::table('branches')->get();

        $recentAttendance = DB::table('attendance as a')
            ->join('members as m',  'a.member_id', '=', 'm.member_id')
            ->join('branches as b', 'a.branch_id', '=', 'b.branch_id')
            ->select('m.first_name', 'm.last_name', 'b.branch_name', 'a.check_in_date', 'a.check_in_time')
            ->whereDate('a.check_in_date', today())
            ->orderByDesc('a.check_in_time')
            ->limit(15)
            ->get();

        return view('checkin.index', compact('branches', 'recentAttendance'));
    }

    // Handles check-in form submission
    // Calls stored procedure sp_member_checkin
    // Procedure validates membership and prevents double check-in
    // Trigger 2 fires automatically after attendance insert and updates last_checkin
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|integer|min:1',
            'branch_id' => 'required|integer',
        ]);

        DB::statement('CALL sp_member_checkin(?, ?, @status, @message)', [
            $request->member_id,
            $request->branch_id,
        ]);

        $result = DB::selectOne('SELECT @status AS status, @message AS message');

        return back()->with([
            'checkin_status'  => $result->status,
            'checkin_message' => $result->message,
        ]);
    }
}