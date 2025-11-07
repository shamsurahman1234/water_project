<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Meter;
use Illuminate\Http\Request;

class BillController extends Controller
{
    // ----------------- List all bills -----------------
    public function index()
    {
        $bills = Bill::with(['customer', 'meter'])->latest()->paginate(10);
        return view('bills.index', compact('bills'));
    }

    // ----------------- Show create form -----------------
    public function create()
    {
        $customers = Customer::all();
        $meters = Meter::all();
        return view('bills.create', compact('customers', 'meters'));
    }

    // ----------------- Store new bill -----------------
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'meter_id' => 'required|exists:meters,id',
            'consumption' => 'required|numeric',
            'amount' => 'required|numeric',
            'paid' => 'nullable|boolean',
        ]);

        Bill::create($validated);
        return redirect()->route('bills.index')->with('success', 'Bill created successfully.');
    }

    // ----------------- Show edit form -----------------
    public function edit(Bill $bill)
    {
        $customers = Customer::all();
        $meters = Meter::all();
        return view('bills.edit', compact('bill', 'customers', 'meters'));
    }

    // ----------------- Update bill -----------------
    public function update(Request $request, Bill $bill)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'meter_id' => 'required|exists:meters,id',
            'consumption' => 'required|numeric',
            'amount' => 'required|numeric',
            'paid' => 'nullable|boolean',
        ]);

        $bill->update($validated);
        return redirect()->route('bills.index')->with('success', 'Bill updated successfully.');
    }

    // ----------------- Delete bill -----------------
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully.');
    }

    // ----------------- Show bill details -----------------
    public function show(Bill $bill)
    {
        return view('bills.show', compact('bill'));
    }

    // ----------------- Payment page -----------------
    public function payment(Bill $bill)
    {
        return view('payments.create', compact('bill'));
    }
}
