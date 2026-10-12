<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'title',
        'message',
        'sent_date',
        'is_read',
    ];

    protected $casts = [
        'sent_date' => 'datetime',
        'is_read' => 'boolean',
    ];

    // Relasi dengan Patient (N:1)
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relasi dengan Doctor (N:1)
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}