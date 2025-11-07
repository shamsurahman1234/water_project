<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meter;
use App\Models\Bill;

class MeterScanController extends Controller
{
    public function showScan(Meter $meter)
    {
        return view('meters.scan', compact('meter'));
    }

    public function processScan(Request $request, Meter $meter)
    {
        $request->validate(['reading' => 'required|string']);

        $raw = preg_replace('/[^\d.,]/', '', $request->reading);
        $current = floatval(str_replace(',', '.', $raw));
        $previous = $meter->current_reading ?? 0;
        $consumption = $current - $previous;

        if ($consumption < 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Scanned value is less than previous reading.',
            ]);
        }

        $rate = 50; // 50 AFN per unit
        $amount = round($consumption * $rate, 2);

        // Update meter
        $meter->update([
            'previous_reading' => $previous,
            'current_reading' => $current,
        ]);

        // Optional: create bill
        Bill::create([
            'customer_id' => $meter->customer_id,
            'meter_id' => $meter->id,
            'consumption' => $consumption,
            'amount' => $amount,
            'paid' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'consumption' => $consumption,
                'amount' => $amount,
            ],
        ]);
    }
}
