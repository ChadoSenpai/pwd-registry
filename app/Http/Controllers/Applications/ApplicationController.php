<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use App\Models\PwdApplication;
use App\Models\PwdRegistrant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        // Log the incoming data for debugging
        \Log::info('Application update request', [
            'application_id' => $application->id,
            'request_data' => $request->all(),
            'validated_data' => $data,
            'current_status' => $application->status,
        ]);

        $oldStatus = $application->status;
        $oldType = $application->type;

        if ($data['status'] === 'approved' && ! $application->approved_at) {
            $data['approved_at'] = now();
            $data['reviewed_at'] = now();
            $data['reviewed_by'] = $request->user()->id;
        } elseif (in_array($data['status'], ['under_review', 'rejected'], true)) {
            $data['reviewed_at'] = now();
            $data['reviewed_by'] = $request->user()->id;
        }

        $application->update($data);

        // Create audit trail entry
        AuditTrail::create([
            'pwd_application_id' => $application->id,
            'user_id' => $request->user()->id,
            'action' => 'Updated',
            'label' => 'Application status updated',
            'registrant_name' => $application->registrant->full_name,
            'old_values' => [
                'status' => $oldStatus,
                'type' => $oldType,
            ],
            'new_values' => [
                'status' => $application->status,
                'type' => $application->type,
            ],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        \Log::info('Application updated successfully', [
            'application_id' => $application->id,
            'new_status' => $application->fresh()->status,
        ]);

        return to_route('applications.show', $application)->with('success', 'Application updated successfully.');
    }

    public function destroy(PwdApplication $application): RedirectResponse
    {
        $application->delete();

        // Create audit trail entry for archiving
        AuditTrail::create([
            'pwd_application_id' => $application->id,
            'user_id' => auth()->id(),
            'action' => 'Archived',
            'label' => 'Application moved to archive',
            'registrant_name' => $application->registrant->full_name,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return to_route('applications.index')->with('success', 'Application was moved to the archive.');
    }
}
