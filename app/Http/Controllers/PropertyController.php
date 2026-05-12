<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Owner;
use App\Models\Branch;
use App\Models\ViewingFeedback;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query()->with(['owner', 'branch']);

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('city', 'like', '%' . $request->q . '%')
                  ->orWhere('area', 'like', '%' . $request->q . '%')
                  ->orWhere('property_type', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('property_type', $request->type);
        }

        if ($request->filled('max_rent')) {
            $query->where('monthly_rent', '<=', $request->max_rent);
        }

        $properties = $query
            ->where('is_active', true)
            ->latest('date_added')
            ->paginate(9);

        $types = Property::where('is_active', true)
    ->select('property_type')
    ->distinct()
    ->orderBy('property_type')
    ->pluck('property_type');

return view('properties.index', compact('properties', 'types'));
    }

    public function show(Property $property)
    {
        $feedbackQuery = ViewingFeedback::whereHas('viewing', function ($query) use ($property) {
            $query->where('property_id', $property->property_id);
        });

        $avgRating = $feedbackQuery->avg('rating');
        $feedbackCount = $feedbackQuery->count();

        $hasCompletedViewing = false;
        if (auth()->check() && auth()->user()->role === 'client') {
            $hasCompletedViewing = \App\Models\Viewing::where('property_id', $property->property_id)
                ->where('client_id', auth()->id())
                ->where('status', 'completed')
                ->exists();
        }

        return view('properties.show', compact('property', 'avgRating', 'feedbackCount', 'hasCompletedViewing'));
    }

    public function staffIndex()
    {
        $properties = Property::latest()->paginate(10);

        return view('staff.properties.index', compact('properties'));
    }

    public function create()
    {
        $owners = Owner::all();
        $branches = Branch::all();

        return view('staff.properties.create', compact('owners', 'branches'));
    }

    public function store(Request $request)
    {
        Property::create($request->all());

        return redirect()
            ->route('staff.properties.index')
            ->with('success', 'Property created successfully.');
    }

    public function edit(Property $property)
    {
        $owners = Owner::all();
        $branches = Branch::all();

        return view('staff.properties.edit', compact('property', 'owners', 'branches'));
    }

    public function update(Request $request, Property $property)
    {
        $property->update($request->all());

        return redirect()
            ->route('staff.properties.index')
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()
            ->route('staff.properties.index')
            ->with('success', 'Property deleted successfully.');
    }
}