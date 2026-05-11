<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function index()
    {
        $coaches = Coach::with('branch')->latest()->paginate(15);
        return view('admin.coaches.index', compact('coaches'));
    }

    public function create()
    {
        $branches    = Branch::all();
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
        $coach->load('branch');
        return view('admin.coaches.show', compact('coach'));
    }

    public function edit(Coach $coach)
    {
        $branches    = Branch::all();
        $specialties = self::$specialties;
        return view('admin.coaches.edit', compact('coach', 'branches', 'specialties'));
    }

    public function update(Request $request, Coach $coach)
    {
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
        if ($coach->certification_path) {
            Storage::disk('public')->delete($coach->certification_path);
        }
        $coach->delete();
        return redirect()->route('admin.coaches.index')
            ->with('success', 'Coach deleted successfully.');
    }
}