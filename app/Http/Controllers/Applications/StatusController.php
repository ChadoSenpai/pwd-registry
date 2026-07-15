<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Models\PwdApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function update(Request $request, PwdApplication $application): RedirectResponse
    {
        $data = $request->validate(['status' => ['required', 'in:pending,under_review,rejected']]);

        $updates = [
            'status' => $data['status'],
            'reviewed_at' => now(),
            'reviewed_by' => $request->user()->id,
        ];

        if ($data['status'] === 'pending' && ! $application->submitted_at) {
            $updates['submitted_at'] = now();
        }

        $application->update($updates);

        return to_route('applications.show', $application)->with('success', 'Application status updated successfully.');
    }
}
