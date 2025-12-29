<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'amount', 
        'payment_method', 'payment_status', 'transaction_id', 
        'message', 'is_anonymous'
    ];
}
