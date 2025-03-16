<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'itinerary_id',
        'name',
        'lodging',
        'places_to_visit',
    ];

    protected $casts = [
        'places_to_visit' => 'array',
    ];

    public function Itineraire()
    {
        return $this->belongsTo(Itineraire::class);
    }
}
