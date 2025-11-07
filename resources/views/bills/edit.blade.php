<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit Bill #{{ $bill->id }}</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <form action="{{ route('bills.update', $bill) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Customer</label>
                <select name="customer_id" class="w-full border px-3 py-2 rounded">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $bill->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Meter</label>
                <select name="meter_id" class="w-full border px-3 py-2 rounded">
                    @foreach($meters as $meter)
                        <option value="{{ $meter->id }}" {{ $bill->meter_id == $meter->id ? 'selected' : '' }}>
                            {{ $meter->serial_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Consumption (m³)</label>
                <input type="number" name="consumption" value="{{ $bill->consumption }}" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Amount (AFN)</label>
                <input type="number" name="amount" value="{{ $bill->amount }}" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Paid</label>
                <select name="paid" class="w-full border px-3 py-2 rounded">
                    <option value="0" {{ !$bill->paid ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $bill->paid ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update Bill</button>
        </form>
    </div>
</x-app-layout>
