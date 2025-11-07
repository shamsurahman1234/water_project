<x-app-layout>
    <x-slot name="header"><h2>Employees</h2></x-slot>
    
    <div class="flex justify-end mb-4">
        <a href="{{ route('employees.create') }}" class="bg-purple-500 text-white px-4 py-2 rounded">Add Employee</a>
    </div>
    
    <table class="w-full table-auto border">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Phone</th>
                <th class="border px-4 py-2">Position</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td class="border px-4 py-2">{{ $employee->id }}</td>
                <td class="border px-4 py-2">{{ $employee->name }}</td>
                <td class="border px-4 py-2">{{ $employee->email }}</td>
                <td class="border px-4 py-2">{{ $employee->phone }}</td>
                <td class="border px-4 py-2">{{ $employee->position }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('employees.show', $employee) }}" class="text-green-600">Show</a>
                    <a href="{{ route('employees.edit', $employee) }}" class="text-blue-600">Edit</a>
                    <form method="POST" action="{{ route('employees.destroy', $employee) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete?')" class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-4">{{ $employees->links() }}</div>
    </x-app-layout>
    