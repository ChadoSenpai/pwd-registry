<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use App\Models\PwdApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArchiveController extends Controller
{
    public function index(): View
    {
        return view('applications.archive', [
            'applications' => PwdApplication::onlyTrashed()->with('registrant')->latest('deleted_at')->paginate(10),
        ]);
    }

    public function restore($applicationId): RedirectResponse
    {
        $application = PwdApplication::withTrashed()->findOrFail($applicationId);

        if ($application->trashed()) {
            $application->restore();

            // Create audit trail entry for restoration
            AuditTrail::create([
                'pwd_application_id' => $application->id,
                'user_id' => auth()->id(),
                'action' => 'Restored',
                'label' => 'Application recovered from archive',
                'registrant_name' => $application->registrant->full_name,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }

        return to_route('applications.archive')->with('success', 'Application was restored successfully.');
    }
}
