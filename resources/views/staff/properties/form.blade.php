@php
    $isEdit = isset($property);
@endphp

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-2">Owner</label>
        <select name="owner_id" class="w-full px-4 py-3 rounded-xl border border-neutral-200">
            <option value="">Select owner</option>
            @foreach($owners as $owner)
                <option value="{{ $owner->owner_id }}" @selected(old('owner_id', $property->owner_id ?? '') == $owner->owner_id)>
                    {{ $owner->first_name }} {{ $owner->last_name }}
                </option>
            @endforeach
        </select>
        @error('owner_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">Branch</label>
        <select name="branch_id" class="w-full px-4 py-3 rounded-xl border border-neutral-200">
            <option value="">Select branch</option>
            @foreach($branches as $branch)
                <option value="{{ $branch->branch_id }}" @selected(old('branch_id', $property->branch_id ?? '') == $branch->branch_id)>
                    {{ $branch->branch_name }}
                </option>
            @endforeach
        </select>
        @error('branch_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">Staff</label>
        <select name="staff_id" class="w-full px-4 py-3 rounded-xl border border-neutral-200">
            <option value="">Select staff</option>
            @foreach($staff as $s)
                <option value="{{ $s->staff_id }}" @selected(old('staff_id', $property->staff_id ?? '') == $s->staff_id)>
                    {{ $s->first_name }} {{ $s->last_name }} ({{ $s->position }})
                </option>
            @endforeach
        </select>
        @error('staff_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">Property Type</label>
        <input type="text" name="property_type" value="{{ old('property_type', $property->property_type ?? '') }}"
               class="w-full px-4 py-3 rounded-xl border border-neutral-200" placeholder="Flat, House, Apartment">
        @error('property_type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">Street</label>
        <input type="text" name="street" value="{{ old('street', $property->street ?? '') }}"
               class="w-full px-4 py-3 rounded-xl border border-neutral-200">
        @error('street') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">Area</label>
        <input type="text" name="area" value="{{ old('area', $property->area ?? '') }}"
               class="w-full px-4 py-3 rounded-xl border border-neutral-200">
        @error('area') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">City</label>
        <input type="text" name="city" value="{{ old('city', $property->city ?? '') }}"
               class="w-full px-4 py-3 rounded-xl border border-neutral-200">
        @error('city') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">Postcode</label>
        <input type="text" name="postcode" value="{{ old('postcode', $property->postcode ?? '') }}"
               class="w-full px-4 py-3 rounded-xl border border-neutral-200">
        @error('postcode') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">Number of Rooms</label>
        <input type="number" name="num_rooms" value="{{ old('num_rooms', $property->num_rooms ?? '') }}"
               class="w-full px-4 py-3 rounded-xl border border-neutral-200">
        @error('num_rooms') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">Monthly Rent</label>
        <input type="number" step="0.01" name="monthly_rent" value="{{ old('monthly_rent', $property->monthly_rent ?? '') }}"
               class="w-full px-4 py-3 rounded-xl border border-neutral-200">
        @error('monthly_rent') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">Status</label>
        <select name="status" class="w-full px-4 py-3 rounded-xl border border-neutral-200">
            @foreach(['Available','Rented','Reserved','Inactive'] as $status)
                <option value="{{ $status }}" @selected(old('status', $property->status ?? 'Available') === $status)>
                    {{ $status }}
                </option>
            @endforeach
        </select>
        @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center gap-3 mt-8">
        <input type="checkbox" name="is_active" value="1" class="w-4 h-4" @checked(old('is_active', $property->is_active ?? true))>
        <label class="text-sm font-medium">Active</label>
    </div>
</div>

<div class="mt-8">
    <button class="px-6 py-3 rounded-xl bg-neutral-900 text-white font-medium">
        {{ $isEdit ? 'Update Property' : 'Save Property' }}
    </button>
</div>