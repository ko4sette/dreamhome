@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <div class="flex items-end justify-between gap-4 flex-wrap">
        <div>
            <h1 class="text-3xl font-bold">Viewing Feedback</h1>
            <p class="mt-2 text-neutral-500">Client feedback and ratings for properties.</p>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-3xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-neutral-50 text-left border-b">
                <tr>
                    <th class="p-4">Property</th>
                    <th class="p-4">Viewed Date</th>
                    <th class="p-4">Rating</th>
                    <th class="p-4">Interested</th>
                    <th class="p-4">Comment</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $feedback)
                    <tr class="border-t hover:bg-neutral-50 transition">
                        <td class="p-4 font-medium">{{ $feedback->viewing->property->property_name ?? 'N/A' }}</td>
                        <td class="p-4">{{ $feedback->viewing->viewing_date?->format('M d, Y') ?? 'N/A' }}</td>
                        <td class="p-4">
                            <span class="text-yellow-500">
                                @for($i = 0; $i < $feedback->rating; $i++)
                                    ⭐
                                @endfor
                            </span>
                            {{ $feedback->rating }}/5
                        </td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $feedback->interested ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $feedback->interested ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td class="p-4 max-w-xs truncate" title="{{ $feedback->feedback_comment }}">{{ $feedback->feedback_comment }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-neutral-500">No feedback submitted yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $feedbacks->links() }}
</div>
@endsection