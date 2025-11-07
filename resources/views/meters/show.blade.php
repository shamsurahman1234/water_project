<x-app-layout>
    <x-slot name="header"><h2>Meter Details</h2></x-slot>
    
    <div class="p-4 bg-white shadow rounded space-y-2">
        <p><strong>ID:</strong> {{ $meter->id }}</p>
        <p><strong>Serial Number:</strong> {{ $meter->serial_number }}</p>
        <p><strong>Customer:</strong> {{ $meter->customer->name }}</p>
        <p><strong>Previous Reading:</strong> {{ $meter->previous_reading }}</p>
        <p><strong>Current Reading:</strong> {{ $meter->current_reading }}</p>
    </div>
    
    <a href="{{ route('meters.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Back</a>
    </x-app-layout>
    