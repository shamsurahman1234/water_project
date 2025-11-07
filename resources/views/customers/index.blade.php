<x-app-layout>
    <x-slot name="header" class="text-red-500"><h2>Customers</h2></x-slot>
    
    <div class="flex justify-end mb-4">
        <a href="{{ route('customers.create') }}" class="bg-blue-500 text-red-500 px-4 py-2 rounded">Add Customer</a>
    </div>
    
    <table class="w-full table-auto border">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Address</th>
                <th class="border px-4 py-2">Phone</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td class="border px-4 py-2">{{ $customer->id }}</td>
                <td class="border px-4 py-2">{{ $customer->name }}</td>
                <td class="border px-4 py-2">{{ $customer->address }}</td>
                <td class="border px-4 py-2">{{ $customer->phone }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('customers.show', $customer) }}" class="text-green-600">Show</a>
                    <a href="{{ route('customers.edit', $customer) }}" class="text-blue-600">Edit</a>
                    <form method="POST" action="{{ route('customers.destroy', $customer) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete?')" class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-4">{{ $customers->links() }}</div>
    </x-app-layout>
    