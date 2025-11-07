<x-app-layout>
    <x-slot name="header"><h2>Add Meter</h2></x-slot>
    
    <form action="{{ route('meters.store') }}" method="POST" class="space-y-4 p-4 bg-retext-red-400 shadow rounded">
        @csrf
        <div>
            <label>Customer</label>
            <select name="customer_id" class="border rounded p-2 w-full">
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
            @error('customer_id')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <div>
            <label>Serial Number</label>
            <input type="text" name="serial_number" class="border rounded p-2 w-full" value="{{ old('serial_number') }}">
            @error('serial_number')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <div>
            <label>Previous Reading</label>
            <input type="number" step="0.01" name="previous_reading" class="border rounded p-2 w-full" value="{{ old('previous_reading',0) }}">
            @error('previous_reading')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <div>
            <label>Current Reading</label>
            <input type="number" step="0.01" name="current_reading" class="border rounded p-2 w-full" value="{{ old('current_reading',0) }}">
            @error('current_reading')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <button type="submit" class="bg-green-500 text-red-400 px-4 py-2 rounded">Save</button>
    </form>
    </x-app-layout>
    