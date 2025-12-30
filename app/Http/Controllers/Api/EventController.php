<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // If authenticated admin, show all events
        if (auth()->check()) {
            $events = Event::orderBy('event_date', 'desc')->get();
            return response()->json($events);
        }

        // Public view - only active events
        $query = Event::where('is_active', true);
        
        if ($request->has('featured') && $request->featured == 'true') {
            $query->where('is_featured', true);
        }
        
        if ($request->has('limit')) {
            $events = $query->orderBy('event_date')->limit($request->limit)->get();
        } else {
            $events = $query->orderBy('event_date')->get();
        }
        
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'event_date' => 'required|date',
            'event_time' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        $event = Event::create($validated);

        return response()->json([
            'message' => 'Event created successfully',
            'data' => $event
        ], 201);
    }

    public function show($id)
    {
        $event = Event::where('is_active', true)->findOrFail($id);
        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'event_date' => 'required|date',
            'event_time' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        $event->update($validated);

        return response()->json([
            'message' => 'Event updated successfully',
            'data' => $event
        ]);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}
