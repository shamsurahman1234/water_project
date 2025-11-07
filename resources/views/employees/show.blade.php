<x-app-layout>
    <x-slot name="header"><h2>Employee Details</h2></x-slot>
    
    <div class="p-4 bg-white shadow rounded space-y-2">
        <p><strong>ID:</strong> {{ $employee->id }}</p>
        <p><strong>Name:</strong> {{ $employee->name }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>
        <p><strong>Phone:</strong> {{ $employee->phone }}</p>
        <p><strong>Position:</strong> {{ $employee->position }}</p>
    </div>
    
    <a href="{{ route('employees.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Back</a>
    </x-app-layout>
    