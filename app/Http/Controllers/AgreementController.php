<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Registration;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AgreementController extends Controller
{
    public function index(Request $request)
    {
        $query = Agreement::with(['registration', 'vehicle', 'user']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('agreement_number', 'like', "%{$search}%")
                  ->orWhereHas('registration', function ($q) use ($search) {
                      $q->where('full_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $agreements = $query->latest()->paginate(15);

        return view('dashboard.agreements.index', compact('agreements'));
    }

    public function show(Agreement $agreement)
    {
        $agreement->load(['registration', 'vehicle', 'user', 'damageRecords']);

        return view('dashboard.agreements.show', compact('agreement'));
    }

    public function create(Registration $registration, Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'insurance_option' => 'required|in:basic,premium,none',
            'deposit_amount' => 'required|numeric|min:0',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        $days = $registration->pickup_date->diffInDays($registration->return_date);
        $totalCost = $vehicle->daily_rate * $days;

        $insuranceCost = match ($request->insurance_option) {
            'basic' => 15.00 * $days,
            'premium' => 25.00 * $days,
            'none' => 0,
        };

        $agreement = Agreement::create([
            'registration_id' => $registration->id,
            'vehicle_id' => $vehicle->id,
            'user_id' => auth()->id(),
            'agreement_number' => Agreement::generateAgreementNumber(),
            'pickup_date' => $registration->pickup_date,
            'return_date' => $registration->return_date,
            'daily_rate' => $vehicle->daily_rate,
            'total_cost' => $totalCost,
            'deposit_amount' => $request->deposit_amount,
            'insurance_option' => $request->insurance_option,
            'insurance_cost' => $insuranceCost,
            'status' => 'in_progress',
        ]);

        // Update registration status
        $registration->update(['status' => 'in_progress']);

        // Update vehicle status
        $vehicle->update(['status' => 'rented']);

        // Generate signed URL for customer signing
        $signUrl = URL::signedRoute('agreements.sign', ['agreement' => $agreement->id]);

        return redirect()->route('dashboard.agreements.show', $agreement)
            ->with('success', 'Agreement created successfully.')
            ->with('sign_url', $signUrl);
    }

    public function sign(Agreement $agreement)
    {
        if ($agreement->status === 'signed') {
            return redirect()->route('agreements.complete', $agreement);
        }

        $agreement->load(['registration', 'vehicle', 'damageRecords']);

        return view('agreements.sign', compact('agreement'));
    }

    public function complete(Agreement $agreement)
    {
        $agreement->load(['registration', 'vehicle']);

        return view('agreements.complete', compact('agreement'));
    }

    public function pdf(Agreement $agreement)
    {
        $agreement->load(['registration', 'vehicle', 'user', 'damageRecords']);

        $pdf = Pdf::loadView('agreements.pdf', compact('agreement'));
        $pdf->setPaper('a4');

        return $pdf->download("agreement-{$agreement->agreement_number}.pdf");
    }

    public function startAgreement(Registration $registration)
    {
        $vehicles = Vehicle::where('status', 'available')
            ->orderBy('category')
            ->orderBy('daily_rate')
            ->get();

        return view('dashboard.agreements.create', compact('registration', 'vehicles'));
    }
}
