<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Models\PwdApplication;
use App\Models\PwdRegistrant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        return view('applications.index', [
            'applications' => PwdApplication::with('registrant')->latest('submitted_at')->paginate(10),
            'registrants' => PwdRegistrant::with(['barangay', 'disabilityType'])->latest()->paginate(10),
        ]);
    }

    public function show(PwdApplication $application): View
    {
        return view('applications.show', ['application' => $application->load(['registrant.barangay', 'registrant.disabilityType', 'reviewer'])]);
    }

    public function edit(PwdApplication $application): View
    {
        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, PwdApplication $application): RedirectResponse
    {
        $data = $request->validate([
            'type' => ['required', 'in:new,renewal,replacement,update'],
            'status' => ['required', 'in:draft,pending,under_review,approved,rejected'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($data['status'] === 'approved' && ! $application->approved_at) {
            $data['approved_at'] = now();
            $data['reviewed_at'] = now();
            $data['reviewed_by'] = $request->user()->id;
        } elseif (in_array($data['status'], ['under_review', 'rejected'], true)) {
            $data['reviewed_at'] = now();
            $data['reviewed_by'] = $request->user()->id;
        }

        $application->update($data);

        return to_route('applications.show', $application)->with('success', 'Application updated successfully.');
    }

    public function destroy(PwdApplication $application): RedirectResponse
    {
        $application->delete();

        return to_route('applications.index')->with('success', 'Application was moved to the archive.');
    }
}
