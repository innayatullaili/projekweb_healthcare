<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class TelemedicineController extends Controller
{
    public function store(Request $request, Appointment $appointment)
    {
        $request->validate([
            'meet_link' => 'required|url',
        ]);

        // 1. Create or Update Telemedicine Session
        \App\Models\TelemedicineSession::updateOrCreate(
            ['appointment_id' => $appointment->id],
            [
                'meet_link' => $request->meet_link,
                'status' => 'Waiting'
            ]
        );

        // 2. Create Notification for Patient
        \App\Models\Notification::create([
            'patient_id' => $appointment->patient_id,
            'doctor_id' => auth()->user()->doctor->id,
            'title' => 'Link Telemedicine Zoom',
            'message' => 'Dokter ' . auth()->user()->name . ' telah mengirim link Zoom untuk konsultasi Anda. Klik link ini: ' . $request->meet_link,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Link Zoom berhasil dikirim ke pasien.');
    }
}
