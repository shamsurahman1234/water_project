<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Add New Bill</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-red-400 p-6 rounded-lg shadow">
        <form action="{{ route('bills.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1">Customer</label>
                <select name="customer_id" class="w-full border px-3 py-2 rounded">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Meter</label>
                <select name="meter_id" class="w-full border px-3 py-2 rounded">
                    @foreach($meters as $meter)
                        <option value="{{ $meter->id }}">{{ $meter->serial_number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Consumption (m³)</label>
                <input type="number" name="consumption" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Amount (AFN)</label>
                <input type="number" name="amount" class="w-full border px-3 py-2 rounded" required>
            </div>

            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-redbg-red-400 px-4 py-2 rounded">Add Bill</button>
        </form>
    </div>
</x-app-layout>
