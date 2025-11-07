<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-red-100">
        <div class="bg-white p-8 rounded-lg shadow text-center">
            <h2 class="text-2xl font-bold text-red-600">Payment Cancelled ❌</h2>
            <p class="mt-2 text-gray-600">You cancelled your payment. Try again later.</p>
            <a href="{{ route('bills.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Back to Bills</a>
        </div>
    </div>
</x-app-layout>
