@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <section class="grid lg:grid-cols-2 gap-8 items-center">
        <div>
            <span class="inline-block px-3 py-1 rounded-full bg-neutral-200 text-sm font-medium mb-4">
                Find Your Dream Home
            </span>

            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight leading-tight">
                Browse rental properties with ease.
            </h1>

            <p class="mt-5 text-lg text-neutral-600 max-w-xl">
                Search homes, flats, and apartments based on city, rent, and room count.
            </p>

            <form action="{{ route('properties.index') }}" method="GET" class="mt-8 bg-white rounded-2xl shadow-lg p-3 flex flex-col md:flex-row gap-3">
                <input
                    type="text"
                    name="q"
                    placeholder="Search city, area, or property type"
                    class="flex-1 px-4 py-3 rounded-xl border border-neutral-200 outline-none"
                >
                <button class="px-6 py-3 rounded-xl bg-neutral-900 text-white font-medium">
                    Search
                </button>
            </form>

            <div class="mt-6 flex flex-wrap gap-3 text-sm">
                <a href="{{ route('properties.index', ['type' => 'Flat']) }}" class="px-4 py-2 rounded-full bg-white border">Flat</a>
                <a href="{{ route('properties.index', ['type' => 'House']) }}" class="px-4 py-2 rounded-full bg-white border">House</a>
                <a href="{{ route('properties.index', ['type' => 'Apartment']) }}" class="px-4 py-2 rounded-full bg-white border">Apartment</a>
                <a href="{{ route('properties.index', ['max_rent' => 500]) }}" class="px-4 py-2 rounded-full bg-white border">Budget friendly</a>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="rounded-3xl bg-neutral-200 h-72"></div>
            <div class="space-y-4">
                <div class="rounded-3xl bg-neutral-300 h-36"></div>
                <div class="rounded-3xl bg-neutral-400 h-28"></div>
            </div>
        </div>
    </section>

    <section class="mt-14 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="text-3xl font-bold">{{ \App\Models\Property::count() }}</div>
            <div class="text-neutral-500 mt-1">Total properties</div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="text-3xl font-bold">{{ \App\Models\Property::where('status','Available')->count() }}</div>
            <div class="text-neutral-500 mt-1">Available now</div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="text-3xl font-bold">{{ \App\Models\Owner::count() }}</div>
            <div class="text-neutral-500 mt-1">Property owners</div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="text-3xl font-bold">₱{{ number_format((int) round(\App\Models\Property::avg('monthly_rent') ?? 0)) }}</div>
            <div class="text-neutral-500 mt-1">Average rent</div>
        </div>
    </section>

    <section class="mt-16">
        <div class="flex items-end justify-between mb-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold">Featured Properties</h2>
                <p class="text-neutral-500 mt-1">Fresh listings from DreamHome.</p>
            </div>
            <a href="{{ route('properties.index') }}" class="text-sm font-medium underline">
                View all
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($featuredProperties as $property)
                <a href="{{ route('properties.show', $property) }}" class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="h-52 bg-neutral-300 flex items-center justify-center text-neutral-500 font-semibold">
                        Property Photo
                    </div>

                    <div class="p-5">
                        <div class="flex items-center justify-between gap-4">
                            <h3 class="font-bold text-lg">{{ $property->property_type }}</h3>
                            <span class="text-sm px-3 py-1 rounded-full bg-neutral-100">
                                {{ $property->status }}
                            </span>
                        </div>

                        <p class="text-neutral-500 mt-2">
                            {{ $property->street ?? 'Street not set' }}, {{ $property->city ?? 'City not set' }}
                        </p>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="font-bold text-xl">₱{{ number_format($property->monthly_rent) }}/mo</div>
                            <div class="text-sm text-neutral-500">{{ $property->num_rooms }} rooms</div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full bg-white rounded-3xl p-8 text-neutral-500">
                    No featured properties yet.
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection