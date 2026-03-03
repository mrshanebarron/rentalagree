<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('confirmation_code', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $registrations = $query->latest()->paginate(15);

        return view('dashboard.registrations.index', compact('registrations'));
    }

    public function show(Registration $registration)
    {
        $registration->load('agreements.vehicle');

        return view('dashboard.registrations.show', compact('registration'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'date_of_birth' => 'required|date|before:today',
            'license_number' => 'required|string|max:100',
            'license_country' => 'required|string|max:100',
            'license_expiry' => 'required|date|after:today',
            'license_front_photo' => 'nullable|image|max:5120',
            'license_back_photo' => 'nullable|image|max:5120',
            'passport_photo' => 'nullable|image|max:5120',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:50',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
            'vehicle_preference' => 'required|in:economy,compact,suv,luxury',
            'hotel_name' => 'required|string|max:255',
            'flight_number' => 'nullable|string|max:50',
        ]);

        // Handle file uploads
        if ($request->hasFile('license_front_photo')) {
            $validated['license_front_photo'] = $request->file('license_front_photo')->store('licenses', 'public');
        }
        if ($request->hasFile('license_back_photo')) {
            $validated['license_back_photo'] = $request->file('license_back_photo')->store('licenses', 'public');
        }
        if ($request->hasFile('passport_photo')) {
            $validated['passport_photo'] = $request->file('passport_photo')->store('passports', 'public');
        }

        $validated['confirmation_code'] = Registration::generateConfirmationCode();
        $validated['status'] = 'pending';

        $registration = Registration::create($validated);

        return redirect()->route('register.confirmation', $registration->confirmation_code)
            ->with('success', 'Pre-registration submitted successfully!');
    }
}
