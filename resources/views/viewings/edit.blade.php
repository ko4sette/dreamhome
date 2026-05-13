@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">

    <div class="mb-6">
        <a href="{{ route('viewings.index') }}" class="text-blue-600 hover:underline text-sm">&larr; Back to Viewings</a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm p-6 space-y-6">
        
        <div>
            <h1 class="text-3xl font-bold">Edit Viewing</h1>
            <p class="mt-2 text-neutral-500">Update viewing details.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('viewings.update', $viewing) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="property_id" class="block text-sm font-semibold text-neutral-900">Property</label>
                <select id="property_id" name="property_id" required class="mt-2 w-full px-4 py-2 border border-neutral-300 rounded-lg focus:outline-none focus:border-blue-500">
                    @foreach($properties as $property)
                        <option value="{{ $property->property_id }}" {{ $viewing->property_id == $property->property_id ? 'selected' : '' }}>
                            {{ $property->property_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="viewing_date" class="block text-sm font-semibold text-neutral-900">Viewing Date</label>
                <input type="date" id="viewing_date" name="viewing_date" value="{{ $viewing->viewing_date?->format('Y-m-d') }}" required class="mt-2 w-full px-4 py-2 border border-neutral-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label for="viewing_time" class="block text-sm font-semibold text-neutral-900">Viewing Time</label>
                <input type="time" id="viewing_time" name="viewing_time" value="{{ $viewing->viewing_time }}" required class="mt-2 w-full px-4 py-2 border border-neutral-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-neutral-900">Status</label>
                <select id="status" name="status" class="mt-2 w-full px-4 py-2 border border-neutral-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="scheduled" {{ $viewing->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="completed" {{ $viewing->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $viewing->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="flex gap-4 justify-end pt-4">
                <a href="{{ route('viewings.index') }}" class="px-6 py-2 border border-neutral-300 rounded-lg hover:bg-neutral-50 transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Update Viewing
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
