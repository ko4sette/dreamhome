@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">

    <a href="{{ route('properties.index') }}" class="text-sm underline">← Back to properties</a>

    <div class="mt-5 grid lg:grid-cols-2 gap-8">
        <div class="rounded-3xl bg-neutral-300 h-96 flex items-center justify-center text-neutral-600 font-semibold">
            Property Photo
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold">{{ $property->property_type }}</h1>
                    <p class="text-neutral-500 mt-2">{{ $property->street }}, {{ $property->area }}, {{ $property->city }}</p>
                </div>
                <span class="px-4 py-2 rounded-full bg-neutral-100">{{ $property->status }}</span>
            </div>

            <div class="mt-6 text-3xl font-extrabold">₱{{ number_format($property->monthly_rent) }}/month</div>

            <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                <div class="p-4 rounded-2xl bg-neutral-50">
                    <div class="text-neutral-500">Rooms</div>
                    <div class="font-semibold">{{ $property->num_rooms }}</div>
                </div>
                <div class="p-4 rounded-2xl bg-neutral-50">
                    <div class="text-neutral-500">Postcode</div>
                    <div class="font-semibold">{{ $property->postcode }}</div>
                </div>
                <div class="p-4 rounded-2xl bg-neutral-50">
                    <div class="text-neutral-500">Owner</div>
                    <div class="font-semibold">{{ $property->owner?->first_name }} {{ $property->owner?->last_name }}</div>
                </div>
                <div class="p-4 rounded-2xl bg-neutral-50">
                    <div class="text-neutral-500">Branch</div>
                    <div class="font-semibold">{{ $property->branch?->branch_name }}</div>
                </div>
            </div>

            <div class="mt-6 p-4 rounded-2xl bg-neutral-50">
                <h2 class="font-semibold mb-2">Description</h2>
                <p class="text-neutral-600 text-sm leading-relaxed">
                    This listing is pulled directly from PostgreSQL and can later be linked to viewing requests,
                    client preferences, and rental contracts.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection