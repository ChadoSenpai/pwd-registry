<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
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
        }

        return to_route('applications.archive')->with('success', 'Application was restored successfully.');
    }
}
