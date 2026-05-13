<?php
namespace App\Http\Controllers;
use App\Models\Viewing;
use App\Models\ViewingFeedback;
use App\Models\Property;
use Illuminate\Http\Request;

class ViewingFeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = ViewingFeedback::with('viewing.property')->latest()->paginate(10);
        return view('feedback.index', compact('feedbacks'));
    }

    public function create(Request $request)
    {
        $propertyId = $request->query('property_id');
        $selectedProperty = $propertyId ? Property::find($propertyId) : null;

        $viewings = Viewing::with('property')
            ->where('client_id', auth()->id())
            ->where('status', 'completed')
            ->whereDoesntHave('feedback')
            ->when($selectedProperty, function ($query, $propertyId) {
                $query->where('property_id', $propertyId);
            })
            ->latest()
            ->get();

        return view('feedback.create', compact('viewings', 'selectedProperty'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'viewing_id'       => 'required|exists:viewings,viewing_id',
            'feedback_comment' => 'required|string',
            'rating'           => 'required|integer|min:1|max:5',
            'interested'       => 'boolean',
        ]);

        ViewingFeedback::create($request->all());
        return redirect()->route('feedback.index')->with('success', 'Thank you for your feedback!');
    }
}