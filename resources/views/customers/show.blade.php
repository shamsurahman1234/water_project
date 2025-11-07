<x-app-layout>
    <x-slot name="header"><h2>Customer Details</h2></x-slot>
    
    <div class="p-4 bg-white shadow rounded space-y-2">
        <p><strong>ID:</strong> {{ $customer->id }}</p>
        <p><strong>Name:</strong> {{ $customer->name }}</p>
        <p><strong>Address:</strong> {{ $customer->address }}</p>
        <p><strong>Phone:</strong> {{ $customer->phone }}</p>
    </div>
    
    <a href="{{ route('customers.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Back</a>
    </x-app-layout>
    