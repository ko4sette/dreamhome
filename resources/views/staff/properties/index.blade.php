@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <div class="flex items-end justify-between gap-4 flex-wrap">
        <div>
            <h1 class="text-3xl font-bold">Property Management</h1>
            <p class="text-neutral-500 mt-2">Add, edit, and deactivate properties.</p>
        </div>

        <a href="{{ route('staff.properties.create') }}" class="px-5 py-3 rounded-xl bg-neutral-900 text-white font-medium">
            Add Property
        </a>
    </div>

    @if(session('success'))
        <div class="mt-6 p-4 rounded-2xl bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-8 bg-white rounded-3xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-neutral-100 text-left">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Type</th>
                    <th class="p-4">Location</th>
                    <th class="p-4">Rent</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Owner</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                    <tr class="border-t">
                        <td class="p-4">{{ $property->property_id }}</td>
                        <td class="p-4">{{ $property->property_type }}</td>
                        <td class="p-4">{{ $property->city }}</td>
                        <td class="p-4">₱{{ number_format($property->monthly_rent) }}</td>
                        <td class="p-4">{{ $property->status }}</td>
                        <td class="p-4">{{ $property->owner?->first_name }} {{ $property->owner?->last_name }}</td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="{{ route('staff.properties.edit', $property) }}" class="px-3 py-2 rounded-lg border">Edit</a>
                                <form action="{{ route('staff.properties.destroy', $property) }}" method="POST" onsubmit="return confirm('Deactivate this property?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-2 rounded-lg border border-red-300 text-red-600">
                                        Deactivate
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-neutral-500">No properties yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $properties->links() }}
    </div>
</div>
@endsection