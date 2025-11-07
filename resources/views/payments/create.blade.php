<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pay Bill</h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-xl font-bold mb-4">Bill Payment for {{ $bill->customer->name }}</h3>
            <p><strong>Amount:</strong> ${{ $bill->amount }}</p>
            <p><strong>Consumption:</strong> {{ $bill->consumption }} m³</p>
            <form action="{{ route('payment.process', $bill->id) }}" method="POST">
                @csrf
                <button class="mt-6 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg">
                    Proceed to Payment
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
