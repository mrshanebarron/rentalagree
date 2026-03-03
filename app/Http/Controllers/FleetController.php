<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        $vehicles = $query->orderBy('category')->orderBy('make')->get();

        return view('dashboard.fleet.index', compact('vehicles'));
    }

    public function create()
    {
        return view('dashboard.fleet.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:2030',
            'license_plate' => 'required|string|max:20|unique:vehicles',
            'color' => 'required|string|max:50',
            'vin' => 'nullable|string|max:50',
            'category' => 'required|in:economy,compact,suv,luxury',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance',
            'current_mileage' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('vehicles', 'public');
        }

        Vehicle::create($validated);

        return redirect()->route('dashboard.fleet.index')
            ->with('success', 'Vehicle added to fleet.');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['agreements.registration', 'damageRecords']);

        return view('dashboard.fleet.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('dashboard.fleet.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:2030',
            'license_plate' => 'required|string|max:20|unique:vehicles,license_plate,' . $vehicle->id,
            'color' => 'required|string|max:50',
            'vin' => 'nullable|string|max:50',
            'category' => 'required|in:economy,compact,suv,luxury',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance',
            'current_mileage' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('vehicles', 'public');
        }

        $vehicle->update($validated);

        return redirect()->route('dashboard.fleet.show', $vehicle)
            ->with('success', 'Vehicle updated.');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->agreements()->where('status', '!=', 'signed')->exists()) {
            return back()->with('error', 'Cannot delete vehicle with active agreements.');
        }

        $vehicle->delete();

        return redirect()->route('dashboard.fleet.index')
            ->with('success', 'Vehicle removed from fleet.');
    }
}
