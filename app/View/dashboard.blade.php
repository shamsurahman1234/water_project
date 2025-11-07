<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800">💧 Water Supply MIS Dashboard</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 p-6">
        <a href="{{ route('customers.index') }}" class="bg-blue-500 text-white p-6 rounded-2xl shadow hover:bg-blue-600 transition">
            👥 Customers
        </a>
        <a href="{{ route('meters.index') }}" class="bg-green-500 text-white p-6 rounded-2xl shadow hover:bg-green-600 transition">
            ⚙️ Meters
        </a>
        <a href="{{ route('bills.index') }}" class="bg-yellow-500 text-white p-6 rounded-2xl shadow hover:bg-yellow-600 transition">
            💵 Bills
        </a>
        <a href="{{ route('employees.index') }}" class="bg-purple-500 text-white p-6 rounded-2xl shadow hover:bg-purple-600 transition">
            👨‍💼 Employees
        </a>
    </div>
</x-app-layout>
