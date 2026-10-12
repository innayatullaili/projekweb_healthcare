<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Doctor profile not found');
        }

        // Count appointments for today that are actually booked (paid or has schedule_id)
        $todayAppointments = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('date', today())
            ->where(function($q) {
                $q->where('payment_status', 'paid')
                  ->orWhereNotNull('schedule_id');
            })
            ->count();

        // Chart Data: Last 7 Days
        $appointments = Appointment::selectRaw('DATE(date) as date, count(*) as count')
            ->where('doctor_id', $doctor->id)
            ->where('date', '>=', now()->subDays(6)->startOfDay())
            ->whereIn('status', ['confirmed', 'completed', 'scheduled']) // Only valid appointments
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $record = $appointments->firstWhere('date', $date);
            
            $labels[] = now()->subDays($i)->isoFormat('dddd');
            $data[] = $record ? $record->count : 0;
        }

        return view('doctor.dashboard', compact('doctor', 'todayAppointments', 'labels', 'data'));
    }
}
