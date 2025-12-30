<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'item_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'age',
        'message',
        'emergency_contact_name',
        'emergency_contact_phone',
        'address_street',
        'address_city',
        'address_state',
        'address_postal_code',
        'address_country',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['full_name', 'full_address'];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullAddressAttribute()
    {
        $addressParts = array_filter([
            $this->address_street,
            $this->address_city,
            $this->address_state,
            $this->address_postal_code,
            $this->address_country
        ]);
        
        return !empty($addressParts) ? implode(', ', $addressParts) : null;
    }

    // Polymorphic relationship to get the associated program or event
    public function registrable()
    {
        if ($this->type === 'program') {
            return $this->belongsTo(Program::class, 'item_id');
        } elseif ($this->type === 'event') {
            return $this->belongsTo(Event::class, 'item_id');
        }
        
        return null;
    }

    // Get the program if type is program
    public function program()
    {
        return $this->belongsTo(Program::class, 'item_id')->where('type', 'program');
    }

    // Get the event if type is event
    public function event()
    {
        return $this->belongsTo(Event::class, 'item_id')->where('type', 'event');
    }

    // Scope for filtering by type
    public function scopeForPrograms($query)
    {
        return $query->where('type', 'program');
    }

    public function scopeForEvents($query)
    {
        return $query->where('type', 'event');
    }

    // Scope for filtering by status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}