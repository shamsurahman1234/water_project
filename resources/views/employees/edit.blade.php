<x-app-layout>
    <x-slot name="header"><h2>Edit Employee</h2></x-slot>
    
    <form action="{{ route('employees.update', $employee) }}" method="POST" class="space-y-4 p-4 bg-white shadow rounded">
        @csrf
        @method('PUT')
    
        <div>
            <label>Name</label>
            <input type="text" name="name" class="border rounded p-2 w-full" value="{{ old('name', $employee->name) }}">
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <div>
            <label>Email</label>
            <input type="email" name="email" class="border rounded p-2 w-full" value="{{ old('email', $employee->email) }}">
            @error('email')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <div>
            <label>Phone</label>
            <input type="text" name="phone" class="border rounded p-2 w-full" value="{{ old('phone', $employee->phone) }}">
            @error('phone')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <div>
            <label>Position</label>
            <input type="text" name="position" class="border rounded p-2 w-full" value="{{ old('position', $employee->position) }}">
            @error('position')<span class="text-red-600">{{ $message }}</span>@enderror
        </div>
    
        <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded">Update</button>
    </form>
    </x-app-layout>
    