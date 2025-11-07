<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Bill Details #{{ $bill->id }}</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow space-y-4">
        <p><strong>Customer:</strong> {{ $bill->customer->name }}</p>
        <p><strong>Meter:</strong> {{ $bill->meter->serial_number }}</p>
        <p><strong>Consumption:</strong> {{ $bill->consumption }} m³</p>
        <p><strong>Amount:</strong> {{ $bill->amount }} AFN</p>
        <p><strong>Paid:</strong> {{ $bill->paid ? 'Yes' : 'No' }}</p>

        @if(!$bill->paid)
        <a href="{{ route('payment.create', $bill->id) }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
           💳 Pay Now
        </a>
        @endif

        <a href="{{ route('bills.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Back to Bills</a>
    </div>
</x-app-layout>
