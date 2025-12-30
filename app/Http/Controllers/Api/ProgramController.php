<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        // If authenticated admin, show all programs
        if (auth()->check()) {
            $programs = Program::orderBy('created_at', 'desc')->get();
            return response()->json($programs);
        }

        // Public view - only active programs
        $query = Program::where('is_active', true);
        
        if ($request->has('featured') && $request->featured == 'true') {
            $query->where('is_featured', true);
        }
        
        if ($request->has('limit')) {
            $programs = $query->orderBy('sort_order')->limit($request->limit)->get();
        } else {
            $programs = $query->orderBy('sort_order')->get();
        }
        
        return response()->json($programs);
    }

    public function show($id)
    {
        $program = Program::where('is_active', true)->findOrFail($id);
        return response()->json($program);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $program = Program::create($validated);

        return response()->json([
            'message' => 'Program created successfully',
            'data' => $program
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $program->update($validated);

        return response()->json([
            'message' => 'Program updated successfully',
            'data' => $program
        ]);
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        $program->delete();

        return response()->json(['message' => 'Program deleted successfully']);
    }
}
