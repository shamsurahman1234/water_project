<x-app-layout>
    <x-slot name="header"><h2>Edit Customer</h2></x-slot>
    
    <form action="{{ route('customers.update', $customer) }}" method="POST" class="space-y-4 p-4 bg-redtext-red-400 shadow rounded">
        @csrf
        @method('PUT')
        <div>
            <label>Name</label>
            <input type="text" name="name" class="border rounded p-2 w-full" value="{{ old('name', $customer->name) }}">
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <div>
            <label>Address</label>
            <input type="text" name="address" class="border rounded p-2 w-full" value="{{ old('address', $customer->address) }}">
            @error('address')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <div>
            <label>Phone</label>
            <input type="text" name="phone" class="border rounded p-2 w-full" value="{{ old('phone', $customer->phone) }}">
            @error('phone')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <button type="submit" class="bg-green-500 text-red-400 px-4 py-2 rounded">Update</button>
    </form>
    </x-app-layout>
    