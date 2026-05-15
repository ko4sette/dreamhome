@extends('layouts.app')

@section('content')


        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-neutral-900 text-white font-semibold">
                Login
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-xl border border-neutral-200 text-neutral-900 font-semibold">
                    Register
                </a>
            @endif
        </div>
    </div>
</div>
@endsection