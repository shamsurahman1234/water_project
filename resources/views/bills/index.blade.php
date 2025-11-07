<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">💧 Bills</h2>
    </x-slot>

    <!-- Add Bill Button -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('bills.create') }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-red-400 px-4 py-2 rounded-md shadow">
            ➕ Add Bill
        </a>
    </div>

    <!-- Bills Table -->
    <div class="overflow-x-auto bg-retext-red-400 shadow rounded-lg">
        <table class="min-w-full table-auto border border-gray-300 rounded-lg">
            <thead class="bg-gray-200 text-gray-800 uppercase text-sm">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Customer</th>
                    <th class="border px-4 py-2">Meter</th>
                    <th class="border px-4 py-2">Consumption</th>
                    <th class="border px-4 py-2">Amount</th>
                    <th class="border px-4 py-2">Paid</th>
                    <th class="border px-4 py-2">Payment</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
                @foreach($bills as $bill)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2 text-center">{{ $bill->id }}</td>
                    <td class="border px-4 py-2">{{ $bill->customer->name }}</td>
                    <td class="border px-4 py-2">{{ $bill->meter->serial_number }}</td>
                    <td class="border px-4 py-2 text-center">{{ $bill->consumption }}</td>
                    <td class="border px-4 py-2 text-center">{{ $bill->amount }} AFN</td>
                    <td class="border px-4 py-2 text-center">
                        @if($bill->paid)
                            <span class="text-green-700 font-semibold">Yes</span>
                        @else
                            <span class="text-red-600 font-semibold">No</span>
                        @endif
                    </td>

                    <!-- ✅ Payment Section -->
                    <td class="border px-4 py-2 text-center">
                        @if(!$bill->paid)
                            <a href="{{ route('payment.create', $bill->id) }}"
                               class="bg-green-600 hover:bg-green-700 text-red-400 px-3 py-1 rounded-md shadow">
                                💳 Pay Now
                            </a>
                        @else
                            <span class="text-green-700 font-semibold">Paid</span>
                        @endif
                    </td>

                    <!-- ✅ CRUD Actions -->
                    <td class="border px-4 py-2 text-center flex justify-center gap-2">
                        <a href="{{ route('bills.show', $bill) }}" 
                           class="text-green-600 hover:underline">Show</a>
                        <a href="{{ route('bills.edit', $bill) }}" 
                           class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('bills.destroy', $bill) }}" onsubmit="return confirm('Are you sure to delete this bill?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $bills->links() }}
    </div>
</x-app-layout>
