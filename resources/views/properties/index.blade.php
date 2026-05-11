@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold">Browse Properties</h1>
        <p class="text-neutral-500 mt-2">Filter by type, city, rent, and rooms.</p>
    </div>

    <form method="GET" action="{{ route('properties.index') }}" class="bg-white rounded-3xl p-5 shadow-sm grid md:grid-cols-5 gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search..." class="px-4 py-3 rounded-xl border border-neutral-200">
        <select name="type" class="px-4 py-3 rounded-xl border border-neutral-200">
            <option value="">All Types</option>
            @foreach($types as $type)
                <option value="{{ $type }}" @selected(request('type') === $type)>{{ $type }}</option>
            @endforeach
        </select>
        <input type="text" name="city" value="{{ request('city') }}" placeholder="City" class="px-4 py-3 rounded-xl border border-neutral-200">
        <input type="number" name="max_rent" value="{{ request('max_rent') }}" placeholder="Max rent" class="px-4 py-3 rounded-xl border border-neutral-200">
        <input type="number" name="rooms" value="{{ request('rooms') }}" placeholder="Min rooms" class="px-4 py-3 rounded-xl border border-neutral-200">

        <div class="md:col-span-5 flex gap-3">
            <button class="px-5 py-3 rounded-xl bg-neutral-900 text-white font-medium">Apply Filter</button>
            <a href="{{ route('properties.index') }}" class="px-5 py-3 rounded-xl border font-medium">Reset</a>
        </div>
    </form>

    <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($properties as $property)
            <a href="{{ route('properties.show', $property) }}" class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition">
                <div class="h-52 bg-neutral-300 flex items-center justify-center text-neutral-500 font-semibold">
                    Property Photo
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-lg">{{ $property->property_type }}</h3>
                        <span class="text-xs px-3 py-1 rounded-full bg-neutral-100">{{ $property->status }}</span>
                    </div>

                    <p class="text-neutral-500 mt-2">{{ $property->street }}, {{ $property->city }}</p>
                    <p class="text-neutral-500 text-sm mt-1">{{ $property->postcode }}</p>

                    <div class="mt-4 flex items-center justify-between">
                        <div class="font-bold text-xl">₱{{ number_format($property->monthly_rent) }}/mo</div>
                        <div class="text-sm text-neutral-500">{{ $property->num_rooms }} rooms</div>
                    </div>

                    <div class="mt-4 text-sm text-neutral-500">
                        Owner: {{ $property->owner?->first_name }} {{ $property->owner?->last_name }}
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-white rounded-3xl p-8 text-neutral-500">
                No properties found.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $properties->links() }}
    </div>
</div>
@endsection