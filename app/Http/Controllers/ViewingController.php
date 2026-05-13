<?php

namespace App\Http\Controllers;

use App\Models\Viewing;
use App\Models\Property;
use Illuminate\Http\Request;

class ViewingController extends Controller
{
    public function index()
    {
        $viewings = Viewing::with(['property', 'feedback'])
            ->latest()
            ->paginate(10);

        return view('viewings.index', compact('viewings'));
    }

    public function create(Request $request)
    {
        $selectedPropertyId = $request->query('property_id');

        $properties = Property::where('status', 'Available')
            ->orWhere('status', 'available')
            ->get();

        return view('viewings.create', compact('properties', 'selectedPropertyId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id'  => 'required|exists:properties,property_id',
            'viewing_date' => 'required|date|after_or_equal:today',
            'viewing_time' => 'required',
        ]);

        Viewing::create([
            'property_id'  => $request->property_id,
            'client_id'    => auth()->id(),
            'viewing_date' => $request->viewing_date,
            'viewing_time' => $request->viewing_time,
            'status'       => 'scheduled',
        ]);

        return redirect()->route('viewings.index')
            ->with('success', 'Viewing scheduled successfully.');
    }

    public function show(Viewing $viewing)
    {
        $viewing->load(['property', 'feedback']);
        return view('viewings.show', compact('viewing'));
    }

    public function edit(Viewing $viewing)
    {
        $properties = Property::all();
        return view('viewings.edit', compact('viewing', 'properties'));
    }

    public function update(Request $request, Viewing $viewing)
    {
        $request->validate([
            'property_id'  => 'required|exists:properties,property_id',
            'client_id'    => 'required|integer|min:1',
            'viewing_date' => 'required|date',
            'viewing_time' => 'required',
            'status'       => 'in:scheduled,completed,cancelled',
        ]);

        $viewing->update($request->all());

        return redirect()->route('viewings.index')
            ->with('success', 'Viewing updated successfully.');
    }

    public function destroy(Viewing $viewing)
    {
        $viewing->delete();

        return redirect()->route('viewings.index')
            ->with('success', 'Viewing deleted successfully.');
    }
}