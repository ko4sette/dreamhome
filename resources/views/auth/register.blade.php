<x-guest-layout>
<div class="dh-auth-wrap">

    {{-- LEFT: Register Form --}}
    <div class="dh-auth-panel">
        <div class="dh-card">

            <div class="dh-card-head">
                <h1>Create an account</h1>
                <p>Join DreamHome and find your perfect rental property.</p>
            </div>

            {{-- Step progress bar --}}
            <div class="dh-steps-bar">
                <div class="dh-step-seg done" id="seg1"></div>
                <div class="dh-step-seg" id="seg2"></div>
            </div>
            <div class="dh-step-meta" id="smeta">
                Step <b>1</b> of 2 &nbsp;·&nbsp; Personal Information
            </div>

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

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- ══════════════════════════════
                     STEP 1 — Personal Information
                     Maps to: client table
                ═══════════════════════════════ --}}
                <div class="dh-fsec active" id="s1">

                    
                        <div class="dh-fg">
                           
                        
                            <label>Name</label>
                            <input type="text" name="name"
                                value="{{ old('name') }}"
                                placeholder="e.g. Ritchie" required/>
                        </div>
                    </div>

                    <div class="dh-row2">
                        <div class="dh-fg">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth"
                                value="{{ old('date_of_birth') }}" required/>
                        </div>
                        <div class="dh-fg">
                            <label>Gender</label>
                            <select name="gender" required>
                                <option value="">Select</option>
                                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="dh-fg">
                        <label>Email Address</label>
                        <input type="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="your@email.com"
                            required autocomplete="username"/>
                    </div>

                    <div class="dh-fg">
                        <label>Telephone</label>
                        <input type="text" name="telephone"
                            value="{{ old('telephone') }}"
                            placeholder="e.g. 01475 392178" required/>
                    </div>

                    <div class="dh-fg">
                        <label>Home Address</label>
                        <input type="text" name="address"
                            value="{{ old('address') }}"
                            placeholder="Street, city, postcode" required/>
                    </div>

                    <div class="dh-fg">
                        <label>Password</label>
                        <input type="password" name="password"
                            placeholder="Create a password"
                            required autocomplete="new-password"/>
                    </div>

                    <div class="dh-fg">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            placeholder="Repeat your password"
                            required autocomplete="new-password"/>
                    </div>

                    <button type="button" class="dh-btn-main" onclick="goStep(2)">
                        Next — Property Preferences →
                    </button>

                    <div class="dh-switch">
                        Already have an account?
                        <a href="{{ route('login') }}">Log in</a>
                    </div>

                </div>

                {{-- ══════════════════════════════
                     STEP 2 — Property Preferences
                     Maps to: client_preference table
                ═══════════════════════════════ --}}
                <div class="dh-fsec" id="s2">

                    <div class="dh-fg">
                        <label>Preferred Property Type</label>
                        <select name="preferred_property_type" required>
                            <option value="">Select a type</option>
                            <option value="Flat"      {{ old('preferred_property_type') == 'Flat'      ? 'selected' : '' }}>Flat</option>
                            <option value="House"     {{ old('preferred_property_type') == 'House'     ? 'selected' : '' }}>House</option>
                            <option value="Apartment" {{ old('preferred_property_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                        </select>
                    </div>

                    <div class="dh-fg">
                        <label>Maximum Monthly Rent (₱)</label>
                        <input type="number" name="max_monthly_rent"
                            value="{{ old('max_monthly_rent') }}"
                            placeholder="e.g. 750"
                            required min="0"/>
                    </div>

                    <div class="dh-fg">
                        <label>Additional Comments</label>
                        <textarea name="comments" rows="3"
                            placeholder="Any specific requirements — location, rooms, pet-friendly...">{{ old('comments') }}</textarea>
                    </div>

                    <button type="submit" class="dh-btn-main">
                        Complete Registration
                    </button>

                    <button type="button" class="dh-btn-sec" onclick="goStep(1)">
                        ← Back
                    </button>

                </div>

            </form>
        </div>
    </div>

    {{-- RIGHT: Decorative Panel --}}
    <div class="dh-auth-deco">
        <div class="dh-deco-text">
            <h2>Almost There — Your Dream Home Awaits</h2>
            <p>Tell us what you're looking for and we'll match you with the best available properties at your nearest branch.</p>
        </div>
        <div class="dh-deco-pills">
            <div class="dh-deco-pill">Flat</div>
            <div class="dh-deco-pill">House</div>
            <div class="dh-deco-pill">Apartment</div>
            <div class="dh-deco-pill">Budget Friendly</div>
            <div class="dh-deco-pill">Pet Friendly</div>
        </div>
        <div class="dh-deco-stat">
            <div class="dh-stat-item"><div class="num">200+</div><div class="lbl">Properties</div></div>
            <div class="dh-stat-item"><div class="num">12</div><div class="lbl">Branches</div></div>
        </div>
    </div>

</div>
<script>
    function goStep(n) {

        // Validate step 1 before moving to step 2
        if (n === 2) {

            const step1 = document.getElementById('s1');

            const inputs = step1.querySelectorAll('input, select');

            for (const input of inputs) {

                if (!input.checkValidity()) {
                    input.reportValidity();
                    return;
                }
            }
        }

        // Hide all steps
        document.querySelectorAll('.dh-fsec')
            .forEach(s => s.classList.remove('active'));

        // Show selected step
        document.getElementById('s' + n)
            .classList.add('active');

        // Progress bars
        document.getElementById('seg1')
            .classList.toggle('done', n >= 1);

        document.getElementById('seg2')
            .classList.toggle('done', n >= 2);

        // Labels
        const labels = {
            1: 'Step <b>1</b> of 2 &nbsp;·&nbsp; Personal Information',
            2: 'Step <b>2</b> of 2 &nbsp;·&nbsp; Property Preferences',
        };

        document.getElementById('smeta').innerHTML = labels[n] || '';
    }

    document.addEventListener('DOMContentLoaded', function () {
        goStep(1);
    });
</script>
</x-guest-layout>