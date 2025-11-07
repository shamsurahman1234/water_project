<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-green-100">
        <div class="bg-white p-8 rounded-lg shadow text-center">
            <h2 class="text-2xl font-bold text-green-600">Payment Successful 💳</h2>
            <p class="mt-2 text-gray-600">Thank you for paying your water bill!</p>
            <a href="{{ route('bills.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Back to Bills</a>
        </div>
    </div>
</x-app-layout>
