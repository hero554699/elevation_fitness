<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WorkerController extends Controller
{
    public static $positions = [
        'Branch Manager',
        'Assistant Manager',
        'Front Desk Officer',
        'Membership Consultant',
        'Security Officer (CCTV)',
        'Security Guard',
        'Maintenance Staff',
        'Janitor / Utility Staff',
        'Cashier',
    ];

    private function branchFilter($query)
    {
        if (Auth::user()->isBranchAdmin()) {
            $query->where('branch_id', Auth::user()->branch_id);
        }
        return $query;
    }

    private function authorizeWorker(Worker $worker)
    {
        if (Auth::user()->isBranchAdmin() && $worker->branch_id !== Auth::user()->branch_id) {
            abort(403, 'You can only manage workers in your branch.');
        }
    }

    public function index()
    {
        $workers = $this->branchFilter(Worker::with('branch'))->latest()->paginate(15);
        return view('admin.workers.index', compact('workers'));
    }

    public function create()
    {
        $branches  = Auth::user()->isSuperAdmin()
            ? Branch::all()
            : Branch::where('branch_id', Auth::user()->branch_id)->get();
        $positions = self::$positions;
        return view('admin.workers.create', compact('branches', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'         => 'required|string|max:100',
            'last_name'          => 'required|string|max:100',
            'email'              => 'nullable|email|unique:workers,email',
            'phone'              => 'nullable|string|max:20',
            'position'           => 'required|string',
            'branch_id'          => 'required|exists:branches,branch_id',
            'status'             => 'required|in:active,inactive',
            'date_hired'         => 'nullable|date',
            'certification_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $certPath = null;
        if ($request->hasFile('certification_file')) {
            $certPath = $request->file('certification_file')->store('worker-certifications', 'public');
        }

        $worker = new Worker();
        $worker->first_name         = $request->first_name;
        $worker->last_name          = $request->last_name;
        $worker->email              = $request->email;
        $worker->phone              = $request->phone;
        $worker->position           = $request->position;
        $worker->branch_id          = $request->branch_id;
        $worker->status             = $request->status;
        $worker->date_hired         = $request->date_hired;
        $worker->certification_path = $certPath;
        $worker->save();

        return redirect()->route('admin.workers.index')
            ->with('success', 'Worker added successfully.');
    }

    public function show(Worker $worker)
    {
        $this->authorizeWorker($worker);
        $worker->load('branch');
        return view('admin.workers.show', compact('worker'));
    }

    public function edit(Worker $worker)
    {
        $this->authorizeWorker($worker);
        $branches  = Auth::user()->isSuperAdmin()
            ? Branch::all()
            : Branch::where('branch_id', Auth::user()->branch_id)->get();
        $positions = self::$positions;
        return view('admin.workers.edit', compact('worker', 'branches', 'positions'));
    }

    public function update(Request $request, Worker $worker)
    {
        $this->authorizeWorker($worker);

        $request->validate([
            'first_name'         => 'required|string|max:100',
            'last_name'          => 'required|string|max:100',
            'email'              => 'nullable|email|unique:workers,email,' . $worker->worker_id . ',worker_id',
            'phone'              => 'nullable|string|max:20',
            'position'           => 'required|string',
            'branch_id'          => 'required|exists:branches,branch_id',
            'status'             => 'required|in:active,inactive',
            'date_hired'         => 'nullable|date',
            'certification_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('certification_file')) {
            if ($worker->certification_path) {
                Storage::disk('public')->delete($worker->certification_path);
            }
            $worker->certification_path = $request->file('certification_file')->store('worker-certifications', 'public');
        }

        $worker->first_name = $request->first_name;
        $worker->last_name  = $request->last_name;
        $worker->email      = $request->email;
        $worker->phone      = $request->phone;
        $worker->position   = $request->position;
        $worker->branch_id  = $request->branch_id;
        $worker->status     = $request->status;
        $worker->date_hired = $request->date_hired;
        $worker->save();

        return redirect()->route('admin.workers.index')
            ->with('success', 'Worker updated successfully.');
    }

    public function destroy(Worker $worker)
    {
        $this->authorizeWorker($worker);
        if ($worker->certification_path) {
            Storage::disk('public')->delete($worker->certification_path);
        }
        $worker->delete();
        return redirect()->route('admin.workers.index')
            ->with('success', 'Worker deleted successfully.');
    }
}
