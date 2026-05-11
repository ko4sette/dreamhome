@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-6">Add Property</h1>

    <form action="{{ route('staff.properties.store') }}" method="POST" class="bg-white rounded-3xl p-6 shadow-sm">
        @csrf
        @include('staff.properties.form')
    </form>
</div>
@endsection