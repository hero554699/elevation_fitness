<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Member;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Show check-in page
    public function index()
    {
        $attendances = Attendance::with('member', 'branch')
            ->orderBy('check_in_date', 'desc')
            ->orderBy('check_in_time', 'desc')
            ->paginate(15);

        return view('admin.attendance.index', compact('attendances'));
    }

    // Show check-in form
    public function create()
    {
        $members = Member::where('status', 'active')->get();
        return view('admin.attendance.create', compact('members'));
    }

    // Store check-in record
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,member_id',
        ]);

        $member = Member::findOrFail($request->member_id);

        // Create attendance record
        Attendance::create([
            'member_id' => $member->member_id,
            'branch_id' => $member->branch_id,
            'check_in_date' => now()->toDateString(),
            'check_in_time' => now()->toTimeString(),
        ]);

        return redirect()->route('admin.attendance.create')
            ->with('success', 'Check-in recorded for ' . $member->first_name . ' ' . $member->last_name);
    }

    // Show attendance by date
    public function show($date)
    {
        $attendances = Attendance::whereDate('check_in_date', $date)
            ->with('member', 'branch')
            ->orderBy('check_in_time', 'desc')
            ->get();

        return view('admin.attendance.show', compact('attendances', 'date'));
    }
}
