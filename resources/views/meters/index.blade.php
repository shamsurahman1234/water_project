<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800">💧 Meters</h2>
    </x-slot>

    <div class="py-4">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4">
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('meters.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">➕ Add Meter</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Customer</th>
                                    <th class="border px-4 py-2">Previous Reading</th>
                                    <th class="border px-4 py-2">Current Reading</th>
                                    <th class="border px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($meters as $m)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $m->id }}</td>
                                        <td class="border px-4 py-2">{{ optional($m->customer)->name }}</td>
                                        <td class="border px-4 py-2">{{ number_format($m->previous_reading, 2) }}</td>
                                        <td class="border px-4 py-2">{{ number_format($m->current_reading, 2) }}</td>
                                        <td class="border px-4 py-2 flex gap-2 items-center">
                                            <a href="{{ route('meters.show', $m) }}" class="text-green-600">Show</a>
                                            <a href="{{ route('meters.edit', $m) }}" class="text-blue-600">Edit</a>

                                            {{-- Scan button (opens camera scan page) --}}
                                            <a href="{{ route('meters.scan', $m->id) }}" class="text-purple-600 font-semibold">📷 Scan</a>

                                            <form method="POST" action="{{ route('meters.destroy', $m) }}" onsubmit="return confirm('Are you sure you want to delete this meter?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border px-4 py-6 text-center text-gray-500">
                                            No meters found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $meters->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
