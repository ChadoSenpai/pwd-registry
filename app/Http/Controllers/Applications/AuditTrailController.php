<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AuditTrailController extends Controller
{
    public function index(): View
    {
        $auditTrail = collect([
            [
                'action' => 'Archived',
                'label' => 'Application moved to archive',
                'registrant' => 'Maria Dela Cruz',
                'time' => now()->subMinutes(12)->format('M d, Y h:i A'),
                'user' => auth()->user()?->name ?? 'System',
            ],
            [
                'action' => 'Restored',
                'label' => 'Application recovered from archive',
                'registrant' => 'Jose Ramos',
                'time' => now()->subMinutes(25)->format('M d, Y h:i A'),
                'user' => auth()->user()?->name ?? 'System',
            ],
            [
                'action' => 'Reviewed',
                'label' => 'Application status updated',
                'registrant' => 'Ana Lopez',
                'time' => now()->subHours(1)->format('M d, Y h:i A'),
                'user' => auth()->user()?->name ?? 'System',
            ],
        ]);

        return view('applications.audit-trail', ['auditTrail' => $auditTrail]);
    }
}
