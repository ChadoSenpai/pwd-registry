<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use Illuminate\View\View;

class AuditTrailController extends Controller
{
    public function index(): View
    {
        $auditTrail = AuditTrail::with(['user', 'application'])
            ->latest()
            ->paginate(20);

        return view('applications.audit-trail', compact('auditTrail'));
    }
}
