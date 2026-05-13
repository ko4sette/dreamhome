<x-guest-layout>
<div class="dh-auth-wrap">

    {{-- LEFT: Login Form --}}
    <div class="dh-auth-panel">
        <div class="dh-card">

            <div class="dh-card-head">
                <h1>Welcome back</h1>
                <p>Log in to your DreamHome account to continue browsing properties.</p>
            </div>

            {{-- Session status --}}
            @if (session('status'))
                <div class="dh-alert dh-alert-success">{{ session('status') }}</div>
            @endif

            {{-- Success message from registration --}}
            @if (session('success'))
                <div class="dh-alert dh-alert-success">{{ session('success') }}</div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="dh-alert dh-alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="dh-fg">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="your@email.com"
                        required autofocus autocomplete="username"/>
                </div>

                <div class="dh-fg">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        placeholder="Enter your password"
                        required autocomplete="current-password"/>
                </div>

                <div class="dh-remember-row" style="margin-bottom: 14px;">
                    <label>
                        <input type="checkbox" name="remember" style="width:auto; margin:0;"/>
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="dh-btn-main">Log In</button>
            </form>

            <div class="dh-divider">or</div>

            <div class="dh-switch">
                Don't have an account?
                <a href="{{ route('register') }}">Register here</a>
            </div>

        </div>
    </div>

    {{-- RIGHT: Decorative Panel --}}
    <div class="dh-auth-deco">
        <div class="dh-deco-text">
            <h2>Find Your Dream Home Today</h2>
            <p>Browse hundreds of rental properties across the UK — flats, houses, and apartments tailored to your budget.</p>
        </div>
        <div class="dh-deco-stat">
            <div class="dh-stat-item"><div class="num">200+</div><div class="lbl">Properties</div></div>
            <div class="dh-stat-item"><div class="num">12</div><div class="lbl">Branches</div></div>
            <div class="dh-stat-item"><div class="num">98%</div><div class="lbl">Satisfaction</div></div>
        </div>
        <div class="dh-deco-pills">
            <div class="dh-deco-pill">Flat</div>
            <div class="dh-deco-pill">House</div>
            <div class="dh-deco-pill">Apartment</div>
            <div class="dh-deco-pill">Budget Friendly</div>
            <div class="dh-deco-pill">Pet Friendly</div>
        </div>
    </div>

</div>
</x-guest-layout>