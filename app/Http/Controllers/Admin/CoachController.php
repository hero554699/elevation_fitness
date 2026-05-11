<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    public static $specialties = [
        'Personal Training',
        'Strength & Conditioning',
        'Cardio & Endurance',
        'Indoor Cycling',
        'Zumba Instructor',
        'Yoga & Flexibility',
        'Boxing & Martial Arts',
        'Nutrition & Diet Coaching',
        'Group Fitness Instructor',
        'Rehabilitation & Recovery',
    ];

    /**
     * Filter coaches by branch based on user role
     */
    private function branchFilter($query)
    {
        if (Auth::user()->isBranchAdmin()) {
            $query->where('branch_id', Auth::user()->branch_id);
        }
        return $query;
    }

    /**
     * Authorize coach access - only super admin or branch admin of that branch
     */
    private function authorizeCoach(Coach $coach)
    {
        if (Auth::user()->isBranchAdmin() && $coach->branch_id !== Auth::user()->branch_id) {
            abort(403, 'You can only manage coaches in your branch.');
        }
    }

    public function index()
    {
        // Apply branch filter
        $coaches = $this->branchFilter(Coach::with('branch'))
            ->latest()
            ->paginate(15);
        return view('admin.coaches.index', compact('coaches'));
    }

    public function create()
    {
        // Only show branches the user has access to
        $branches = Auth::user()->isSuperAdmin()
            ? Branch::all()
            : Branch::where('branch_id', Auth::user()->branch_id)->get();
            
        $specialties = self::$specialties;
        return view('admin.coaches.create', compact('branches', 'specialties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'         => 'required|string|max:100',
            'last_name'          => 'required|string|max:100',
            'email'              => 'nullable|email|unique:coaches,email',
            'phone'              => 'nullable|string|max:20',
            'specialty'          => 'required|string',
            'branch_id'          => 'required|exists:branches,branch_id',
            'status'             => 'required|in:active,inactive',
            'bio'                => 'nullable|string',
            'date_hired'         => 'nullable|date',
            'certification_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Prevent branch admin from assigning coach to other branches
        if (Auth::user()->isBranchAdmin() && $request->branch_id != Auth::user()->branch_id) {
            abort(403, 'You can only create coaches in your branch.');
        }

        $certPath = null;
        if ($request->hasFile('certification_file')) {
            $certPath = $request->file('certification_file')->store('certifications', 'public');
        }

        $coach = new Coach();
        $coach->first_name         = $request->first_name;
        $coach->last_name          = $request->last_name;
        $coach->email              = $request->email;
        $coach->phone              = $request->phone;
        $coach->specialty          = $request->specialty;
        $coach->branch_id          = $request->branch_id;
        $coach->status             = $request->status;
        $coach->bio                = $request->bio;
        $coach->date_hired         = $request->date_hired;
        $coach->certification_path = $certPath;
        $coach->save();

        return redirect()->route('admin.coaches.index')
            ->with('success', 'Coach added successfully.');
    }

    public function show(Coach $coach)
    {
        $this->authorizeCoach($coach);
        $coach->load('branch');
        return view('admin.coaches.show', compact('coach'));
    }

    public function edit(Coach $coach)
    {
        $this->authorizeCoach($coach);
        
        $branches = Auth::user()->isSuperAdmin()
            ? Branch::all()
            : Branch::where('branch_id', Auth::user()->branch_id)->get();
            
        $specialties = self::$specialties;
        return view('admin.coaches.edit', compact('coach', 'branches', 'specialties'));
    }

    public function update(Request $request, Coach $coach)
    {
        $this->authorizeCoach($coach);

        $request->validate([
            'first_name'         => 'required|string|max:100',
            'last_name'          => 'required|string|max:100',
            'email'              => 'nullable|email|unique:coaches,email,' . $coach->coach_id . ',coach_id',
            'phone'              => 'nullable|string|max:20',
            'specialty'          => 'required|string',
            'branch_id'          => 'required|exists:branches,branch_id',
            'status'             => 'required|in:active,inactive',
            'bio'                => 'nullable|string',
            'date_hired'         => 'nullable|date',
            'certification_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Prevent branch admin from moving coach to other branches
        if (Auth::user()->isBranchAdmin() && $request->branch_id != Auth::user()->branch_id) {
            abort(403, 'You can only manage coaches in your branch.');
        }

        if ($request->hasFile('certification_file')) {
            if ($coach->certification_path) {
                Storage::disk('public')->delete($coach->certification_path);
            }
            $coach->certification_path = $request->file('certification_file')->store('certifications', 'public');
        }

        $coach->first_name = $request->first_name;
        $coach->last_name  = $request->last_name;
        $coach->email      = $request->email;
        $coach->phone      = $request->phone;
        $coach->specialty  = $request->specialty;
        $coach->branch_id  = $request->branch_id;
        $coach->status     = $request->status;
        $coach->bio        = $request->bio;
        $coach->date_hired = $request->date_hired;
        $coach->save();

        return redirect()->route('admin.coaches.index')
            ->with('success', 'Coach updated successfully.');
    }

    public function destroy(Coach $coach)
    {
        $this->authorizeCoach($coach);
        
        if ($coach->certification_path) {
            Storage::disk('public')->delete($coach->certification_path);
        }
        $coach->delete();
        return redirect()->route('admin.coaches.index')
            ->with('success', 'Coach deleted successfully.');
    }
}
