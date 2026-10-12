<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelemedicineSession extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'appointment_id',
        'meet_link',
        'duration_minutes',
        'status',
    ];

    // Relasi dengan Appointment (1:1)
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}