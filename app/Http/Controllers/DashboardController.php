<?php

namespace App\Http\Controllers;

use App\Models\PwdApplication;
use App\Models\PwdRegistrant;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'totalRegistrants' => PwdRegistrant::count(),
            'activeCards' => PwdRegistrant::where('card_status', 'active')->count(),
            'pendingApplications' => PwdApplication::where('status', 'pending')->count(),
            'expiringCards' => PwdRegistrant::whereBetween('card_expiry_date', [now(), now()->addDays(60)])->count(),
            'recentApplications' => PwdApplication::with('registrant')->latest()->paginate(5, ['*'], 'recent_page'),
        ]);
    }
}
