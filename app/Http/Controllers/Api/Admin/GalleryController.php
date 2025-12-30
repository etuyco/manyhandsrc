<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::with('event:id,title')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($galleries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',
            'url' => 'nullable|url|required_if:type,video',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|required_if:type,image',
            'event_id' => 'nullable|exists:events,id',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['title', 'description', 'type', 'url']);
        
        // Convert boolean and integer values properly
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($request->sort_order ?? 0);
        
        if ($request->filled('event_id')) {
            $data['event_id'] = (int) $request->event_id;
        }

        // Handle file upload for images
        if ($request->hasFile('file') && $request->type === 'image') {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('gallery', $filename, 'public');
            $data['file_path'] = $path;
        }

        // For YouTube videos, extract thumbnail
        if ($request->type === 'video' && $request->url) {
            preg_match("/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/\s]{11})/", $request->url, $matches);
            if (isset($matches[1])) {
                $data['thumbnail'] = "https://img.youtube.com/vi/{$matches[1]}/maxresdefault.jpg";
            }
        }

        $gallery = Gallery::create($data);
        $gallery->load('event:id,title');

        return response()->json($gallery, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::with('event')->findOrFail($id);
        return response()->json($gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',
            'url' => 'nullable|url|required_if:type,video',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_id' => 'nullable|exists:events,id',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['title', 'description', 'type', 'url']);
        
        // Convert boolean and integer values properly
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($request->sort_order ?? 0);
        
        if ($request->filled('event_id')) {
            $data['event_id'] = (int) $request->event_id;
        }

        // Handle file upload for images
        if ($request->hasFile('file') && $request->type === 'image') {
            // Delete old file if exists
            if ($gallery->file_path) {
                Storage::disk('public')->delete($gallery->file_path);
            }
            
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('gallery', $filename, 'public');
            $data['file_path'] = $path;
        }

        // For YouTube videos, extract thumbnail
        if ($request->type === 'video' && $request->url) {
            preg_match("/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/\s]{11})/", $request->url, $matches);
            if (isset($matches[1])) {
                $data['thumbnail'] = "https://img.youtube.com/vi/{$matches[1]}/maxresdefault.jpg";
            }
        }

        $gallery->update($data);
        $gallery->load('event:id,title');

        return response()->json($gallery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete file if exists
        if ($gallery->file_path) {
            Storage::disk('public')->delete($gallery->file_path);
        }

        $gallery->delete();

        return response()->json(['message' => 'Gallery item deleted successfully']);
    }

    /**
     * Get events for dropdown
     */
    public function events()
    {
        $events = Event::where('is_active', true)
            ->orderBy('title')
            ->get(['id', 'title']);
            
        return response()->json($events);
    }
}
