<?php
namespace App\Http\Controllers;
use App\Models\Viewing;
use App\Models\Property;
use Illuminate\Http\Request;

class RentalContractController extends Controller
{
    public function index()
    {
        $viewings = Viewing::with('property')->latest()->paginate(10);
        return view('viewings.index', compact('viewings'));
    }

    public function create()
    {
        $properties = Property::where('status', '!=', 'rented')->get();
        return view('viewings.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id'  => 'required|exists:properties,property_id',
            'client_id'    => 'required|integer',
            'viewing_date' => 'required|date',
            'viewing_time' => 'required',
            'status'       => 'in:scheduled,completed,cancelled',
        ]);
        Viewing::create($request->all());
        return redirect()->route('viewings.index')->with('success', 'Viewing scheduled.');
    }

    public function edit(Viewing $viewing)
    {
        $properties = Property::all();
        return view('viewings.edit', compact('viewing', 'properties'));
    }

    public function update(Request $request, Viewing $viewing)
    {
        $viewing->update($request->all());
        return redirect()->route('viewings.index')->with('success', 'Viewing updated.');
    }

    public function destroy(Viewing $viewing)
    {
        $viewing->delete();
        return redirect()->route('viewings.index')->with('success', 'Viewing deleted.');
    }
}