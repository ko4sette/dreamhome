@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">

    <div class="flex flex-col gap-2">
        <h1 class="text-3xl font-bold">Rate your viewing</h1>
        <p class="text-neutral-500">Choose the viewing you attended and leave a quick rating with comments.</p>
    </div>

    @if($errors->any())
        <div class="mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('feedback.store') }}" class="mt-8 bg-white rounded-3xl shadow-sm p-6 space-y-6">
        @csrf

        @if($selectedProperty)
            <div class="rounded-3xl border border-blue-100 bg-blue-50 p-4">
                <div class="text-sm text-blue-700 font-semibold">Rating for</div>
                <div class="mt-2 text-lg font-bold">{{ $selectedProperty->property_type }}</div>
                <div class="text-neutral-600">{{ $selectedProperty->street }}, {{ $selectedProperty->area }}, {{ $selectedProperty->city }}</div>
            </div>
        @endif

        <div>
            <div class="flex items-center justify-between gap-4">
                <label class="block text-sm font-semibold text-neutral-900">Select a viewing</label>
                <span class="text-xs text-neutral-500">{{ $viewings->count() }} available</span>
            </div>

            @if($viewings->isEmpty())
                <div class="mt-3 rounded-2xl border border-yellow-200 bg-yellow-50 p-4 text-sm text-yellow-700">
                    No viewings found for this property yet. Please schedule a viewing first, then come back to rate it.
                </div>
            @else
                <div class="mt-3 grid gap-3">
                    @foreach($viewings as $viewing)
                        <label class="cursor-pointer rounded-3xl border px-4 py-4 transition hover:border-blue-500 {{ old('viewing_id') == $viewing->viewing_id ? 'border-blue-500 bg-blue-50' : 'border-neutral-200 bg-white' }}">
                            <input type="radio" name="viewing_id" value="{{ $viewing->viewing_id }}" class="sr-only" {{ old('viewing_id') == $viewing->viewing_id ? 'checked' : '' }} required>
                            <div class="flex items-center justify-between gap-4 text-sm">
                                <div>
                                    <div class="font-semibold">{{ $viewing->property->property_name ?? $viewing->property->property_type }}</div>
                                    <div class="text-neutral-500">{{ $viewing->viewing_date?->format('M d, Y') }} at {{ $viewing->viewing_time }}</div>
                                </div>
                                <div class="text-neutral-500">Status: {{ ucfirst($viewing->status) }}</div>
                            </div>
                        </label>
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <label class="block text-sm font-semibold text-neutral-900">Your rating</label>
            <div class="mt-3 flex gap-2 text-3xl">
                @foreach(range(1, 5) as $star)
                    <label class="cursor-pointer text-gray-300 hover:text-yellow-500">
                        <input type="radio" name="rating" value="{{ $star }}" class="sr-only" {{ old('rating') == $star ? 'checked' : '' }} required>
                        <span class="{{ old('rating', 0) >= $star ? 'text-yellow-500' : '' }}">★</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <label for="feedback_comment" class="block text-sm font-semibold text-neutral-900">Your feedback</label>
            <textarea id="feedback_comment" name="feedback_comment" rows="5" class="mt-2 w-full px-4 py-3 border border-neutral-300 rounded-2xl focus:outline-none focus:border-blue-500" placeholder="Share what you liked or what could be better">{{ old('feedback_comment') }}</textarea>
        </div>

        <div>
            <label for="interested" class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-neutral-900">
                <input type="checkbox" id="interested" name="interested" value="1" {{ old('interested') ? 'checked' : '' }} class="w-4 h-4 rounded border-neutral-300 text-blue-600 focus:ring-blue-500">
                I'm interested in renting this property
            </label>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('properties.index') }}" class="px-6 py-3 rounded-2xl border border-neutral-300 text-sm font-semibold hover:bg-neutral-50 transition text-neutral-700">
                Cancel
            </a>
            <button type="submit" class="px-6 py-3 rounded-2xl bg-blue-600 text-sm font-semibold text-white hover:bg-blue-700 transition">
                Submit Feedback
            </button>
        </div>
    </form>

</div>
@endsection
