@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <div class="flex items-end justify-between gap-4 flex-wrap">
        <div>
            <h1 class="text-3xl font-bold">Staff Home</h1>
            <p class="mt-2 text-neutral-500">Welcome, {{ $staffMember }}.</p>
        </div>

        <a href="{{ route('staff.properties.index') }}" class="px-5 py-3 rounded-xl bg-neutral-900 text-white font-medium">
            Manage Properties
        </a>
    </div>

    <div class="mt-8 grid md:grid-cols-4 gap-4">
        <div class="bg-white rounded-3xl p-6 shadow-sm">
            <div class="text-sm text-neutral-500">Total Properties</div>
            <div class="text-3xl font-bold mt-2">{{ $totalProperties }}</div>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-sm">
            <div class="text-sm text-neutral-500">Available</div>
            <div class="text-3xl font-bold mt-2">{{ $availableProperties }}</div>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-sm">
            <div class="text-sm text-neutral-500">Rented</div>
            <div class="text-3xl font-bold mt-2">{{ $rentedProperties }}</div>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-sm">
            <div class="text-sm text-neutral-500">Owners</div>
            <div class="text-3xl font-bold mt-2">{{ $owners }}</div>
        </div>
    </div>

    <div class="mt-10 bg-white rounded-3xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b font-semibold">Recent Properties</div>
        <table class="w-full text-sm">
            <thead class="bg-neutral-50 text-left">
                <tr>
                    <th class="p-4">Type</th>
                    <th class="p-4">Location</th>
                    <th class="p-4">Rent</th>
                    <th class="p-4">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentProperties as $property)
                    <tr class="border-t">
                        <td class="p-4">{{ $property->property_type }}</td>
                        <td class="p-4">{{ $property->city }}</td>
                        <td class="p-4">₱{{ number_format($property->monthly_rent) }}</td>
                        <td class="p-4">{{ $property->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-neutral-500">No properties yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection