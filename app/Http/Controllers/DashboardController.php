<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Registration;

class DashboardController extends Controller
{
    public function index()
    {
        $todayRegistrations = Registration::whereDate('created_at', today())->count();
        $pendingAgreements = Agreement::where('status', 'in_progress')->count();
        $completedToday = Agreement::where('status', 'signed')->whereDate('signed_at', today())->count();
        $activeRentals = Agreement::where('status', 'signed')
            ->where('return_date', '>=', today())
            ->where('pickup_date', '<=', today())
            ->count();

        $recentRegistrations = Registration::latest()->take(10)->get();

        return view('dashboard.index', compact(
            'todayRegistrations',
            'pendingAgreements',
            'completedToday',
            'activeRentals',
            'recentRegistrations'
        ));
    }
}
