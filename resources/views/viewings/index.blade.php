@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <div class="flex items-end justify-between gap-4 flex-wrap">
        <div>
            <h1 class="text-3xl font-bold">Viewings</h1>
            <p class="mt-2 text-neutral-500">Schedule and manage property viewings.</p>
        </div>
        <a href="{{ route('viewings.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Schedule Viewing
        </a>
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

    @if(session('success'))
        <div class="mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-8 bg-white rounded-3xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-neutral-50 text-left border-b">
                <tr>
                    <th class="p-4">Property</th>
                    <th class="p-4">Viewing Date</th>
                    <th class="p-4">Time</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($viewings as $viewing)
                    <tr class="border-t hover:bg-neutral-50 transition">
                        <td class="p-4 font-medium">{{ $viewing->property->property_name ?? 'N/A' }}</td>
                        <td class="p-4">{{ $viewing->viewing_date?->format('M d, Y') }}</td>
                        <td class="p-4">{{ $viewing->viewing_time }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($viewing->status === 'scheduled') bg-blue-100 text-blue-700
                                @elseif($viewing->status === 'completed') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700
                                @endif
                            ">
                                {{ ucfirst($viewing->status) }}
                            </span>
                        </td>
                        <td class="p-4 space-x-2">
                            <a href="{{ route('viewings.edit', $viewing) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                            <form method="POST" action="{{ route('viewings.destroy', $viewing) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-neutral-500">No viewings scheduled yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $viewings->links() }}
    </div>
</div>
@endsection
