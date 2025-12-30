<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Program;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => ['required', Rule::in(['program', 'event'])],
            'item_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'age' => 'nullable|string|max:20',
            'message' => 'nullable|string|max:1000',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'address_street' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_state' => 'nullable|string|max:255',
            'address_postal_code' => 'nullable|string|max:20',
            'address_country' => 'nullable|string|max:255',
        ]);

        // Verify that the program or event exists
        if ($validatedData['type'] === 'program') {
            $item = Program::findOrFail($validatedData['item_id']);
        } else {
            $item = Event::findOrFail($validatedData['item_id']);
        }

        // Check for duplicate registration
        $existingRegistration = Registration::where('type', $validatedData['type'])
            ->where('item_id', $validatedData['item_id'])
            ->where('email', $validatedData['email'])
            ->first();

        if ($existingRegistration) {
            return response()->json([
                'message' => 'You have already registered for this ' . $validatedData['type'] . '.'
            ], 422);
        }

        // Create the registration
        $registration = Registration::create($validatedData);

        // Send confirmation email (optional)
        try {
            $this->sendConfirmationEmail($registration, $item);
        } catch (\Exception $e) {
            // Log email error but don't fail the registration
            \Log::error('Failed to send registration confirmation email: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Registration submitted successfully!',
            'registration' => $registration
        ], 201);
    }

    public function index(Request $request)
    {
        $query = Registration::query();

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by item_id
        if ($request->has('item_id')) {
            $query->where('item_id', $request->item_id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Search by name or email
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(20);

        // Add related program/event data
        foreach ($registrations->items() as $registration) {
            if ($registration->type === 'program') {
                $registration->related_item = Program::find($registration->item_id);
            } elseif ($registration->type === 'event') {
                $registration->related_item = Event::find($registration->item_id);
            }
        }

        return response()->json($registrations);
    }

    public function show($id)
    {
        $registration = Registration::findOrFail($id);
        return response()->json($registration);
    }

    public function update(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $validatedData = $request->validate([
            'status' => ['sometimes', Rule::in(['pending', 'confirmed', 'cancelled'])],
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'nullable|string|max:20',
            'age' => 'nullable|string|max:20',
            'message' => 'nullable|string|max:1000',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'address_street' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_state' => 'nullable|string|max:255',
            'address_postal_code' => 'nullable|string|max:20',
            'address_country' => 'nullable|string|max:255',
        ]);

        $registration->update($validatedData);

        return response()->json([
            'message' => 'Registration updated successfully!',
            'registration' => $registration
        ]);
    }

    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return response()->json([
            'message' => 'Registration deleted successfully!'
        ]);
    }

    private function sendConfirmationEmail($registration, $item)
    {
        // This is a basic implementation
        // You can expand this to use proper mail templates
        $details = [
            'name' => $registration->full_name,
            'email' => $registration->email,
            'type' => $registration->type,
            'item_title' => $item->title,
            'registration_id' => $registration->id,
        ];

        // You would need to create a proper mail class for this
        // Mail::to($registration->email)->send(new RegistrationConfirmationMail($details));
    }
}