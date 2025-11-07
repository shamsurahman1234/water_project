<?php

namespace App\Http\Controllers;

use App\Models\Meter;
use App\Models\Customer;
use Illuminate\Http\Request;

class MeterController extends Controller
{
    public function index()
    {
        $meters = Meter::with('customer')->latest()->paginate(10);
        return view('meters.index', compact('meters'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('meters.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'serial_number' => 'required|unique:meters',
            'previous_reading' => 'nullable|numeric',
            'current_reading' => 'nullable|numeric',
        ]);

        Meter::create($validated);
        return redirect()->route('meters.index')->with('success', 'Meter created successfully.');
    }

    public function edit(Meter $meter)
    {
        $customers = Customer::all();
        return view('meters.edit', compact('meter', 'customers'));
    }

    public function update(Request $request, Meter $meter)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'serial_number' => 'required|unique:meters,serial_number,' . $meter->id,
            'previous_reading' => 'nullable|numeric',
            'current_reading' => 'nullable|numeric',
        ]);

        $meter->update($validated);
        return redirect()->route('meters.index')->with('success', 'Meter updated successfully.');
    }

    public function destroy(Meter $meter)
    {
        $meter->delete();
        return redirect()->route('meters.index')->with('success', 'Meter deleted successfully.');
    }
}
