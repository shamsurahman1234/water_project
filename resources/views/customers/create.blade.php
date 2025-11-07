<x-app-layout>
    <x-slot name="header"><h2>Add Customer</h2></x-slot>
    
    <form action="{{ route('customers.store') }}" method="POST" class="space-y-4 p-4 bg-redtext-red-400 shadow rounded">
        @csrf
        <div>
            <label>Name</label>
            <input type="text" name="name" class="border rounded p-2 w-full" value="{{ old('name') }}">
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <div>
            <label>Address</label>
            <input type="text" name="address" class="border rounded p-2 w-full" value="{{ old('address') }}">
            @error('address')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <div>
            <label>Phone</label>
            <input type="text" name="phone" class="border rounded p-2 w-full" value="{{ old('phone') }}">
            @error('phone')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <button type="submit" class="bg-blue-500 text-red-400 px-4 py-2 rounded">Save</button>
    </form>
    </x-app-layout>
    