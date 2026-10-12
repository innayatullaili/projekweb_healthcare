<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the patient's notifications.
     */
    public function index()
    {
        $patientId = auth()->user()->patient->id;

        $notifications = Notification::where('patient_id', $patientId)
            ->latest()
            ->paginate(10);
            
        // Mark unread notifications as read
        Notification::where('patient_id', $patientId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('patient.notifications.index', compact('notifications'));
    }
}