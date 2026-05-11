<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Member;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the attendance records.
     */
    public function index()
    {
        $user = Auth::user();

        // Get attendance records based on user role
        if ($user->role === 'super_admin') {
            $attendances = Attendance::with(['member', 'branch'])
                ->latest('check_in_date')
                ->paginate(15);
        } else {
            $attendances = Attendance::where('branch_id', $user->branch_id)
                ->with(['member', 'branch'])
                ->latest('check_in_date')
                ->paginate(15);
        }

        return view('admin.attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new attendance record.
     */
    public function create()
    {
        $user = Auth::user();

        // Get branches based on user role
        if ($user->role === 'super_admin') {
            $branches = Branch::all();
        } else {
            $branches = Branch::where('branch_id', $user->branch_id)->get();
        }

        return view('admin.attendance.create', compact('branches'));
    }

    /**
     * Store a newly created attendance record in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,member_id',
            'branch_id' => 'required|exists:branches,branch_id',
            'check_in_date' => 'required|date',
            'check_in_time' => 'required|date_format:H:i',
        ], [
            'member_id.required' => 'Member is required.',
            'member_id.exists' => 'Selected member does not exist.',
            'branch_id.required' => 'Branch is required.',
            'branch_id.exists' => 'Selected branch does not exist.',
            'check_in_date.required' => 'Check-in date is required.',
            'check_in_date.date' => 'Check-in date must be a valid date.',
            'check_in_time.required' => 'Check-in time is required.',
            'check_in_time.date_format' => 'Check-in time must be in HH:MM format.',
        ]);

        // Verify member belongs to branch
        $member = Member::find($validated['member_id']);
        if ($member->branch_id != $validated['branch_id']) {
            return back()->withErrors(['member_id' => 'Selected member does not belong to this branch.']);
        }

        // Check if member is active
        if ($member->status !== 'active') {
            return back()->withErrors(['member_id' => 'Only active members can check in.']);
        }

        // Create attendance record
        Attendance::create($validated);

        return redirect()->route('admin.attendance.index')
            ->with('success', 'Check-in recorded successfully!');
    }

    /**
     * Display the specified attendance record.
     */
    public function show(Attendance $attendance)
    {
        $attendance->load(['member', 'branch']);
        return view('admin.attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified attendance record.
     */
    public function edit(Attendance $attendance)
    {
        $user = Auth::user();

        // Authorization check
        if ($user->role !== 'super_admin' && $attendance->branch_id != $user->branch_id) {
            abort(403, 'Unauthorized action.');
        }

        $branches = Branch::all();
        return view('admin.attendance.edit', compact('attendance', 'branches'));
    }

    /**
     * Update the specified attendance record in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $user = Auth::user();

        // Authorization check
        if ($user->role !== 'super_admin' && $attendance->branch_id != $user->branch_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'member_id' => 'required|exists:members,member_id',
            'branch_id' => 'required|exists:branches,branch_id',
            'check_in_date' => 'required|date',
            'check_in_time' => 'required|date_format:H:i',
        ]);

        // Verify member belongs to branch
        $member = Member::find($validated['member_id']);
        if ($member->branch_id != $validated['branch_id']) {
            return back()->withErrors(['member_id' => 'Selected member does not belong to this branch.']);
        }

        $attendance->update($validated);

        return redirect()->route('admin.attendance.index')
            ->with('success', 'Attendance record updated successfully!');
    }

    /**
     * Remove the specified attendance record from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $user = Auth::user();

        // Authorization check
        if ($user->role !== 'super_admin' && $attendance->branch_id != $user->branch_id) {
            abort(403, 'Unauthorized action.');
        }

        $attendance->delete();

        return redirect()->route('admin.attendance.index')
            ->with('success', 'Attendance record deleted successfully!');
    }

    /**
     * Get members for AJAX lookup
     */
    public function getMembersByBranch(Request $request)
    {
        $branchId = $request->get('branch_id');

        $members = Member::where('branch_id', $branchId)
            ->where('status', 'active')
            ->select('member_id', 'first_name', 'last_name', 'email')
            ->get()
            ->map(function ($member) {
                return [
                    'id' => $member->member_id,
                    'name' => $member->first_name . ' ' . $member->last_name,
                    'email' => $member->email,
                ];
            });

        return response()->json($members);
    }
}
